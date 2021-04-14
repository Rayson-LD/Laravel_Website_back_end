<?php
	
	namespace App\http\models;
	
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Auth;
	
	class AdminModel extends Model
	{
		public function insertCustomer($id)
		{
			
			if($id['si_no']=="")
			{
				
			 $Customer= DB::table('customers')->insertGetId(["customer_ID"=>$id['customer_ID'],"customer_name"=>$id['cust_name'],"customer_number"=>$id['cust_number'],"customer_email"=>$id['cust_email'],"address1"=>$id['cust_address1'],"address2"=>$id['cust_address2'],"city"=>$id['cust_city'],"state"=>$id['cust_state'],"customer_status"=>'0']);
			}
			else
			{
				
			 $Customer= DB::table('customers')->where('si_no','=',$id['si_no'])->update(["customer_ID"=>$id['customer_ID'],"customer_name"=>$id['cust_name'],"customer_number"=>$id['cust_number'],"customer_email"=>$id['cust_email'],"address1"=>$id['cust_address1'],"address2"=>$id['cust_address2'],"city"=>$id['cust_city'],"state"=>$id['cust_state']]);
			}
			
				
			 return $Customer;
			
		}
		
		public function viewCustomers()
		{
			return DB::table('customers')->where('customer_status','=','0')->get();
		}
		
		public function EditCustomer($id)
		{
			return DB::table('customers')->where('si_no','=',$id['EditId'])->first();
			//getting data from database whose id is same as that of id clicked to edit
		}
		
		public function DeleteCustomer($id)
		{
			return DB::table('customers')->where('si_no','=',$id['DeleteId'])->update(['customer_status'=>'1']);
			//this is changing status from 0 to 1 means deactivate
			//return DB::table('form')->where('customer_id','=',$id['EditId'])->delete();we can also delete the row from the database
		}
		public function insertVendor($id)
		{
			if($id['vendor_id']=="")
			{
				 $Vendor= DB::table('vendors')->insertGetId(["vendor_name"=>$id['vendor_name'],"Order_ID"=>$id['Order_ID'],"vendor_phone"=>$id['vendor_number'],"vendor_email"=>$id['vendor_email'],"address"=>$id['vendor_address'],"city"=>$id['vendor_city'],"state"=>$id['vendor_state'],"pin"=>$id['vendor_pin'],"vendor_status"=>'0']);
			}
			else
			{
				
			 $Vendor= DB::table('vendors')->where('vendor_id','=',$id['vendor_id'])->update(["vendor_name"=>$id['vendor_name'],"Order_ID"=>$id['Order_ID'],"vendor_phone"=>$id['vendor_number'],"vendor_email"=>$id['vendor_email'],"address"=>$id['vendor_address'],"city"=>$id['vendor_city'],"state"=>$id['vendor_state'],"pin"=>$id['vendor_pin']]);
			}
			return $Vendor;
		}
		public function viewVendor()
		{
			return DB::table('vendors')->where('vendor_status','=','0')->get();
		}
		public function EditVendor($id)
		{
			return DB::table('vendors')->where('vendor_id','=',$id['EditId'])->first();
			//getting data from database whose id is same as that of id clicked to edit
		}
		public function DeleteVendor($id)
		{
			return DB::table('vendors')->where('vendor_id','=',$id['DeleteId'])->update(['vendor_status'=>'1']);
			//this is changing status from 0 to 1 means deactivate
			//return DB::table('form')->where('customer_id','=',$id['EditId'])->delete();we can also delete the row from the database
		}
		
		public function resetPassword($id){
			
			
			$pass=DB::table('users')->where('user_type','admin')->select('password','id')->first();
			$uid=$pass->id;
			$password=$pass->password;
			if($password==$id['old_p'])
			{
				$det=DB::table('users')->where("id",'=',$uid)->where('password',$id['old_p'])->update(['password'=>$id['new_p']]);
			}
			else 
			{
				$det=0;
			}
			return $det;
			
		}
		
		
		/*-----------------------------*/
		public function about_insert($id)
		{
			if($id['about_id']=="")
			{
				
			 $about= DB::table('about')->insertGetId(["about_image"=>$id['about_image'],"about_name"=>$id['about_name'],"about_desc"=>$id['about_description'],"time"=>$id['time'],"about_status"=>'0']);
			}
			else
			{
				
			 $about= DB::table('about')->where('about_id','=',$id['about_id'])->update(["about_image"=>$id['about_image'],"about_name"=>$id['about_name'],"about_desc"=>$id['about_description'],"time"=>$id['time']]);
			}
			 return $about;
		}
		public function viewImage()
		{
			return DB::table('about')->get();
		}
		public function insertCareer($id)
		{
			if($id['careers_id']=="")
			{
				 $career= DB::table('careers')->insertGetId(["careers_description"=>$id['careers_description'],"careers_status"=>'0']);
			}
			else
			{
				
			 $career= DB::table('careers')->where('career_id','=',$id['careers_id'])->update(["careers_description"=>$id['careers_description']]);
			}
			return $career;
		}
		public function viewdesc()
		{
			return DB::table('careers')->where('careers_status','=','0')->get();
		}
		public function Editdesc($id)
		{
			return DB::table('careers')->where('career_id','=',$id['EditId'])->first();
			//getting data from database whose id is same as that of id clicked to edit
		}
		
		
		//<---    ************************ -->//
		public function EditService($id)
		{
			return DB::table('services')->where('service_id','=',$id['EditId'])->first();
			//getting data from database whose id is same as that of id clicked to edit
		}
		public function insertServices($id)
		{
			if($id['service_id']=="")
			{
				 $services= DB::table('services')->insertGetId(["services_title"=>$id['services_title'],"services_description"=>$id['services_description'],"services_status"=>'0']);
			}
			else
			{
				
			 $services= DB::table('services')->where('service_id','=',$id['service_id'])->update(["services_title"=>$id['services_title'],"services_description"=>$id['services_description']]);
			}
			return $services;
		}
		public function viewServices()
		{
			return DB::table('services')->where('services_status','=','0')->get();
		}
		public function DeleteServices($id)
		{
			return DB::table('services')->where('service_id','=',$id['DeleteId'])->update(['services_status'=>'1']);
			//this is changing status from 0 to 1 means deactivate
			//return DB::table('form')->where('customer_id','=',$id['EditId'])->delete();we can also delete the row from the database
		}
		
		public function insertContact($id)
		{
			if($id['contact_id']=="")
			{
				 $contacts= DB::table('comments')->insertGetId(["contact_name"=>$id['contact_name'],"contact_desc"=>$id['contact_desc'],
				 "time"=>$id['time'],"contact_status"=>'0']);
			}
			else
			{
				
			 $contacts= DB::table('comments')->where('contact_id','=',$id['contact_id'])->update(["contact_name"=>$id['contact_name'],"contact_desc"=>$id['contact_desc'],"time"=>$id['time']]);
			}
			return $contacts;
		}
		public function viewComments()
		{
			return DB::table('comments')->where('contact_status','=','0')->get();
		}
		public function insertOrder($id)
		{
			if($id['si_no']=="")
			{
				
			 $Order= DB::table('item')->insertGetId(["Order_ID"=>$id['Order_ID'],"customer_ID"=>$id['customer_ID'],"Order_Name"=>$id['Order_Name'],"Cost"=>$id['Cost']]);
			 
			}
			else
			{
				
			 $Order= DB::table('item')->where('si_no','=',$id['si_no'])->update(["Order_ID"=>$id['Order_ID'],"customer_ID"=>$id['customer_ID'],"Order_Name"=>$id['Order_Name'],"Cost"=>$id['Cost']]);
			}
			
			 return $Order;
		}
		
		public function viewOrders()
		{
			return DB::table('item')->where('order_status','=','0')->get();
		}
		
		public function editOrder($id)
		{
			return DB::table('item')->where('si_no','=',$id['EditId'])->first();
			//getting data from database whose id is same as that of id clicked to edit
		}
		public function deleteOrder($id)
		{
			return DB::table('item')->where('si_no','=',$id['DeleteId'])->update(['order_status'=>'1']);
			//this is changing status from 0 to 1 means deactivate
			//return DB::table('form')->where('customer_id','=',$id['EditId'])->delete();we can also delete the row from the database
		}
	
	}