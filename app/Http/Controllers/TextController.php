<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Text;
use Illuminate\Validation\Rule;

class TextController extends Controller
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
        $brand_res=Brand::all();
        // dd($brand_res);
        $name=request()->name;
        $n_name=request()->n_name;
        $where=[];
        if($name){
            $where[]=['text_name','like',"%$name%"];
        }
         if($n_name){
            $where[]=['text_man','like',"%$n_name%"];
        }
        $res=Text::
        leftjoin('brand','text.brand_id','=','brand.brand_id')
        ->where($where)
        ->paginate(3);
        // dump($brand_res);
        $query=request()->all();
        if(request()->ajax()){
            return view('text.indexpage',['res'=>$res]);      
        }
        return view('text.index',['res'=>$res,'query'=>$query,'brand_res'=>$brand_res]);
    }

    /**
     * Show the form for creating a new resource.
     *Ddddsdassd
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
     $brand_res=Brand::all();
        return view("text.create",['brand_res'=>$brand_res]);
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
            'text_name' => 'regex:/^[\x{4e00}-\x{9fa5}w]{2,50}$/u|unique:text|max:255|required',
            'brand_id' => 'required',
            'text_man' => 'required',
            'text_desc' => 'required',
            'text_man'=>'regex:/^[\x{4e00}-\x{9fa5}w]{2,50}$/u',
            'text_email'=>'regex:/^[a-zA-Z0-9]{6,}@qq\.com$/'],
            [
                'text_name.required'=>'名称必填',
                'text_man.required'=>'作者必填',
                'text_desc.required'=>'描述必填',
                'text_name.regex'=>'位数不够',
                'text_name.unique'=>'名称已存在',
                'text_name.max'=>'长度不得大于20',
                'brand_id.unique'=>'brand必填',
                'text_man.regex'=>'作者名称必填且在0到5为之间',
                'text_email.regex'=>'邮箱格式不正确'
        ]);
        $data=request()->except("_token");
        // dd($data);
        $data['text_time']=time();
        if($request->hasFile('text_logo')){
            // echo 123;die;
            $data['text_logo']=uploadsss('text_logo');
        }
        // dd($data);
        $res=Text::create($data);
        // dd($res);
        if($res){
            return redirect("/text/index");
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
        $brand_res=Brand::all();
        $res=Text::find($id);
        // dd($res);
        return view("text.edit",['res'=>$res,'brand_res'=>$brand_res]);
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
         $data=request()->except("_token");
        // dd($data);
         $data['text_time']=time();
         $validatedData = $request->validate([
            'text_name' =>[
                'required',
                 Rule::unique('text')->ignore($id,'text_id'),
            ],
             'brand_id' => 'required',
            'text_man' => 'required',
            'text_man'=>'regex:/^[\x{4e00}-\x{9fa5}w]{2,50}$/u',
            'text_email'=>'regex:/^[a-zA-Z0-9]{6,}@qq\.com$/'
        ],
            [
               'text_name.required'=>'名称必填',
                'text_man.required'=>'作者必填',
                'text_name.regex'=>'位数不够',
                'text_name.unique'=>'名称已存在',
                'text_name.max'=>'长度不得大于20',
                'brand_id.unique'=>'brand必填',
                'text_man.digits_between'=>'作者名称必填且在0到5为之间',
                'text_email.regex'=>'邮箱格式不正确'
        ]);
        if($request->hasFile('text_logo')){
            // echo 123;die;
            $data['text_logo']=uploadsss('text_logo');
        }
        // dd($data);
        $res=Text::where('text_id',$id)->update($data);
        // dd($res);
        if($res!==false){
            return redirect("/text/index");     
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
       $res= Text::destroy($id);
       // dd($res);
        if($res){
            if(request()->ajax()){
            return json_encode(['code'=>'00000','msg'=>'odk']);                     
            }
            return redirect("/text/index");     
        }       
    }
}
