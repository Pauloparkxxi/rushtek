<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Staff;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = User::where('users.id',Auth::user()->id);

        if (Auth::user()->role == 2) {
            $q->join('staff','users.id','=','staff.user_id')
            ->leftJoin('departments','departments.id','=','staff.department_id');
        } elseif (Auth::user()->role == 3) {
            $q->join('clients','users.id','=','clients.user_id');
        }

        $user = $q->first();
        return view('profile.index',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->update([
            'lname' => $request->lname,
            'fname' => $request->fname,
            'email' => $request->email,
            'username' => $request->username
        ]);

        if ($request->file('avatar')) {
            $photo = $request->file('avatar');
            $avatar_name = Auth::user()->id.$photo->getClientOriginalName();

            $storage = Storage::disk('public');
            if ($user->avatar) {
                $storage->delete('/asset/img/profile/'.$user->avatar);
            }
            $path = $storage->putFileAs('/asset/img/profile/', $photo, $avatar_name);

            $user->update(['avatar' => $avatar_name]);
        }

        if (Auth::user()->role == 2) {
            Staff::where('user_id',Auth::user()->id)
                ->update([
                    'contact' => $request->contact,
                    'birthdate' => $request->birthdate
                ]);
        } elseif (Auth::user()->role == 3) {
            $client = Client::where('user_id',Auth::user()->id)
                ->update([
                    'contact' => $request->contact,
                    'address' => $request->address,
                ]);
        }

        if($request->password) {
            $validated = Hash::make($request->password);
            $user->update(['password' => $validated]);
        }

        return redirect(route('profile'))->with('alert', 'Profile Updated!');
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
