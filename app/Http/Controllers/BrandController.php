<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
class BrandController extends Controller
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
        $res=Brand::paginate(3);
        // dd($res);
        return view('brand.index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *Ddddsdassd
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("brand.brand");
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
        // dd($data);
        if($request->hasFile('brand_logo')){
            // echo 123;die;
            $data['brand_logo']=$this->uploadsss('brand_logo');
        }
        // dd($data);
        $res=Brand::create($data);
        // dd($res);
        if($res){
            return redirect("/index");
        }
    }
    public function uploadsss($img){
        if(request()->file($img)->isValid()){
            $file=request()->$img;
            $file_result=$file->store('uploads');
            // dump($file_result);
            return $file_result;
        }
    exit('文件上传出错');
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
        // echo $id;
        $res=Brand::find($id);
        // dd($res);
        return view("brand.edit",['res'=>$res]);
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
        // echo $id;
        $data=request()->except('_token');
        $res=Brand::where('brand_id',$id)->update($data);
        if($res!==false){
            return redirect("/index");     
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
        // echo $id;
       $res= Brand::destroy($id);
       // dd($res);
        if($res){
            return redirect("/index");     
        }       
    }
}
