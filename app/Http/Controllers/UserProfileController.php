<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function index()
    {
        return view('users.index', [
            'users' => User::paginate(15)->onEachSide(1)
        ]);
    }


    public function profile($route)
    {
        $user = User::where('route', $route)->orWhere('username', $route)->firstOrFail();
        if (!is_null($user->route) && $route != $user->route)
            return redirect(route('user.profile', $user->route), 301);
        return view('users.profile', [
            'user' => $user
        ]);
    }


    public function edit($route)
    {
        $user = User::where('route', $route)->orWhere('username', $route)->firstOrFail();
        if ($user->id != Auth::id())
            return abort(404);
        if (!is_null($user->route) && $route != $user->route)
            return redirect(route('user.profile.edit', $user->route), 301);
        return view('users.profile_edit', [
            'user' => $user
        ]);
    }


    protected function checkUserRoute(Request $request)
    {
        if (request()->ajax()) {
            if (Auth::user()->username == $request->route || Auth::user()->route == $request->route)
                return response()->json(['success' => true]);

            $validator = Validator::make($request->all(),
                ['route' => ['required', 'string', 'min:3', 'max:15', 'unique:users,username', 'unique:users,route', 'regex:/^[a-z0-9-_]+$/u']],
                ['required' => 'Не может быть пустым!',
                    'min' => 'Минимальная длина 3 символа!',
                    'max' => 'Мaксимальная длина 15 символов!',
                    'unique' => 'Url занят!',
                    'regex' => 'Разрешены символы a-z, 0-9 и -_!']
            );
            if ($validator->passes())
                return response()->json(['success' => true, 'error' => ['']]);
            return response()->json(['success' => false, 'error' => $validator->errors()->all()]);
        }
        return abort(404);
    }
}