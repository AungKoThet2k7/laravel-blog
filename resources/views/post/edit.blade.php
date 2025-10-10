@extends('layouts.app')

@section('content')

    <x-breadcrumb :links="$links"/>

    <x-card>

        <x-slot:title>Edit Post</x-slot:title>

        <form id="postUpdateForm" action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        </form>

        <div class="row mb-3">

            <x-input class="col-6" name="title" label="Title" default="{{ $post->title }}" form="postUpdateForm" />

            {{-- <div class="col-6">
                <label class="form-label" for="title">Title</label>
                <input form="postUpdateForm" name="title" id="title" value="{{ old('title', $post->title) }}"
                    class="form-control @error('title') is-invalid @enderror" type="text">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> --}}

            <div class="col-6">
                <label class="form-label" for="category">Category</label>
                <select form="postUpdateForm" name="category" id="category" class="form-select">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="">
            <div class="mb-3">
                <label for="photos" class="form-label">Post Photo</label>
                <input form="postUpdateForm" name="photos[]" id="photos" multiple
                    class="form-control @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror"
                    type="file">

                @error('photos')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @error('photos.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @foreach ($post->photos as $photo)
                <div class="d-inline-block position-relative me-2 mb-3">
                    <img class="rounded" height="100" src="{{ asset('storage/500/' . $photo->name) }}" alt="">
                    <form class="" action="{{ route('photo.destroy', $photo->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger position-absolute bottom-0 end-0 z-index-10">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea form="postUpdateForm" class="form-control @error('description') is-invalid @enderror" name="description"
                id="description" rows="7">{{ old('description', $post->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 d-flex justify-content-between align-items-end">

            <div class="d-flex gap-3">

                @isset($post->featured_image)
                    <img class="rounded" height="70" src="{{ asset('storage/500/' . $post->featured_image) }}" alt="">
                @endisset

                <div class="">
                    <label for="featured_image" class="form-label">Featured Image
                        {{ old('featured_image') }}</label>
                    <input form="postUpdateForm" name="featured_image" id="featured_image"
                        class="form-control @error('featured_image') is-invalid @enderror" type="file">
                    @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <button type="submit" class="btn btn-primary" form="postUpdateForm">Update</button>

        </div>

    </x-card>
@endsection
