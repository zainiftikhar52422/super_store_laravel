<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="container" style="margin-top: 75px;">
		<div class="row">
			<div class="col-md-12">
				<input type="text" name="search_text" onblur="avilbelProducts(this.value)" id="search_text" class="form-control" list="json-datalist">
				<datalist id="json-datalist" ></datalist>
			</div>
		</div>
		<div class="row" id="products" style="margin-top: 20px;">

		</div>
		<div class="row" id="addNewProducts" style="display: none;">
			<div class="col-md-10 col-md-offset-2">
				<button onclick="showTab3()" class="btn btn-primary" style="float: right;margin-right: 75px;margin-top: 25px;">Add New Products</button>
			</div>
		</div>
		<hr>
		<div class="row" id="tab3" style="display: none;">
			<div id="product_section" class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2"> 
				<input type="text" class="form-control r" style="float: left;width: 200px;margin-right: 3px;" onChange="checkProduct(this.id)" placeholder="Products" id="product1" name="products[]" required="">
				<input type="text" class="form-control r" style="float: left;width: 200px;margin-right: 3px;" placeholder="Sale Unit" id="sale1" name="sale_unit[]" required="" onChange="calculateRatio2(this.id)">
				<input type="text" class="form-control r" style="float: left;width: 200px;margin-right: 3px;" placeholder="Purchase Unit" id="purchase1" name="purchase_unit[]" required="" onChange="calculateRatio(this.id)">
				<input type="text" class="form-control r" style="float: left;width: 70px;margin-right: 3px;" onChange="checkRatio(this.id)" onclick="salePurchaseCheck(this.id)" placeholder="Ratio" id="ratio1" name="ratio[]" required="">
				<input type="button" onclick="add()" style="float: left;margin-left:22px;"class="btn btn-success" value="Add">
			</div>
			<div class="col-md-10 col-md-offset-2"><button onclick="addProduct()" class="btn btn-primary" style="float: right;margin-right: 75px;margin-top: 25px;">Add Products</button></div>
		</div>
	</div>
	
	
	

	<!--JavaScript-->
	<script src="https://unpkg.com/vue@2.5.21/dist/vue.js" ></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
    	var g=[];
    	var id="";
    	var flage=false;//to find weather item exist or doesnt
    	var emptyInputs=[];//add index of item which is removed
    	var i=2;//to give row number to rows
    	$("#search_text").keyup(function()
    	{
    		$("#tab3").css("display","none");
    		var txt=$(this).val();
    		if(txt != "")	//if user enter some chracters in box
    		{
    			$.get("/item/search",{
	    			item_name: txt,
	    		},function(data){
	    			this.g=JSON.parse(data);
	    			var arrayLength=(this.g).length;
	    			//alert(arrayLength);
	    			$("#json-datalist").empty();
	    			flage=false;
	    			for(let j=0;j<arrayLength;j++)//for looop for making option of all names
	    			{
	    				$("#result").val("");
	    				flage=true;
	    				var dataList=document.getElementById('json-datalist');
	    				var option = document.createElement('option');
	    				option.setAttribute("id", (this.g)[j]["id"]);
	    				//$("img").attr("width","500");
				        // Set the value using the item in the JSON array.
				        option.value = (this.g)[j]["item_name"];
				        // Add the <option> element to the <datalist>.
				        dataList.appendChild(option);
				        $("#"+(this.g)[j]["id"]).click( function(){
							avilbelProducts(this.id);
						});
	    			}//ending of for loop for appending data oin data list
	    			if(flage == false)
	    			{
	    				//alert("No such product is avibel");
	    			}//ending of if item is not yet registerd
	    			console.log(flage);
	    		});

    		}//ending of if input is not empty
    	});
    	function checkProduct(productId)	//function for checking product on change
    	{
    		var value=$("#"+productId).val();
    		if(value != "")	//if 
    		{
    			$("#"+productId).css("border","1px solid #CCCCCC");
    			
    		}
    	}
    	function checkRatio(ratioId)	//function for checking product on change
    	{
    		if($("#"+ratioId).val() != "")	
    		{
    			$('#ratioId').css("border","1px solid #CCCCCC");
    		}
    	}
    	function showTab3()	//function for showing addnew products whole tab
    	{
    		$("#tab3").css("display","block");
    	}
    	function calculateRatio(rowId)
    	{
    		var rowNumber=(rowId.slice(-1));
    		var saleUnit=$('#sale'+rowNumber).val();
    		var purchaseUnit=$('#purchase'+rowNumber).val();
    		if(saleUnit == "")
    		{
    		}
    		else
    		{
    			if(saleUnit == purchaseUnit)
    			{
    				$("#ratio"+rowNumber).val("1");
    				$("#ratio"+rowNumber).css("border","1px solid #CCCCCC");
    				$("#ratio"+rowNumber).attr("disabled", "disabled");
    			}
    			else
    			{
    				$("#ratio"+rowNumber).prop('disabled', false);
    				$("#ratio"+rowNumber).val("");
    			}
    		}
    		if(purchaseUnit != "")
    		{
    			$('#purchase'+rowNumber).css("border","1px solid #CCCCCC");
    			
    		}
    	}
    	function calculateRatio2(rowId)
    	{
    		var rowNumber=(rowId.slice(-1));
    		var saleUnit=$('#sale'+rowNumber).val();
    		var purchaseUnit=$('#purchase'+rowNumber).val();
    		if(saleUnit == "")
    		{
    			
    		}
    		else
    		{
    			$('#sale'+rowNumber).css("border","1px solid #CCCCCC");
    			if(saleUnit == purchaseUnit)	//if condition for disabling ratio
    			{
    				$("#ratio"+rowNumber).val("1");
    				$("#ratio"+rowNumber).css("border","1px solid #CCCCCC");
    				$("#ratio"+rowNumber).attr("disabled", "disabled");
    			}	//ending of if condition
    			else
    			{
    				$("#ratio"+rowNumber).prop('disabled', false);
    			}//ending of else condition
    		}
    	}
    	function salePurchaseCheck(rowId)
    	{
    		var rowNumber=(rowId.slice(-1));
    		var saleUnit=$('#sale'+rowNumber).val();
    		var purchaseUnit=$('#purchase'+rowNumber).val();
    		if(saleUnit == "" && purchaseUnit=="")//both sale unit and purchase unitts are not yet put
    		{
    			$("#ratio"+rowNumber).prop('disabled', true);
    			$('#sale'+rowNumber).css("border","1px solid red");
    			$('#purchase'+rowNumber).css("border","1px solid red");
    			alert("First Put sale and purchase unit");
    			return false;
    		}
    		if(saleUnit =="")
    		{
    			$("#ratio"+rowNumber).prop('disabled', true);
    			$('#sale'+rowNumber).css("border","1px solid red");
    			alert("First PUt sale unit");
    		}
    		if(purchaseUnit =="")
    		{
    			$("#ratio"+rowNumber).prop('disabled', true);
    			$('#purchase'+rowNumber).css("border","1px solid red");
    			alert("First Put Purchase unit");
    		}

    	}
    	function avilbelProducts(itemName)//event triggers onBlur from item to find its products
    	{
    		$("#products").empty();
    		$("#addNewProducts").css("display","none");
    		if(flage==true)//if thta item found then onblur show its products
    		{
    			$("#addNewProducts").css("display","block");
    			var products=[];
	    		//alert(itemName);
	    		$.get("/item/id",{
		    			item_name: itemName,
		    		},function(data="false")
		    		{
		    			
		    			if (data >0)	//if item has no products
		    			{
		    				alert('Item has no proucts');
		    				id=data;
		    			}
		    			else
		    			{
		    				products=data;
		    				for(let x=0;x<products.length;x++)//for loop for printing products of item
		    				{
		    					//making 4md area for one panel
		    					var node = document.createElement("div");
								node.setAttribute("class", "col-md-3");
								node.setAttribute("id", "col"+x);
								$("#products").append(node);
								
		    					//making panel container
		    					var node = document.createElement("div");
								node.setAttribute("class", "panel panel-default");
								node.setAttribute("id", "panel"+x);
								$("#col"+x).append(node);
								//panel heading
								node = document.createElement("div");
								node.setAttribute("class", "panel-body");
								node.setAttribute("id", "body"+x);
								$("#panel"+x).append(node);
								$("#body"+x).text(products[x]["name"]);
								//making footer
								node = document.createElement("div");
								node.setAttribute("class", "panel-footer");
								node.setAttribute("id", "foot"+x);
								$("#panel"+x).append(node);
								//making a button in footer
								node = document.createElement("a");
								node.setAttribute("class", "btn btn-primary");
								node.setAttribute("id", "button"+x);
								$("#foot"+x).append(node);
								$("#button"+x).text("Read More");
		    				}
		    				id=products[0]["item_id"];
		    			}
		    			
		    	});
    		}//enidng of if condition for checking wether item exist then found its products
    		else
    		{
    			alert("item doesnt exist");
    		}
    	}//ending of onBlur event avilbel functions
    	function addNewProducts()	//function for adding new products of item
    	{

    	}//ending of addNewProducts function
    	function add()	//function for adding a new input field
		{
			var node = document.createElement("input");
			node.setAttribute("type", "text");
			node.setAttribute("placeholder", "Products");
			node.setAttribute("id", "product"+i);
			node.setAttribute("name", "products[]");
			node.setAttribute("class", "form-control r");
			node.setAttribute("style", "float: left;width: 200px;margin-top:5px;")
			$("#product_section").append(node);
			$("#product"+i).css("margin-right","3px");
			$("#product"+i).change(function()
			{
				checkProduct(this.id);
			});
			//making an input for sale unit
			node = document.createElement("input");
			node.setAttribute("type", "text");
			node.setAttribute("placeholder", "Sale Unit");
			node.setAttribute("id", "sale"+i);
			node.setAttribute("name", "sale_unit[]");
			node.setAttribute("class", "form-control r");
			node.setAttribute("style", "float: left;width: 200px;margin-top:5px;")
			$("#product_section").append(node);
			$("#sale"+i).css("margin-right","3px");
			$("#sale"+i).change(function()
			{
				calculateRatio2(this.id);
			});
			//making an input for Purchase unit
			node = document.createElement("input");
			node.setAttribute("type", "text");
			node.setAttribute("placeholder", "Purchase Unit");
			node.setAttribute("id", "purchase"+i);
			node.setAttribute("name", "purchase_unit[]");
			node.setAttribute("class", "form-control r");
			node.setAttribute("style", "float: left;width: 200px;margin-top:5px;")
			$("#product_section").append(node);
			$("#purchase"+i).css("margin-right","3px");
			$("#purchase"+i).change(function()
			{
				calculateRatio(this.id);
			});
			//making an input for Ratio
			node = document.createElement("input");
			node.setAttribute("type", "text");
			node.setAttribute("placeholder", "Ratio");
			node.setAttribute("id", "ratio"+i);
			node.setAttribute("name", "ratio[]");
			node.setAttribute("class", "form-control r");
			node.setAttribute("style", "float: left;width: 70px;margin-top:5px;")
			$("#product_section").append(node);
			$("#ratio"+i).click( function(){
				salePurchaseCheck(this.id);
			});
			$("#ratio"+i).change(function()
			{
				checkRatio(this.id);
			});
			//Making a button to remove element
			node=document.createElement("input");
			node.setAttribute("type", "button");
			node.setAttribute("id", i);
			node.setAttribute("class", "btn btn-danger");
			node.setAttribute("value", "Remove");
			node.setAttribute("style", "float: left;margin-top:5px;margin-left:5px;")
			$("#product_section").append(node);
			$("#"+i).click( function(){
				removeSkill(this.id);
			});
			i++;
		}//ending of add function
		function removeSkill(id)	//function for removing a skill input
		{
			$("#product"+id).remove();
			$("#sale"+id).remove();
			$("#purchase"+id).remove();
			$("#ratio"+id).remove();
			$("#"+id).remove();
			emptyInputs.push(id);
		}


		function addProduct()
    	{
    		let product=[];
    		let sale=[];
    		let purchase=[];
    		let ratio=[];
    		var flageValidation=true;	//for checking validations of products fields
    		for(let j=1;j<i;j++)
    		{
    			if(emptyInputs.indexOf((j.toString())) == -1)
    			{
    				if($("#product"+j).val() == "")
    				{
    					flageValidation=false;
    					$("#product"+j).css("border","1px solid red");
    				}
    				else{
    					$("#product"+j).css("border","1px solid #CCCCCC");
    				}
    				if($("#sale"+j).val() == "")
    				{
    					flageValidation=false;
    					$("#sale"+j).css("border","1px solid red");
    				}
    				else{
    					$("#sale"+j).css("border","1px solid #CCCCCC");
    				}
    				if($("#purchase"+j).val() == "")
    				{
    					flageValidation=false;
    					$("#purchase"+j).css("border","1px solid red");
    				}
    				else{
    					$("#purchase"+j).css("border","1px solid #CCCCCC");
    				}
    				if($("#ratio"+j).val() == "")
    				{
    					flageValidation=false;
    					$("#ratio"+j).css("border","1px solid red");
    				}
    				else{
    					$("#ratio"+j).css("border","1px solid #CCCCCC");
    				}
    			} //ending of if that row is not deleted already
    			
    		}//ending of for loop for checking validations of products

    		if(flageValidation == true)	//if form passes validations
    		{
	    		for(let j=1;j<i;j++)	//for loop forpacing data in an array so that it can be send to server
	    		{
	    			if(emptyInputs.indexOf((j.toString())) == -1)
	    			{
	    				product.push($("#product"+j).val());
	    				sale.push($("#sale"+j).val());
	    				purchase.push($("#purchase"+j).val());
	    				ratio.push($("#ratio"+j).val());
	    			} 
	    			
	    		}//ending of for loop
	    		$.get("/item/products/store",{
					products : product,
					salesUnit: sale,
					purchasesUnit :purchase,
					ratio: ratio,
					item_id:id,
				});	//sending data to server through ajax
	    		alert("products registerd succesfully");
	    		for(let j=2;j<i;j++)	//for loop for remving items that are added for additon of previous product
	    		{
	    			if(emptyInputs.indexOf((j.toString())) == -1)
	    			{
	    				removeSkill(j);
	    			} 
	    		}//ending of for loop for reming of iteams
	    		$("#product1").val("");
	    		$("#sale1").val("");
	    		$("#purchase1").val("");
	    		$("#ratio1").val("");
	    		flage=true;//main flage for showing products of registered items
	    		avilbelProducts($("#search_text").val());
				i=2;
				emptyInputs=[];
				$("#tab3").css("display","none");
    		}//ending of if form passes validation
    	}//ending of addProduct function	
    </script>
</body>
</html>