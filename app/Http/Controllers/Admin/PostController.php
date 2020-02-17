<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AdminPostCollection;
use App\Http\Resources\AdminPostResource;
use App\Http\Resources\PostResource;
use App\Enums\PostStatus;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new AdminPostCollection(Post::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->data();
        $data["cover_path"] = $this->uploadCover($request->file("cover"));
        $data["visits"] = 0;
        $post = Post::create($data);
        return new PostResource($post);
    }

    private function uploadCover(UploadedFile $file) : string
    {
        $filename = time() . "." . $file->getClientOriginalExtension();
        $file->storeAs("public/covers", $filename);
        return asset("storage/covers/". $filename);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->data();
        
        if($request->file("cover")) {
            Storage::delete("public/covers/" . $post->cover);
            $data["cover_path"] = $this->uploadCover($request->file("cover"));
        }

        $post->update($data);
        
        // return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Storage::delete("public/covers/{$post->cover}");
        return response()->json([], 204);
    }
}
