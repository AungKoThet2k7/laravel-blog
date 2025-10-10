@extends('layouts.app')

@section('content')
    <x-breadcrumb :links="$links" />

    <x-card>
        <x-slot:title>{{ $post->title }}</x-slot:title>

        <div class="mb-3">

            <span class="badge bg-info">
                <i class="bi bi-grid"></i>
                {{ $post->category->title }}
            </span>

            <span class="badge bg-info">
                <i class="bi bi-person"></i>
                {{ $post->user->name }}
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
            <img class="me-4 w-50 rounded float-start" src="{{ asset('storage/500/' . $post->featured_image) }}" alt="">
        @endisset
        <p class=" text-justify" style="white-space: pre-wrap">{{ $post->description }}</p>

        <hr>

        @foreach ($post->photos as $photo)
            <img class="rounded me-3 mb-3" height="100" src="{{ asset('storage/500/' . $photo->name) }}" alt="">
        @endforeach

        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('post.create') }}" class="btn btn-outline-primary">Create New Post</a>
            <a href="{{ route('post.index') }}" class="btn btn-primary">All Posts</a>
        </div>
    </x-card>
@endsection
