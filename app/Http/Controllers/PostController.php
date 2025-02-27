<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Hilo;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function verPost($id = 1)
    {
        $hilo = Hilo::find($id);

        if ($hilo) {
            $posts = Post::with('user')->withCount('likes as total_likes')->where('hilo_id', $id)->orderBy('created_at', 'asc')->get();
            return view('post')->with('hilo', $hilo)->with('posts', $posts);
        }
        return redirect(route('home'));
    }

    public function createPost(PostRequest $request, $hilo)
    {
        $hilo = Hilo::find($hilo);
        if ($hilo) {
            Post::create([
                'mensaje' => $request->input('postmsg'),
                'user_id' => auth()->guard('web')->user()->id,
                'hilo_id' => $hilo->id,
            ]);
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $post)
    {
        $post = Post::findOrFail($post)->delete();
        return redirect()->back();
    } 
     
    public function like($post){
        $user = auth()->guard('web')->user();

        $existeLike = Like::where('user_id', $user->id)->where('post_id', $post)->first();
    
        if ($existeLike) {
            $existeLike->delete();
        } else { 
            $post = Post::findOrFail($post);
            $post->likes()->create([
                'user_id' => $user->id,
            ]);
        } 
         
        return redirect()->back();
    }
}
