<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\PostbaseController;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Post;

class PostController extends PostbaseController {


    public function index() {

        $data = [];
        $data['menu_post'] = true;
        return view('posts', $data);
    }

    public function load(Request $request) {
        // if ajax request
        if ($request->ajax()) {
            $user_id = $this->globaldata['user']->user_id;
            $posts = Post::search($request->search)->where('user_id', $user_id)->latest('post_id')->get();
            $data['posts'] = $posts;
            return view('ajax.posts', $data);
        }
        // if non ajax request
        else {
            return 'No direct access allowed!';
        }
    }

    // Post add code
    public function add() {
        $data = ['menu_post' => true];

        $post = new Post();
        $data['post'] = $post;
        $user_id = $this->globaldata['user']->user_id;
        $data['user_id'] = $user_id;
        
        return view('post', $data);
    }

    // Post edit code
    public function edit($id) {
        $user_id = $this->globaldata['user']->user_id;
        $post = Post::where('user_id', $user_id)->where('post_id', intval($id))->first();
        if(!empty($post)) {
            $data = [];
            $data = ['menu_post' => true];
            $data['post'] = $post;
            $data['user_id'] = $user_id;
            return view('post', $data);
        }
        else {
            abort(404);
        }
    }

    // Post insert and update
	public function store(Request $request) {
        // if ajax request
        if ($request->ajax()) {
            // dd($request);
            $data = [];

            $user_id = intval($request->user_id);
            $post_id = intval($request->post_id);
            $name  = trim($request->name);
            $description  = trim($request->description);

            // make validation rules for received data
            $rules = [
                    'name'     => 'required',
                    'description'      => 'required'
            ];

            if($request->imagefile != "") {
                $rules['imagefile'] = 'mimes:jpeg,jpg,png';
            }

            $post = ($post_id == 0) ? new Post() : Post::find($post_id);


            // validate received data
            $validator = Validator::make($request->all(), $rules);

            // if validation fails
            if ($validator->fails()) {
                $data['type'] = 'error';
                $data['caption'] = 'One or more invalid input found.';
                $data['errorfields'] = $validator->errors()->keys();
                $data['errormessage'] = $validator->errors()->all()[0];
            }
            // if validation success
            else {

                $post->user_id          = $user_id;
                $post->name             = $request->name;
                $post->description      = $request->description;

                // add
                if($post_id == 0) {
                    $result = $post->save();
                    $captionsuccess = 'Post added successfully.';
                    $captionerror = 'Unable add post. Please try again.';
                }
                // edit
                else {
                    $result = $post->update();
                    $captionsuccess = 'Post updated successfully.';
                    $captionerror = 'Unable update post. Please try again.';
                }

                // database insert/update success
                if($result) {
                    $data["type"] = "error";

                    $imgpath = public_path($post->postdir);

                    // delete image if set to true
                    if(intval($request->deleteimage) == 1) {

                        // delete old image file if any
                        if($post->hasimage) {
                            File::deleteDirectory($imgpath);
                        }

                        $post->imagefile = '';
                        $post->update();
                    }

                    // upload image file if exist
                    if ($request->hasFile('imagefile')) {
                        if($request->file('imagefile')->isValid()) {
                            $imagefile   = $request->file('imagefile');
                            $extension = $request->file('imagefile')->getClientOriginalExtension();
                            // delete old image file
                            File::deleteDirectory($imgpath);
                            $img = Image::make($imagefile);
                            $img->fit(config('constants.post_image_width'), config('constants.post_image_height'), function ($constraint) {
                                $constraint->upsize();
                            });
                            $filecreated = File::makeDirectory($imgpath, 0777, true, true);
                            if($filecreated) {
                                $fileName = getTempName($imgpath, $extension);
                                if($img->save($imgpath . $fileName)) {
                                    $post->imagefile = $fileName;
                                    $post->update();
                                    $data["type"] = "success";
                                }
                                else {
                                    $data['caption'] = $captionsuccess. ' But unable to upload post image.';
                                }
                            }
                            else {
                                $data['caption'] = $captionsuccess. ' But unable to upload post image.';
                            }
                        }
                        else {
                            $data['caption'] = $captionsuccess. ' But invalid file uploaded.';
                        }
                    }
                    // if no image uploaded
                    else {
                        $data["type"] = "success";
                    }


                    if($data["type"] == 'success') {
                        $data['caption'] = $captionsuccess;
                        $data['redirectUrl'] = url('/posts');
                    }

                }
                // database insert/update fail
                else {
                    $data['type'] = 'error';
                    $data['caption'] = $captionerror;
                }
            }

            return response()->json($data);

        }
        // if non ajax request
        else {
            return 'No direct access allowed!';
        }
    }

    // Post delete
    public function destroy(Request $request) {
        // if ajax request
        if ($request->ajax()) {

            $data = [];

            $post = Post::find($request->post_id);
            if(!empty($post)) {

                $postdir = public_path($post->postdir);
                $files_deleted = true;

                // delete old image file if any
                if($post->hasimage) {
                    if(!File::deleteDirectory($postdir)) {
                        $files_deleted = false;
                    }
                }

                // if physical files deleted then delete entry from database
                if($files_deleted) {
                    if($post->delete()) {
                        $data['type'] = 'success';
                        $data['caption'] = 'Post deleted successfully.';
                    }
                    else {
                        $data['type'] = 'error';
                        $data['caption'] = 'Unable to delete post.';
                    }
                }
                // physical files not deleted
                else {
                    $data['type'] = 'error';
                    $data['caption'] = 'Unable to delete post.';
                }
            }
            else {
                $data['type'] = 'error';
                $data['caption'] = 'Invalid post.';
            }

            return response()->json($data);
        }
        // if non ajax request
        else {
            return 'No direct access allowed!';
        }
    }

}
