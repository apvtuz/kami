<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Age;
use Mail;
use App\Mail\TestEmail;
use Twilio;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::whereRaw('conducted_to > now()')->orderBy('created_at', 'desc')->get();

//whereIn('category',Auth::user()->category)->

        return view('dashboard', ['header' => 'Dashboard', 'posts' => $posts]);
    }

    /**
     * Show my favorites
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function favorite()
    {
        $favorites = Auth::user()->favorites;
        $posts = $favorites ? Post::whereIn('id', $favorites)->get() : null;

        return view('favorites', ['header' => 'Favorites', 'posts' => $posts]);
    }

    /**
     * Show the user profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile_page($id)
    {

        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $user = User::find($id);
        return view('profile_page', ['header' => 'Dashboard', 'posts' => $posts, 'user' => $user]);
    }

    public function view($id)
    {

        $data = ['message_text' => 'This is a test!'];

        // Mail::to('apvsem@gmail.com')->send(new TestEmail($data));
        $post = Post::find($id);
        $user = User::find($post->user_id);
        $ages = Age::where('post_id', $post->id);
        //Twilio::message($user->phone, 'Test sms');
        $twilio = new Twilio('ACb8ba6bc985605eed4db898bd8b88014b', '7d04085c411a1ea2dab89e10bdf21df8', '‎+441592323042');
      //dump($twilio);
       // $twilio->message('+359876297904', 'Pink Elephants and Happy Rainbows');
        $chars = ['[', '"', ']'];
        $conducted_at = str_replace($chars, '', $post->conducted_at);
        $post->conducted_at_array = explode(",", $conducted_at);
        return view('view_post', ['header' => 'Project', 'post' => $post, 'user' => $user, 'ages' => $ages]);
    }


}
