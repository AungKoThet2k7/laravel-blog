@extends('layouts.app')

@section('content')
    <x-breadcrumb :links="$links" />

    <x-card>
        <x-slot:title>Create Category</x-slot:title>
        <form action="{{ route('category.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-9">
                    <input type="text" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror"
                        name="title" placeholder="Category Title">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-3">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </x-card>
@endsection
