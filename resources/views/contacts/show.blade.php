@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $contact->name }}</h1>
        <p>Phone: {{ $contact->phone }}</p>
        <p>Email: {{ $contact->email }}</p>
        <p>Address: {{ $contact->street_address }}, {{ $contact->city }}, {{ $contact->state }}, {{ $contact->country }}</p>
        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
