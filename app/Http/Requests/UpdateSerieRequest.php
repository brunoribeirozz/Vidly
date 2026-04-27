<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSerieRequest extends FormRequest
{
public function authorize(): bool
{
    return true; // repeti o processo no StoreFormRequest
}

public function rules(): array
{
    return [
        'name' => ['required', 'min:3', 'max:255'],
        'description' => ['nullable'],
        'thumbnail' => ['nullable', 'url'],
    ];
    }
}
