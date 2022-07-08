<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

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
            ->join('departments','departments.id','=','staff.user_id')
            ->orderBy('users.lname','ASC');

        $staff_status = 1;
        if ($request->has('status')){
            $q->where('status',$request->has('status'));
        } else {
            $q->where('status',1);
        }
        
        $staffs = $q->paginate(10);
        return view('staffs.index',compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $departments = Department::all();
        return view('staffs.create',compact('departments'));
    }

    public function detail ($user_id)
    {
        $user = staff::where('users.role','=','2')
            ->where('users.id','=',$user_id)
            ->join('users','users.id','=','staff.user_id')
            ->join('departments','departments.id','=','staff.user_id')
            ->first();

        return view('staffs.detail',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
