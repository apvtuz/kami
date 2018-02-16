<?php


namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Record;
use App\User;
class AdminComposer {


    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!Auth::user()) return;
        $notifications = Record::where('post_user_id',Auth::user()->id)->where('viewed',0)->get();
        $users =  new User;
        view()->share('notifications', $notifications);
        view()->share('users', $users);

/*
        $view->with('currentUser', Auth::user());

        Menu::make('admin', function ($menu)
        {

            $UserCompany = Auth::user()->group->name; // Find user which Company
            $menu->add($UserCompany, '/')->data('permissions', ['view_home_page']);
            $menu->add('Reseller', '/')->data('permissions', ['view_home_page']);
            $menu->add('Users', 'dashboard')->data('permissions', ['view_about_page']);
            $menu->add('Log', '/admin')->data('permissions', ['access_admin']);
            $menu->add('Configurations', '/admin')->data('permissions', ['access_admin']);


        })
            ->filter(function ($item)
            {
                $sat = Auth::check() && Auth::user()->canAtLeast($item->data('permissions')) ?: false;

                return ($sat);
            });

*/
    }


}

