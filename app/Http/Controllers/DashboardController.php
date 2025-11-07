<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = $this->getLatestPosts(false);
        return view('page.dashboard', compact('posts'));
    }

    /*
    * Simulated method to retrieve latest posts.
    * @return object[]
    */
    private function getLatestPosts($test = false)
    {
        if ($test == true) {
            // This is a placeholder. Replace with actual data retrieval logic.
            return [
                (object)[ 'id' => 1, 'user_name' => 'App_Admin', 'image_test' => 'First+Image', 'caption' => 'Post 1 content' ],
                (object)[ 'id' => 2, 'user_name' => 'App_Admin_1', 'image_test' => 'Second+Image', 'caption' => 'Post 2 content' ],
                (object)[ 'id' => 3, 'user_name' => 'App_Admin_2', 'image_test' => 'Third+Image', 'caption' => 'Post 3 content' ],
            ];
        } else {
            $dbPosts = Post::with('user')->latest()->get();
            $dbPosts->transform(function ($item) {
                $item->post_image = str_replace(' ', '+', $item->post_image);
                return $item;
            });

            // pick up some datas with mapping like test above
            $posts = [];
            foreach($dbPosts as $post){
                $postData = new \stdClass();
                $postData->id = $post->id;
                $postData->user_name = $post->user->name;
                $postData->image_source = Storage::get('public/'.$post->post_image);
                $postData->caption = $post->caption;
                $posts[] = $postData;
                unset($postData);
            }
            dd($posts);
            return $posts;
        }
    }
}
