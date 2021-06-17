<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        \Menu::make('MyNavBar', function ($menu) {
            $menu->add('Home', ['route'  => 'login', 'class' => 'nav-item', 'id' => 'home'])->data('permission', 'admin')->link->attr(['class' => 'nav-link']);
            $menu->add('User', ['route'  => 'user.index', 'class' => 'nav-item', 'id' => 'home1'])->data('permission', 'admin')->link->attr(['class' => 'nav-link']);
            $menu->add('Create', ['route'  => 'user.getCreate', 'class' => 'nav-item', 'id' => 'home2'])->data('permission', 'admin')->link->attr(['class' => 'nav-link']);
//            $menu->add('About',    ['route'  => 'user.getCreate'])->link->attr(['class' => 'nav-link dropdown-toggle','id' => "navbarDropdown", 'role'=> "button" ,'data-toggle'=> "dropdown", 'aria-haspopup'=> "true", 'aria-expanded'=>"false"]);
//            $menu->add('Level2', ['route'  => 'user.index' , 'parent' => $menu->about->id])->link->attr(['class' => 'dropdown-item']);
//            $menu->group(['style' => 'padding: 0', 'data-role' => 'navigation'], function($m){
//                $m->add('About',    ['route'  => 'user.index', 'class' => 'navbar navbar-about dropdown'])->link->attr(['class' => 'nav-link']);
//                $m->add('services', ['route'  => 'user.getCreate'])->link->attr(['class' => 'nav-link']);
//            });
            $menu->add('About', ['url'  => '#', 'class' => 'nav-item dropdown'])->data('permission', 'admin')->link->attr(['class' => 'nav-link dropdown-toggle', 'id' => "navbarDropdown", 'role' => "button" ,'data-toggle' => "dropdown", 'aria-haspopup' => "true", 'aria-expanded' => "false"]);
            $menu->about->add('Who are we?', ['route'  => 'user.getCreate',  'id' => 'home21'])->data('permission', 'admin')->link->attr(['class' => 'dropdown-item']);
            $menu->about->add('What we do?', ['route'  => 'user.index', 'id' => 'home211'])->data('permission', 'admin')->link->attr(['class' => 'dropdown-item']);
            $menu->add('Logout', ['route'  => 'logout', 'class' => 'nav-item', 'id' => 'home2'])->data('permission', 'admin')->link->attr(['class' => 'nav-link']);
        });

        return $next($request);
    }
}
