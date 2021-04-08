<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Authentication System</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap.min.css')?>">
</head>
<body>

	<div class="container">
		<div class="container">
			<div class="text-center">
				    <h1 class="text-success mb-3">This is your private area</h1>
				    <a class="btn btn-danger" href="<?php  echo base_url('login/logout') ?>">Logout</a>
			</div>
		</div>
	</div>

</body>
</html>