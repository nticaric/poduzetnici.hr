<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $company = $this->route('company');

        return $company && $company->userCanManage($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $company = $this->route('company');

        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:company,craft'],
            'oib' => ['required', 'string', 'size:11', Rule::unique('companies', 'oib')->ignore($company->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:1000'],
            'address' => ['nullable', 'string', 'max:255'],
            'web' => ['nullable', 'url', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('companies', 'slug')->ignore($company->id)],
            'is_public' => ['nullable', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Naziv tvrtke je obavezan.',
            'type.required' => 'Vrsta tvrtke je obavezna.',
            'type.in' => 'Vrsta tvrtke mora biti tvrtka ili obrt.',
            'oib.required' => 'OIB je obavezan.',
            'oib.size' => 'OIB mora imati točno 11 znakova.',
            'oib.unique' => 'Tvrtka s ovim OIB-om već postoji.',
            'slug.unique' => 'Ovaj slug je već zauzet.',
        ];
    }
}
