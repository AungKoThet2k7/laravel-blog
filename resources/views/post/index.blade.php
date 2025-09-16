@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manage Post</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4>Manage Post</h4>
            <hr>

            <div class="d-flex mb-3 justify-content-between align-items-center">
                <div class="d-flex align-items-center mb-0">
                    @if (request()->has('s'))
                        <p class="mb-0 me-2">Search By : " <span>{{ request('s') }}</span> "</p>
                        <a href="{{ route('post.index') }}" class="mb-0 text-primary">
                            <i class="bi bi-trash"></i>
                        </a>
                    @endif

                </div>
                <form action="{{ route('post.index') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="s" placeholder="Search ...">
                        <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Owner</th>
                        <th scope="col">Control</th>
                        <th scope="col">Created_at</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>
                                {{ $post->title }}
                            </td>
                            <td class="text-nowrap">
                                {{ App\Models\Category::find($post->category_id)->title }}
                            </td>
                            <td>
                                {{ App\Models\User::find($post->user_id)->name }}
                            </td>
                            <td class="text-nowrap">
                                <a class="btn btn-sm btn-outline-dark" href="{{ route('post.show', $post->id) }}"><i
                                        class="bi bi-info-circle"></i></a>
                                <a class="btn btn-sm btn-outline-dark" href="{{ route('post.edit', $post->id) }}"><i
                                        class="bi bi-pencil"></i></a>
                                <form action="{{ route('post.destroy', $post->id) }}" class="d-inline-block"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-dark"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                            </td>
                            <td>
                                <p class="text-sm mb-0 text-nowrap"><i class="bi bi-calendar"></i>
                                    {{ $post->created_at->format('d M Y') }}</p>
                                <p class="text-sm mb-0"><i class="bi bi-clock"></i>
                                    {{ $post->created_at->format('g : m A') }}</p>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Post Found</td>
                            </tr>
                    @endforelse 
                </tbody>
            </table>
            <div class="">{{ $posts->onEachSide(1)->links() }}</div>
        </div>
    </div>
@endsection
