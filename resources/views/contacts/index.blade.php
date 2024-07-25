@extends('layouts.app')

@section('content')
<div class="container">
    <div class="box">
        <h1>Contacts</h1>
        <div>
            <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add Contact</a>
            <a href="{{ route('import') }}" class="btn btn-primary">Import Contact</a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>
                @if ($contact->image)
                <img src="{{ asset($contact->image) }}" style="width: 50px; height: 50px;" alt="Contact Image">
                @else
               
                @endif
                </td>

                <td>{{ $contact->name }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->email }}</td>
                <td>
                    <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection