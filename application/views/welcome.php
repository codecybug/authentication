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
			<div class="row">
				<h1 class="text-danger text-center">Authentication System By codecybug</h1>
				
				<div class="col-md-4 justify-content-center mx-auto text-center">
				<?php if(!empty($this->session->flashdata('message'))): ?>
				<div class="alert alert-info">
					<?php echo $this->session->flashdata('message'); ?>
				</div>
				<?php endif; ?>
					<a class="btn btn-success" href="<?php  echo base_url('login') ?>">Login</a>
					<a class="btn btn-primary" href="<?php  echo base_url('register') ?>">Register</a>
				</div>
			</div>
		</div>
	</div>

</body>
</html>