@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Manage Post</a></li>
            <li class="breadcrumb-item active" aria-current="page">Post Detail</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4>{{ $post->title }}</h4>
            <hr>
            <div class="mb-3">

                <span class="badge bg-info">
                    <i class="bi bi-bookmark"></i>
                    {{ App\Models\Category::find($post->category_id)->title }}
                </span>

                <span class="badge bg-info">
                    <i class="bi bi-person"></i>
                    {{ App\Models\User::find($post->user_id)->name }}
                </span>

                <span class="badge bg-info">
                    <i class="bi bi-calendar"></i>
                    {{ $post->created_at->format('d M Y') }}
                </span>

                <span class="badge bg-info">
                    <i class="bi bi-clock"></i>
                    {{ $post->created_at->format('g : m A') }}
                </span>

            </div>

            @isset($post->featured_image)
                <img class="mb-3 w-50 rounded " src="{{ asset('storage/' . $post->featured_image) }}" alt="">
            @endisset
            <p class="mb-3 text-justify">{{ $post->description }}</p>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('post.create') }}" class="btn btn-outline-primary">Create New Post</a>
                <a href="{{ route('post.index') }}" class="btn btn-primary">All Posts</a>
            </div>

        </div>
    </div>
@endsection
