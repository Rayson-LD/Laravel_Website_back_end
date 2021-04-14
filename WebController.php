<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
use DB;
use App\User;
use file;
use hash;
use Input;

class WebController extends Controller
{
	public function home()
	{
		return view('front-end.kushalservices');
	}
	public function About()
	{
		return view('front-end.AboutKushal');
	}
	public function report()
	{
		return view('front-end.report');
	}
	public function index()
	{
		return view('front-end.index');
	}
	public function dashboardchart()
	{
		return view('front-end.dashboardchart');
	}
	public function yearly()
	{
		return view('front-end.yearly');
	}
	public function quarter()
	{
		return view('front-end.quarter');
	}
	public function services()
	{
		$data['services']=DB::table('services')->where('services_status','0')->get();
		return view('front-end.services',compact('data'));//if you are getting data from database, we need to compact data to view
	}
	public function heads()
	{
		return view('front-end.layouts.header');
	}
	public function about_us()
	{
		return view('front-end.about_us');
	}	
	public function contact()
	{
		return view('front-end.Contact');
	}
	public function get_careers()
	{
		$data['careers']=DB::table('careers')->first();
		return view('front-end.get_careers',compact('data'));
	}
	public function join_table()
	{
		$data=DB::table('item')->join('customers','item.customer_ID','=','customers.customer_ID')
		->join('vendors','item.Order_ID','=','vendors.Order_ID')
		->select('customers.customer_name','customers.customer_email','customers.customer_number','item.Cost','item.Order_Name','vendors.vendor_name')->where('customer_status','=','0')->where('order_status','=','0')->where('vendor_status','=','0')->get();
		return view('front-end.join_table',compact('data'));
	}
	
	public function emailview()
	{
		return view('front-end.emailview');
	}
	public function email_verification(Request $request)
{    
   $data['name']=$request->input('name');

$data['email']=$request->input('email');

$data['mobile_no']=$request->input('mobile_no');

$data['comments']=$request->input('comments');

            $values = ['name' => $data['name'],'email'=> $data['email'],'mobile_no'=> $data['mobile_no'],'comments'=> $data['comments']];
           

$data['to'] = 'xxx@gmail.com'; //give your mail id here
Mail::send(['html'=>'front-end.emailview'],['value'=>$values],function($message) use ($data){

$message->from($data['email'], $data['name']);
$message->to($data['to'], 'Example')->subject('Review about our Store');
});
//return 1;
return Redirect('join_table')->with('message', 'Feedback Sent Successfully!!!');
//return Redirect('/')->with('message', 'Message Sent Succesfully!!!');


}
	
}