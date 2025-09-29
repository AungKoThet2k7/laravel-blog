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
                            @if ($post->photos->count() > 0)
                                <div id="carouselExample" class="carousel slide">
                                    <div class="carousel-inner">
                                        @foreach ($post->photos as $key => $photo)
                                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                <a class="my-image-links" data-gall="gallery01"
                                                    href="{{ asset('storage/' . $photo->name) }}"><img
                                                        class="rounded mb-3 post-detail-img"
                                                        src="{{ asset('storage/' . $photo->name) }}" alt="">
                                                </a>

                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <p class="text-justify" style="white-space: pre-wrap">{{ $post->description }}</p>
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
                                @can('update', $post)
                                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-outline-primary me-2">
                                        Edit
                                    </a>
                                @endcan
                                <a href="{{ route('page.index') }}" class="btn btn-primary">All Post</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
