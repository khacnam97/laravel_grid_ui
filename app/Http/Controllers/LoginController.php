<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package App\Http\Controllers
 * @property UserService userService
 */
class LoginController extends Controller
{
    /**
     * UserController constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function getLogin()
    {
        if(Auth::check()) {
            return redirect()->route('user.index');
        }
        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function index(LoginRequest $request): RedirectResponse
    {
        $name = $request->name;
        $credentials = $request->except(['_token']);
        if (auth()->attempt($credentials)) {
            return redirect()->route('user.index');
        }
        return back()->with(['msg' => __('user.Message Error'), 'name' => $name]);
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }


}
