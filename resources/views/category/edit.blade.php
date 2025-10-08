@extends('layouts.app')

@section('content')

    <x-breadcrumb :links="$links"/>

    <x-card>
        <x-slot:title>Edit Category</x-slot:title>
        <form action="{{ route('category.update', $category->id) }}" method="post">
                @csrf
                @method("PUT")
                <div class="row">
                    <div class="col-9">
                        <input type="text" value="{{old('title', $category->title)}}" class="form-control @error('title') is-invalid @enderror" name="title"
                            placeholder="Category Title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
    </x-card>
@endsection
