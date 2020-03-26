<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Category;
use App\Cart;
use App\Order;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    //
	public function index(){
		$new_res=Redis::get('is_new');
		// dd($new_res);
		// Redis::flushall();
		// die;
		if(!$new_res){
			// echo '测试一下，马上回来';
			$new_res=Goods::where('is_new',1)->take(4)->get();
			$new_res=serialize($new_res);
			Redis::setex('is_new',60*60*24,$new_res);
		}
		// dd($new_res);
		$new_res=unserialize($new_res);
		// dd($new_res);
		$up_res=Cache::get('is_up');
		// dump($new_res);
		if(!$up_res){
   			$up_res=Goods::where('is_up',1)->take(4)->get();
			// echo '库你锡瓦，辛巴得儿';
			Cache::put('is_up',$up_res,60*60*24);
		}
		$hot_res=Cache::get('is_hot');
		// dump($new_res);
		if(!$hot_res){
			$hot_res=Goods::where('is_hot',1)->take(4)->get();
			// echo '库你锡瓦，辛巴得儿';
			Cache::put('is_hot',$hot_res,60*60*24);
		}
		$pid_res=Cache::get('pid');
		// pid_res($new_res);
		if(!$pid_res){
			$pid_res=Category::where('pid',1)->take(4)->get();
			// echo 'nig';
			Cache::put('pid',$pid_res,60*60*24);
		}
		// dd($pid_res);
		// $pid_res=Category::where('pid',0)->get();
		// // dd($pid_res);
		// $hot_res=Goods::where('is_hot',1)->take(4)->get();
		// $up_res=Goods::where('is_up',1)->take(4)->get();
		return view('index.index',['new_res'=>$new_res,'hot_res'=>$hot_res,'up_res'=>$up_res,'pid_res'=>$pid_res]);
	}
	public function pid($pid){
		$cate_res=Category::get();
		$new_res=selectId($cate_res,$pid);
		$result=Goods::whereIn('cate_id',$new_res)->take(5)->get();
		return view('index.prolist',['result'=>$result]);
	}
	public function proinfo($id){
		$count=Cache::add('count_'.$id,1)?Cache::get('count_'.$id):Cache::increment('count_'.$id);
		$goods_res=Goods::find($id);
		// dump($count);
		return view('index.proinfo',['goods_res'=>$goods_res,'count'=>$count]);
	}
	public function cart(){
		$ress=session('admin');
		// dd($ress);
		if(!$ress){
			return json_encode(['code'=>'0000','msg'=>'登录先']);
		}	
		$data=request()->except('_token');
		$num=request()->shop_num;
		$goods_id=request()->goods_id;
		$goods_res=Goods::find($goods_id);
		$admin=session('admin');
		// dd($admin);
		$data['user_id']=$admin['user_id'];
		$leijia=Cart::where(['user_id'=>$admin->user_id,'goods_id'=>$goods_id])->first();
		$data['time']=time();
		// dd($leijia);
		$shop_num=$num+$leijia['shop_num'];
		if($leijia){
			if($shop_num>=$goods_res['goods_num']){
				$shop_num=$goods_res['goods_num'];
			}else{
				$shop_num=$num+$leijia['shop_num'];
			}
			$res=Cart::where(['user_id'=>$admin->user_id,'goods_id'=>$goods_id])->update(['shop_num'=>$shop_num]);
			// dd($leijia1);
		}else{
			$res=Cart::create($data);
			// dd($res);	
		}
		// dd($res);
		if($res!==false){
			return json_encode(['code'=>'00000','msg'=>'正在跳转至购物车,请稍等....']);
		}
	}
	public function cartlist(){
		$admin=session('admin');
		$res=Cart::where(['user_id'=>$admin->user_id])->count();
		$cart_res=Cart::
		leftjoin('goods','cart.goods_id',"=",'goods.goods_id')
		->where(['user_id'=>$admin->user_id])
		->get();
		// dd($cart_res);
		return view('index.cartlist',['res'=>$res,'cart_res'=>$cart_res]);
	}
	public function rexiaoji(){
		$admin=session('admin');
		$goods_id=request()->goods_id;
		$_num=request()->_num;
		// dump($goods_id);
		// dd($_num);
		$result=Cart::where(['user_id'=>$admin->user_id,'goods_id'=>$goods_id])->update(['shop_num'=>$_num]);
		// dd($result);
		if($result){
			return json_encode(['code'=>'000','msg'=>'成功']);
		}
	}
	public function getRxiaoji(){
		$goods_id=request()->goods_id;
		$admin=session('admin');
		$res=Cart::where(['user_id'=>$admin->user_id,'cart_del'=>1,'goods_id'=>$goods_id])->first();
		// dd($res);
		echo $res['shop_num']*$res['goods_price'];
	}
	public function getTotall(){
		$good_id=request()->good_id;
		// dd($good_id);
		$admin=session('admin');
		$good_id=explode(",",$good_id);
		// $sss=Cart::whereIn('goods_id',$good_id)->get();
		// dump($sss);
		$result=Cart::whereIn('goods_id',$good_id)->get();
		// dd($result);
		$money=0;
		foreach($result as $k=>$v){
			$money+=$v['goods_price']*$v['shop_num'];
		}
		// dd($money);
		echo $money;
	}
	public function buy($id){
		// dd($id);
		$id=explode(',',$id);
		$admin=session('admin');
		$res=Cart::whereIn('goods_id',$id)->get();
		// dd($res);
		$money=0;	
		foreach($res as $k=>$v){
			$money+=$v['goods_price']*$v['shop_num'];
		}		
		// dd($money);
		// $rod=$res['goods_id'];
		// dd($id);
		$id=implode(",",$id);
		return view('index.order',['res'=>$res,'money'=>$money,'id'=>$id]);
	}
	public function order(){
		$goods_id=request()->goods_id;
		// dd($goods_id);
		$order_no=rand().time();
		$order_time=time();
		$user_id=session('admin');
		// dd($user_id->user_id);
		$user_id=$user_id->user_id;
		$goods_id=explode(",",$goods_id);
		$result=Cart::whereIn('goods_id',$goods_id)->get();
		// dd($result->goods_id);
		// $result[$k]=$result->user_id;
		$money=0;
		foreach($result as $k=>$v){
			$money+=$v['goods_price']*$v['shop_num'];
		}
		// $data[]=[];
		foreach($result as $k=>$v){
			$data[]=[
				
					'goods_id'=>$v->goods_id,
					'order_no'=>$order_no,
					'time'=>time(),
					'user_id'=>$user_id,
					'money_totall'=>$money,
				
			];	
		}
		// dd($data);
		$res=Order::insert($data);
		// dd($res);0
		$order_id=Order::where('user_id',$user_id)->get();
		// dd($order_id);
		// dd($order_id['order_id']);
		$order_idd=[];
		foreach ($order_id as $key => $value) {
			// dd($value['order_id']);
			$order_idd[]=$value['order_id'];
			// dump($order_idd);
		}
		// dd($order_idd);
		if($res){
			return json_encode(['code'=>'2222222','msg'=>'下单成功','order_id'=>$order_idd]);
		}else{
			return json_encode(['code'=>'00000','msg'=>'操作失误','order_id'=>$order_idd]);			
		}
	}
	public function order_buy($id){
		// dd($id);
		$id=explode(",",$id);
		$order_res=Order::whereIn('order_id',$id)->get();
		return view('index.order_buy',['order_res'=>$order_res]);
	}
	public function address(){
		// $address=request()->;

		return view('index.address');
	}
	public function order_success(){
		$user_id=session('admin');
		$user_id=$user_id->user_id;
		$order_res=Order::where('user_id',$user_id)->get();
		$money=0;
		foreach($order_res as $k=>$v){
			$money+=$v['money_totall'];
		}
		$order_no='';
		foreach ($order_res as $k=>$v){
			$order_no=$v->order_no;
		}
		require_once app_path('libs/alipay/wappay/service/AlipayTradeService.php');
		require_once app_path('libs/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php');
		$config=config('alipay');
		// dd($config);
		if (!empty($order_no)&& trim($order_no!="")){
		    //商户订单号，商户网站订单系统中唯一订单号，必填
		    $out_trade_no = $order_no;
		    //订单名称，必填
		    $subject = "$money";
		    //付款金额，必填
		    $total_amount = $money;
		    //商品描述，可空
		    $body = "很好";
		    //超时时间
		    $timeout_express="10m";
		    $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
		    $payRequestBuilder->setBody($body);
		    $payRequestBuilder->setSubject($subject);
		    $payRequestBuilder->setOutTradeNo($out_trade_no);
		    $payRequestBuilder->setTotalAmount($total_amount);
		    $payRequestBuilder->setTimeExpress($timeout_express);
		    $payResponse = new \AlipayTradeService($config);
		    $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);
		    return ;
		}
	}
	public function return_url(){
		$config=config("alipay");
		require_once app_path('libs/alipay/wappay/service/AlipayTradeService.php');
		require_once app_path('libs/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php');

		$arr=$_GET;
		$alipaySevice = new \AlipayTradeService($config); 
		$result = $alipaySevice->check($arr);

		/* 实际验证过程建议商户添加以下校验。
		1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
		2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
		3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
		4、验证app_id是否为该商户本身。
		*/
		if($result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码
			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
		    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

			//商户订单号

			$out_trade_no = htmlspecialchars($_GET['out_trade_no']);

			//支付宝交易号

			$trade_no = htmlspecialchars($_GET['trade_no']);
				
			echo "验证成功<br />外部订单号：".$out_trade_no;

			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
		    //验证失败
		    echo "验证失败";
		}
	}
	public function notify_url(){
		$config=config("alipay");
		require_once app_path('libs/alipay/wappay/service/AlipayTradeService.php');
		require_once app_path('libs/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php');
		$arr=$_POST;
		$alipaySevice = new \AlipayTradeService($config); 
		$alipaySevice->writeLog(var_export($_POST,true));
		$result = $alipaySevice->check($arr);

		/* 实际验证过程建议商户添加以下校验。
		1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
		2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
		3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
		4、验证app_id是否为该商户本身。
		*/
		if($result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代

			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
			
		    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
	
			//商户订单号

			$out_trade_no = $order_no;

			//支付宝交易号

			$trade_no = $_POST['trade_no'];

			//交易状态
			$trade_status = $_POST['trade_status'];


		    if($_POST['trade_status'] == 'TRADE_FINISHED') {

				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//请务必判断请求时的total_amount与通知时获取的total_fee为一致的
					//如果有做过处理，不执行商户的业务程序
						
				//注意：
				//退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
		    }else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//请务必判断请求时的total_amount与通知时获取的total_fee为一致的
				//如果有做过处理，不执行商户的业务程序			
				//注意：
				//付款完成后，支付宝系统发送该交易状态通知
		    }
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——        
			echo "success";		//请不要修改或删除
				
		}else {
		    //验证失败
		    echo "fail";	//请不要修改或删除

		}
	}
}		