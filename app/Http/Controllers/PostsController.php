<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Language;
use App\Accent;
use App\Category;
use App\Record;
use App\User;
use App\Age;
use App\Slot;
use Carbon\Carbon;

class PostsController extends Controller
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
     * Show my posts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('posts', ['posts' => $posts,
            'header' => 'Posts',
        ]);
    }

    /**
     * Show the projects Im in
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projects()
    {
        /*$posts = Post::whereIn('id', function ($query) {
            $query->select('post_id')
                ->from(with(new Record)->getTable())
                ->where('user_id', Auth::user()->id);
        })->get();*/
        $slots = Slot::where('user', Auth::user()->id)->get();
        //$posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('projects', ['slots' => $slots,
            'header' => 'Projects',
        ]);
    }

    /**
     * Edit post
     * @param int $id
     *
     * @return FormInterface
     */
    public function edit($id)
    {

        $post = $id ? Post::find($id) : new Post;
        $action = $id ? url('/post') . '/' . $id . '/edit' : url('/post/create');
        $post->color = $post->publish == 1 ? 'danger' : 'success';
        $post->icon = $post->publish == 1 ? 'pause' : 'publish';
        $post->btn_text = $post->publish == 1 ? 'Unpublish' : 'Publish';
        $languages = Language::all()->sortBy("name");
        $categories = Category::all()->sortBy("name");
        $accents = Accent::all()->sortBy("name");
        $ages = Age::where('post_id', $post->id);
        return view('edit_post', ['post' => $post,
            'action' => $action,
            'languages' => $languages,
            'categories' => $categories,
            'accents' => $accents,
            'header' => 'Post',
            'ages' => $ages]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function slots($id)
    {
        $post = Post::find($id);
        $post->conducted_at_array = null;
        if ($post->conducted_at) {
            $chars = ['[', '"', ']'];
            $conducted_at = str_replace($chars, '', $post->conducted_at);
            $post->conducted_at_array = explode(",", $conducted_at);
        }
        return view('slots_post', ['header' => 'Time slots', 'post' => $post]);
    }


    /**
     * Show participants
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function people($id)
    {
        // dump($id);


        $records = Record::where('post_id', $id);
        $records->update(['viewed' => 1]);
        $records = $records->get();


        return view('people_post', ['records' => $records,

            'header' => 'Post people']);
    }

    /**
     * Change status for participant
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function people_change($id, Request $request)
    {
        $record = Record::find($id);
        $record->status = $request->status;
        $record->save();
        return redirect('/post/' . $record->post_id . '/people')->with('success', 'Post has been updated successfully');
    }

    /**
     * Show post create page
     * @return FormInterface
     */
    public function create()
    {
        return $this->edit(null);
    }

    /**
     * On click edit post
     * @param null $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function onEdit($id = null, Request $request)
    {
        $this->validator($request->all())->validate();
        $post = $id ? Post::find($id) : $post = new Post;

        $newpost = $request->except(['_token']);
        //dump($newpost);return;
        //$newpost['conducted_from'] .= ':00';
        //$newpost['conducted_to'] .= ':00';
        $post->fill($newpost);
//dump($post->conducted_at);return;
        $post->hearing_disorder = $request->has('hearing_disorder');
        $post->sight_disorder = $request->has('sight_disorder');
        $post->contact_mail = $request->has('contact_mail');
        if (!$id) $post->user_id = Auth::user()->id;

        if ($request->file('file')) $post->file = $this->upload_doc($request->file('file'));
        if ($request->file('image')) $post->image = $this->upload_image($request->file('image'));

        $post->save();


        $action = $id ? 'updated' : 'created';
        $id = $post->id;
        return redirect("/post/$id/edit")->with('success', "Post has been $action successfully");
    }

    /**
     * On click create post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function onCreate(Request $request)
    {
        return $this->onEdit(null, $request);

    }

    /**
     * Delete post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        Post::find($id)->delete();
        return redirect('/posts');

    }

    /**
     * Set / unset favorite mark on post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public
    function favorite(Request $request)
    {
        $id = $request->id;
        $user = User::find(Auth::id());
        $favorites = $user->favorites;
        if ($favorites && in_array($id, $favorites)) unset($favorites[array_search($id, $favorites)]); else $favorites[] = $id;

        $user->favorites = $favorites;
        $user->save();
        return redirect('/dashboard');

    }


    /**
     * Record for participate
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public
    function record(Request $request)
    {
        $id = $request->id;
        $record = new Record;
        $record->post_id = $id;
        $record->post_user_id = Auth::user()->id;
        $record->user_id = Post::find($id)->user_id;
        $record->save();
        return redirect('/projects');

    }

    public function publish($id)
    {
        $post = Post::find($id);
        $post->published = $post->published == 0 ? 1 : 0;
        $post->save();
        return redirect('/posts/');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|max:255',
            'content' => 'required|max:5000',
            'exp_info' => 'max:5000',
            //'conducted_from' => 'required',
            //'conducted_to' => 'required',
            'takes' => 'required',
        ]);
    }

    /**
     * Renaming and mooving uploaded file
     * @param $file
     * @return string
     */
    public function upload_doc($file)
    {

        $filename = base_convert(time(), 10, 36) . base_convert(rand(0, 2000000000), 10, 36) . '.' . $file->getClientOriginalExtension();
        $file->move('docs', $filename);
        return $filename;

    }

    /**
     * Renaming and mooving uploaded file
     * @param $file
     * @return string
     */
    public function upload_image($file)
    {
        $filename = base_convert(time(), 10, 36) . base_convert(rand(0, 2000000000), 10, 36) . '.' . $file->getClientOriginalExtension();
        $file->move('posts', $filename);
        return $filename;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add_age()
    {

        return view('age')->with('key', rand(100, 10000000));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_slots(Request $request)
    {
        $post = Post::find($request->post_id);
        if ($request->interval) {
            $post->takes = $request->takes;
            $post->interval = $request->interval;
            $post->save();
        }
        if ($request->time_from) Slot::create_slots($request->post_id, $request);
        $slots = Slot::where('post_id', $request->post_id)->whereRaw("DATE(start) = '{$request->date}'")->get();
        if ($slots->count() < 1) $slots = null;
        return view('slots_table', ['slots' => $slots, 'post' => $post]);
    }

    /**
     * Remove time slot
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function remove_slot(Request $request)
    {
        $slot = Slot::find($request->id);
        $slot->delete();
        return $this->get_slots($request);

    }

    /**
     * Change the slot: accept user or free slot
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function change_slot(Request $request)
    {
        $slot = Slot::find($request->slot_id);
        if ($request->action == 'accept') {
            $slot->status = 1;
            $slot->save();
        }
        if ($request->action == 'free') {
            $slot->user = null;
            $slot->save();
        }
        return $this->get_slots($request);
    }

    /**
     * Remove all time slots for date
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function remove_all_slots(Request $request)
    {
        //dump($request->post_id,$request->date);
        Slot::where('post_id', $request->post_id)->whereRaw("DATE(start) = '{$request->date}'")->delete();
        return  $this->get_slots($request);

    }

    /**
     * Show the time slots
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_slots(Request $request)
    {
        // dump($request->post_id);
        $post = Post::find($request->post_id);
        $date = null;
        if (!empty($post->conducted_at)) {
            $chars = ['[', '"', ']'];
            $conducted_at = str_replace($chars, '', $post->conducted_at);
            $conducted_at_array = explode(",", $conducted_at);
            $date = $conducted_at_array[$request->current];
            $slots = Slot::where('post_id', $request->post_id)->whereRaw("DATE(start) = '$date'")->whereRaw("`user` is null")->get();
            if ($slots->count() < 1) $slots = null;
        } else $slots = null;
        return view('slots_select', ['slots' => $slots, 'post' => $post, 'date' => $date]);
    }

    /**
     *  Participate the time slots
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function select_slot(Request $request)
    {
        $slot = Slot::find($request->slot_id);
        $slot->user = Auth::user()->id;
        $slot->save();
        return $this->show_slots($request);
    }

}
