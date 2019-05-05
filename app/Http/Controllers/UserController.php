<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        $currentUser = $request->user();
        $data['user'] = $currentUser;
        $data['users'] = User::all()->filter(function ($user) use ($currentUser) {
            return $user->id != $currentUser->id;
        });
        return view('home', $data);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deposit(Request $request)
    {
        $this->validate($request, [
            'monto' => 'required|numeric|min:0|max:1000000'
        ]);

        $data['user'] = $request->user();
        $user = User::find($data['user']->id);
        $user->balance = $user->balance + $request->input('monto');
        $user->save();

        return back()->with('success', 'Se ha hecho tu deposito');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function withdraw(Request $request)
    {
        $this->validate($request, [
            'monto' => 'required|numeric|min:0|max:1000'
        ]);

        $data['user'] = $request->user();
        $user = User::find($data['user']->id);
        $user->balance = $user->balance - $request->input('monto');
        $user->save();

        return back()->with('success', 'Se ha hecho tu retiro');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function transfer(Request $request)
    {
        $this->validate($request, [
            'user' => 'required',
            'monto' => 'required|numeric|min:0|max:1000'
        ]);

        $data['user'] = $request->user();
        $user = User::find($data['user']->id);

        if ($user->id == $request->input('user')) {
            return back()->withErrors(['No te puedes transefir a ti mismo.']);
        }

        if ($user->balance < $request->input('monto')) {
            return back()->withErrors(['Balance insuficiente.']);
        }

        $user->balance = $user->balance - $request->input('monto');
        $user->save();

        $otherUser = User::find($request->input('user'));
        // $151,600.00 pejos

        if ($otherUser == null) {
            return back()->withErrors(['Usuario no existente']);
        }

        $otherUser->balance = $otherUser->balance + $request->input('monto');
        $otherUser->save();

        return back()->with('success', 'Se ha hecho tu transferencia');
    }

}
