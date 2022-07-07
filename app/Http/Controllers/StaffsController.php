<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Staffs;
use App\Http\Requests\StorestaffsRequest;
use App\Http\Requests\UpdatestaffsRequest;
use Illuminate\Http\Request;


class StaffsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = staffs::join('users','users.id','=','staffs.user_id')
            ->orderBy('users.lname','ASC')
            ->where('users.role','=','2');

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorestaffsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorestaffsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staffs  $staffs
     * @return \Illuminate\Http\Response
     */
    public function show(staffs $staffs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staffs  $staffs
     * @return \Illuminate\Http\Response
     */
    public function edit(Staffs $staffs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatestaffsRequest  $request
     * @param  \App\Models\Staffs  $staffs
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatestaffsRequest $request, Staffs $staffs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staffs  $staffs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staffs $staffs)
    {
        //
    }
}
