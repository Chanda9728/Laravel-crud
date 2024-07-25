<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Facades\Log; // Import Log facade


class ContactsImport implements ToModel, WithValidation
{
    use Importable;
    private $isFirstRow = true;

    public function model(array $row)
    {
        // dd($row);
        if ($this->isFirstRow) {
            $this->isFirstRow = false;
            return null;
        }

        Log::info('Row data before validation:', $row);


        return new Contact([
            'name' => $row[0],
            'phone' => $row[1],
            'email' => $row[2],
            'street_address' => $row[3],
            'city' => $row[4],
            'state' => $row[5],
            'country' => $row[6],
        ]);
    }

    public function rules(): array
    {
        $rules = [
            '0' => 'required|string|max:25', // name
            // '1' => 'required|regex:/^\+\d{1,3}\s?[-]?\(?\d{3}\)?\s?\d{3}[-]?\d{4}$/', // phone
            '1' => 'required', // phone
            '2' => 'required|unique:contacts,email', // email
            '3' => 'required|string|max:255', // street_address
            '4' => 'required|string|max:255', // city
            '5' => 'required', // state
            '6' => 'required', // country
        ];

        return $rules;
    }

  
}
