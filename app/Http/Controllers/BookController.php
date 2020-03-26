<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Book;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name=request()->name;
        $man=request()->man;
        $where=[];
        if($name){
            $where[]=['book_name','like',"%$name%"];
        }
        if($man){
            $where[]=['book_man','like',"%$man%"];
        }
        $res=Book::where($where)->paginate(3);
        $query=request()->all();
        return view('book.index',['res'=>$res,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *Ddddsdassd
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.book');
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
			'book_name' => 'required|unique:book|max:255',
			'book_man' => 'required'],
			[
				'book_name.required'=>'书必填',
				'book_man.required'=>'必填',
                'book_name.unique'=>'已存在',
                'book_name.max'=>'长度太大'
		]);
        $data=request()->except("_token");
        // dd($data);

       if(request()->hasFile('book_logo')){
    		$data['book_logo']=uploadsss('book_logo');
    	}
        $res=Book::create($data);
        // dd($res);
        if($res){
            return redirect("/book/index");
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
        // echo $id;die;
    
    }
}
