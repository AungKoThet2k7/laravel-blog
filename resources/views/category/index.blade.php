@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manage Category</li>
        </ol>
    </nav>
    <div class="card bg-white">
        <div class="card-body">
            <h4>Manage Category</h4>
            <hr>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Post Count</th>
                        <th scope="col">Control</th>
                        <th scope="col">Created_at</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>
                                {{ $category->title }}
                                <br>
                                <span class="badge bg-info me-1">
                                    {{ $category->slug }}
                                </span>
                                @notAuthor
                                    <span class="badge bg-info">
                                        <i class="bi bi-person"></i>
                                        {{ $category->user->name }}
                                    </span>
                                @endnotAuthor
                            </td>
                            <td>
                                {{ $category->posts()->count() }}
                            </td>
                            <td class="text-center">
                                @can('update', $category)
                                    <a class="btn btn-sm btn-outline-dark" href="{{ route('category.edit', $category->id) }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @endcan
                                @can('delete', $category)
                                    <form action="{{ route('category.destroy', $category->id) }}" class="d-inline-block"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-dark"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
                                @endcan
                            </td>
                            <td>
                                <p class="text-sm mb-0"><i class="bi bi-calendar"></i>
                                    {{ $category->created_at->format('d M Y') }}</p>
                                <p class="text-sm mb-0"><i class="bi bi-clock"></i>
                                    {{ $category->created_at->format('g : m A') }}</p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Category Found <span><i class="bi bi-heartbreak-fill text-danger"></i></span></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection
