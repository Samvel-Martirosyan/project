<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use http\Env\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    /**
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function edit(UserRequest $request): RedirectResponse
    {
        User::where('id', $request['id'])->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        return redirect()->back();
    }
}
