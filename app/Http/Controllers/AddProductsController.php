<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AddProduct;

use Session;

use Illuminate\Support\Facades\Validator;

class AddProductsController extends Controller
{
    //
   public function __construct(){

        $this -> middleware('auth') ; 
        //this middelware allows only if you are signed in except for the index and show method

      }



  	public function index(){

        $products = AddProduct::all();
      	return view('admins.addproduct',compact('products'));

    }

    public function store(Request $request){
            //dd($request);
            $validatedData = $request->validate([
                'prod_name' => 'required||max:255',
                'price' => 'required|numeric',
            ]);
            $product = AddProduct::where('id','=',$request->id); 
        	  $product->update($request->except('_token'));
        	
            Session::flash('flash_message', 'Data Successfully Updated'); 
            //set the flash message just need to display this in a blade
      	return back();
      	
    }

    public function show(){
            $products = AddProduct::all();
          return view('admins.showproducts',compact('products'));

    }

    

}
