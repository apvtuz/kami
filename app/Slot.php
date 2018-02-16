<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Post;

class Slot extends Model
{
    static function create_slots($id, $request)
    {
        //Slot::where('post_id', $id)->delete();
        $post = Post::find($id);
        switch ($post->takes) {
            case '10 min':
                $takes = 10;
                break;
            case '20 min':
                $takes = 20;
                break;
            case '30 min':
                $takes = 30;
                break;
            case '1 h':
                $takes = 60;
                break;
            case '1.5 h':
                $takes = 90;
                break;
            default:
                $takes = 10;

        }
        $time_to = $request->time_to ?
            Carbon::create(
                substr($request->date, 0, 4),
                substr($request->date, 5, 2),
                substr($request->date, 8, 2),
                substr($request->time_to, 0, 2), substr($request->time_to, 3, 2))
            :
            Carbon::create(
                substr($request->date, 0, 4), substr($request->date, 5, 2),
                substr($request->date, 8, 2), 23, 59);
       $start = Carbon::create(
            substr($request->date, 0, 4),
            substr($request->date, 5, 2),
            substr($request->date, 8, 2),
            substr($request->time_from, 0, 2), substr($request->time_from, 3, 2));
$finish = Carbon::create(
            substr($request->date, 0, 4),
            substr($request->date, 5, 2),
            substr($request->date, 8, 2),
    substr($request->time_from, 0, 2), (int)substr($request->time_from, 3, 2)+$takes);
$startnext = Carbon::create(
            substr($request->date, 0, 4),
            substr($request->date, 5, 2),
            substr($request->date, 8, 2),
    substr($request->time_from, 0, 2), (int)substr($request->time_from, 3, 2)+$takes + (int)$post->interval);

       // $startnext->addMinutes($takes + $post->interval);
       // dump($request->time_to,$time_to);
        //return;
        while ($startnext < $time_to) {

            $slot = new Slot;
            $slot->start = $start;
            $slot->finish = $finish;
            $slot->author = $post->user_id;
            $slot->post_id = $id;
            $slot->save();
            $start->addMinutes($takes + $post->interval);
            $finish->addMinutes($takes + $post->interval);
            $startnext->addMinutes($takes + $post->interval);

        }


    }
    //
}
