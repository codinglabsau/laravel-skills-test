<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Image;


class PostController extends Controller
{
    public function create(Request $request) 
    {
        return view('home');
    }

    public function store(PostCreateRequest $request) 
    {
        try {

            $imgPath = "";

            if ($request->hasFile('image')) {
                // Create directory images if doesn't exist
                File::makeDirectory(public_path().'/images', 0755, true, true);
                // Avoid file names duplicated
                $fileNameWithExt = $request->file('image')->getClientOriginalName();
                // Just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Just file extension
                $extension = $request->file('image')->extension();
                // Name to Store
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                //Full Path
                $imgPath = public_path().'/images/'.$fileNameToStore;
                //resize and store
                Image::make($request->file('image'))->resize(400, 300)->save($imgPath);
            } 
    
            $post = Post::create([
                'user_id'     => Auth::user()->id,
                'name'        => trim($request->name),
                'description' => trim($request->description),
                'image'       => $imgPath
            ]);

            session()->flash('success', "The post '{$post->name}' has been created!");
            
        } catch(QueryException $exception) {
            session()->flash('exception', "A database error occurred when creating a new post. 
                                           Please refresh the page and try again. 
                                           If the problem persists, contact the support.");
        } catch(\Exception $exception) {
            session()->flash('exception', "Please refresh the page and try again. If the problem persists, contact the support.");
        } finally {
            return redirect(route('post.create'));
        }
    }    
}
