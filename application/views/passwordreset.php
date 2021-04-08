<?php defined('BASEPATH') OR exit("No dirrect script access allowed"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication System | Register</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap.min.css') ?>">
    <style>
        body,html {
            height: 100%;
            font-family: Roboto;
        }
    </style>
</head>
<body>
    <div class="container h-100">
        
        <div class="row justify-content-center h-100">
            <div class="col-md-5 my-auto">
                <h2 class="text-center text-danger mb-3">Enter your email to reset password</h2>
                <?php if(!empty($this->session->flashdata('message'))): ?>
				<div class="alert alert-info">
					<?php echo $this->session->flashdata('message'); ?>
				</div>
				<?php endif; ?>
                <?php echo form_open('passwordreset/create'); ?>
                <input class="form-control mb-3" type="email" name="email" placeholder="Enter your email">
                <p><?php echo form_error('password'); ?></p>
                <input class="form-control btn btn-primary" type="submit" value="Reset password">
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</body>
</html>