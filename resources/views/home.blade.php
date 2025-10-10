@extends('layouts.app')

@section('content')
    
    <x-breadcrumb></x-breadcrumb>

    <x-card>
        <x-slot:title>Hello, {{ auth()->user()->name }}</x-slot:title>

        <form action="{{ route('home.upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <x-input class="col-6 mb-3" name="upload" label="File Test" type="file"></x-input>
            <button class="btn btn-outline-primary">Upload</button>
        </form>
    </x-card>
@endsection
