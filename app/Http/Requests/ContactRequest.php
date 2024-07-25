<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        // Dump and die the request data to debug
        $rules = [
            'name' => 'required|string|max:25',
            'phone' => ['required', 'regex:/^\+\d{1,3}\s?\(?\d{3}\)?\s?\d{3}[-]?\d{4}$/'],
            'email' => 'required|email',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|in:CA,NY,AT',
            'country' => 'required|in:IN,US,EU',
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = 'required|mimes:jpeg,jpg';
            $rules['email'] .= '|unique:contacts';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['image'] = 'nullable|mimes:jpeg,jpg';
            $rules['email'] .= '|unique:contacts,email,' . $this->contact->id;
        }
        return $rules;
    }
}
