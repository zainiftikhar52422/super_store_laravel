<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemModel;
use App\ItemProducts;
use App\sellerModel;
use App\ImageModal;


class Item extends Controller
{
    public function __construct()//constrctor to authnticate the user
    {
        $this->middleware('auth');
    }//ending of constrcutor to authenticate user
    public function imageTest() //function for imageTesting
    {
        dd($_FILES["image"]);
        dd($img);
    }
    public function addItem()
    {
        $itemName=request("itemName");
        $data=ItemModel::where('item_name', $itemName)->first();
        if($data == null )//if item already doesn't exist
        {
            $id=ItemModel::create([
                "item_name"=> $itemName,
            ])->id;
            return $id;
        }
        else  //else seller exist
        {
            return "-12";
        }//ending of else
        //image code
        /*$target_dir = "";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        dd($target_file);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) 
        {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) 
            {
               echo "File is an image - " . $check["mime"] . ".";
               $uploadOk = 1;
            }
            else 
            {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000)
            {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) 
            {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } 
            else 
            {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } 
                else
                {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        */
        //ending of image code
        
    }
    public function store()	//function for storing new item
    {
    	$obj=ItemModel::where('item_name',request('item_name'))->first();
    	if($obj != null)
    	{
    		return "off";
    	}
    	$id=ItemModel::create([
    		"item_name"=> request('item_name'),
    	])->id;
    	return $id;
    }
    public function image()
    {
        $name=ImageModal::where("id",1)->first();
        $name=$name["name"];
        return view("image",[
            "name"=>$name,
        ]);
    }
    public function editProductName() //function for editing product anme
    {
        ItemProducts::where('id',request('productId'))->update([
            "name"=>request("newName"),
        ]);
    }
    function addAProduct()  //function for adding a product from purchase view
    {
        $checkpoint=false;
        $saleUnit=request("saleUnit");
        $purchaseUnit=request("purchaseUnit");
        $productName=request("productName");
        $ratio=request("ratio");
        $itemId=request("itemId");
        $data=ItemProducts::where('item_id', $itemId)->get();
        if($data != null)
        {
            foreach($data as $row)
            {
                if($row["name"] == $productName)
                {
                    $checkpoint=true;
                    break;
                }
                else
                {
                    $checkpoint=false;
                }
            }
        }
        
        if($checkpoint == false )//if product already doesn't exist
        {
            ItemProducts::create([
                "name"=> $productName,
                "purchase_unit"=>$purchaseUnit,
                "sale_unit"=>$purchaseUnit,
                "item_id"=>$itemId,
                "ratio"=>$ratio,
            ]);
        }
        else  //else product exist
        {
            return "-12";
        }//ending of else
    }//enidnf of addAProduct function from purchase blade
    public function storeProducts()	//function for storing new item
    {
    	$products=request("products");
    	$salesUnit=request("salesUnit");
    	$purchasesUnit=request("purchasesUnit");
    	$ratio=request("ratio");
    	$arraySize=sizeof($products);
    	for($i=0;$i<$arraySize;$i++)
    	{
    		ItemProducts::create([
    			"name"=> $products[$i],
    			"item_id"=>request("item_id"),
    			"sale_unit"=>$salesUnit[$i],
    			"purchase_unit"=>$purchasesUnit[$i],
    			"ratio"=>$ratio[$i],
    		]);
    	}
    }//ending of function for storing products of an item
    public function productAll()    //function for searching all products
    {
        $itemId=request("itemId");
        $obj=ItemProducts::where('item_id',$itemId)->get();
        return $obj;
    }//ending of productall function
    public function productId() //function for getting product id
    {
        $obj=ItemProducts::where('name',request('productName'))->first();
        return $obj["id"];
    }
    public function addProductsOnly()
    {
    	return view("addProductsOnly");
    }
    public function searchItem()	//function for live searching Item
    {
    	$itemName=request("item_name");
    	$data=ItemModel::where('item_name', 'like', '%'.$itemName.'%')->get();
        echo json_encode($data);
    }
    public function searchProduct()    //function for live searching Item
    {
        $products= array();
        $productName=request("productName");
        $data=ItemProducts::where('name', 'like', '%'.$productName.'%')->get();
        for($i=0;$i<sizeof($data);$i++)
        {
            if($data[$i]["item_id"] == request("itemId"))
            {
                array_push($products, $data[$i]);
            }
        }
        echo json_encode($products);
    }
    public function purchase()//function for making point of purchase
    {
        $obj=ItemModel::all();
        $sellers=sellerModel::all();
        //dd($sellers);
        return view("purchases",[
            "items"=>$obj ,
            "sellers"=>$sellers,
        ]);
    }//ending of point of purchase function
    public function addProductsOnly2()//function for adding products
    {
        $obj=ItemModel::all();
        return view("addProductsOnly2",[
            "items"=>$obj ,
        ]);
    }//ending of point of purchase function
    public function allItems()  //fuction for returnning all items
    {
        $items=ItemModel::all();

        return json_encode($items);
    }

    public function itemIdCalculte()//function for finding id of item
    {
    	$itemName=request("item_name");
    	$data=ItemModel::where('item_name', $itemName)->first();
    	$data=($data["id"]);
		//dd($data);
		$var=ItemProducts::where('item_id', $data)->get();
		//dd($var);
		if(sizeof($var) != 0)//if products of item exist
		{
			//var_dump("products exist");
			return $var;
		}
		else  //products of item doesnt exits
		{
			//var_dump("products doesn't exist");
			return $data;
		}//ending of else condiiotn
    }//ending of function for calculting id
    public function itemName()  //function determine itemName through its id
    {
        $obj=ItemModel::where('id',request('itemId'))->first();
        return $obj["item_name"];
    }
    public function productName()  //function determine itemName through its id
    {
        $obj=ItemProducts::where('id',request('productId'))->first();
        return $obj["name"];
    }
    public function productPurchaseType()  //function determine itemName through its id
    {

        $obj=ItemProducts::where('id',request('productId'))->first();
        return $obj["purchase_unit"];
    }

    public function productComplete()  //function for searching single product full detail
    {
        $productId=request("productId");
        $data=ItemProducts::where('id', $productId)->first();
        echo json_encode($data);
    }//ending of sellerDetail function
}
