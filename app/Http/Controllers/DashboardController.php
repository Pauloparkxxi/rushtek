<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $q = staff::join('users','users.id','=','staff.user_id')
        //     ->orderBy('users.lname','ASC')
        //     ->where('users.role','=','2');

        $clientsCount = User::where('users.role','!=','1')->where('users.role','3')->count();
        $staffsCount = User::where('users.role','!=','1')->where('users.role','2')->count();
        // dd($staffsCount,$clientsCount);

        return view('dashboard',compact(['staffsCount','clientsCount']));
    }
}
