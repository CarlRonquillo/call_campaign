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
        <nav class="navbar navbar-expand-lg navbar-dark cyan darken-2">
            <div class="container-fluid">
                <logo>
                    <?php echo anchor("","<h4><strong>Campaign Report</strong></h4>",["class" => "navbar-brand"]); ?>
    			</logo>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-3" aria-controls="navbarSupportedContent-3"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            	</button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent-3">
                    <ul class="navbar-nav ml-auto nav-flex-icons">
                    	<li class="nav-item">
                            <a class="nav-link waves-effect waves-light" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search"></i>Search</a>
                        </li>
                        <li class="nav-item">
                            <?php echo anchor("report/Order","<i class='fa fa-cube amber-text'></i>Order Form",["class" => "nav-link waves-effect waves-light", 'target' => 'blank']); ?>
                        </li>
                        <li class="nav-item">
                            <?php echo anchor("report/Completed","<i class='fa fa-check lime-text'></i>Create Completed",["class" => "nav-link waves-effect waves-light", 'target' => 'blank']); ?>
                        </li>
                        <li class="nav-item">
                            <?php echo anchor("report/Summary","<i class='fa fa-tasks'></i>Individual Summary",["class" => "nav-link waves-effect waves-light"]); ?>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-user'></i> <?php echo $this->session->userdata('Name'); ?></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                <?php
                                    if($this->session->userdata('Username') == 'admin')
                                    {
                                        echo "<a class='dropdown-item waves-effect waves-light' href='". base_url("index.php/report/register") ."'>Add User</a>";
                                    }
                                ?>

                                <!--<a class="dropdown-item waves-effect waves-light" href="#">Account Details</a>-->
                                <?php echo anchor("report/Logout","Logout",["class" => "dropdown-item waves-effect waves-light"]); ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>