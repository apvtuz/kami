<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Countries;
use App\Language;
use App\Accent;
use App\Category;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
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

         $countries = Countries::all()->sortBy("name");
         $accents = Accent::all()->sortBy("name");
         $user_accents = Auth::user()->accent??[];
         $user_languages = Auth::user()->language??[];
         $languages = Language::all()->sortBy("name");
         $categories = Category::all()->sortBy("name");
         $user = Auth::user();
        return view('profile', ['countries' => $countries,
                                    'accents' => $accents,
                                    'languages' => $languages,
                                    'categories' => $categories,
                                    'user_accents'=>$user_accents,
                                    'user_languages'=>$user_languages,
                                    'user'=>$user,
                                    'header'=>'Profile']);
    }
    public function update_user(Request $request)
    {

        $user = User::find(Auth::user()->id);
        if ($request->file('photo'))  $this->upload($request->file('photo'));
        $this->validator($request->all())->validate();
        $this->update($user, $request->except(['_token','photo']));
        //return $this->index();
        return redirect('/profile')->with('success','Profile has been created successfully');

    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',

        ]);
    }
    protected function update($user,array $data)
    {
        if ($user->author) $data['author']=$user->author;
        $data['author']=empty($data['author'])?0:1;
        $data['hearing_disorder']=empty($data['hearing_disorder'])?0:1;
        $data['sight_disorder']=empty($data['sight_disorder'])?0:1;
        $data['contact_mail']=empty($data['contact_mail'])?0:1;
        $data['contact_phone']=empty($data['contact_phone'])?0:1;
        $data['accent'] = json_encode( $data['accent']??[]);
        $data['language'] = json_encode( $data['language']??[]);

        return User::whereId($user->id)->update($data);

    }
    public function upload($file)
    {

       $filename = base_convert(time(), 10, 36) . base_convert(rand(0, 2000000000), 10, 36).'.'.$file->getClientOriginalExtension();
       $file->move('images/avatars', $filename);
        //$path = $request->file('avatar')->store('avatars');
        $user = User::find(Auth::user()->id);
        $user->photo = $filename;
        $user->save();

    }
}
