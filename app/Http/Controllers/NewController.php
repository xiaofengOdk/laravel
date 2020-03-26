<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Newss;
class NewController extends Controller
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
        $res=Newss::paginate(3);
        // dd($res);
        return view('new.index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *Ddddsdassd
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_res=Newss::get();
        $sres=newssCate($new_res);
        // dd($sres);
        return view("new.create",['sres'=>$sres]);
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
            'new_name' => 'regex:/^[\x{4e00}-\x{9fa5}w]{2,50}$/u|unique:newss|max:255',
            'new_man'   => 'required',
         ],
            [
                'new_name.regex'=>'名称位数',
                'new_name.unique'=>'名称已存在',
                 'new_man.required'=>'作者必填',
       ]);
        $data=request()->except("_token");
      
        // dd($data);
        $data['new_time']=time();
        $res=Newss::create($data);
        // dd($res);
        if($res){
            return redirect("/new/index");
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
