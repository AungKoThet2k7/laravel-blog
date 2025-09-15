@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Manage Category</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Category</li>
        </ol>
    </nav>
    <div class="card bg-white">
        <div class="card-body">
            <h4>Create Category</h4>
            <hr>
            <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-9">
                        <input type="text" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" name="title"
                            placeholder="Category Title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
