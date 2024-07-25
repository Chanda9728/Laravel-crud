<?php

namespace App\Http\Controllers;

use App\Imports\ContactsImport;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Exceptions\LaravelExcelException;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'name' => 'required|string|max:25',
            'image'=>'required|mimes:jpeg,jpg',
            'phone' => ['required', 'regex:/^\+\d{1,3}\s?[-]?\(?\d{3}\)?\s?\d{3}[-]?\d{4}$/'],
            'email' => 'required|email|unique:contacts',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|in:CA,NY,AT',
            'country' => 'required|in:IN,US,EU',
        ]);
        // dd($request->all());
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = 'image_' . time() . '.' . $extension;
            $request->file('image')->move(public_path('admin/image'), $filename);
            $data['image'] = 'admin/image/' . $filename;
        }
        Contact::create($data);

        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $data = $request->all();
        $request->validate([
            'name' => 'required|string|max:25',
            'image'=>'nullable|mimes:jpeg,jpg',
            'phone' => ['required', 'regex:/^\+\d{1,3}\s?[-]?\(?\d{3}\)?\s?\d{3}[-]?\d{4}$/'],
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|in:CA,NY,AT',
            'country' => 'required|in:IN,US,EU',
        ]);
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = 'image_' . time() . '.' . $extension;
            $request->file('image')->move(public_path('admin/image'), $filename);
            $data['image'] = 'admin/image/' . $filename;
            if ($contact['image']) {
                @unlink($contact['image']);
            }
        }

        $contact->update($data);

        return redirect()->route('contacts.index')
            ->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        if ($contact['image']) {
            @unlink($contact['image']);
        }
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }

    public function import(Request $request)
    {
        try {
            // Import the file
            Excel::import(new ContactsImport, $request->file('file'));

            // Debugging: You can remove this after confirming it works
            Log::info('File imported successfully', ['file' => $request->file('file')->getClientOriginalName()]);

            return Redirect::to('contacts')->with('success', 'Contacts imported successfully.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            Log::error('Validation error during import', ['failures' => $failures]);
            return Redirect::back()->with('error', 'Error importing contacts: validation failed. Check the log for details.');
        } catch (\Exception $e) {
            Log::error('Unexpected error during import', ['exception' => $e]);
            return Redirect::back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }

    public function importView()
    {
        return view('contacts.import');
    }
}
