@extends('templates.master')
@section('content')
    <div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                @if (request()->has('s') || isset($category))
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-1">
                            @isset($category)
                                <p class="mb-0"><span>Filter by : </span>{{ $category->title }}</p>
                            @endisset
                            @if (request()->has('s'))
                                <p class="mb-0"><span>Search by : </span>{{ request('s') }}</p>
                            @endif
                        </div>
                        <a href="{{ route('page.index') }}" class="btn btn-outline-info">See All Posts</a>
                    </div>
                @endif

                @forelse ($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-1 card-header">
                                <h3 class="mb-0">{{ $post->title }}</h3>
                                <a class="mb-0" href="{{ route('page.category', $post->category->slug) }}">
                                    <span class="mb-0 badge bg-info">{{ $post->category->title }}</span>
                                </a>
                            </div>
                            <p>{{ $post->excerpt }}</p>
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
                                    <a href="{{ route('page.detail', $post->slug) }}" class="btn btn-primary">See more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                    <div class="card">
                        <div class="card-body">
                            <p>There is No Post Yet !</p>
                        </div>
                    </div>
                @endforelse

                <div>
                    {{ $posts->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
