<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Admin;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('login.index');
    }

    /**
     * Show the form for creating a new resource.
     *Ddddsdassd
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("login.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->except("_token");
        // $data['admin_pwd']=md5(md5($data['admin_pwd']));
        $res=Admin::where('admin_name',$data['admin_name'])->first();
        if(!$res){
             return  redirect("/login/create")->with('msg','用户名或者密码错误');            
        }
        $res['admin_pwd']=decrypt($res['admin_pwd']);
         // dd($data['admin_pwd']);
       if($res['admin_pwd']!=$data['admin_pwd']){
            return  redirect("/login/create")->with('msg','用户名或者密码错误');            
        }
            session(['adminuser'=>$res]);
            return redirect("/login/index");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        //
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
