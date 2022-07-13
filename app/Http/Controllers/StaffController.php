<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = staff::where('users.role','=','2')
            ->join('users','users.id','=','staff.user_id')
            ->leftJoin('departments','departments.id','=','staff.department_id')
            ->orderBy('users.lname','ASC');

        $status = 1;
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
        
        $staffs = $q->paginate(10);
        return view('staffs.index',compact(['staffs','status']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $departments = Department::where('dep_status',1)
            ->orderBy('dep_name','ASC')
            ->get();
        return view('staffs.create',compact('departments'));
    }

    public function detail ($user_id)
    {
        $user = staff::where('users.role','=','2')
            ->where('users.id','=',$user_id)
            ->join('users','users.id','=','staff.user_id')
            ->leftJoin('departments','departments.id','=','staff.department_id')
            ->first();

        $departments = Department::orderBy('dep_name','ASC')
            ->get();

        return view('staffs.detail',compact(['user','departments']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $staff = User::create([
            'fname'     => Str::ucfirst(Str::lower($request->fname)),
            'lname'     => Str::ucfirst(Str::lower($request->lname)),
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'status'    => 1,
            'role'      => 2
        ]);

        if ($request->file('avatar')) {
            $photo = $request->file('avatar');
            $avatar_name = $staff->id.$photo->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('/asset/img/profile/', $photo, $avatar_name);
            $staff->update(['avatar' => $avatar_name]);
        }

        Staff::create([
            'user_id' => $staff->id,
            'department_id' => $request->department,
            'contact' => $request->contact,
            'birthdate' => $request->birthdate
        ]);

        return redirect(route('staffs'))->with('alert', 'Staff Added!');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

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

        $staff = Staff::where('user_id',$id);
        $staff->update([
            'department_id' => $request->department,
            'contact' => $request->contact,
            'birthdate' => $request->birthdate
        ]);

        return redirect(route('staffs.detail',$id))->with('alert', 'Staff Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        User::find($id)->delete();
        Staff::where('user_id',$id)->delete();
        
        return redirect(route('staffs'))->with('alert', 'Staff Deleted!');
    }
}
