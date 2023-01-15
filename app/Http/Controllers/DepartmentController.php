<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = Department::orderBy('dep_name','ASC');
        
        $status = 1;
        $search = '';
        if ($request->has('search') && Str::length($request->search) > 0) {
            $search = $request->search;
            $q->where('dep_name','Like','%'.$search.'%');
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
            $q->where('dep_status','=',$status);
        }

        $departments = $q->paginate(10);

        return view('departments.index',compact(['departments','status','search']));
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
        $request->validate([
            'name' => 'required|max:255',
        ]);

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
        $request->validate([
            'name'      => 'required|max:255',
            'status'    => 'required',
        ]);

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
