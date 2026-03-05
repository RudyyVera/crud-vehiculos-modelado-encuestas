<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;

class VehiculoController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $vehiculos = Vehicle::with('client')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('plate', 'like', '%' . $search . '%')
                        ->orWhereHas('client', function ($clientQuery) use ($search) {
                            $clientQuery->where('document_number', 'like', '%' . $search . '%');
                        });
                });
            })
            ->orderByDesc('id')
            ->paginate(5)
            ->withQueryString();

        return view('vehiculos.index', compact('vehiculos', 'search'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $validated = $validator->validated();

            DB::transaction(function () use ($validated) {
                $client = $this->resolveClientFromPayload($validated);

                $client->vehicles()->create([
                    'plate' => $validated['placa'],
                    'brand' => $validated['marca'],
                    'model' => $validated['modelo'],
                    'manufacturing_year' => (int) $validated['anio_fabricacion'],
                ]);
            });

            return redirect()
                ->route('vehiculos.index')
                ->with('success', '¡Vehículo y Cliente registrados con éxito!');
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        } catch (Throwable $exception) {
            return $this->processingErrorResponse();
        }
    }

    public function update(Request $request, Vehicle $vehiculo)
    {
        $validator = Validator::make($request->all(), $this->rules($vehiculo->id));

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $vehiculo->loadMissing('client');

            $validated = $validator->validated();

            DB::transaction(function () use ($validated, $vehiculo) {
                $client = $this->resolveClientFromPayload($validated);

                $vehiculo->update([
                    'plate' => $validated['placa'],
                    'brand' => $validated['marca'],
                    'model' => $validated['modelo'],
                    'manufacturing_year' => (int) $validated['anio_fabricacion'],
                    'client_id' => $client->id,
                ]);
            });

            return redirect()
                ->route('vehiculos.index')
                ->with('success', 'Vehículo actualizado con éxito');
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        } catch (Throwable $exception) {
            return $this->processingErrorResponse();
        }
    }

    private function rules(?int $vehicleId = null): array
    {
        $plateRule = Rule::unique('vehicles', 'plate');

        if ($vehicleId !== null) {
            $plateRule = $plateRule->ignore($vehicleId);
        }

        return [
            'placa' => ['required', 'string', 'min:6', 'max:15', 'regex:/^[A-Za-z0-9-]+$/', $plateRule],
            'marca' => ['required', 'string', 'min:2', 'max:50', 'regex:/^[\pL\pN\s\-\.]+$/u'],
            'modelo' => ['required', 'string', 'max:255', 'min:2', 'max:100', 'regex:/^[\pL\pN\s\-\.]+$/u'],
            'anio_fabricacion' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'nombre_cliente' => ['required', 'string', 'max:255', 'min:2', 'max:150', 'regex:/^[\pL\s\-\']+$/u'],
            'apellidos_cliente' => ['required', 'string', 'max:255', 'min:2', 'max:150', 'regex:/^[\pL\s\-\']+$/u'],
            'dni_cliente' => ['required', 'digits_between:8,20'],
            'correo_cliente' => ['required', 'email:rfc,dns', 'max:255', 'max:150'],
            'telefono_cliente' => ['nullable', 'string', 'min:7', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
        ];
    }

    public function destroy(Vehicle $vehiculo)
    {
        try {
            $vehiculo->delete();

            return redirect()
                ->route('vehiculos.index')
                ->with('info', 'Vehículo eliminado correctamente');
        } catch (Throwable $exception) {
            return $this->processingErrorResponse(false);
        }
    }

    private function validationErrorResponse(ValidationException $exception)
    {
        return back()->withErrors($exception->errors())->withInput();
    }

    private function processingErrorResponse(bool $withInput = true)
    {
        $response = redirect()->back();

        if ($withInput) {
            $response = $response->withInput();
        }

        return $response->with('error', 'Hubo un problema al procesar la solicitud');
    }

    private function resolveClientFromPayload(array $validated): Client
    {
        $document = $validated['dni_cliente'];
        $email = $validated['correo_cliente'];

        $byDocument = Client::where('document_number', $document)->first();
        $byEmail = Client::where('email', $email)->first();

        if ($byDocument && $byEmail && $byDocument->id !== $byEmail->id) {
            throw ValidationException::withMessages([
                'dni_cliente' => 'El DNI ya pertenece a otro cliente con diferente correo.',
                'correo_cliente' => 'El correo ya pertenece a otro cliente con diferente DNI.',
            ]);
        }

        $client = $byDocument ?? $byEmail;

        if (! $client) {
            return Client::create([
                'document_number' => $document,
                'first_name' => $validated['nombre_cliente'],
                'last_name' => $validated['apellidos_cliente'],
                'email' => $email,
                'phone' => $validated['telefono_cliente'] ?? null,
            ]);
        }

        $client->update([
            'document_number' => $document,
            'first_name' => $validated['nombre_cliente'],
            'last_name' => $validated['apellidos_cliente'],
            'email' => $email,
            'phone' => $validated['telefono_cliente'] ?? null,
        ]);

        return $client;
    }
}
