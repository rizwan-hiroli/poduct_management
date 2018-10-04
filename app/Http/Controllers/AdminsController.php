<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use Response;

use DB;

use Illuminate\Support\Facades\Hash;

use Session;

use DateTime;

use App\User;

use App\Admin;

use App\AddUsage;

use App\AddProduct;

use Carbon\Carbon;

class AdminsController extends Controller
{
    
        public function __construct(){

        $this -> middleware('auth') -> except(['index','store','registration','register']); 
        //this middelware allows only if you are signed in except for the index and show method

      }



        public function index(){
          // $this->middleware('guest');
          // $this -> middleware('guest',['except' => 'destroy']);
          if (Auth::check())
          {
              // The user is logged in...
            return redirect('/dashboard');
          }

     	    return view('admins.create');

        }


        private function ddd($param){ //to displayy dd commaand while using ajax
              http_response_code(500);
              dd($param);
        }

        //putting all the rules together in an array
        protected $rules= array(
                                   'quantity'=>'required|max:1'
                                );
        //setting the displAY MESSAGE for each field
        protected $messages= array(
                                     'quantity.required' => ' This field is required'
                                 );



        public function dashboard(){


          return view('admins.dashboard');
        }

        public function registration(){

          return view('admins.register') ;
        }

        public function register(Request $request){
          //dd($request);
          $validatedData = $request->validate([
                'name' => 'required||max:255',
                'email' => 'required||email||unique:users,email',
                'password' => 'required||confirmed',
                
            ]); 
            $password = Hash::make($request->password);
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $password;  
            $user -> save();
            //$name = $request->name
            //$users = User::create($request->all());


          Session::flash('flash_message', 'You have registered successfully');            

         return redirect('/');
        }
    

        public function store(Request $request){
        
                $result= Auth::attempt(array('email' =>$request->email, 'password' =>$request->password));
                //verifyiing details by default laravel Auth method 
          
                if(! $result){

                        return back() -> withErrors([
                        //redirecting to same page and send error by laravel default function
                            'message' => 'Please check your credentials'
                        ]);
                }
                
          return redirect('/dashboard'); //redirecting to dashboard
          
    	  }

		
        public function show(){

                  $users = User::select('id','name') //select only id
                                    ->where('is_admin',0) //dont get value of admin
                                    ->where('status',1) //dont get the where user is disabled 
                                    ->get();
                  $product=AddProduct::select('price')
                                      ->get(); 
           return view('admins.show',compact('users','product'));

       	}


        public function save(Request $request)
        {

                // $userInputs = array(
                //                            'quantity'=> $request->quantity
                //                            );
                // //dd($request);
                //  $validation = validator::make($userInputs,$this->rules,$this->messages);
                //  // using validator class to validate.usually use for ajax responses
                //  if($validation->fails()){
                //         //using ajax validaation of laravel
                //         $response['result'] = "error";
                //         $response['errors'] = $validation->errors()->toArray();
                //         return json_encode($response); 
                //         // returning back data to dispaly on view
                    
                //   }
                  $price = AddProduct::select('price')
                                          ->get()
                                          ->toArray();
                  //$quantity=$request->addproduct;
                  
                  foreach ($request->addproduct as $array){
                        if($array[1] != null )
                          {
                        $product_function = new AddUsage;
                        //getting the first array i.e user id
                        $product_function->user_id = $array[0];
                        //inserting quantity form 
                        $product_function->quantity = $array[1]; 
                        $product_function->price =intval($price[0]['price']) ; 
                        $product_function->save();
                          }                      
                   }
                
                 //getting the response store in response array if success is return
                $response['result'] = "success"; 
                 return json_encode($response);
                 //returning back response to display in blade 
                
        }


        public function display(Request $request){
                      //getting the data from ajax and chunk it accordingly using explode
                      //explode works like split() of java

                      //$dateformat=$request->start->format();

                      $dates = explode(' - ', $request->start);
                                          //join table where id of 2 tables matches

                      //$temp = date_format(new DateTime($dates[0]),'Y-m-d');
                      //dd($temp);
                      if($request->id =='summary'){
                      $user = AddUsage::join('users', 'add_usage.user_id', '=', 'users.id')
                                          ->select(DB::raw('SUM(price*quantity) AS total,users.name,SUM(add_usage.quantity) as quantity'))
                                          ->groupBy('users.name')

                                          //->select('users.name','add_usage.quantity','add_usage.created_at')
                                          //getting the vlaues between the dates in array
                                          ->whereBetween('add_usage.created_at',[date_format(new DateTime($dates[0]),'Y-m-d').' 00:00:00',date_format(new DateTime($dates[1]),'Y-m-d').' 23:59:59']) 
                                          //carbon to fetch as per the request from user
                                          //->SUM('price'*'quantity')
                                          
                                          ->get()

                                          ->toArray();//converting object to array as we need to make json array
                            //dd($user);

                      }
                      elseif($request->id =='all'){
                      $user = AddUsage::join('users', 'add_usage.user_id', '=', 'users.id')
                                          ->select(DB::raw('price*quantity AS total,price,users.name,add_usage.quantity,add_usage.created_at'))
                                          //->select('users.name','add_usage.quantity','add_usage.created_at')
                                          //getting the vlaues between the dates in array
                                          ->whereBetween('add_usage.created_at',[date_format(new DateTime($dates[0]),'Y-m-d').' 00:00:00',date_format(new DateTime($dates[1]),'Y-m-d').' 23:59:59']) 
                                          //carbon to fetch as per the request from user
                                          //->SUM('price'*'quantity')
                                          ->get()
                                          ->toArray();//converting object to array as we need to make json array

                      }
                      else{
                          $user = AddUsage::where('user_id',$request->id)
                                          -> join('users', 'add_usage.user_id', '=', 'users.id')
                                         ->select(DB::raw('price*quantity AS total,price,users.name,add_usage.quantity,add_usage.created_at'))
                                          //getting the vlaues between the dates in array
                                          ->whereBetween('add_usage.created_at',[date_format(new DateTime($dates[0]),'Y-m-d').' 00:00:00',date_format(new DateTime($dates[1]),'Y-m-d').' 23:59:59']) 
                                          //carbon to fetch as per the request from user
                                          ->get()
                                          ->toArray();//converting object to array as we need to make json array
                         
                      }

            //dd($user);
            //sending respoonse back to ajax  in the form of ajax array
            //making the two json array named as user and product need to access on ajax accordingly 
           return Response::json(array('user'=>$user));
           
            
        }


        public function total(){
                                          
              $users =    User::select('id','name')
                                ->where('is_admin',0)
                                ->get();

              //dd($users);
            return view('admins.today',compact('users'));

        }

         public function destroy(){

                        auth()->logout(); //perform the logout by inbuild function/helper
                        return redirect() -> home(); //redirecting to homepage after logout
              
        
        } 


}