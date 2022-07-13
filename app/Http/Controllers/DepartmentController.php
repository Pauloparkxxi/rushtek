<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Staff;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::where('dep_status','=','1')
            ->orderBy('dep_name','ASC')
            ->paginate(10);
        return view('departments.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    public function detail($department_id) {
        $department = Department::find($department_id);

        return view('departments.detail',compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = Department::create([
            'dep_name'      => $request->name,
            'dep_description'   => $request->description,
            'dep_status'    => 1,
        ]);

        return redirect(route('departments'))->with('alert', 'Department Added!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $department = Department::find($id);
        $department->update([
            'dep_name' => $request->name,
            'dep_description' => $request->description,
            'dep_status' => $request->status
        ]);

        return redirect(route('departments.detail',$id))->with('alert', 'Department Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Department::find($id)->delete();
        $staff = Staff::where('department_id',$id)
            ->update(['department_id' => null]);
        
        return redirect(route('departments'))->with('alert', 'Department Deleted!');
    }
}
