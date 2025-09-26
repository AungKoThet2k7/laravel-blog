@extends('master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card my-5">
                    <div class="card-body">
                        <div class="mb-3 text-center">
                            <h3 class="mb-0 card-header">{{ $post->title }}</h3>
                            <a href="{{ route('page.category', $post->category->slug) }}">
                                <span class=" badge bg-info">{{ $post->category->title }}</span>
                            </a>
                        </div>
                        <div class="text-center">
                            @foreach ($post->photos as $photo)
                                <img class="rounded mb-3" height="100" src="{{ asset('storage/' . $photo->name) }}"
                                    alt="">
                            @endforeach
                        </div>
                        <p class="text-justify">{{ $post->description }}</p>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="">
                                <p class="mb-0 text-muted">
                                    {{ $post->user->name }}
                                </p>
                                <p class="mb-0 text-muted">
                                    {{ $post->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="">
                                <a href="{{ route('page.index') }}" class="btn btn-primary">All Post</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
