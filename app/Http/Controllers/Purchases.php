<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchasesModel;
use App\ItemProducts;
use App\PurchasesDetailsModel;
use App\PurchasesPriceHistory;
use App\DebitModal;


class Purchases extends Controller
{
    public function __construct()//constrctor to authnticate the user
    {
        $this->middleware('auth');
    }//ending of constrcutor to authenticate user
    
    public function add()
    {
        return view('addNewProducts');
    }
    public function createPurchase()	//function for creating a new purchase
    {
    	$sellerId=request("seller_id");
    	$invoiceId=request("invoice_id");
    	$totalBill=request("totalBill");
    	$paid=request("paid");
    	$productsName=(request("productsName"))[0];
    	$productsQuantity=request("productsQuantity")[0];
    	$productsAmount=request("productsAmount")[0];
    	$productsMoney=request("productsMoney")[0];
    	$productsPricePerItem=request("productsPricePerItem")[0];
    	$productsId=array();
    	//creating a new row in purchases table
    	$purchaseId=PurchasesModel::create([
    		"seller_id"=> $sellerId,
    		"invoice_id"=>$invoiceId,
    		"amount"=>$totalBill,
    		"paid"=>$paid,
    	])->id;
        //making a row in debit table
        DebitModal::create([
            "purchase_id"=> $purchaseId,
            "amount"=>$totalBill,
        ]);

    	//getting the ids of products
    	foreach ($productsName as $productName) {
    		$productsId[]=ItemProducts::where('name', $productName)->first()->id; 	
    	}//ending of foreach
    	$productsUsed=(sizeof($productsName));
    	for($i=0;$i<$productsUsed;$i++)	//loop for storing data in purchases details
    	{
    		PurchasesDetailsModel::create([
    			"product_id"=> $productsId[$i],
    			"purchases_id"=>$purchaseId,
    			"quantaity"=>$productsQuantity[$i],
    			"amount"=>$productsAmount[$i],
    		]);
    		PurchasesPriceHistory::create([
    			"product_id"=> $productsId[$i],
    			"price"=>$productsPricePerItem[$i],
    		]);
    		//updating blance of product
    		$obj=ItemProducts::where('id',$productsId[$i])->first();
    		$newBlance=$obj["ratio"]*$productsQuantity[$i];
    		$obj=ItemProducts::find($productsId[$i]);
    		$obj["balance"]=$obj['balance']+$newBlance;
    		$obj->update();
    	}//ending of for loop 
    }//ending of create purchase function
    public function recentPurchasePrice()
    {
    	$obj=PurchasesPriceHistory::where('product_id',request('productId'))->get();
        $lastIndex=(sizeof($obj));
        if($lastIndex != 0)//if product last price found
        {
        	return ($obj[$lastIndex-1]["price"]);
        }//enidng of if product last purchased price found
        else//else not found
        {
        	return "-12";
        }//ending of else product last price not found
    }//ending of recent purchase function
}
