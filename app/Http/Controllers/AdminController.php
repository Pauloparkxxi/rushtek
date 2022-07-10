<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('role','=','1')
            ->where('status','=','1')
            ->orderBy('id','ASC')
            ->paginate(10);
        
        return view('admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create');
    }

    public function detail ($user_id) {
        $user = user::where('users.role','=','1')
            ->where('users.id','=',$user_id)
            ->first();

        return view('admins.detail',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = User::create([
            'fname'     => Str::ucfirst(Str::lower($request->fname)),
            'lname'     => Str::ucfirst(Str::lower($request->lname)),
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'status'    => 1,
            'role'      => 1
        ]);
        if ($request->file('avatar')) {
            $photo = $request->file('avatar');
            $avatar_name = $admin->id.$photo->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('/asset/img/profile/', $photo, $avatar_name);
            $admin->update(['avatar' => $avatar_name]);
        }
        return redirect(route('admins'))->with('alert', 'Admin Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // dd($id);
        User::find($id)->delete();
        
        return redirect(route('admins'))->with('alert', 'Admin Deleted!');
    }
}
