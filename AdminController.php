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
use App\Http\models\AdminModel;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

class AdminController extends Controller
{
	public function __construct()
		{
			$this->Admin= new AdminModel;
		}
	
	public function AboutUs()
	{
		return view('back-end.AboutUs');
	}
	public function Login()
    {
        return view('back-end.Login');
    }

	
	public function admin_login(Request $request)
	{
		$canLogin = 0;
			$username = $request->input('username');//input taken from user
			$password = $request->input('password');
			$auth = user::where('username',$username)->first();// getting username from db
		
			if($auth)
			{
				Auth::login($auth);
				$apassword = Auth::user()->password;
				if($apassword)
				{
					if ($password==$apassword)// matching the emails
					{
						$canLogin=1;// return value
					}
				}					
				else
				{
					$canLogin=0; 
				}
			}
			return $canLogin;
	}
	
	 public function dashboard()
    {
        return view('back-end.dashboard');
    }
	
	public function KushalEdits()
	{
		return view('back-end.KushalDashboard');
	}
	public function InsertImage(Request $request)
	{
		$data['about_image'] = $request->input('about_image');
		$data['about_desc'] = $request->input('about_desc');
		
		$InsertImage=$this->Admin->InsertImage($data);
	}
	
	public function customers(Request $request)
    {
		$data['customers']=$this->Admin->viewCustomers();
		return view('back-end.customers',compact('data'));
		return view('back-end.customer_login',compact('data'));
	}
	public function customer_login(Request $request)
    {
		$data['customers']=$this->Admin->viewCustomers();
		
		return view('back-end.customer_login',compact('data'));
	}
	
	 public function insertCustomer(Request $request)
    {
		$data['si_no'] = $request->input('si_no');
		$data['customer_ID'] = $request->input('customer_ID');
		$data['cust_name'] = $request->input('cust_name');
		$data['cust_number'] = $request->input('cust_number');
		$data['cust_email'] = $request->input('cust_email');
		$data['cust_address1'] = $request->input('cust_address1');
		$data['cust_address2'] = $request->input('cust_address2');
		$data['cust_email'] = $request->input('cust_email');
		$data['cust_state'] = $request->input('cust_state');
		$data['cust_city'] = $request->input('cust_city');
		
		$insertCustomer=$this->Admin->insertCustomer($data);
			
    }
	
	public function EditCustomer(Request $request)
	{
		$data['EditId'] = $request->input('EditId');//getting id passed in the function
		$EditCustomer=$this->Admin->EditCustomer($data);
		return json_encode($EditCustomer);
	}
	
	public function DeleteCustomer(Request $request)
	{
		$data['DeleteId'] = $request->input('DeleteId');//getting id passed in the function
		$DeleteCustomer=$this->Admin->DeleteCustomer($data);
		
	}
	public function vendors(Request $request)
	{
				$data['vendors']=$this->Admin->viewVendor();
		return view('back-end.vendors',compact('data'));
		return view('back-end.vendor_login',compact('data'));
	}
	public function vendor_login(Request $request)
	{
				$data['vendors']=$this->Admin->viewVendor();
		return view('back-end.vendor_login',compact('data'));
	}
	public function insertVendor(Request $request)
	{
		$data['vendor_id'] = $request->input('vendor_id');
		$data['Order_ID'] = $request->input('Order_ID');
		$data['vendor_name'] = $request->input('vendor_name');
		$data['vendor_number'] = $request->input('vendor_number');
		$data['vendor_email'] = $request->input('vendor_email');
		$data['vendor_address'] = $request->input('vendor_address');
		$data['vendor_city'] = $request->input('vendor_city');
		$data['vendor_state'] = $request->input('vendor_state');
		$data['vendor_pin'] = $request->input('vendor_pin');
		
			$insertVendor=$this->Admin->insertVendor($data);
	}
	public function EditVendor(Request $request)
	{
		$data['EditId'] = $request->input('EditId');//getting id passed in the function
		$EditVendor=$this->Admin->EditVendor($data);
		return json_encode($EditVendor);
	}
	public function DeleteVendor(Request $request)
	{
		$data['DeleteId'] = $request->input('DeleteId');//getting id passed in the function
		$DeleteVendor=$this->Admin->DeleteVendor($data);
		
	}

	public function change_password()
	{
		return view('back-end.change_Password');
	}
	
	public function resetPassword(Request $request){
	$data['old_p'] = $request->input('old_p');
		$data['new_p'] = $request->input('new_p');
		$resetPassword=$this->Admin->resetPassword($data);
		return $resetPassword;
	}
	
	public function admin_about()
	{
		$data['about_image']=$this->Admin->viewImage();
		return view('back-end.admin_about',compact('data'));
	}
	
	public function about_insert(Request $request)
	{
		$data['about_id']=$request->input('about_id');
		$data['about_description']=$request->input('about_description');
		$data['about_name'] = $request->input('about_name');
		$data['time'] = $request->input('time');
		
			$path = 'Upload\about';
			$destinationPath=$path;
			$fn=$request->file('about_image');
			if($fn)
			{
			$fname= $request->file('about_image')->getClientOriginalName();
			$data['about_image']=$request->file('about_image')->move($destinationPath,$fname);
			}
			else
			{
				$data['about_image']=$request->file('about_image');
			}
			$about_insert=$this->Admin->about_insert($data);
	}
	
	public function admin_careers()
	{
		$data['careers']=$this->Admin->viewdesc();
		return view('back-end.admin_careers',compact('data'));
	}
	
	public function careers(Request $request)
	{
		$data['careers_id']= $request->input('careers_id');
		$data['careers_description']= $request->input('careers_description');
		$insertCareer=$this->Admin->insertCareer($data);
	}
	public function get_comments(Request $request)
	{
		$data['contact_id'] = $request->input('contact_id');
		$data['time'] = $request->input('time');
		$data['contact_name'] = $request->input('contact_name');
		$data['contact_desc'] = $request->input('contact_desc');
		$insertComments= $this->Admin->insertContact($data);
	}
	
	public function view_comments()
	{
		$data['contacts']=$this->Admin->viewComments();
		return view('back-end.contactus',compact('data'));
	}
	
		
	public function EditDesc(Request $request)
	{
		$data['EditId'] = $request->input('EditId');//getting id passed in the function
		$EditDesc=$this->Admin->Editdesc($data);
		return json_encode($EditDesc);
	}
	
	
	public function admin_services()
	{
		$data['services']=$this->Admin->viewServices();
		return view('back-end.admin_services',compact('data'));
	}
	public function EditServices(Request $request)
	{
		$data['EditId'] = $request->input('EditId');//getting id passed in the function
		$EditServices=$this->Admin->EditService($data);
		return json_encode($EditServices);
	}
	public function DeleteServices(Request $request)
	{
		$data['DeleteId'] = $request->input('DeleteId');//getting id passed in the function
		$DeleteServices=$this->Admin->DeleteServices($data);
		
	}
	public function Services(Request $request)
	{
		$data['service_id']= $request->input('service_id');
		$data['services_title']= $request->input('services_title');
		$data['services_description']= $request->input('services_description');
		$insertServices=$this->Admin->insertServices($data);
	}
	public function orders(Request $request)
    {
		$data['orders']=$this->Admin->viewOrders();
		return view('back-end.orders',compact('data'));
		return view('back-end.buy_now',compact('data'));
	}
	public function buy_now(Request $request)
    {
		$data['orders']=$this->Admin->viewOrders();
		return view('back-end.buy_now',compact('data'));
	}
	public function insertOrder(Request $request)
    {
		$data['si_no'] = $request->input('si_no');
		$data['Order_ID'] = $request->input('Order_ID');
		$data['customer_ID'] = $request->input('customer_ID');
		$data['Order_Name'] = $request->input('Order_Name');
		$data['Cost'] = $request->input('Cost');
		$insertOrder=$this->Admin->insertOrder($data);
    }
	
	public function editOrder(Request $request)
	{
		$data['EditId'] = $request->input('EditId');//getting id passed in the function
		$editOrder=$this->Admin->editOrder($data);
		return json_encode($editOrder);
	}
	public function deleteOrder(Request $request)
	{
		$data['DeleteId'] = $request->input('DeleteId');//getting id passed in the function
		$deleteOrder=$this->Admin->deleteOrder($data);
		
	}
	
		
}