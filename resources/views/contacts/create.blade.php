@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Contact</h1>
        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf
            @include('contacts.form')
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
