@extends('layout')

@section('title', 'Listado de Vehiculos')

@section('styles')
    <style>
        :root {
            --bg-soft: #f4f7fb;
            --bg-card: #ffffff;
            --text-main: #111827;
            --text-soft: #6b7280;
            --line-soft: #e7edf5;
        }

        body {
            color: var(--text-main);
            background: radial-gradient(circle at top right, #ebf1ff 0%, var(--bg-soft) 44%, #f8fafc 100%);
            min-height: 100vh;
        }

        .dashboard-card {
            background: var(--bg-card);
            border: 0;
            border-radius: 20px;
            box-shadow: 0 16px 34px rgba(15, 23, 42, 0.08);
        }

        .card-header-clean {
            border-bottom: 1px solid var(--line-soft);
            background: transparent;
            padding: 1.15rem 1.35rem;
        }

        .muted-subtitle {
            color: var(--text-soft);
            font-size: 0.92rem;
        }

        .table-clean {
            margin-bottom: 0;
        }

        .table-clean thead th {
            font-size: 0.79rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: 0;
            white-space: nowrap;
            color: #f8fafc;
            vertical-align: middle;
        }

        .table-clean tbody td {
            border: 0;
            border-bottom: 1px solid var(--line-soft);
            padding-top: 0.82rem;
            padding-bottom: 0.82rem;
            vertical-align: middle;
        }

        .table-clean tbody tr:last-child td {
            border-bottom: 0;
        }

        .table-wrap {
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid #e9eff7;
            background: #ffffff;
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #dbeafe;
            object-fit: cover;
        }

        .avatar-fallback {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #eef2ff;
            color: #4338ca;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #e0e7ff;
        }

        .placa-chip {
            display: inline-block;
            padding: 0.34rem 0.62rem;
            border-radius: 999px;
            font-weight: 600;
            letter-spacing: 0.02em;
            background: #eff6ff;
            color: #1d4ed8;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.4rem;
            white-space: nowrap;
        }

        .btn-action {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid transparent;
            transition: transform 0.18s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }

        .btn-action i {
            font-size: 0.82rem;
            line-height: 1;
        }

        .btn-view {
            background: linear-gradient(180deg, #ecfdf3 0%, #dcfce7 100%);
            border-color: #bbf7d0;
            color: #15803d;
        }

        .btn-edit {
            background: linear-gradient(180deg, #fefce8 0%, #fef9c3 100%);
            border-color: #fde68a;
            color: #a16207;
        }

        .btn-delete {
            background: linear-gradient(180deg, #fff1f2 0%, #ffe4e6 100%);
            border-color: #fecdd3;
            color: #be123c;
        }

        .btn-action:hover {
            transform: translateY(-1px);
            filter: brightness(0.98);
            box-shadow: 0 6px 12px rgba(15, 23, 42, 0.12);
        }

        .col-id {
            white-space: nowrap;
        }

        .col-anio {
            width: 7%;
        }

        .col-correo {
            width: 18%;
        }

        .col-acciones {
            width: 10%;
            text-align: right;
        }

        .celda-compacta {
            max-width: 120px; /* Un ancho pequeno y fijo */
            white-space: nowrap; /* Evita que el texto salte a otra linea */
            overflow: hidden; /* Esconde lo que sobra */
            text-overflow: ellipsis; /* Pone los puntos suspensivos ... */
        }

        .modal-content {
            border-radius: 15px;
            border: 0;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.10);
        }

        .modal-header {
            border-bottom-color: #eef2f7;
            padding: 0.55rem 0.85rem;
        }

        .modal-footer {
            border-top-color: #eef2f7;
            padding: 0.55rem 0.85rem;
        }

        .modal-body-compact {
            padding: 0.5rem;
        }

        .form-section-card {
            border: 1px solid #ecf1f7;
            background: #f8fafd;
            border-radius: 12px;
            padding: 0.55rem;
        }

        .form-section-title {
            font-size: 0.66rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #9ca3af;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .form-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 0.2rem;
        }

        .form-control {
            border-radius: 10px;
            border-color: #dfe6f2;
            font-size: 0.82rem;
        }

        .form-select {
            border-radius: 10px;
            border-color: #dfe6f2;
            font-size: 0.82rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.16rem rgba(13, 110, 253, 0.18);
        }

        .input-group-text {
            border-color: #dfe6f2;
            background: #f8faff;
            color: #6b7280;
            font-size: 0.8rem;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .form-control.is-invalid {
            border-color: #f0a9b2;
            box-shadow: 0 0 0 0.1rem rgba(220, 53, 69, 0.08);
        }

        .invalid-feedback {
            display: block;
            font-size: 0.7rem;
            margin-top: 0.15rem;
        }

        .btn-modal-cancel {
            color: #6b7280;
        }
    </style>
@endsection

@section('content')
<div class="container py-5">
    <div class="card dashboard-card shadow-sm">
        <div class="card-header card-header-clean d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="h5 mb-1">Listado de Vehiculos</h1>
                <p class="mb-0 muted-subtitle">Panel principal de registros de clientes y vehiculos.</p>
            </div>
            <button type="button" class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#modalNuevoVehiculo">
                <i class="fa-solid fa-plus me-1"></i>Nuevo Vehiculo
            </button>
        </div>

        <div class="card-body">
            <form method="GET" action="{{ route('vehiculos.index') }}" class="row g-2 align-items-center mb-3">
                <div class="col-md-5">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        class="form-control form-control-sm"
                        placeholder="Buscar por Placa o DNI"
                    >
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-sm btn-primary">Buscar</button>
                </div>
                @if(!empty($search))
                    <div class="col-auto">
                        <a href="{{ route('vehiculos.index') }}" class="btn btn-sm btn-outline-secondary">Limpiar</a>
                    </div>
                @endif
            </form>

            <div class="table-wrap">
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-clean align-middle">
                        <thead class="table-dark">
                        <tr>
                            <th class="col-id">ID</th>
                            <th>Placa</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th class="col-anio">Año</th>
                            <th>Cliente</th>
                            <th>DNI</th>
                            <th class="col-correo">Correo</th>
                            <th>Telefono</th>
                            <th class="col-acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($vehiculos as $vehiculo)
                            <tr>
                                <td>{{ $vehiculo->id }}</td>
                                <td><span class="placa-chip">{{ $vehiculo->plate }}</span></td>
                                <td>{{ $vehiculo->brand }}</td>
                                <td class="celda-compacta" title="{{ $vehiculo->model }}">{{ $vehiculo->model }}</td>
                                <td>{{ $vehiculo->manufacturing_year }}</td>
                                <td>{{ optional($vehiculo->client)->first_name }} {{ optional($vehiculo->client)->last_name }}</td>
                                <td>{{ optional($vehiculo->client)->document_number }}</td>
                                <td class="celda-compacta" title="{{ optional($vehiculo->client)->email }}">{{ optional($vehiculo->client)->email }}</td>
                                <td>{{ optional($vehiculo->client)->phone }}</td>
                                <td class="text-end">
                                    <div class="actions">
                                        <button type="button" class="btn btn-action btn-view" title="Ver detalle" data-tooltip="true" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modalVerVehiculo{{ $vehiculo->id }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-action btn-edit" title="Editar Registro" data-tooltip="true" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modalEditarVehiculo{{ $vehiculo->id }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <form id="form-eliminar-{{ $vehiculo->id }}" action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST" class="d-inline-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-action btn-delete" title="Eliminar" data-tooltip="true" data-bs-placement="top" onclick="confirmarEliminacion({{ $vehiculo->id }})">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-4">No hay registros en la tabla vehiculos.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-end">
                {{ $vehiculos->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalNuevoVehiculo" tabindex="-1" aria-labelledby="modalNuevoVehiculoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNuevoVehiculoLabel">Nuevo Vehiculo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="{{ route('vehiculos.store') }}" method="POST">
                @csrf
                <div class="modal-body modal-body-compact p-2">
                    <div class="row g-2">
                        <div class="col-12">
                            <div class="form-section-card">
                                <div class="form-section-title mb-1">Informacion del Vehiculo</div>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label class="form-label small" for="placa">Placa</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                            <input class="form-control" type="text" id="placa" name="placa" placeholder="ABC-123" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small" for="marca">Marca</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text"><i class="fa-solid fa-car-side"></i></span>
                                            <select class="form-select" id="marca" name="marca" required>
                                                <option value="" selected disabled>Selecciona una marca</option>
                                                <option value="Toyota">Toyota</option>
                                                <option value="Nissan">Nissan</option>
                                                <option value="Chevrolet">Chevrolet</option>
                                                <option value="Mazda">Mazda</option>
                                                <option value="Suzuki">Suzuki</option>
                                                <option value="Hyundai">Hyundai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small" for="modelo">Modelo</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text"><i class="fa-solid fa-car"></i></span>
                                            <input class="form-control" type="text" id="modelo" name="modelo" placeholder="Corolla" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small" for="anio_fabricacion">Año</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text"><i class="fa-regular fa-calendar"></i></span>
                                            <input class="form-control" type="number" id="anio_fabricacion" name="anio_fabricacion" placeholder="2024" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-section-card">
                                <div class="form-section-title mb-1">Informacion del Propietario</div>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label class="form-label small" for="nombre_cliente">Nombre</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                                            <input class="form-control" type="text" id="nombre_cliente" name="nombre_cliente" placeholder="Carlos" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small" for="apellidos_cliente">Apellidos</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text"><i class="fa-regular fa-id-badge"></i></span>
                                            <input class="form-control" type="text" id="apellidos_cliente" name="apellidos_cliente" placeholder="Perez Gomez" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small" for="dni_cliente">DNI</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                                            <input class="form-control" type="text" id="dni_cliente" name="dni_cliente" maxlength="8" placeholder="12345678" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small" for="correo_cliente">Correo</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                                            <input class="form-control" type="email" id="correo_cliente" name="correo_cliente" placeholder="cliente@correo.com" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small" for="telefono_cliente">Telefono</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                            <input class="form-control" type="text" id="telefono_cliente" name="telefono_cliente" placeholder="987654321" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light border rounded-pill btn-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-primary rounded-pill"><i class="fas fa-save me-1"></i>Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($vehiculos as $vehiculo)
    <div class="modal fade" id="modalVerVehiculo{{ $vehiculo->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalle de Vehiculo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center">
                    <span class="avatar-fallback mb-3" style="width:64px;height:64px;"><i class="fa-solid fa-car-side"></i></span>
                    <p class="mb-1"><strong>Placa:</strong> {{ $vehiculo->plate }}</p>
                    <p class="mb-1"><strong>Marca:</strong> {{ $vehiculo->brand }}</p>
                    <p class="mb-1"><strong>Modelo:</strong> {{ $vehiculo->model }}</p>
                    <p class="mb-1"><strong>Año:</strong> {{ $vehiculo->manufacturing_year }}</p>
                    <p class="mb-1"><strong>Cliente:</strong> {{ optional($vehiculo->client)->first_name }} {{ optional($vehiculo->client)->last_name }}</p>
                    <p class="mb-1"><strong>DNI:</strong> {{ optional($vehiculo->client)->document_number }}</p>
                    <p class="mb-1"><strong>Correo:</strong> {{ optional($vehiculo->client)->email }}</p>
                    <p class="mb-0"><strong>Telefono:</strong> {{ optional($vehiculo->client)->phone }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditarVehiculo{{ $vehiculo->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Vehiculo #{{ $vehiculo->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body modal-body-compact p-2">
                        <div class="row g-2">
                            <div class="col-12">
                                <div class="form-section-card">
                                    <div class="form-section-title mb-1">Informacion del Vehiculo</div>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <label class="form-label small">Placa</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                                <input class="form-control @error('placa') is-invalid @enderror" type="text" name="placa" value="{{ old('placa', $vehiculo->plate) }}" placeholder="ABC-123" required>
                                            </div>
                                            @error('placa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small">Marca</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text"><i class="fa-solid fa-car-side"></i></span>
                                                <select class="form-select @error('marca') is-invalid @enderror" name="marca" required>
                                                    @php $marcaActual = old('marca', $vehiculo->brand); @endphp
                                                    <option value="Toyota" @selected($marcaActual === 'Toyota')>Toyota</option>
                                                    <option value="Nissan" @selected($marcaActual === 'Nissan')>Nissan</option>
                                                    <option value="Chevrolet" @selected($marcaActual === 'Chevrolet')>Chevrolet</option>
                                                    <option value="Mazda" @selected($marcaActual === 'Mazda')>Mazda</option>
                                                    <option value="Suzuki" @selected($marcaActual === 'Suzuki')>Suzuki</option>
                                                    <option value="Hyundai" @selected($marcaActual === 'Hyundai')>Hyundai</option>
                                                </select>
                                            </div>
                                            @error('marca')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small">Modelo</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text"><i class="fa-solid fa-car"></i></span>
                                                <input class="form-control @error('modelo') is-invalid @enderror" type="text" name="modelo" value="{{ old('modelo', $vehiculo->model) }}" placeholder="Corolla" required>
                                            </div>
                                            @error('modelo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small">Año</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text"><i class="fa-regular fa-calendar"></i></span>
                                                <input class="form-control @error('anio_fabricacion') is-invalid @enderror" type="number" name="anio_fabricacion" value="{{ old('anio_fabricacion', $vehiculo->manufacturing_year) }}" placeholder="2024" required>
                                            </div>
                                            @error('anio_fabricacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-section-card">
                                    <div class="form-section-title mb-1">Informacion del Propietario</div>
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label class="form-label small">Nombre</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                                                <input class="form-control @error('nombre_cliente') is-invalid @enderror" type="text" name="nombre_cliente" value="{{ old('nombre_cliente', optional($vehiculo->client)->first_name) }}" placeholder="Carlos" required>
                                            </div>
                                            @error('nombre_cliente')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small">Apellidos</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text"><i class="fa-regular fa-id-badge"></i></span>
                                                <input class="form-control @error('apellidos_cliente') is-invalid @enderror" type="text" name="apellidos_cliente" value="{{ old('apellidos_cliente', optional($vehiculo->client)->last_name) }}" placeholder="Perez Gomez" required>
                                            </div>
                                            @error('apellidos_cliente')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small">DNI</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                                                <input class="form-control @error('dni_cliente') is-invalid @enderror" type="text" name="dni_cliente" value="{{ old('dni_cliente', optional($vehiculo->client)->document_number) }}" maxlength="20" placeholder="12345678" required>
                                            </div>
                                            @error('dni_cliente')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small">Correo</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                                                <input class="form-control @error('correo_cliente') is-invalid @enderror" type="email" name="correo_cliente" value="{{ old('correo_cliente', optional($vehiculo->client)->email) }}" placeholder="cliente@correo.com" required>
                                            </div>
                                            @error('correo_cliente')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small">Telefono</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                                <input class="form-control @error('telefono_cliente') is-invalid @enderror" type="text" name="telefono_cliente" value="{{ old('telefono_cliente', optional($vehiculo->client)->phone) }}" placeholder="987654321">
                                            </div>
                                            @error('telefono_cliente')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light border rounded-pill btn-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-sm btn-primary rounded-pill"><i class="fas fa-save me-1"></i>Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection

@section('scripts')
    <script>
        function confirmarEliminacion(id) {
            Swal.fire({
                title: '<strong>¿Eliminar vehículo?</strong>',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                background: '#ffffff',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#e5e7eb',
                customClass: {
                    popup: 'rounded-4',
                    confirmButton: 'text-white',
                    cancelButton: 'text-dark'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('form-eliminar-' + id);
                    if (form) {
                        form.submit();
                    }
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tooltipTriggerList = document.querySelectorAll('[data-tooltip="true"]');
            tooltipTriggerList.forEach((element) => {
                new bootstrap.Tooltip(element);
            });

            const editModals = document.querySelectorAll('[id^="modalEditarVehiculo"]');
            editModals.forEach((modalEl) => {
                modalEl.addEventListener('hidden.bs.modal', () => {
                    Swal.close();

                    const form = modalEl.querySelector('form');
                    if (!form) {
                        return;
                    }

                    form.querySelectorAll('.is-invalid').forEach((field) => {
                        field.classList.remove('is-invalid');
                    });

                    form.querySelectorAll('.invalid-feedback').forEach((feedback) => {
                        feedback.style.display = 'none';
                    });
                });
            });
        });
    </script>
@endsection
