@extends('layouts.app')

@section('content')

    <x-breadcrumb :links="$links" />

    <x-card>

        <x-slot:title>Manage Post</x-slot:title>

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
                    @notAuthor
                        <th scope="col">Owner</th>
                    @endnotAuthor
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
                            {{ $post->category->title }}
                        </td>
                        @notAuthor
                            <td>
                                {{ $post->user->name }}
                            </td>
                        @endnotAuthor
                        <td class="text-nowrap text-center">
                            <a class="btn btn-sm btn-outline-dark" href="{{ route('post.show', $post->id) }}"><i
                                    class="bi bi-info-circle"></i></a>
                            @can('update', $post)
                                <a class="btn btn-sm btn-outline-dark" href="{{ route('post.edit', $post->id) }}"><i
                                        class="bi bi-pencil"></i></a>
                            @endcan

                            @can('delete', $post)
                                @trash
                                    {{-- Restore --}}
                                    <form action="{{ route('post.destroy', [$post->id, 'delete' => 'restore']) }}"
                                        class="d-inline-block" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-dark"><i class="bi bi-recycle"></i></button>
                                    </form>

                                    {{-- Force Delete --}}
                                    <form action="{{ route('post.destroy', [$post->id, 'delete' => 'force']) }}"
                                        class="d-inline-block" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure to delete this post forever?')"
                                            class="btn btn-sm btn-outline-dark"><i class="bi bi-trash3"></i></button>
                                    </form>
                                @else
                                    {{-- Soft Delete --}}
                                    <form action="{{ route('post.destroy', $post->id) }}" class="d-inline-block" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-dark"><i class="bi bi-trash"></i></button>
                                    </form>
                                @endtrash
                            @endcan

                        </td>
                        <td>
                            {!! $post->time !!}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Post Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="">
            {{ $posts->onEachSide(1)->links() }}
        </div>

    </x-card>

@endsection
