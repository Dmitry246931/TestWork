<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutoRequest;
use App\Http\Requests\AutoUpRequest;
use App\Models\Auto;
use Illuminate\Http\Request;

use App\Models\User;

class AutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        return view('auto_new', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AutoRequest $request, User $user)
    {
        /*try {
            $data = $request;*/
        $autos = new Auto();
        $autos::auto_create($request, $user);
        $autos = Auto::au_where_us($user);
        return view('my_auto', compact('autos'), compact('user'));
        /*}catch (\Exception $ex){
            return redirect()->route('park')->with('message', 'err'.$ex);
        }*/
    }

    /**
     * Display the specified resource.
     */
    public function show(Auto $auto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(auto $auto)
    {
        return view('auto_new', compact('auto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AutoUpRequest $request, auto $auto)
    {
        Auto::up_auto($request, $auto);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($auto)
    {
        $count_auto = Auto::get_auto_count($auto);
        if ($count_auto == 1) {
            $user = User::get_users_auto($auto);
            return redirect()->route('users.show', compact('user'));
        } else {
            Auto::delete_auto($auto);
            return redirect()->route('users.index');
        }
    }
}
