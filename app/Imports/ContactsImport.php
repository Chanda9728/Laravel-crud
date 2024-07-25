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
            'image' => $row[0],
            'name' => $row[1],
            'phone' => $row[2],
            'email' => $row[3],
            'street_address' => $row[4],
            'city' => $row[5],
            'state' => $row[6],
            'country' => $row[7],
            
        ]);
    }

    public function rules(): array
    {
        $rules = [
            '0' => 'required', // image
            '1' => 'required|string|max:25', // name
            // '1' => 'required|regex:/^\+\d{1,3}\s?[-]?\(?\d{3}\)?\s?\d{3}[-]?\d{4}$/', // phone
            '2' => 'required', // phone
            '3' => 'required|unique:contacts,email', // email
            '4' => 'required|string|max:255', // street_address
            '5' => 'required|string|max:255', // city
            '6' => 'required', // state
            '7' => 'required', // country
            
        ];

        return $rules;
    }

  
}
