<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'document_number',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'client_id');
    }
}
