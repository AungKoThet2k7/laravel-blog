<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::search()
            ->latest('id')
            ->when(Auth::user()->isAuthor(), fn($q) => $q->where("user_id", Auth::id()))
            ->when(request('trash'), fn($q) => $q->onlyTrashed())
            ->paginate(10)
            ->withQueryString();

        $links = ["Manage Post" => route("post.index")];
        return view('post.index', compact('posts', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $links = ["Manage Post" => route("post.index"), "Create" => route("post.create")];
        return view('post.create', compact('links'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

        try {
            DB::beginTransaction();


            $post = new Post();

            $post->title = $request->title;
            $post->slug = Str::slug($request->title);
            $post->description = $request->description;
            $post->excerpt = Str::words($request->description, 50, ' ...');
            $post->category_id = $request->category;
            $post->user_id = Auth::id();

            if ($request->hasFile('featured_image')) {
                $newFileName = uniqid() . "_featured_image." . $request->file('featured_image')->extension();

                $image = Image::make($request->file('featured_image'));

                //Small
                $image->fit(500, 500);
                Storage::makeDirectory('public/500');
                $image->save("storage/500/$newFileName");

                // $request->file('featured_image')->storeAs('public', $newFileName);

                // Db  
                $post->featured_image = $newFileName;
            }

            $post->save();

            $savedPhotos = [];

            if ($request->hasFile('photos')) {
                foreach ($request->photos as $key => $photo) {
                    $newName = uniqid() . "_post_photo." . $photo->extension();

                    $image = Image::make($photo);

                    //Large
                    $image->resize(1000, null, fn($constraint) => $constraint->aspectRatio());
                    Storage::makeDirectory('public/1000');
                    $image->save("storage/1000/$newName");

                    //Small
                    $image->fit(500, 500);
                    Storage::makeDirectory('public/500');
                    $image->save("storage/500/$newName");

                    // $photo->storeAs('public', $newName);

                    $savedPhotos[$key] = [
                        "post_id" => $post->id,
                        "name" => $newName,
                    ];

                    // $photo = new Photo();
                    //     $photo->name = $newName;
                    //     $photo->post_id = $post->id;
                    //     $photo->save();
                }


                //Multiple insert
                Photo::insert($savedPhotos);

                DB::commit();
                return redirect()->route('post.index')->with('status', $post->title . ' has been created successfully');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        Gate::authorize("view", $post);

        $links = ["Manage Post" => route("post.index"), "Detail" => route("post.show", $post)];

        return view('post.show', compact('post', 'links'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize("update", $post);

        $links = ["Manage Post" => route("post.index"), "Edit" => route("post.edit", $post)];
        return view('post.edit', compact('post', 'links'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        Gate::authorize("update", $post);

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 50, ' ...');
        $post->category_id = $request->category;

        if ($request->hasFile('featured_image')) {

            Storage::delete('public/500/' . $post->featured_image);

            $newFileName = uniqid() . "_featured_image." . $request->file('featured_image')->extension();

            $image = Image::make($request->file('featured_image'));

            //Small
            $image->fit(500, 500);
            Storage::makeDirectory('public/500');
            $image->save("storage/500/$newFileName");

            // $request->file('featured_image')->storeAs('public', $newFileName);

            // Db
            $post->featured_image = $newFileName;
        }

        $post->update();

        if ($request->hasFile('photos')) {
            foreach ($request->photos as $photo) {
                $newName = uniqid() . "_post_photo." . $photo->extension();

                $image = Image::make($photo);

                //Large
                $image->resize(1000, null, fn($constraint) => $constraint->aspectRatio());
                Storage::makeDirectory('public/1000');
                $image->save("storage/1000/$newName");

                //Small
                $image->fit(500, 500);
                Storage::makeDirectory('public/500');
                $image->save("storage/500/$newName");

                // $photo->storeAs('public', $newName);

                $photo = new Photo();
                $photo->name = $newName;
                $photo->post_id = $post->id;
                $photo->save();
            }
        }

        return redirect()->route('post.index')->with('status', $post->title . ' has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        // return $post;
        Gate::authorize('delete', $post);
        $postTitle = $post->title;

        if (request('delete') === 'force'):

            if (isset($post->featured_image)) {
                Storage::delete('public/500/' . $post->featured_image);
            };

            // foreach ($post->photos as $photo) {

            //     // delete photo from storage
            //     Storage::delete('public/' . $photo->name);

            //     // delete photo from database
            //     // $photo->delete();
            // };

            // delete photos from storage
            Storage::delete($post->photos->map(fn($photo) => "public/500/" . $photo->name)->toArray());
            Storage::delete($post->photos->map(fn($photo) => "public/1000/" . $photo->name)->toArray());

            // delete photos from database
            Photo::where("post_id", $post->id)->delete();

            $post->forceDelete();
            $message = $postTitle . ' has been deleted successfully';

        elseif (request('delete') === 'restore'):
            $post->restore();
            $message = $postTitle . ' has been restore successfully';
        else:
            $post->delete();
            $message = $postTitle . ' is move to trash successfully';
        endif;

        return redirect()->route('post.index')->with('status', $message);
    }
}
