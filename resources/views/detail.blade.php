@extends('templates.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9">
                <div class="card my-5">
                    <div class="card-body">
                        <div class="text-center">
                            <h3 class="mb-0 card-header">{{ $post->title }}</h3>
                            <a href="{{ route('page.category', $post->category->slug) }}">
                                <span class="my-1 badge bg-info">{{ $post->category->title }}</span>
                            </a>
                        </div>
                        <div class="text-center">
                            @if ($post->photos->count())
                                <div id="carouselExample" class="carousel slide">
                                    <div class="carousel-inner">
                                        @foreach ($post->photos as $key => $photo)
                                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                <a class="my-image-links" data-gall="gallery01"
                                                    href="{{ asset('storage/1000/' . $photo->name) }}"><img
                                                        class="rounded mb-3 post-detail-img"    
                                                        src="{{ asset('storage/500/' . $photo->name) }}" alt="">
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
                                <a href="{{ route('page.postPdf', $post->slug) }}" class="btn btn-primary"><i class="bi bi-file-pdf"></i></a>
                                <a href="{{ route('page.index') }}" class="btn btn-primary">All Post</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="my-5">
                    <div class="list-group">
                        <h3 class="text-center mt-2">Recent Posts</h3>
                        @foreach ($recentPosts as $recentPost)
                        <a class="list-group-item list-group-item-action {{ $recentPost->id === $post->id ? 'active' : '' }}" href="{{ route('page.detail', $recentPost->slug) }}" >{{ $recentPost->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
