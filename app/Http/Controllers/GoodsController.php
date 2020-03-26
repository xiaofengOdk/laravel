<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Goods;
use App\Brand;
use App\Category;
use Illuminate\Validation\Rule;
class GoodsController extends Controller
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
        // session(['name'=>'sdasdwa']);
        // session()->put('ssssss',22222222222);
        // session(['']);
        // echo request()->session()->get('name');
        $res=Goods::
         leftjoin('brand','goods.brand_id','=','brand.brand_id')
         ->leftjoin('category','goods.cate_id','=','category.cate_id')   
        ->paginate(3);
        // dd($res);
        if(request()->ajax()){
            return view('goods.listpage',['res'=>$res]); 
        }
        return view('goods.list',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *Ddddsdassd
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$brand_res=Brand::get();
        $cate_new=Category::all();
        //这是那个方法名字记得要先查询category表中的数据，
        //然后将$cate_new以形参的形式放到newCate
        $cate_res=newCate($cate_new);
        // dd($cate_res);
        return view("goods.index",['brand_res'=>$brand_res,'cate_res'=>$cate_res]);
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
			'goods_name' => 'regex:/^[\x{4e00}-\x{9fa5}w]{2,50}$/u|unique:goods|max:255',
			'brand_id' => 'required',
			'cate_id' => 'required',
			'goods_num'=>'digits_between:1,8',
			'goods_price'=>'digits_between:1,8'],
			[
				'goods_name.regex'=>'商品位数',
				'goods_name.unique'=>'名称已存在',
				'goods_name.max'=>'长度不得大于20',
				'brand_id.unique'=>'brand必填',
				'cate_id.unique'=>'cate_id必填',
				'goods_num.digits_between'=>'在1到8为之间',
				'goods_price.digits_between'=>'价格必须在1到8位之间'
		]);
        $data=request()->except("_token");
        // dd($data);

       if(request()->hasFile('goods_img')){
    		$data['goods_img']=$this->uploadsss('goods_img');
    	}
    	if(request()->hasFile('goods_imgs')){
    		$data['goods_imgs']=$this->uploads('goods_imgs');
    		$data['goods_imgs']=implode("|",$data['goods_imgs']);
    	}
        // dd($data);
    
        // dd($brand_res);
        $res=Goods::create($data);
        // dd($res);
        if($res){
            return redirect("/goods/index");
        }
    }
    public function uploads($imgs){
    	$file=request()->$imgs;
    	foreach ($file as $k=>$v){
    		if($v->isValid()){
    			$result_imgs[$k]=$v->store('uploads');
    		}
    	}
    	return $result_imgs;
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
        $res=Goods::find($id);
        // dd($res);
        $brand_res=Brand::get();
        $cate_res=Category::all();
        // dd($cate_res);
        return view("goods.edit",['res'=>$res,'brand_res'=>$brand_res,'cate_res'=>$cate_res]);
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
        $validatedData = $request->validate([
			'goods_name' =>[
                'required',
                 Rule::unique('goods')->ignore($id,'goods_id'),
            ],
			'brand_id' => 'required',
			'cate_id' => 'required',
			'goods_num'=>'digits_between:1,8',
			'goods_price'=>'digits_between:1,8'],
			[
				'goods_name.required'=>'商品名称必填',
				'goods_name.unique'=>'名称已存在',
				'brand_id.unique'=>'brand必填',
				'cate_id.unique'=>'cate_id必填',
				'goods_num.digits_between'=>'在1到8为之间',
				'goods_price.digits_between'=>'价格必须在1到8位之间'
		]);
        $data=request()->except('_token');
        $res=Goods::where('goods_id',$id)->update($data);
        if($res!==false){
            return redirect("/goods/index");     
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
        // echo $id;die;
       $res= Goods::destroy($id);
       // dd($res);
        if($res){
            return redirect("/goods/index");     
        }       
    }
}
