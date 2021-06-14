<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Itstructure\GridView\DataProviders\EloquentDataProvider;

class UserController
{
    public function index(Request $request)
    {
        $dataProvider = new EloquentDataProvider(User::query());

        return view('user.index', [
            'dataProvider' => $dataProvider
        ]);
    }
}
