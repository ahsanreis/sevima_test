<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = $this->getLatestPosts(true);
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
            $post = Post::with('user')->latest()->get();
            return $post;
        }
    }
}
