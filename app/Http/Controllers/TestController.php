<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Test;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redis;
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('test.create');
    }

    /**
     * Show the form for creating a new resource.
     *Ddddsdassd
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data=request()->except('_token');
        // dd($data);
        $data['time']=time();
        $res=Test::create($data);
        // dd($res);
        if($res){
            return redirect('/test/show');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     **/
    public function show(){
        $name=request()->name??'';
        // $man=request()->man;
       $where=[];
       Redis::flushall();
        if($name){
            $where[]=['name','like',"%$name%"];
        }
        $id=request()->id??1;
        // dd($name);
        $res=Redis::get('new_res'.$id.$name);
        // dump($res);
        if(!$res){
        $res=Test::
            where($where)
            ->paginate(2);
            $res=serialize($res);
         Redis::set('new_res'.$id,60*60*24*7,$res);
        }
            $res=unserialize($res);
            $query=request()->all();
        if(request()->ajax()){
            // dump($res);
             return view('test.showpage',['res'=>$res]);
        }
        return view('test.show',['res'=>$res,'query'=>$query]);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }
}
