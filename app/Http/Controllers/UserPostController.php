<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserPostController extends Controller
{
    public function index(User $user)
    {

        $posts = $user->posts;

        return view('users.posts.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
