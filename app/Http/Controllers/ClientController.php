<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = Client::where('users.role','=','3')
        ->join('users','users.id','=','clients.user_id')
        ->orderBy('users.lname','ASC');

        $status = 1;
        $search = '';
        if ($request->has('search') && Str::length($request->search) > 0) {
            $search = $request->search;
            $q->where('fname','Like','%'.$search.'%')
                ->orWhere('lname','Like','%'.$search.'%')
                ->orWhere('company','Like','%'.$search.'%');
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

        $clients = $q->paginate(10);
        return view('clients.index',compact(['clients','status','search']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    public function detail ($user_id)
    {
        $user = client::where('users.role','=','3')
            ->where('users.id','=',$user_id)
            ->join('users','users.id','=','clients.user_id')
            ->first();

        // dd($user_id,$user);

        return view('clients.detail',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname'     => 'required|max:255',
            'lname'     => 'required|max:255',
            'email'     => 'required|email|unique:users,email',
            'username'  => 'required|max:20|min:6|unique:users,username',
            'company'   => 'required|max:255',
            'contact'   => 'required|max:255',
            'address'   => 'required|max:255',
            'avatar'    => 'max:10000|mimes:jpeg,jpg,png',
        ]);

        $client = User::create([
            'fname'     => Str::ucfirst(Str::lower($request->fname)),
            'lname'     => Str::ucfirst(Str::lower($request->lname)),
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'status'    => 1,
            'role'      => 3
        ]);

        if ($request->file('avatar')) {
            $photo = $request->file('avatar');
            $avatar_name = $client->id.$photo->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('/asset/img/profile/', $photo, $avatar_name);
            $client->update(['avatar' => $avatar_name]);
        }

        Client::create([
            'user_id' => $client->id,
            'company' => $request->company,
            'address'   => $request->address,
            'contact' => $request->contact,
        ]);

        return redirect(route('clients'))->with('alert', 'Client Added!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fname'     => 'required|max:255',
            'lname'     => 'required|max:255',
            'email'     => 'required|email|unique:users,email,'.$id,
            'username'  => 'required|max:20|min:6|unique:users,username,'.$id,
            'company'   => 'required|max:255',
            'contact'   => 'required|max:255',
            'address'   => 'required|max:255',
            'status'    => 'required',
            'avatar'    => 'max:10000|mimes:jpeg,jpg,png',
        ]);


        $user = User::find($id);
        $user->update([
            'lname' => $request->lname,
            'fname' => $request->fname,
            'email' => $request->email,
            'username'  => $request->username,
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

        $client = Client::where('user_id',$id);
        $client->update([
            'company' => $request->company,
            'contact' => $request->contact,
            'address'   => $request->address,
        ]);

        return redirect(route('clients.detail',$id))->with('alert', 'Client Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        User::find($id)->delete();
        Client::where('user_id',$id)->delete();
        
        return redirect(route('clients'))->with('alert', 'Client Deleted!');
    }
}
