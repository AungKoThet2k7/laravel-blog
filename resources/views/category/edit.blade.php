@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Manage Category</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
        </ol>
    </nav>
    <div class="card bg-white">
        <div class="card-body">
            <h4>Edit Category</h4>
            <hr>
            <form action="{{ route('category.update', $category->id) }}" method="post">
                @csrf
                @method("PUT")
                <div class="row">
                    <div class="col-9">
                        <input type="text" value="{{old('title', $category->title)}}" class="form-control @error('title') is-invalid @enderror" name="title"
                            placeholder="Category Title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
