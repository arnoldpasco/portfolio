<?php

// Validates the contact form fields before the controller runs.

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
{
    // Anyone visiting the site may send a message
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            // Honeypot: not validated here; the controller checks it so bots get a fake success
            'website' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'message.min' => 'Please write at least a few words so I know how to help.',
        ];
    }
}
