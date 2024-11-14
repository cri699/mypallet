<?php

namespace App\Models;

use App\Enums\TransportType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class TransportUnit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => TransportType::from($value),
            set: fn ($value) => $value instanceof TransportType ? $value->value : TransportType::from($value)->value
        );
    }
}
