<!--<!DOCTYPE html>
<html>
<head>
	<title></title>
  	<link href="<?php echo e(URL::asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(URL::asset('css/bootstrap2.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(URL::asset('css/gluph.min.css')); ?>" rel="stylesheet">
	<script type="text/javascript" src="<?php echo e(URL::asset('js/jquery.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap.min.js')); ?>"></script>-->
	<?php $__env->startSection('css'); ?>
		<style type="text/css">
			.form-popup {
			  display: none;
			  position: absolute;
			  top: 70;
			  left: 75px;
			  border: 3px solid #f1f1f1;
			  z-index: 1;
			  width: 1000px;
			}
			.form-container {
			  max-width: 1000px;
			  padding: 10px;
			  background-color: white;
			  z-index: 1;
			}
			.form-popup {
			  width: 1000px;
			  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 1, 0, 1);
			}
			.blur{
			  -webkit-filter: blur(5px); /* Chrome, Safari, Opera */
			  filter: blur(5px);
			}

			.badge {
			  padding-left: 9px;
			  padding-right: 9px;
			  -webkit-border-radius: 9px;
			  -moz-border-radius: 9px;
			  border-radius: 9px;
			}

			.label-warning[href],
			.badge-warning[href] {
			  background-color: #c67605;
			}
			#lblCartCount {
			    font-size: 12px;
			    background: #ff0000;
			    color: #fff;
			    padding: 0 5px;
			    vertical-align: top;
			    margin-left: -10px; 
			}
			.fa {cursor: pointer;}
			#my_logo{
			    background: url"../graphics/dhaka logo.png");
			    width : 90px;
			    margin-top:150px;
			    margin-left: 180px;
			}
			#my_logo_div{
			    
			}
			.simple{
				 width: 127px;
				 border:1px solid black;
			}
			.inputs{
				width: 77px;
			}
		</style>
	<?php $__env->stopSection(); ?>	
<!--
</head>
<body>-->
	<?php $__env->startSection('content'); ?>
		<div class="container" style="margin-top: 25px;">
			<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
	            <?php echo csrf_field(); ?>
	        </form>
			<!--PILLS-->
			<div class="row" style="margin-bottom: 7px;">
				<div class="col-md-12">
					<ul class="nav nav-tabs">
					  <li role="presentation"><a href="/sell"><img src="/image/point-of-sale-terminal-pos.png" >Point Of Sale</a></li>
					  <li role="presentation" class="active"><a href="#"><img src="/image/point-of-per-terminal-pos.png" >Purchase</a></li>
					  <li role="presentation"><a href="/product/add2"><img src="/image/add.png" >Add Product</a></li>
					  <li role="presentation"><a href="/survey"><img src="/image/survey.png" >Survey</a></li>
					  <ul class="nav navbar-nav navbar-right" style="margin-top: -9px;">
						    <li>
						    	<a href="<?php echo e(route('logout')); ?>"
				                   onclick="event.preventDefault();
				                                 document.getElementById('logout-form').submit();">
				                    <img src="/image/exit.png">
				                    <?php echo e(__('Logout')); ?>

				                </a>
						    </li>
					   </ul>
					</ul>
				</div>
			</div>
	<!--Navigation and sellere select-->
			
			<div class="row">
				<div class="col-md-8" id="crumb_bar">
					<ol class="breadcrumb" id="breadcrumb">
					  <li class="breadcrumb-item active" id="crumb1">Home</li>
					</ol>
				</div>
				<div class="col-md-3" id="seller_bar">
					<select class="form-control" id="seller">
						<option>Select a Seller</option>
						<?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option id="<?php echo e('seller'.$seller['id']); ?>"><?php echo e($seller["seller_name"]); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
				<div class="col-md-1" style="margin-left: -20px;">
					<button type="button"  id="add_seller_button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Seller</button>
					<!--<button type="button" class="btn-info" onclick="popup_seller()">+</button>-->
				</div>
			</div>
			<!--Modal content-->
			<div class="modal fade" id="myModal" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Add New Seller</h4>
				        </div>
				        <div class="modal-body">
				          <form class="form-horizontal" action="enrollment.php" method="post">
								<div class="form-group">
									<label class="control-label col-md-3" for="first_name">	Seller Name: 
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="Seller Name" name="new_seller_name" required id="new_seller_name">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3" for="psw">Company Name: </label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="Company Name" name="new_seller_company" id="new_seller_company" required>
									</div>
								</div>
							</form>
				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-success" id="add_new_seller_button" onclick="addNewSeller()" data-dismiss="modal">Submit</button>
				        </div>
				      </div>
			      
			    </div>
			</div>
			<!--search bars-->
			<div class="row">
				
				<div class="col-md-1 col-md-offset-8" id="basket_sign">
					<img src="/image/shopping-cart (1).png">
					<span class='badge badge-warning' id='lblCartCount'></span>
				</div>
				<!--search bar for items-->
				<div class="col-md-3" id="item_search">
					<input type="text" name="search_text" id="search_text" class="form-control" list="json-datalist" placeholder="Search Here">
					<datalist id="json-datalist" ></datalist>
				</div>
			</div>
			<!--Items and cart-->
			<div class="row" style="margin-top: 8px;">	
				<div class="col-md-5" style="border: 1px solid #CFCFCF;height: 950px;background-color: #FCFAFB" id="itemCart">
					<div class="row" style="background-color: #3A393A;height: 30px;color: white">
						<div class="col-md-12">
							<h4>Purchasing Cart</h4>
						</div>
						<div id="my_logo_div">
							<img src="/image/goods (1).png" id="my_logo">
							<h3 style="color: #C1C1C1;margin-left: 160px;">Cart is empty</h3>
						</div>
					</div>
					<table id="list" style="display: none;">
						<tr>
							<th class="simple">Name</th>
							<th class="inputs" style="border: 1px solid black;">Quanty</th>
							<th class="inputs" style="border: 1px solid black;">Price/Item</th>
							<th class="simple">Total</th>
						</tr>
					</table>

				</div>
				<!--registered items-->
				<div class="col-md-7" id="items" style="margin-top:5px; ">
					<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-body"> <?php echo e($item["item_name"]); ?> </div>
								<div class="panel-footer"> 
									<button class="btn btn-primary" onclick="itemName(this.id)" id="<?php echo e($item['id']); ?>">
		  								Products
									</button>
								</div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				<div class="col-md-7" id="products">
				</div>
				<div class="col-md-7" id="addProductFromPurchase" style="display: none;">
					<hr>
					<button class="btn btn-success" id="buttonShowingTab3"  onclick="showTab3()" style="float: right;">Add New Product</button>
					<br>
					<div class="row" id="tab3" style="display: none;">
						<div id="product_section" class="col-md-10 col-md-offset-1"> 
							<input type="text" class="form-control r" style="float: left;width: 150px;margin-right: 3px;" placeholder="Products" id="addProduct1" name="products[]" required="">
							<input type="text" class="form-control r" style="float: left;width: 100px;margin-right: 3px;" placeholder="Sale Unit" id="addSale1" name="sale_unit[]" required="" onChange="calculateRatio2()">
							<input type="text" class="form-control r" style="float: left;width: 150px;margin-right: 3px;" placeholder="Purchase Unit" id="addPurchase1" name="purchase_unit[]" required="" onChange="calculateRatio()">
							<input type="text" class="form-control r" style="float: left;width: 70px;margin-right: 3px;" onclick="salePurchaseCheck()" placeholder="Ratio" id="addRatio1" name="ratio[]" required="">
							<input type="button" onclick="addProduct()" style="float: left;margin-left:0px;"class="btn btn-success" value="Add">
						</div>
					</div><!--Tab3 ends-->
				</div>
			</div>
		</div>













		<!-- java script------------------------>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript">
			var flage=false;//to find weather item exist or doesnt
			var selectedSellerId=0;
			var g=[];
			let proId;	//id of product whom we are going to purchase
			var productsPurchased=0;	//number of products purchased
	    	var sellers=[];	//array for storing sellers obtained from ajax search
			$("#lblCartCount").text(productsPurchased);
			//selecting a seller
			$("#seller").change(function() {
			  var id = $(this).children(":selected").attr("id");
			  $("#seller").prop( "disabled", true );
			  selectedSellerId = id.slice(6);
			  $("#seller").css("border","1px solid #CCCCCC");
			});//ending of seller function

			function showTab3()	//function for showing addnew products whole tab
	    	{
	    		$("#tab3").css("display","block");
	    		$("#buttonShowingTab3").hide();
	    	}//ending of showTab3 function

	    	//function for adding productys
	    	function addProduct()
	    	{
	    		var flageValidation=true;	//for checking validations of products fields
				if($("#addProduct1").val() == "")
				{
					flageValidation=false;
					$("#addProduct1").css("border","1px solid red");
				}
				else
				{
					$("#addProduct1").css("border","1px solid #CCCCCC");
				}
				if($("#addSale1").val() == "")
				{
					flageValidation=false;
					$("#addSale1").css("border","1px solid red");
				}
				else{
					$("#addSale1").css("border","1px solid #CCCCCC");
				}
				if($("#addPurchase1").val() == "")
				{
					flageValidation=false;
					$("#addPurchase1").css("border","1px solid red");
				}
				else{
					$("#addPurchase1").css("border","1px solid #CCCCCC");
				}
				if($("#addRatio1").val() == "")
				{
					flageValidation=false;
					$("#addRatio1").css("border","1px solid red");
				}
				else{
					$("#addRatio1").css("border","1px solid #CCCCCC");
				}
	    		if(flageValidation == true)	//if form passes validations
	    		{
	    			ajaxRegisterProduct()//product registered successfully
	    		}//ending of if form passes validation
	    	}//ending of addProduct function
	    	function ajaxRegisterProduct()//function for stroing data in serever
	    	{
	    		let flage;
	    		$.get("/item/product/purchase/store",{
						productName : $("#addProduct1").val(),
						saleUnit: $("#addSale1").val(),
						purchaseUnit :$("#addPurchase1").val(),
						ratio: $("#addRatio1").val(),
						itemId:selectedItemId,
					},
					function(data)
					{
						if(data == "-12")//if product already exist
						{
							alert("Product already exist");
							$("#addProduct1").val("");
				    		$("#addSale1").val("");
				    		$("#addPurchase1").val("");
				    		$("#addRatio1").val("");
				    		$("#addRatio1").prop("disabled",false);
						}
						else{
							successForRegistered();
						}
					},
				);	//sending data to server through ajax
	    	}//ending of creating new product
	    	function successForRegistered()//function for showing success message
	    	{
	    		alert("products registerd succesfully");
	    		$("#addProduct1").val("");
	    		$("#addSale1").val("");
	    		$("#addPurchase1").val("");
	    		$("#addRatio1").val("");
	    		$("#addRatio1").prop("disabled",false);
	    		itemName(selectedItemId);
				$("#tab3").css("display","none");
				$("#buttonShowingTab3").css("display","block");
	    	}//endin gof function showing success message


			//for loading all items on page load
			$("#search_text").keyup(function()
	    	{
	    		//$("#tab3").css("display","none");
	    		var txt=$(this).val();
	    		if(txt != "")	//if user enter some chracters in box
	    		{
	    			$.get("/item/search",{
		    			item_name: txt,
		    		},function(data){
		    			this.g=JSON.parse(data);
		    			var arrayLength=(this.g).length;
		    			$("#json-datalist").empty();
		    			$("#items").empty();
		    			for(let j=0;j<arrayLength;j++)//for looop for making option of all names
		    			{
		    				var dataList=document.getElementById('json-datalist');
		    				var option = document.createElement('option');
		    				// Set the value using the item in the JSON array.
					        option.value = (this.g)[j]["item_name"];
					        // Add the <option> element to the <datalist>.
					        dataList.appendChild(option);
					        //making 4md area for one panel
					        var node = document.createElement("div");
							node.setAttribute("class", "col-md-3");
							node.setAttribute("id", "col"+j);
							$("#items").append(node);
							
	    					//making panel container
	    					var node = document.createElement("div");
							node.setAttribute("class", "panel panel-default");
							node.setAttribute("id", "panel"+j);
							$("#col"+j).append(node);
							//panel heading
							node = document.createElement("div");
							node.setAttribute("class", "panel-body");
							node.setAttribute("id", "body"+j);
							$("#panel"+j).append(node);
							$("#body"+j).text((this.g)[j]["item_name"]);
							//making footer
							node = document.createElement("div");
							node.setAttribute("class", "panel-footer");
							node.setAttribute("id", "foot"+j);
							$("#panel"+j).append(node);
							//making a button in footer
							node = document.createElement("button");
							node.setAttribute("class", "btn btn-primary");
							node.setAttribute("id",(this.g)[j]["id"]);
							$("#foot"+j).append(node);
							$("#"+(this.g)[j]["id"]).text("Products");
							$("#"+(this.g)[j]["id"]).click(function()
							{
								itemName(this.id);
							});
		    			}//ending of for loop for appending data oin data list
		    		});
	    		}//ending of if input is not empty
	    		else
	    		{
	    			$.get("/item/all",function(data){
		    			this.g=JSON.parse(data);
		    			var arrayLength=(this.g).length;
		    			//alert(arrayLength);
		    			$("#items").empty();
		    			$("#json-datalist").empty();
		    			for(let j=0;j<arrayLength;j++)//for looop for making option of all names
		    			{
		    				//making 4md area for one panel
					        var node = document.createElement("div");
							node.setAttribute("class", "col-md-3");
							node.setAttribute("id", "col"+j);
							$("#items").append(node);
							
	    					//making panel container
	    					var node = document.createElement("div");
							node.setAttribute("class", "panel panel-default");
							node.setAttribute("id", "panel"+j);
							$("#col"+j).append(node);
							//panel heading
							node = document.createElement("div");
							node.setAttribute("class", "panel-body");
							node.setAttribute("id", "body"+j);
							$("#panel"+j).append(node);
							$("#body"+j).text((this.g)[j]["item_name"]);
							//making footer
							node = document.createElement("div");
							node.setAttribute("class", "panel-footer");
							node.setAttribute("id", "foot"+j);
							$("#panel"+j).append(node);
							//making a button in footer
							node = document.createElement("button");
							node.setAttribute("class", "btn btn-primary");
							node.setAttribute("id",(this.g)[j]["id"]);
							$("#foot"+j).append(node);
							$("#"+(this.g)[j]["id"]).text("Products");
							$("#"+(this.g)[j]["id"]).click(function()
							{
								itemName(this.id);
							});
		    			}//ending of for loop for appending data oin data list
		    		}//eninf of get request function
		    		);//ending of ajax request
	    			
		    		//console.log(this.itemName);
	    		}//enidng of else condition
	    	});
	    	function addNewSeller()	//function for adding new seller
	    	{
	    		let sellerName=$("#new_seller_name").val();
	    		let companyName=$("#new_seller_company").val();
	    		$.get("/addSeller",
	    			{
		    			sellerName: sellerName,
		    			companyName: companyName,
	    			},
	    			function(id)
	    			{
	    				if(id != "-12")//seller already doesn't exist
	    				{
	    					assignId(id,sellerName);
	    				}
	    				else
	    				{
	    					alert("seller already registered");
	    				}
	    				

	    			}//ending of id function
	    		);
	    	}
	    	function assignId(id,sellerName)	//function for selecting new seller from seller list
	    	{
	    		selectedSellerId=id;
	    		$("#seller").empty();
	    		var node = document.createElement("option");
	    		node.setAttribute("id","too");
				$("#seller").append(node);
				$("#too").text(sellerName);
				$("#seller").prop( "disabled", true );
				$("#add_seller_button").prop("disabled",true);
	    	}
	    	var selectedItemId=0;
			function itemName(itemId) {
				selectedItemId=itemId;
				if(selectedSellerId==0)//if seller is not yet selected
				{
					alert("Please select a seller first");
					$("#seller").css("border","1px solid red");
				}//ending of i seller is not selected
				else//else seller is selected
				{
					$.get("/itemName",{
	    			itemId: itemId,},
	    			function(data)
	    			{
	    				showProducts(data);//function for showing prodyucts
	    			}
	    			);
				}//ening of else seller is selected
			}//ending of itemName function
	    	function showProducts(itemName)//function for showing products
	    	{
	    		$("#item_search").hide();
	    		$("#items").hide();
	    		$("#crumb_bar").addClass('col-md-12').removeClass('col-md-8');
	    		$("#basket_sign").addClass('col-md-1 col-md-offset-11').removeClass('col-md-1 col-md-offset-8');
	    		$("#seller_bar").css("display","none");
	    		$("#add_seller_button").css("display","none");
	    		$("#breadcrumb").empty();
	    		var node = document.createElement("li");
				node.setAttribute("class", "breadcrumb-item");
				node.setAttribute("id", "crumb1");
				$("#breadcrumb").append(node);
				node = document.createElement("a");
				node.setAttribute("href", "#");
				node.setAttribute("id", "crumb11");
				$("#crumb1").append(node);
				$("#crumb11").text("Items");
				$("#crumb11").click(function()
				{
					mainPage();//function for displying main screen
				});
	    		node = document.createElement("li");
				node.setAttribute("class", "breadcrumb-item active");
				node.setAttribute("id", "crumb2");
				$("#breadcrumb").append(node);
				$("#crumb2").text(itemName);
				$("#products").empty();
				$.get("/item/id",{
			    			item_name: itemName,
			    		},function(data)
			    		{
			    			if (data >0)	//if item has no products
			    			{
			    				alert('Item has no proucts');
			    			}
			    			else
			    			{
			    				for(let j=0;j<data.length;j++)//for looop for making option of all names
				    			{
				    				//making 4md area for one panel
							        var node = document.createElement("div");
									node.setAttribute("class", "col-md-3");
									node.setAttribute("id", "pro_col"+j);
									$("#products").append(node);
									
			    					//making panel container
			    					var node = document.createElement("div");
									node.setAttribute("class", "panel panel-default");
									node.setAttribute("id", "pro_panel"+j);
									$("#pro_col"+j).append(node);
									//panel heading
									node = document.createElement("div");
									node.setAttribute("class", "panel-body");
									node.setAttribute("id", "pro_body"+j);
									$("#pro_panel"+j).append(node);
									$("#pro_body"+j).text((data)[j]["name"]);
									//making footer
									node = document.createElement("div");
									node.setAttribute("class", "panel-footer");
									node.setAttribute("id", "pro_foot"+j);
									$("#pro_panel"+j).append(node);
									//making a button in footer
									node = document.createElement("button");
									node.setAttribute("class", "btn btn-primary");
									node.setAttribute("id","pro"+(data)[j]["id"]);
									$("#pro_foot"+j).append(node);
									$("#pro"+(data)[j]["id"]).text("Add");
									$("#pro"+(data)[j]["id"]).click(function()
									{
										$("#pro"+(data)[j]["id"]).prop( "disabled", true );
										purchaseItem(this.id);
									});
				    			}//ending of for loop for appending data oin data list
			    			}//ending of else item has products
			    		}//ending of ajax request function
			    );//ending of ajax request
			    $("#addProductFromPurchase").css("display","block");
	    	}//ending of showProducts function
	    	function mainPage()//function for displying main page
	    	{
	    		
	    		$("#crumb_bar").addClass('col-md-8').removeClass('col-md-12');
	    		$("#seller_bar").css("display","block");
	    		$("#add_seller_button").css("display","block");
	    		$("#basket_sign").addClass('col-md-1 col-md-offset-8').removeClass('col-md-offset-11');
	    		$("#item_search").css("display","block");
	    		$("#items").css("display","block");
	    		$("#items").empty();
	    		$("#breadcrumb").empty();
	    		var nodee = document.createElement("li");
				nodee.setAttribute("class", "breadcrumb-item active");
				nodee.setAttribute("id", "crumb1");
				$("#breadcrumb").append(nodee);
				$("#crumb1").text("Items");

	    		$.get("/item/all",function(data){
	    			this.g=JSON.parse(data);
	    			var arrayLength=(this.g).length;
	    			//alert(arrayLength);
	    			$("#items").empty();
	    			$("#products").empty();
	    			$("#json-datalist").empty();
	    			for(let j=0;j<arrayLength;j++)//for looop for making option of all names
	    			{
	    				//making 4md area for one panel
				        var node = document.createElement("div");
						node.setAttribute("class", "col-md-3");
						node.setAttribute("id", "col"+j);
						$("#items").append(node);
						
						//making panel container
						var node = document.createElement("div");
						node.setAttribute("class", "panel panel-default");
						node.setAttribute("id", "panel"+j);
						$("#col"+j).append(node);
						//panel heading
						node = document.createElement("div");
						node.setAttribute("class", "panel-body");
						node.setAttribute("id", "body"+j);
						$("#panel"+j).append(node);
						$("#body"+j).text((this.g)[j]["item_name"]);
						//making footer
						node = document.createElement("div");
						node.setAttribute("class", "panel-footer");
						node.setAttribute("id", "foot"+j);
						$("#panel"+j).append(node);
						//making a button in footer
						node = document.createElement("button");
						node.setAttribute("class", "btn btn-primary");
						node.setAttribute("id",(this.g)[j]["id"]);
						$("#foot"+j).append(node);
						$("#"+(this.g)[j]["id"]).text("Products");
						$("#"+(this.g)[j]["id"]).click(function()
						{
							itemName(this.id);
						});
	    			}//ending of for loop for appending data oin data list
	    		}//eninf of get request function
	    		);//ending of ajax request

	    	}//ending of mainPage function
	    	function purchaseItem(productId)	//function for purchasing product
	    	{
	    		proId=productId;
	    		productId = productId.slice(3);
	    		$.get("/product/complete",{
	    			productId: productId,},
	    			function(data)
	    			{
	    				data=JSON.parse(data);
	    				addToCart(productId,data['name'],data['purchase_unit']);

	    			}
	    		);
	    	}//ending of purchaseItem function
	    	function productName()
	    	{
	    		productId = proId.slice(3);
	    		$.get("/productName",{
	    			productId: productId,},
	    			function(data)
	    			{
	    				purchaseType(data);

	    			}
	    		);

	    	}//ending of product name function
	    	function purchaseType(productName)
	    	{
	    		productId = proId.slice(3);
	    		$.get("/purchaseType",{
	    			productId: productId,},
	    			function(data)
	    			{
	    				addToCart(data,productName);

	    			}
	    		);
	    	}//endin gof purchase type function
	    	var row=2;
	    	var col=1;
	    	function addToCart(productId,productName,purchaseUnit)	//function for adding purchase to cart
	    	{
	    		$("#my_logo_div").hide();
	    		$("#list").css("display","block");
	    		$("#hrline").remove();
	    		$("#checkout").remove();
	    		$("#total").remove();
	    		//var quantity=$("#quant").val();//quanty of purchased porduct
	    		//var pricePerItem=$("#price").val();	//price of purchased product
				var quantity=1;//quanty of purchased porduct
	    		var pricePerItem=1;	//price of purchased product

	    		$("#my_logo2").css("display","none");
	    		//creating media
	    		//$("#leftCart").css("display","block");
	    		//making a row
	    		var node=document.createElement("tr");
	    		node.setAttribute("id","row"+row);
	    		$("#list").append(node);
				//appending a col of product name
				node=document.createElement("th");
	    		node.setAttribute("id","row"+row+"col"+col);
	    		node.setAttribute("class","simple");
	    		//node.setAttribute("style","font-size:12px;");
	    		$("#row"+row).append(node);
	    		$("#row"+row+"col"+col).text(productName+"("+purchaseUnit+")");
	    		col++;
	    		//appending a col of product quantaty
	    		node=document.createElement("td");
	    		node.setAttribute("id","row"+row+"col"+col);
	    		$("#row"+row).append(node);
	    		node=document.createElement("input");
	    		node.setAttribute("class","inputs");
	    		node.setAttribute("id","row"+row+"input"+col);
	    		node.setAttribute("type","number");
	    		$("#row"+row+"col"+col).append(node);
	    		$("#row"+row+"input"+col).val(quantity);
	    		$("#row"+row+"input"+col).change(function()
				{
					calculteSum2(this.id,this.value);
				});
	    		//$("#row"+row+"col"+col).text(quantity);
	    		col++;
	    		//appending input for price peritem

	    		node=document.createElement("td");
	    		node.setAttribute("id","row"+row+"col"+col);
	    		$("#row"+row).append(node);
	    		node=document.createElement("input");
	    		node.setAttribute("id","row"+row+"input"+col);
	    		node.setAttribute("class","inputs");
	    		node.setAttribute("type","number");
	    		$("#row"+row+"col"+col).append(node);
	    		$.get("/recentPurchasePrice",{	//ajax request for suggestion in pricePerItem
	    			productId: productId,},
	    			function(data)
	    			{
	    				if(data != -12)	//product find
	    				{
	    					//alert(row);
	    					$("#row"+(row-1)+"input3").val(data);
	    					$("#row"+(row-1)+"col4").text(data);
	    				}//ending of if condition
	    				else
	    				{
	    					$("#row"+(row-1)+"input3").val("1");
	    				}
	    				calculteSum();
	    			}//ending of function for setting data
	    		);//ending of get ajax request for placing suggestion
	    		
	    		$("#row"+row+"input"+col).change(function()
				{
					
					calculteSum3(this.id,this.value);
				});
	    		col++;
	    		node=document.createElement("th");
	    		node.setAttribute("id","row"+row+"col"+col);
	    		node.setAttribute("class","simple");
	    		$("#row"+row).append(node);
	    		$("#row"+row+"col"+col).text(quantity*pricePerItem);
	    		col++;
	    		//making a button for removing item
	    		node=document.createElement("button");
	    		node.setAttribute("id","row"+row+"btn"+col);
	    		node.setAttribute("class","btn-danger");
	    		$("#row"+row).append(node);
	    		$("#row"+row+"btn"+col).text("X");
	    		$("#row"+row+"btn"+col).click(function()//function for removing that item from cart list
				{
					remove(this.id);
				});//enidng of onclick function
	    		//making a hr line
	    		node=document.createElement("hr");
	    		node.setAttribute("id","hrline");
	    		$("#itemCart").append(node);
	    		node=document.createElement("font");
	    		node.setAttribute("id","total");
	    		node.setAttribute("size","5px");
	    		$("#itemCart").append(node);
	    		let payAbleBill=0;
	    		for(var i=2;i<=row;i++)	//loop for summing total money
	    		{
	    			payAbleBill=payAbleBill+Number($("#row"+i+"col4").text());
	    		}
	    		$("#total").text("Payable Bill: "+payAbleBill);
	    		node=document.createElement("button");
	    		node.setAttribute("id","checkout");
	    		node.setAttribute("class","btn-success");
	    		$("#itemCart").append(node);
	    		$("#checkout").text("CheckOut");
	    		$("#checkout").click(function()
				{
					if(selectedSellerId == 0)
					{
						alert("Please enter seler id");
					}
					else
					{
						let productsMoney=[];
						let productsQuantity=[];
						let productsPricePerItem=[];
						let productsAmount=[];
						let productsName=[];
						let totalBill=($("#total").text());
						totalBill=totalBill.slice(14);
						for(let i=2;i<row;i++)
						{
							var num=Number($("#row"+i+"col4").text());
							if(num != 0)
							{	
								productsName.push(($("#row"+i+"col1").text()).slice(0,($("#row"+i+"col1").text()).lastIndexOf('(')));
								productsQuantity.push(Number($("#row"+i+"input2").val()));
								productsPricePerItem.push(Number($("#row"+i+"input3").val()));
								productsAmount.push(Number($("#row"+i+"col4").text()));
								productsMoney.push(num);
							}
						}//ending of for loop
						var invoice = prompt("Enter invoice id if doesn't leave it empty:");
						alert("Thanks for shopping");
						if(invoice == "")
						{
							invoice="0";
						}//ending of if invoice is empty
						$.get("/purchaseCreate",{
							//for purchases section
			    			seller_id: selectedSellerId,
			    			invoice_id:invoice,
			    			totalBill:totalBill,
			    			paid:"1",
			    			//for purchases details
			    			productsName:[productsName],
			    			productsQuantity:[productsQuantity],
			    			productsAmount:[productsAmount],
			    			productsMoney:[productsMoney],
			    			productsPricePerItem:[productsPricePerItem],
			    		});
						location.reload();
					}
				});
	    		//creating a row
				//$("#myForm").css("display","none");
				row++;
				col=1;
				productsPurchased++;
				$("#lblCartCount").text(productsPurchased);
				$("#products").css("display","block");
	    	}//ending of add product to cart  
	    	function calculteSum()	//function for calcuting sum
	    	{
	    		let totalAmount=0;
	    		for(let i=2;i<row;i++)
	    		{
	    			totalAmount=totalAmount+Number($("#row"+i+"col4").text());
	    		}
	    		$("#total").text("Payable Bill: "+totalAmount);
	    	}//ending of calculte sum function
	    	function calculteSum3(id,value)	//caluctie total by changing to price peritem
	    	{
	    		var temp=id.slice(0,7);
	    		temp=temp.match(/\d+/g).map(Number);
	    		value=Number(value);
	    		temp=Number(temp);
	    		$("#row"+temp+"col4").text(value*($("#row"+temp+"input2")).val());
	    		let totalAmount=0;
	    		for(i=2;i<row;i++)
	    		{
	    			totalAmount=totalAmount+Number($("#row"+i+"col4").text());
	    		}
	    		$("#total").text("Payable Bill: "+totalAmount);
	    	}//ending of calculte sum3 function
	    	function calculteSum2(id,value)	//caluctie total by changing quanty
	    	{
	    		var temp=id.slice(0,7);
	    		temp=temp.match(/\d+/g).map(Number);
	    		value=Number(value);
	    		temp=Number(temp);
	    		$("#row"+temp+"col4").text(value*($("#row"+temp+"input3")).val());
	    		let totalAmount=0;
	    		for(i=2;i<row;i++)
	    		{
	    			totalAmount=totalAmount+Number($("#row"+i+"col4").text());
	    		}
	    		$("#total").text("Payable Bill: "+totalAmount);
	    	}
	    	function enableButton(id)	//function for enabling button of removed product
	    	{
	    		$("#pro"+id).prop( "disabled", false );
	    	}//ending of enable button function
	    	function remove(id)	//function for removing a item
	    	{
	    		var temp=id.slice(0,7);
	    		temp=temp.match(/\d+/g).map(Number);
	    		var addy=$("#row"+temp+"col1").text();
	    		$("#row"+temp).remove();
	    		productsPurchased--;
	    		addy= addy.substr(0, addy.indexOf('('));
	    		//ajax request for product id
	    		$.get("/productId",{
	    			productName: addy,},
	    			function(data)
	    			{
	    				enableButton(data);//passing product id

	    			}
	    		);
	    		$("#lblCartCount").text(productsPurchased);
				var totalAmount=0;
				for(i=2;i<row;i++)
	    		{
	    			totalAmount=totalAmount+Number($("#row"+i+"col4").text());
	    		}
	    		$("#total").text("Payable Bill: " + totalAmount);
				if(productsPurchased == 0)
				{
					$("#total").remove();
					$("#checkout").remove();
					$("#hrline").remove();
					$("#list").hide();
					$("#my_logo_div").css("display","block");
				}
	    	}//ending of remove function
	    	function proceed()
	    	{
	    		let totalAmount=0;
	    		var node = document.createElement("tr");
	    		for(var i=2;i<table;i++)	//loop for summing all purchased products prices
				{
					totalAmount=totalAmount+(Number($("#row"+i+"col4").text()));
				}
				$("#answer").text(totalAmount);
	    		$("#products").css("display","none");
	    		$("#items").css("display","none");
	    		$("#table").css("display","block");
	    	}

	    	//functions for putting ratio=1 if sale and purchase units are same
	    	function calculateRatio2()
	    	{
	    		var saleUnit=$('#addSale1').val();
	    		var purchaseUnit=$('#addPurchase1').val();
				$('#addSale1').css("border","1px solid #CCCCCC");
				if(saleUnit == purchaseUnit)	//if condition for disabling ratio
				{
					$("#addRatio1").val("1");
					$("#addRatio1").css("border","1px solid #CCCCCC");
					$("#addRatio1").attr("disabled", "disabled");
				}	//ending of if condition
				else
				{
					$("#addRatio1").prop('disabled', false);
				}//ending of else condition
	    	}//ending of calculteRatio2 function
	    	function calculateRatio()
	    	{
	    		var saleUnit=$('#addSale1').val();
	    		var purchaseUnit=$('#addPurchase1').val();
				if(saleUnit == purchaseUnit)
				{
					$("#addRatio1").val("1");
					$("#addRatio1").css("border","1px solid #CCCCCC");
					$("#addRatio1").attr("disabled", "disabled");
				}
				else
				{
					$("#addRatio1").prop('disabled', false);
					$("#addRatio1").val("");
				}

	    	}
	    	function salePurchaseCheck()
	    	{
	    		var saleUnit=$('#addSale1').val();
	    		var purchaseUnit=$('#addPurchase1').val();
	    		if(saleUnit == "" && purchaseUnit=="")//both sale unit and purchase unitts are not yet put
	    		{
	    			$("#addRatio1").prop('disabled', true);
	    			$('#addSale1').css("border","1px solid red");
	    			$('#addPurchase1').css("border","1px solid red");
	    			alert("First Put sale and purchase unit");
	    			return false;
	    		}
	    		if(saleUnit =="")
	    		{
	    			$("#addRatio1").prop('disabled', true);
	    			$('#addSale1').css("border","1px solid red");
	    			alert("First PUt sale unit");
	    		}
	    		if(purchaseUnit =="")
	    		{
	    			$("#addRatio1").prop('disabled', true);
	    			$('#addPurchase1').css("border","1px solid red");
	    			alert("First Put Purchase unit");
	    		}
	    	}
		</script>
	<?php $__env->stopSection(); ?>
	<!--
</body>
</html>-->
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>