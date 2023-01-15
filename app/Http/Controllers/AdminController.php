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
    public function index(Request $request)
    {
        $q = User::where('role','=','1')
            ->orderBy('id','ASC');

        $status = 1;
        $search = '';
        if ($request->has('search') && Str::length($request->search) > 0) {
            $search = $request->search;
            $q->where(function ($query) use ($search){
                $query->where('fname','Like','%'.$search.'%')
                ->orWhere('lname','Like','%'.$search.'%')
                ->orWhere('email','Like','%'.$search.'%');
            });
        }
        if ($request->has('status')){
            switch($request->status) {
                case 'active':
                    $status = 1;
                    break;
                case 'inactive':
                    $status = 0;
                    break;
                case 'all':
                    $status = 3;
                default:
            }
        }
        
        if ($status != 3) {
            $q->where('status','=',$status);
        } 

        $admins = $q->paginate(10);
        
        return view('admins.index',compact(['admins','status','search']));
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


        // dd($user,$user_id);
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

        $request->validate([
            'fname'     => 'required|max:255',
            'lname'     => 'required|max:255',
            'email'     => 'required|email|unique:users,email',
            'avatar'    => 'max:10000|mimes:jpeg,jpg,png',
        ]);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fname'     => 'required|max:255',
            'lname'     => 'required|max:255',
            'email'     => 'required|email|unique:users,email,'.$id,
            'status'    => 'required',
            'avatar'    => 'max:10000|mimes:jpeg,jpg,png',
        ]);
        
        $user = User::find($id);
        $user->update([
            'lname' => $request->lname,
            'fname' => $request->fname,
            'email' => $request->email,
            'status' => $request->status,
        ]);

        if ($request->file('avatar')) {
            $photo = $request->file('avatar');
            $avatar_name = $id.$photo->getClientOriginalName();
            
            $storage = Storage::disk('public');
            if ($user->avatar) {
                $storage->delete('/asset/img/profile/'.$user->avatar);
            }
            $path = $storage->putFileAs('/asset/img/profile/', $photo, $avatar_name);
            
            $user->update(['avatar' => $avatar_name]);
        }

        if($request->password) {
            $validated = Hash::make($request->password);
            $user->update(['password' => $validated]);
        }

        return redirect(route('admins.detail',$id))->with('alert', 'Admin Updated!');
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
