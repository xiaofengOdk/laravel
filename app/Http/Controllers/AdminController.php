<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Admin;
use Illuminate\Validation\Rule;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $brand=new Brand();
        // echo 11111111111;
        $res=Admin::paginate(3);
        // dd($res);
        return view('admin.index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *Ddddsdassd
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $validatedData = $request->validate([
            'admin_name' => 'regex:/^[\x{4e00}-\x{9fa5}w]{2,50}$/u|unique:admin|max:255',
            'admin_tel'=>'digits_between:10,11',
            'admin_pwd'=>'digits_between:6,20',
  ],
            [
                'admin_name.regex'=>'名称位数',
                'admin_name.unique'=>'名称已存在',
                'admin_pwd.digits_between'=>'在6为以上',
                'admin_tel.digits_between'=>'11位',
        ]);
        $data=request()->except("_token");
        // dd($data);
        $data['admin_pwd']=encrypt($data['admin_pwd']);
        if($request->hasFile('admin_logo')){
            // echo 123;die;
            $data['admin_logo']=uploadsss('admin_logo');
        }
        // dd($data);
        $res=Admin::create($data);
        // dd($res);
        if($res){
            return redirect("/admin/index");
        }
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
        //
        $res=Admin::find($id);
        return view('admin.edit',['res'=>$res]);
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
         $validatedData = $request->validate([
            'admin_name' =>[
                'required',
                'regex:/^[\x{4e00}-\x{9fa5}w]{2,50}$/u',
                 Rule::unique('admin')->ignore($id,'admin_id'),
            ],
            'admin_tel'=>'digits_between:10,11',
            'admin_pwd'=>'digits_between:6,18'
        ],
            [
                'admin_name.required'=>'名称必填',
                'admin_name.regex'=>'位数',
                'admin_name.unique'=>'名称已存在',
                'admin_tel.digits_between'=>'11位',
                'admin_pwd.digits_between'=>'密码必须在6位以上'
        ]);
        $data=request()->except("_token");
        // dd($data);
        if($request->hasFile('admin_logo')){
            // echo 123;die;
            $data['admin_logo']=uploadsss('admin_logo');
        }  
        $res=Admin::where('admin_id',$id)->update($data);
        if($res!==false){
            return redirect('/admin/index');
        }
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
       $res= Admin::destroy($id);
        if($res){
            return redirect('/admin/index');
        }
    }
}
