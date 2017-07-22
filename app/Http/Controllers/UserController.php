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
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the config dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(!$this->checkForAdminRights(auth()->user()))
            return redirect('home');

        return view('user.home')->withUsers(User::all());
    }

    public function showCreateForm() {
        if(!$this->checkForAdminRights(auth()->user()))
            return redirect('home');

        return view('user.create');
    }

    public function createUser(Request $request) {
        if(!$this->checkForAdminRights(auth()->user()))
            return redirect('home');

        $this->validateFormInput($request);

        $user = new User();

        $user->name = $request->input('user_name');
        $user->email = $request->input('user_email');
        $user->password = bcrypt($request->input('user_password'));

        $user->save();

        return redirect('user')
                ->withStatus(['Der Benutzer "' . $user->name . '" wurde erfolgreich angelegt.']);
    }

    public function showEditForm(User $user) {
        if(!$this->checkForAdminRights(auth()->user()))
            return redirect('home');

        return view('user.edit')
                ->with(compact('user'));
    }

    public function updateUser(User $user, Request $request) {
        if(!$this->checkForAdminRights(auth()->user()))
            return redirect('home');

        $this->validateFormInput($request);

        $user->name = $request->input('user_name');
        $user->email = $request->input('user_email');
        $user->password = bcrypt($request->input('user_password'));

        $user->save();

        return redirect('user')
                ->withStatus(['Der Benutzer "' . $user->name . '" wurde erfolgreich angepasst.']);
    }

    public function delete(User $user) {
        if(!$this->checkForAdminRights(auth()->user()))
            return redirect('home');

        if($user->delete())
            return redirect('user')->withStatus(['Der Nutzer "' . $user->name . '" wurde erfolgreich gelöscht.']);

        return redirect('config')->withErrors(['Beim Löschen des Nutzers "' . $user->name . '" ist ein Fehler aufgetreten.']);
    }

    private function validateFormInput($request) {
        $this->validate($request, [
            'user_name' => 'required|min:5',
            'user_email' => 'required|email|unique:users,email|confirmed',
            'user_password' => 'required|min:6|confirmed'
        ]);
    }

    private function checkForAdminRights(User $user) {
        return $user->name === 'admin';
    }
}
