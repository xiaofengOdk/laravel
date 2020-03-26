<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cateindex()
    {
        //
      $res=Category::paginate(3);
        return view('cate.cateindex',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *Ddddsdassd
     * @return \Illuminate\Http\Response
     */
    public function catecreate()
    {
        return view('cate.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function catestore(Request $request){
        $data=request()->except('_token');
        $res=Category::create($data);
        // dd($res);
        if($res){
            return redirect('/cateindex');
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
    public function cateedit($id)
    {
        //
        $res=Category::find($id);
        // dd($res);
        return view("cate.cateedit",['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cateupdate(Request $request, $id)
    {
        //
        // echo $id;
        $data=request()->except('_token');
        // dd($data);
        $res=Category::where('cate_id',$id)->update($data);
        if($res!==false){
            return redirect('/cateindex');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function catedestroy($id)
    {
        //
        // echo $id;
       $res= Category::destroy($id); 
        if($res){
            return redirect('/cateindex');
        }
    }
}
