<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sellerModel;

class SellerController extends Controller
{
    public function __construct()//constrctor to authnticate the user
    {
        $this->middleware('auth');
    }//ending of constrcutor to authenticate user
    public function sellerSearch()	//function for searching seller from database
    {
    	$sellerName=request("seller_name");
    	$data=sellerModel::where('seller_name', 'like', '%'.$sellerName.'%')->get();
        echo json_encode($data);
    }//ending of sellerSearch function
    public function sellerDetail()	//function for searching single seller detail
    {
    	$sellerId=request("sellerId");
    	$data=sellerModel::where('id', $sellerId)->first();
    	echo json_encode($data);
    }//ending of sellerDetail function
    public function addSeller()
    {
        $sellerName=request("sellerName");
        $sellerCompany=request("companyName");
        $data=sellerModel::where('seller_name', $sellerName)->first();
        if($data == null )//if seller already doesn't exist
        {
            $id=sellerModel::create([
                "seller_name"=> $sellerName,
                "seller_company"=>$sellerCompany,
            ])->id;
            return $id;
        }
        else  //else seller exist
        {
            return "-12";
        }//ending of else
    }
}//ending of searchController class
