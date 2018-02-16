<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Countries;
use App\Language;
use App\Accent;
use App\Category;

class PreferenceController extends Controller
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

    public function index()
    {

        $countries = Countries::all()->sortBy("name");
        $accents = Accent::all()->sortBy("name");
        $user_accents = Auth::user()->accent ?? [];
        $user_languages = Auth::user()->language ?? [];
        $user_categories = Auth::user()->category ?? [];
        $languages = Language::all()->sortBy("name");
        $categories = Category::all()->sortBy("name");
        return view('preference', ['countries' => $countries,
            'accents' => $accents,
            'languages' => $languages,
            'categories' => $categories,
            'user_accents' => $user_accents,
            'user_languages' => $user_languages,
            'user_categories'=> $user_categories,
            'header' => 'Filter Preference']);
    }

    public function update_user(Request $request)
    {

       // dump($request->accent);
        $user = User::find(Auth::user()->id);
        $user->fill($request->except(['_token']));
        // $this->validator($request->all())->validate();
        $user->accent = $request->accent??[];
        $user->language = $request->language??[];
        $user->category = $request->category??[];
        $user->contact_mail = $request->has('contact_mail');
        $user->contact_phone = $request->has('contact_phone');
        $user->sight_disorder = $request->has('sight_disorder');
        $user->hearing_disorder = $request->has('hearing_disorder');
        //dump($user->accent);
        $user->save();
        return redirect('/preference')->with('success', 'Profile has been updated successfully');

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|max:255',
            'content' => 'required|max:5000',
            'exp_info' => 'max:5000',
            'conducted_from' => 'required',
            'conducted_to' => 'required',
            'takes' => 'required',
        ]);
    }
}
