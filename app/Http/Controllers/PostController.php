<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Post;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();

        return view('post-list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'        => 'required|string|max:40',
                'description' => 'required|string|min:2|max:255',
                'image'       => 'nullable|mimes:jpg,png,jpeg,gif,pdf|max:10240'
            ]
        );

        try {

            $post = Post::create(
                [
                    'user_id'     => Auth::user()->id,
                    'name'        => request('name'),
                    'description' => request('description')
                ]
            );

            if ($request->file('image')) {
                $image      = $request->file('image');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();

                $img = Image::make($image->getRealPath());
                $img->resize(400, 300, function ($constraint) {
                    $constraint->aspectRatio();                 
                });
                $img->stream();
                Storage::disk('local')->put('public/images/'.'/'.$fileName, $img, 'public');

                $post->update(['image' => $fileName]);
            }

            flash('Post added successfully.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while adding the post.')->error();
        }

        return redirect(route('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

         return view('post-edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $this->validate($request,
            [
                'name'        => 'required|string|max:40',
                'description' => 'required|string|min:2|max:255'
            ]
        );

        try {

            $post->update(
                [
                    'name'        => request('name'),
                    'description' => request('description')
                ]
            );

            if ($request->file('image')) {
                $image      = $request->file('image');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();

                $img = Image::make($image->getRealPath());
                $img->resize(400, 300, function ($constraint) {
                    $constraint->aspectRatio();                 
                });
                $img->stream();
                Storage::disk('local')->put('public/images/'.'/'.$fileName, $img, 'public');

                $post->update(['image' => $fileName]);
            }

            flash('Post updated successfully.')->info();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while updating the post.')->error();
        }

        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        try {
            $post->delete();
            flash('Post deleted successfully.')->error();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while deleting the post.')->error();
        }

        return redirect(route('post.index'));
    }
}
