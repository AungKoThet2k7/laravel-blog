@extends('layouts.app')

@section('content')
    <x-breadcrumb :links="$links"/>

    <x-card>

        <x-slot:title>Create Post</x-slot:title>

        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">

                <x-input class="col-6" name="title" label="Title" />

                <div class="col-6">
                    <label class="form-label" for="category">Category</label>
                    <select name="category" id="category" class="form-select">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <x-input class="mb-3" multiple="true" name="photos" label="Post Photo" type="file"/>
            {{-- <div class="mb-3">


                <label for="photos" class="form-label">Post Photo</label>
                <input name="photos[]" id="photos" multiple
                    class="form-control @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror"
                    type="file">

                @error('photos')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @error('photos.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> --}}

            <div class="mb-3">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="7">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 d-flex justify-content-between align-items-end">

                <x-input name="featured_image" label="Featured Image" type="file"/>

                <button class="btn btn-primary">Create</button>
            </div>

        </form>

    </x-card>
@endsection
