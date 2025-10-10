@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gallery</li>
        </ol>
    </nav>
    </nav>
    <div class="card bg-white">
        <div class="card-body ">
            <h4>Photo Gallery</h4>
            <hr>

            <div class="gallery">
                @forelse (Auth::user()->photos as $photo)
                    <img class="w-100 rounded mb-3" src="{{ asset('storage/500/' . $photo->name) }}" alt="">
                @empty
                    <p>No Photo</p>
                @endforelse
            </div>

        </div>
    </div>
@endsection
