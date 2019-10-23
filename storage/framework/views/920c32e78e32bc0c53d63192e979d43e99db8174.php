<!--
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>-->
	<?php $__env->startSection('content'); ?>
		<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
	            <?php echo csrf_field(); ?>
	    </form>
		<div class="container" style="margin-top: 25px;">
			<div class="row" style="margin-bottom: 7px;">
				<div class="col-md-12">
					<ul class="nav nav-tabs">
					  <li role="presentation"><a href="/sell"><img src="/image/point-of-sale-terminal-pos.png" >Point Of Sale</a></li>
					  <li role="presentation"><a href="/purchase"><img src="/image/point-of-per-terminal-pos.png" >Purchase</a></li>
					  <li role="presentation"><a href="/product/add2"><img src="/image/add.png" >Add Product</a></li>
					  <li role="presentation"  class="active"><a href="#"><img src="/image/survey.png" >Survey</a></li>
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
			</div><!--Ending of div for navbar-->
			<div class="row">
				<div class="col-md-6" >
					<h2 class="page-header">Last Month Debit</h2>
					<h4>Amount: <?php echo e($totalDebit); ?></h4>
				</div>
				<div class="col-md-6">
					<h2 class="page-header">Last Month Credit</h2>
					<h4>Amount: <?php echo e($totalCredit); ?></h4>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<h3>Profit: <?php echo e($totalCredit-$totalDebit); ?></h3>
				</div>
			</div>
		</div><!--Ending of container-->
	<?php $__env->stopSection(); ?><!--
</body>
</html>-->
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>