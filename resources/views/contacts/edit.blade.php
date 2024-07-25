@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Contact</h1>
        <form action="{{ route('contacts.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('contacts.form', ['contact' => $contact])
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
