<!--<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
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
	<?php $__env->stopSection(); ?>	<!--
</head>
<body>-->
	<?php $__env->startSection('content'); ?>
		<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
	            <?php echo csrf_field(); ?>
	    </form>
		<div class="container" style="margin-top: 25px;">
			<!--navbar pills-->
			<div class="row" style="margin-bottom: 7px;">
				<div class="col-md-12">
					<ul class="nav nav-tabs">
					  <li role="presentation"><a href="/sell"><img src="/image/point-of-sale-terminal-pos.png" >Point Of Sale</a></li>
					  <li role="presentation"><a href="/purchase"><img src="/image/point-of-per-terminal-pos.png" >Purchase</a></li>
					  <li role="presentation" class="active"><a href="/product/add2"><img src="/image/add.png" >Add Product</a></li>
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
				<!--search bar-->
				<div class="col-md-3" id="item_search">
					<input type="text" name="search_text" id="search_text" class="form-control" list="json-datalist" placeholder="Search Here">
					<datalist id="json-datalist" ></datalist>
				</div>
				<!--Add Item button-->
				<div class="col-md-1" id="itemButton">
					<button type="button"  style="margin-left: -15px;"  class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Item</button>
				</div>
		<!------------search bar for products------------------->
				<div class="col-md-3" id="product_search" style="display: none;margin-left: -25px;">
					<input type="text" name="search_text" id="product_search_input" class="form-control" list="product-datalist" placeholder="Search Product Here">
					<datalist id="product-datalist" ></datalist>
				</div>
				<!--Add Product button-->
				<div class="col-md-1" id="productButton" style="display: none;">
					<button type="button"  style="margin-left: -20px;" class="btn btn-info" data-toggle="modal" data-target="#productModal">Add Product</button>
				</div>
			</div>
			<!--New item Modal Content-->
			<div class="modal fade" id="myModal" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" id="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Add New Item</h4>
				        </div>
				        <div class="modal-body">
								<div class="form-group">
									<label class="control-label col-md-3" for="first_name">	Item Name: 
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="Item Name" name="new_item_name" required id="new_item_name">
									</div>
								</div>
				        </div>
				        <div class="modal-footer" style="margin-top: 15px;">
				        	<input type="button" class="btn btn-success" id="add_new_item_button" value="submit" onclick="addNewItem()">
				        </div>
				      </div>
			      
			    </div>
			</div>
			<!--New Product Modal Content-->
			<div class="modal fade" id="productModal" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" id="colse2" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Add New Product</h4>
				        </div>
				        <div class="modal-body">
				          <form class="form-horizontal" action="enrollment.php" method="post">
								<div class="form-group">
									<label class="control-label col-md-3" for="first_name">	Product Name: 
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="Product Name" name="new_product_name" required id="addProduct1">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3" for="first_name">	Sale Unit: 
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="Sale Unit" onchange="changeSale()" name="new_product_name" required id="addSale1">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3" for="first_name">	Purchase Unit: 
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="Product Name" name="new_product_name" onchange="changePurchase()" required id="addPurchase1">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3" for="first_name">	Ratio Unit: 
									</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="Ratio" name="new_product_name" required id="addRatio1">
									</div>
								</div>
							</form>
				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-success" id="add_new_product_button" onclick="addProduct()">Add</button>
				        </div>
				      </div>
			    </div>
			</div>
			<!--Items-->
				<!--registered items-->
				<div class="col-md-12" id="items" style="margin-top:5px; ">
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
				<div class="col-md-12" id="products">
				</div>
				<div class="modal fade" id="infoModal" role="dialog">
			    	<div class="modal-dialog">
			    
			      		<!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Edit Name</h4>
				        </div>
				        <div class="modal-body">
				          <div><font style="font-size: 15px;"><b>Product Name: </b></font><pre  id="product_name"></pre></div>
				          <div><font style="font-size: 15px;"><b>Sale Unit: </b></font><pre id="sale_section"></pre></div>
				          <div><font style="font-size: 15px;"><b>Purchase Unit: </b></font><pre id="purchase_section"></pre></div>
				          <div><font style="font-size: 15px;"><b>Blance: </b></font><pre id="blance"></pre></div>
				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-success" id="add_new_seller_button" data-dismiss="modal">Okay</button>
				        </div>
				      </div>
			      
			    	</div>
				</div>
			</div>
		</div>













		<!-- java script------------------------>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript">
			var flage=false;//to find weather item exist or doesnt
			var selectedItemId=0;//id of selectd item which is used for add new product
			var g=[];
			let proId;	//id of product whom we are going to purchase
			

	    	function changeSale()	//function on changing sale unit
	    	{
	    		if($("#addSale1").val() == $("#addPurchase1").val() )
	    		{
	    			$("#addRatio1").val("1");
	    			$("#addRatio1").prop("disabled",true);
	    		}
	    		else
	    		{
	    			$("#addRatio1").prop("disabled",false);
	    		}
	    	}
	    	function changePurchase()	//function on changing purchase unit
	    	{
	    		if($("#addSale1").val() == $("#addPurchase1").val() )	//sale and purchase units are equal then ratio will be 1
	    		{
	    			$("#addRatio1").val("1");
	    			$("#addRatio1").prop("disabled",true);
	    		}
	    		else
	    		{
	    			$("#addRatio1").prop("disabled",false);
	    		}
	    	}

	    	//function for adding new item
	    	$("#formForImage").submit(function(e) {
			    e.preventDefault();
			    var formData = new FormData(this); 
			    console.log(JSON.stringify(formData)); 
			    /*$.post("/addItem",
		    			{
			    			itemName: formData,
			    			
		    			},
		    			);

	*/
				$.ajax({
				    url: '/addItem',
				    type: "get",
				    data: formData,
				    processData: false,
				    contentType: 'application/json'
				});
	/* 
			    $.post($(this).attr("action"), formData, function(data) {
			        alert(data);
			    });*/
			});
			//ending of function for adding for submitting form data
	    	function addNewItem()	//function for adding new item
	    	{
	    		let itemName=$("#new_item_name").val();
	    		if(itemName != "")
	    		{
	    			$.get("/addItem",
		    			{
			    			itemName: itemName,
		    			},
		    			function(data)
		    			{
		    				if(data != "-12")//seller already doesn't exist
		    				{
		    					$("#new_item_name").val("");
		    					$("#new_item_name").css("border","1px solid #CCCCCC");
		    					mainPage();
		    					$("#close").click();
		    				}
		    				else
		    				{
		    					alert("Item already registered");
		    				}
		    				

		    			}//ending of id function
		    		);//ening of addItem ajax request
	    		}
	    		else
	    		{
	    			$("#new_item_name").css("border","1px solid red");
	    		}
	    		
	    	}//ending of function for addItem
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
				    		$("#addProduct1").css("border","1px solid red");
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
	    		$("#colse2").click();
	    		$("#addRatio1").prop("disabled",false);
	    		$("#addProduct1").css("border","1px solid #CCCCCC");
	    		$("#addPurchase1").css("border","1px solid #CCCCCC");
	    		$("#addRatio1").css("border","1px solid #CCCCCC");
	    		$("#addSale1").css("border","1px solid #CCCCCC");
	    		itemName(selectedItemId);
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
	    	var test=[];
	    	//search products
	    	$("#product_search_input").keyup(function()
	    	{
	    		var txt=$(this).val();
	    		if(txt != "")	//if user enter some chracters in box
	    		{
	    			$.get("/product/search",{
		    			productName: txt,
		    			itemId:selectedItemId,
		    		},function(data){
		    			test=JSON.parse(data);
		    			var arrayLength=(test).length;
		    			$("#product-datalist").empty();
		    			$("#products").empty();
		    			for(let j=0;j<arrayLength;j++)//for looop for making option of all names
		    			{
		    				var dataList=document.getElementById('product-datalist');
		    				var option = document.createElement('option');
		    				// Set the value using the item in the JSON array.
					        option.value = (test)[j]["name"];
					        // Add the <option> element to the <datalist>.
					        dataList.appendChild(option);
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
							$("#pro_body"+j).text((test)[j]["name"]);
							//making footer
							node = document.createElement("div");
							node.setAttribute("class", "panel-footer");
							node.setAttribute("id", "pro_foot"+j);
							$("#pro_panel"+j).append(node);
							//making a button in footer
							node = document.createElement("button");
							node.setAttribute("class", "btn btn-primary");
							node.setAttribute("data-toggle", "modal");
							node.setAttribute("data-target", "#infoModal");
							node.setAttribute("id","pro_btn"+(test)[j]["id"]);
							$("#pro_foot"+j).append(node);
							$("#pro_btn"+(test)[j]["id"]).text("Complete Info");
							//test.push((test)[j]["name"]);
							//alert((test.length));
							$("#pro_btn"+(test)[j]["id"]).click(function()
							{
								document.getElementById("product_name").innerHTML ="    "+$("#pro_body"+j).text();
								document.getElementById("sale_section").innerHTML ="    "+ (test)[j]["sale_unit"];
								document.getElementById("purchase_section").innerHTML ="    "+ (test)[j]["purchase_unit"];
								document.getElementById("blance").innerHTML = "    "+ (test)[j]["balance"] + "("+(test)[j]["sale_unit"]+")";
							});
		    			}//ending of for loop for appending data oin data list
		    		});
	    		}//ending of if input is not empty
	    		else
	    		{
	    			$.get("/product/all",{
		    			itemId:selectedItemId,
		    		},function(data){
		    			test=(data);
		    			var arrayLength=(test).length;
		    			$("#product-datalist").empty();
		    			$("#products").empty();
		    			for(let j=0;j<arrayLength;j++)//for looop for making option of all names
		    			{
		    				var dataList=document.getElementById('product-datalist');
		    				var option = document.createElement('option');
		    				// Set the value using the item in the JSON array.
					        option.value = (test)[j]["name"];
					        // Add the <option> element to the <datalist>.
					        dataList.appendChild(option);
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
							$("#pro_body"+j).text((test)[j]["name"]);
							//making footer
							node = document.createElement("div");
							node.setAttribute("class", "panel-footer");
							node.setAttribute("id", "pro_foot"+j);
							$("#pro_panel"+j).append(node);
							//making a button in footer
							node = document.createElement("button");
							node.setAttribute("class", "btn btn-primary");
							node.setAttribute("data-toggle", "modal");
							node.setAttribute("data-target", "#infoModal");
							node.setAttribute("id","pro_btn"+(test)[j]["id"]);
							$("#pro_foot"+j).append(node);
							$("#pro_btn"+(test)[j]["id"]).text("Complete Info");
							//test.push((test)[j]["name"]);
							//alert((test.length));
							$("#pro_btn"+(test)[j]["id"]).click(function()
							{
								document.getElementById("product_name").innerHTML ="    "+$("#pro_body"+j).text();
								document.getElementById("sale_section").innerHTML ="    "+ (test)[j]["sale_unit"];
								document.getElementById("purchase_section").innerHTML ="    "+ (test)[j]["purchase_unit"];
								document.getElementById("blance").innerHTML = "    "+ (test)[j]["balance"] + "("+(test)[j]["sale_unit"]+")";
							});
		    			}//ending of for loop for appending data oin data list
		    		});
	    		}//enidng of else condition
	    	});
	    	
			function itemName(itemId) {
				selectedItemId=itemId;
				$.get("/itemName",{
					itemId: itemId,},
					function(data)
					{
						showProducts(data);//function for showing prodyucts
					}
				);
			}//ending of itemName function
	    	function showProducts(itemName)//function for showing products
	    	{
	    		$("#item_search").hide();
	    		$("#itemButton").hide();
	    		$("#product_search").css("display","block");
	    		$("#productButton").css("display","block");
	    		$("#items").hide();
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
									node.setAttribute("data-toggle", "modal");
									node.setAttribute("data-target", "#infoModal");
									
									node.setAttribute("id","pro"+(data)[j]["id"]);
									$("#pro_foot"+j).append(node);
									$("#pro"+(data)[j]["id"]).text("Complete Info");
									$("#pro"+(data)[j]["id"]).click(function()
									{
										document.getElementById("product_name").innerHTML ="    "+ (data)[j]["name"];
										document.getElementById("sale_section").innerHTML ="    "+ (data)[j]["sale_unit"];
										document.getElementById("purchase_section").innerHTML ="    "+ (data)[j]["purchase_unit"];
										document.getElementById("blance").innerHTML = "    "+ (data)[j]["balance"] + "("+(data)[j]["sale_unit"]+")";
									});
				    			}//ending of for loop for appending data oin data list
			    			}//ending of else item has products
			    		}//ending of ajax request function
			    );//ending of ajax request
			    $("#addProductFromPurchase").css("display","block");
	    	}//ending of showProducts function
	    	var selectedProductId=0;//product which is selected for editing
	    	function mainPage()//function for displying main page
	    	{
	    		$("#product_search").hide();
	    		$("#productButton").hide();
	    		$("#item_search").css("display","block");
	    		$("#itemButton").css("display","block");
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
	<?php $__env->stopSection(); ?><!--
</body>
</html>-->
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>