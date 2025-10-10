<div class="list-group mb-3">

    <a class="list-group-item list-group-item-action bg-white" href="{{ route('home') }}">
        Home
    </a>

    {{-- <a class="list-group-item list-group-item-action bg-white" href="{{ route('test') }}">
        Test
    </a> --}}

    <a class="list-group-item list-group-item-action bg-white" href="{{ route('photo.index') }}">
        Gallery
    </a>

</div>

<p class="font-weight-bold mb-1">Manage Post</p>
<div class="list-group mb-3">

    <a class="list-group-item list-group-item-action bg-white" href="{{ route('post.index') }}">
        Post List
    </a>

    <a class="list-group-item list-group-item-action bg-white" href="{{ route('post.create') }}">
        Create Post
    </a>

    <a class="list-group-item list-group-item-action bg-white" href="{{ route('post.index', ['trash' => true]) }}">
        Trash Post
    </a>

</div>

<p class="font-weight-bold mb-1">Manage Category</p>
<div class="list-group mb-3">

    <a class="list-group-item list-group-item-action bg-white" href="{{ route('category.index') }}">
        Category List
    </a>

    <a class="list-group-item list-group-item-action bg-white" href="{{ route('category.create') }}">
        Create Category
    </a>

</div>

@admin
    <p class="font-weight-bold mb-1">Manage User</p>
    <div class="list-group mb-3">

        <a class="list-group-item list-group-item-action bg-white" href="{{ route('user.index') }}">
            User List
        </a>

    </div>
@endadmin
