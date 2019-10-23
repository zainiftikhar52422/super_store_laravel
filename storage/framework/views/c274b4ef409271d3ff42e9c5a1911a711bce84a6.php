<html>
<head lang="en">
	<meta charset="utf-8">
	<title>Ajax File Upload with jQuery and PHP</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">

			<div class="col-md-8">

				<form id="form" action="/testee" method="get" enctype="multipart/form-data">
					<div class="form-group">
					<label for="name">NAME</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
					</div>
					<div class="form-group">
					<label for="email">EMAIL</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required />
					</div>

					<input id="uploadImage" type="file" name="image" />
					<button onclick="me()">Click</button>
				</form>

			
			</div>
		</div>
	</div>



	<script type="text/javascript">
		function me()
		{
			var input = $("#uploadImage");
			alert(<?php echo $_FILES["name"]["temp"] ?>);
			$.get("/testee",{
    			image: input,
    		});
		}
		
	</script>	
</body>
</html>
