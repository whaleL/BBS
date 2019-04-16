<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Topic;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth', ['except' => ['home','show']]);
    }

    public function home()
    {
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }
        $user = User::all();
        $topics = Topic::all();
        
        //$user = $user->followers()->paginate(30);


        return view('home.show', compact('feed_items','topics','user'));
    }

}
