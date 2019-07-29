<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\Navigation\Navigation;
use App\Utils\Navigation\NavigationItem;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getUser(): User
    {
        /** @var User $user */
        $user = Auth::user();
        return $user;
    }

    protected function topNavigation(): Navigation
    {
        $nav = new Navigation([
            new NavigationItem('home', 'Timer'),
            new NavigationItem('tags', 'Tags'),
        ]);
        $nav->activate(Route::currentRouteName());

        return $nav;
    }
}
