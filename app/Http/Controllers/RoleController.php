<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = Role::all();
        return view('role.index',compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Role;
        if($request->id!=0 && Role::find($request->id)!=null){
            $model = Role::find($request->id);
        }
        
        $model->name = $request->role_name;
        $model->save();

        return response()->json(['success'=>'Data berhasil ditambah']);
    }
}
