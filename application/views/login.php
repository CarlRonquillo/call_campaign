<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>NCM - Call Campaign</title>

	<link rel="stylesheet" href="<?php echo base_url("resources/css/font-awesome.min.css"); ?>"/>
  	<link rel="stylesheet" href="<?php echo base_url("resources/css/bootstrap.css"); ?>"/>
  	<link rel="stylesheet" href="<?php echo base_url("resources/css/mdb.css"); ?>"/>
  	<link rel="stylesheet" href="<?php echo base_url("resources/css/style.css"); ?>"/>
	<link rel="stylesheet" href="<?php echo base_url("resources/css/material-icons.css"); ?>"/>
	<link rel="stylesheet" href="<?php echo base_url("resources/css/bootstrap-material-datetimepicker.css"); ?>"/>

    <script src="<?php echo base_url("resources/js/jquery-3.1.1.min.js"); ?>"></script>
  
</head>
<body>

        <!--Navbar-->
        <nav class=" navbar navbar-expand-lg navbar-dark cyan darken-2">
            <div class="container-fluid">
                <logo>
                    <?php echo anchor("","<h4><strong>Campaign Orders</strong></h4>",["class" => "navbar-brand"]); ?>
    			</logo>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-3" aria-controls="navbarSupportedContent-3"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            	</button>
            </div>
        </nav>

	<div class="container"><br><br><br><br>
	<div class="row justify-content-md-center">
	<!--Panel-->
		<div class="card" style="width: 30rem;">
		    <div class="card-header text-center amber darken-1 white-text">
		        Login
		    </div>
		    <div class="card-body">
		    	<?php 
		            if($error = $this->session->flashdata('response')):
		            {                       
			        ?>
			        <p class="text-danger text-center">
			            <span class ="fa fa-info text-danger"></span>
			            <?php echo $error; ?>
			        </p>
			        <?php 
			        }
			            endif
		        ?>
		        <!-- Form register -->
				<?php echo form_open("report/login_validation",['method' => 'post','id' => 'frm_search']); ?>
				    <div class="md-form">
				        <i class="fa fa-id-badge prefix grey-text"></i>
				        <input type="text" id="Username" name="Username" class="form-control" required>
				        <label for="Username">Username</label>
				        <span><?php echo form_error('Username') ?></span>
				    </div>
				    <div class="md-form">
				        <i class="fa fa-lock prefix grey-text"></i>
				        <input type="password" id="Password" name="Password" class="form-control" required>
				        <label for="Password">Password</label>
				    </div>

				    <div class="text-center">
				        <button class="btn amber darken-1">Rock On!</button>
				    </div>

				<?php echo form_close(); ?>
				<!-- Form register -->
		    </div>
		</div>
		<!--/.Panel-->
	</div>

	</div>

<?php include('footer.php'); ?>