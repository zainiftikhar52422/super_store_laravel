<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemModel;
use App\ItemProducts;
use App\SellPriceHistoryModal;
use App\SalesModal;
use App\SalesDetailsModal;
use App\CreditModal;

 
class SellController extends Controller
{
    public function __construct()//constrctor to authnticate the user
    {
        $this->middleware('auth');
    }//ending of constrcutor to authenticate user
    public function main()//function for showing page for selling
    {
    	$obj=ItemModel::all();
        return view("sell",[
            "items"=>$obj ,
        ]);
    }//enindg of main function
    public function recentSellPrice()	//function for returning suggestion of recent sell price
    {
    	$obj=SellPriceHistoryModal::where('product_id',request('productId'))->get();
        $lastIndex=(sizeof($obj));
        if($lastIndex != 0)//if product last price found
        {
        	return ($obj[$lastIndex-1]["price"]);
        }//enidng of if product last purchased price found
        else//else not found
        {
        	return "-12";
        }//ending of else product last price not found
    }//ending of recentSellPrice function
    public function sell()//function for selling a product
    {
    	$productsName=(request("productsName"))[0];
    	$productsQuantity=request("productsQuantity")[0];
    	$productsAmount=request("productsAmount")[0];//amount of money of product
    	$productsPricePerItem=request("productsPricePerItem")[0];
    	$productsId=array();

    	//creating a row in sales table
    	$salesId=SalesModal::create([
    		"buyer_name"=> request('customerName'),
    		"amount"=>request('totalBill'),
    	])->id;
    	//creating a row in credit table
    	CreditModal::create([
    		"sales_id"=>$salesId,
    		"amount"=>request('totalBill'),
    	]);

    	//getting the ids of products
    	foreach ($productsName as $productName) {
    		$productsId[]=ItemProducts::where('name', $productName)->first()->id; 	
    	}//ending of foreach
    	$productsUsed=(sizeof($productsName));
    	for($i=0;$i<$productsUsed;$i++)	//loop for storing data in purchases details
    	{
    		SalesDetailsModal::create([
    			"product_id"=> $productsId[$i],
    			"sales_id"=>$salesId,
    			"quantity"=>$productsQuantity[$i],
    			"amount"=>$productsAmount[$i],
    		]);
    		SellPriceHistoryModal::create([
    			"product_id"=> $productsId[$i],
    			"price"=>$productsPricePerItem[$i],
    		]);
    		//updating blance of a product after selling 
    		$obj=ItemProducts::find($productsId[$i]);
    		$obj["balance"] -= $productsQuantity[$i];
    		$obj->update();
    	}//ending of for loop 
    }
}//enidng of SellController class