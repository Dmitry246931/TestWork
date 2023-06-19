<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpRequest;
use App\Models\User;
use App\Models\Auto;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = new User();
        $users = $users->get_users();
        $user_count = User::get_user_count();
        if ($user_count == 0) {
            return view('sign');
        } else {
            return view('all_clients_page', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sign');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $data = $request;
            $user = User::user_create($data);
            Auto::auto_create($data, $user);

            return redirect()->route('users.index')->with('message', 'perf');
        }catch (\Exception $ex){
            return redirect()->route('users.index')->with('message', 'err'.$ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $autos = Auto::show_autos($user);
        return view('my_auto', compact('autos'), compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('sign', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpRequest $request, User $user)
    {
        try {
            $data =$request;
            User::up_user($data, $user);
            return redirect()->route('users.index');
        }catch (\Exception $ex){
            return redirect()->route('users.index')->with('message', 'err'.$ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::delete_user($user);
        return redirect()->route('users.index');
    }
}
