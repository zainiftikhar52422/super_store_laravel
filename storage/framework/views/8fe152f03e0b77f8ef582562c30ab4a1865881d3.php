<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
    </form>
        

	<div class="container" style="margin-top: 25px;">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                  <li role="presentation"><a href="/sell">Point Of Sale</a></li>
                  <li role="presentation"><a href="/purchase">Purchase</a></li>
                  <li role="presentation"><a href="/product/add2">Add Product</a></li>
                  <li role="presentation"  class="active"><a href="/">Add Items</a></li>
                  <ul class="nav navbar-nav navbar-right" style="margin-top: -9px;">
                        <li>
                            <a href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out"></span> 
                                <?php echo e(__('Logout')); ?>

                            </a>
                        </li>
                   </ul>
                </ul>
                </ul>
            </div>
        </div>
		<div class="row">
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-2 col-xs-12"  for="first_name">New Item Name: </label>
				<div class="col-md-9 col-sm-10 col-xs-12">
					<input type="text" class="form-control" placeholder="Add New"  name="item_name" id="item_name">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2 col-md-offset-10 col-sm-2 col-xs-12" style="margin-top: 15px;"><button onclick="addItem()" class="btn btn-success" id="item_button">Add It</button> </div>
		</div>
		<hr>
			<!--Products Section------------->
			<div class="form-group" id="tab3" style="display: none;">
				<div class="col-md-10 col-md-offset-1">
					<h3  id="itemLabel">Products of </h3>
				</div>
				<div id="product_section" class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2"> 
					<input type="text" class="form-control r" style="float: left;width: 200px;margin-right: 3px;" placeholder="Products" id="product1" name="products[]" required="">
					<input type="text" class="form-control r" style="float: left;width: 200px;margin-right: 3px;" placeholder="Sale Unit" id="sale1" name="sale_unit[]" required="" onChange="calculateRatio2(this.id)">
					<input type="text" class="form-control r" style="float: left;width: 200px;margin-right: 3px;" placeholder="Purchase Unit" id="purchase1" name="purchase_unit[]" required="" onChange="calculateRatio(this.id)">
					<input type="text" class="form-control r" style="float: left;width: 70px;margin-right: 3px;" onclick="salePurchaseCheck(this.id)" placeholder="Ratio" id="ratio1" name="ratio[]" required="">
					<input type="button" onclick="add()" style="float: left;margin-left:5px;"class="btn btn-success" value="Add">
				</div>
				<button onclick="addProduct()" class="btn btn-primary" style="float: right;margin-right: 75px;margin-top: 25px;">Add Products</button>
			</div>

		

		
		
	</div>


	<!--JAVA SCRIPT -->

	<script src="https://unpkg.com/vue@2.5.21/dist/vue.js" ></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script type="text/javascript">
    	/*new Vue({
			el:"#root",
			data:{
				value:"",
				all:{},
			},
			methods:{
				addItem()	//function for adding new product in db
				{
					axios.post('/projects/store',{
						item: this.value,
					}).then(({ data }) =>  ( this.all = data ));
				}
			}
			
		})*/
		var i=2;
		var id="";
		var emptyInputs=[];
    	function addItem()
    	{
    		var item;
    		item=$("#item_name").val();
    		if(item =="")	//no data is placed yet
    		{
    			alert("Please enter item name");
    			$('#item_name').css("border","1px solid #red");
    			return false;
    		}
    		else{
    			$('#item_name').css("border","1px solid #CCCCCC");
    		}
    		$.get("/item/store",{
    			item_name: item,
    		},function(data){

    			if(data != "off")
    			{
    				$("#item_name").attr("disabled", "disabled");
    				$("#item_button").attr("disabled", "disabled");
    				$("#tab3").css("display", "block");
    				$('#itemLabel').append("'"+item+"'");
    				id=data;
    			}
    			else{
    				alert("Item already exist");
    				$('#item_name').css("border","1px solid #red");
    			}
    		});
    	}//enidng o of itemAdd function for adding new item
    	function addProduct()
    	{
    		let product=[];
    		let sale=[];
    		let purchase=[];
    		let ratio=[];
    		var flage=true;	//for checking validations of products fields
    		for(let j=1;j<i;j++)
    		{
    			if(emptyInputs.indexOf((j.toString())) == -1)
    			{
    				if($("#product"+j).val() == "")
    				{
    					flage=false;
    					$("#product"+j).css("border","1px solid red");
    				}
    				else{
    					$("#product"+j).css("border","1px solid #CCCCCC");
    				}
    				if($("#sale"+j).val() == "")
    				{
    					flage=false;
    					$("#sale"+j).css("border","1px solid red");
    				}
    				else{
    					$("#sale"+j).css("border","1px solid #CCCCCC");
    				}
    				if($("#purchase"+j).val() == "")
    				{
    					flage=false;
    					$("#purchase"+j).css("border","1px solid red");
    				}
    				else{
    					$("#purchase"+j).css("border","1px solid #CCCCCC");
    				}
    				if($("#ratio"+j).val() == "")
    				{
    					flage=false;
    					$("#ratio"+j).css("border","1px solid red");
    				}
    				else{
    					$("#ratio"+j).css("border","1px solid #CCCCCC");
    				}
    			} //ending of if that row is not deleted already
    			
    		}//ending of for loop for checking validations of products

    		if(flage == true)	//if form passes validations
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
	    		alert("Itam and Its products registerd succesfully");
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
	    		$("#item_name").val("");
	    		$("#item_name").prop('disabled', false);
	    		$("#item_button").prop('disabled', false);
	    		$("#tab3").css("display","none");

	    		i=2;
				id="";
				emptyInputs=[];


    		}//ending of if form passes validation
    		else //else products doesn't passes validations
    		{
    			alert("Please enter field value");
    		}	//enidng of else condition
    	}//ending of addProduct function
    	function calculateRatio(id)
    	{
    		var rowNumber=(id.slice(-1));
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
    	function calculateRatio2(id)
    	{
    		var rowNumber=(id.slice(-1));
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
    				$("#ratio"+rowNumber).attr("disabled", "disabled");
    			}	//ending of if condition
    			else
    			{
    				$("#ratio"+rowNumber).prop('disabled', false);
    			}//ending of else condition
    		}
    	}
    	function salePurchaseCheck(id)
    	{
    		var rowNumber=(id.slice(-1));
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
    	
    	/* For adding and removing new input field*/
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

    </script>
</body>
</html>