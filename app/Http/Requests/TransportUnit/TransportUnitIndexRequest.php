<?php

namespace App\Http\Requests\TransportUnit;

use App\Enums\TransportType;
use Illuminate\Foundation\Http\FormRequest;

class TransportUnitIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => 'string|max:255',
            'type' => ['required', 'string', 'in:' . implode(',', TransportType::values())],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
