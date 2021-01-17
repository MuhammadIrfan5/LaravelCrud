<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myuser= User::all();
        return view('users.index',compact('myuser'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "saved";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'same' => 'The :attribute and :other must match.',
            'username' => 'User Name must be contain more than 4 characters'
        ];
        $this->validate(request(), [
            'name' => ['required','min:5','max:25'],
            'username' => ['required', 'unique:users','min:5','max:25'],
            'email' => ['bail','required','email:rfc,dns','unique:users,email'],
            'password' =>['required'],
            'password_confirm' => 'same:password' 
        ],$messages);
        $user=new User();
        $user->name=request('name');
        $user->username=request('username');
        $user->email=request('email');
        $user->password=bcrypt(request('password'));
        $user->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {  
        $myuser= User::all();
        return view('users.showuser',compact('myuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $u=User::find($id);
        //dd($u);
        return view('users.edit',compact('u'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $u=User::find($id);
        $u->name=request('name');
        $u->username=request('username');
        $u->email=request('email');
        $u->password=bcrypt(request('password'));
        $u->update();
        return redirect('show');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
