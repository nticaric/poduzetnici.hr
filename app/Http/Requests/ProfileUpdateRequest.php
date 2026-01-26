<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isCompany = $this->user()->account_type === 'company';

        $rules = [
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'preferred_contact_method' => ['nullable', 'string', 'in:email,phone,platform'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'is_public' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string', 'max:1000'],
            'address' => ['nullable', 'string', 'max:255'],
            'web' => ['nullable', 'url', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
        ];

        if ($isCompany) {
            $rules['company_name'] = ['nullable', 'string', 'max:255'];
            $rules['oib'] = ['nullable', 'string', 'max:11'];
        } else {
            $rules['firstname'] = ['nullable', 'string', 'max:255'];
            $rules['lastname'] = ['nullable', 'string', 'max:255'];
        }

        return $rules;
    }
}
