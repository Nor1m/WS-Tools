<?php

namespace App\Http\Requests\Tools;

use Illuminate\Foundation\Http\FormRequest;

class ServerResponseRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'url' => ['required', 'string', 'max:100']
        ];
    }
}
