@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Test</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4>Edit Post</h4>
            <hr>
            <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label" for="title">Title</label>
                        <input name="title" id="title" value="{{ old('title', $post->title) }}"
                            class="form-control @error('title') is-invalid @enderror" type="text">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-6">
                        <label class="form-label" for="category">Category</label>
                        <select name="category" id="category" class="form-select">
                            @foreach (App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                        rows="7">{{ old('description', $post->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 d-flex justify-content-between align-items-end">
                    <div class="">
                        <label for="featured_image" class="form-label">Featured Image {{ old('featured_image') }}</label>
                        <input name="featured_image" id="featured_image"
                            class="form-control @error('featured_image') is-invalid @enderror" type="file">
                        @error('featured_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Update</button>
                </div>

                @isset($post->featured_image)
                    <img class="rounded w-50" src="{{ asset('storage/' . $post->featured_image) }}" alt="">
                @endisset
            </form>
        </div>
    </div>
@endsection
