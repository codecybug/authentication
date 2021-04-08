<?php defined('BASEPATH') OR exit("No dirrect script access allowed"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication System | Login</title>
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
                <h2 class="text-center text-danger mb-3">Enter your details to login</h2>
                <?php if(!empty($this->session->flashdata('error'))) : ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <?php echo form_open('login/singin'); ?>
                <input class="form-control mb-3" type="email" name="email" placeholder="Enter your email" value="<?php echo set_value('email'); ?>">
                <p><?php echo form_error('email'); ?></p>
                <input class="form-control mb-3" type="password" name="password" placeholder="Enter your password" value="<?php echo set_value('password'); ?>">
                <p><?php echo form_error('password'); ?></p>
                <input class="form-control btn btn-primary" type="submit" value="Login">
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</body>
</html>