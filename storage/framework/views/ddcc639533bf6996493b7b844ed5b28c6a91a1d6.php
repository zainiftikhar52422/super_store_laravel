<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="<?php echo e(URL::asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(URL::asset('css/bootstrap2.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(URL::asset('css/gluph.min.css')); ?>" rel="stylesheet">
	<script type="text/javascript" src="<?php echo e(URL::asset('js/jquery.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap.min.js')); ?>"></script>
	<link rel="icon" href="/image/point-of-sale-terminal-pos.png" type="image/gif" sizes="16x16">
	<title>Title of the document</title>
	<?php echo $__env->yieldContent('css'); ?>
	
</head>
<body>
	<?php echo $__env->yieldContent('content'); ?>
</body>
</html>