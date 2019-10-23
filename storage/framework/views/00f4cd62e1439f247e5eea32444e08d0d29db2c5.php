<!--<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="<?php echo e(URL::asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(URL::asset('css/bootstrap2.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(URL::asset('css/gluph.min.css')); ?>" rel="stylesheet">
	<script type="text/javascript" src="<?php echo e(URL::asset('js/jquery.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap.min.js')); ?>"></script>-->
	<?php $__env->startSection('title'); ?>
		<title>POS</title>
	<?php $__env->stopSection(); ?>
	<?php $__env->startSection('css'); ?>
		<style type="text/css">
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
<!--</head>
<body>-->
	<?php $__env->startSection('content'); ?>
		<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
	            <?php echo csrf_field(); ?>
	    </form>
		<div class="container" style="margin-top: 25px;">
			<div class="row" style="margin-bottom: 7px;">
				<div class="col-md-12">
					<ul class="nav nav-tabs">
					  <li role="presentation" class="active"><a href="#"><img src="/image/point-of-sale-terminal-pos.png" >Point Of Sale</a></li>
					  <li role="presentation"><a href="/purchase#"><img src="/image/point-of-per-terminal-pos.png" >Purchase</a></li>
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
				<div class="col-md-12" id="crumb_bar">
					<ol class="breadcrumb" id="breadcrumb">
					  <li class="breadcrumb-item active" id="crumb1">Home</li>
					</ol>
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
							<h4>Selling Cart</h4>
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
			</div>
		</div>













		<!-- java script------------------------>
		<script type="text/javascript">
			var flage=false;//to find weather item exist or doesnt
			var selectedSellerId=0;
			var g=[];
			let proId;	//id of product whom we are going to purchase
			var productsPurchased=0;	//number of products purchased
	    	var sellers=[];	//array for storing sellers obtained from ajax search
			$("#lblCartCount").text(productsPurchased);
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
	    	var selectedItemId=0;
	    	//function for showing products
			function itemName(itemId) {
				selectedItemId=itemId;
				$.get("/itemName",{
	    			itemId: itemId,},
	    			function(data)
	    			{
	    				showProducts(data);//function for showing products
	    			}
	    		);
			}//ending of itemName function
	    	function showProducts(itemName)//function for showing products
	    	{
	    		$("#item_search").hide();
	    		$("#items").hide();
	    		$("#crumb_bar").addClass('col-md-12').removeClass('col-md-8');
	    		$("#basket_sign").addClass('col-md-1 col-md-offset-11').removeClass('col-md-1 col-md-offset-8');
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
									$("#pro"+(data)[j]["id"]).text("Add To Cart");
									$("#pro"+(data)[j]["id"]).click(function()
									{
										//$("#pro"+(data)[j]["id"]).prop( "disabled", true );
										purchaseItem(this.id,(data)[j]["balance"]);
									});
				    			}//ending of for loop for appending data oin data list
			    			}//ending of else item has products
			    		}//ending of ajax request function
			    );//ending of ajax request
	    	}//ending of showProducts function
	    	
	    	function purchaseItem(buttonId,productBlance)	//function for purchasing product
	    	{
	    		let productId = buttonId.slice(3);
	    		$.get("/product/complete",{	//request for getting complete info of product
	    			productId: productId,},
	    			function(data)
	    			{
	    				data=JSON.parse(data);
	    				addToCart(productId,data['name'],data['purchase_unit'],productBlance,buttonId);

	    			}
	    		);
	    	}//ending of purchaseItem function
	    	function mainPage()//function for displying main page
	    	{
	    		
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
	    	var balance=[];	//array for holding availbel blance of product added to cart for checkpoint
	    	var globalDiscount=0;
	    	function addToCart(productId,productName,purchaseUnit,productBlance,buttonId)	//function for adding purchase to cart
	    	{
	    		if(productBlance>0)//if product has blance availbel then add it
	    		{
	    			$("#"+buttonId).prop( "disabled", true );
	    			balance.push(productBlance);
	    			$("#my_logo_div").hide();
		    		$("#list").css("display","block");
		    		$("#hrline").remove();
		    		$("#checkout").remove();
		    		$("#total").remove();
		    		$("#discountRow").remove();
		    		//var quantity=$("#quant").val();//quanty of purchased porduct
		    		//var pricePerItem=$("#price").val();	//price of purchased product
					var quantity=1;//quanty of purchased porduct
		    		var pricePerItem=1;	//price of purchased product

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
					$("#row"+row+"input"+col).keyup(function(){
					  if(this.value > productBlance)
					  {
					  	alert("Blance is "+productBlance);
					  	this.value=productBlance;
					  }
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
		    		$.get("/recentSellPrice",{	//ajax request for selling price suggestion in pricePerItem
		    			productId: productId,},
		    			function(data)
		    			{
		    				if(data != -12)	//product last price suggestion find
		    				{
		    					$("#row"+(row-1)+"input3").val(data);
		    					$("#row"+(row-1)+"col4").text(data);
		    				}//ending of if condition
		    				else
		    				{
		    					$("#row"+(row-1)+"input3").val("1");
		    				}
		    				calculteSum();
		    				//findDiscount(this.id);
		    			}//ending of function for setting data
		    		);//ending of get ajax request for placing suggestion
		    		
		    		$("#row"+row+"input"+col).change(function()
					{
						
						calculteSum3(this.id,this.value);
						//findDiscount(this.id,this.value);
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
		    		//appending an input field for discount
		    		var node=document.createElement("tr");
		    		node.setAttribute("id","discountRow");
		    		$("#itemCart").append(node);
		    		node=document.createElement("th");
		    		node.setAttribute("id","discountHead");
		    		$("#discountRow").append(node);
		    		$("#discountHead").text("Discount:%");
		    		node=document.createElement("td");
		    		node.setAttribute("id","discountInput");
		    		$("#discountRow").append(node);
		    		node=document.createElement("input");
		    		node.setAttribute("id","discount");
		    		node.setAttribute("class","form-control");
		    		node.setAttribute("type","number");
		    		$("#discountInput").append(node);
		    		$("#discount").css("margin-left","20px");
		    		$("#discount").val(globalDiscount);
		    		$("#discount").css("width","100px");
		    		$("#discount").keyup(function()//function for removing that item from cart list
					{
						globalDiscount=this.value;
						calculteSum();
					});//enidng of onclick function
		    		//appending total price
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
								//productsMoney.push(num);
							}
						}//ending of for loop
						var customerName="";
						do
						{
							customerName = prompt("Enter Customer Name:");
						}while(customerName == "");
						alert("Thanks for shopping");
						$.get("/product/sell",{
							//for purchases section
			    			customerName:customerName,
			    			totalBill:totalBill,
			    			//for purchases details
			    			productsName:[productsName],
			    			productsQuantity:[productsQuantity],
			    			productsAmount:[productsAmount],
			    			productsPricePerItem:[productsPricePerItem],
			    		});
						location.reload();
					});
		    		//creating a row
					//$("#myForm").css("display","none");
					row++;
					col=1;
					productsPurchased++;
					$("#lblCartCount").text(productsPurchased);
					$("#products").css("display","block");
	    		}//ending of if productBlance doesn't availbel
	    		else
	    		{
	    			alert(productName +" has 0 blance");
	    		}//ending of else blance doesnt avile
	    	}//ending of add product to cart  
	    	function calculteSum()	//function for calcuting sum
	    	{
	    		let totalAmount=0;
	    		for(let i=2;i<row;i++)
	    		{
	    			totalAmount=totalAmount+Number($("#row"+i+"col4").text());
	    		}
	    		if(totalAmount >=100)
	    		{
	    			$("#discount").prop("disabled",false);
	    			let discountAmount=Number($("#discount").val());
					if( discountAmount != 0)
					{

						totalAmount -= (totalAmount*discountAmount)/100;

					}
	    		}
	    		else
	    		{
	    			$("#discount").val(0);
	    			$("#discount").prop("disabled",true);
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
	    		if(totalAmount>100)
	    		{
	    			$("#discount").prop("disabled",false);
	    		}
	    		if(totalAmount<100)
	    		{
	    			$("#discount").val(0);
	    			$("#discount").prop("disabled",true);
	    		}
	    		let discountAmount=Number($("#discount").val());
	    		if( discountAmount != 0)
	    		{

	    			totalAmount -= (totalAmount*discountAmount)/100;

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
	    		if(totalAmount>100)
	    		{
	    			$("#discount").prop("disabled",false);
	    		}
	    		if(totalAmount<100)
	    		{
	    			$("#discount").val(0);
	    			$("#discount").prop("disabled",true);
	    		}
	    		let discountAmount=Number($("#discount").val());
	    		if( discountAmount != 0)
	    		{

	    			totalAmount -= (totalAmount*discountAmount)/100;

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
				calculteSum();
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
		</script>
	<?php $__env->stopSection(); ?><!--
</body>
</html>-->
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>