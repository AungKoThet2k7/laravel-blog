@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manage User</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4>Manage User</h4>
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
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Control</th>
                        <th scope="col">Created_at</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>
                                {{ $user->name }}
                                <br>
                                <span class="badge bg-info">{{ $user->role }}</span>
                            </td>
                            <td class="text-nowrap">
                                {{ $user->email }}
                            </td>
                            <td class="text-nowrap text-center">
                                <a class="btn btn-sm btn-outline-dark" href="{{ route('user.show', $user->id) }}"><i
                                        class="bi bi-info-circle"></i></a>
                                @can('update', $user)
                                    <a class="btn btn-sm btn-outline-dark" href="{{ route('user.edit', $user->id) }}"><i
                                            class="bi bi-pencil"></i></a>
                                @endcan

                                @can('delete', $user)
                                    <form action="{{ route('user.destroy', $user->id) }}" class="d-inline-block"
                                        method="user">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-dark"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
                                @endcan

                            </td>
                            <td>
                                <p class="text-sm mb-0 text-nowrap"><i class="bi bi-calendar"></i>
                                    {{ $user->created_at->format('d M Y') }}</p>
                                <p class="text-sm mb-0"><i class="bi bi-clock"></i>
                                    {{ $user->created_at->format('g : m A') }}</p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No user Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="">{{ $users->onEachSide(1)->links() }}</div>
        </div>
    </div>
@endsection
