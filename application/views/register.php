<?php include('header.php'); ?>

	<div class="container-fluid"><br>
	<div class="row justify-content-md-center">
	<!--Panel-->
		<div class="card" style="width: 30rem;">
		    <div class="card-header text-center bg-default white-text">
		        Register
		    </div>
		    <div class="card-body">
		    	<?php 
		            if($error = $this->session->flashdata('response')):
		            {                       
			        ?>
			        <p class="text-success text-center">
			            <span class ="fa fa-info text-success"></span>
			            <?php echo $error; ?>
			        </p>
			        <?php 
			        }
			            endif
		        ?>
		        <!-- Form register -->
				<?php echo form_open("report/save_user",['method' => 'post','id' => 'frm_search']); ?>
				    <div class="md-form">
				        <i class="fa fa-user prefix grey-text"></i>
				        <input type="text" id="Name" name="Name" class="form-control" required>
				        <label for="Name">Name</label>
				    </div>
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
				        <button class="btn btn-default">Sign up</button>
				    </div>

				<?php echo form_close(); ?>
				<!-- Form register -->
				<?php echo anchor("","<i class='fa fa-home'></i> back to Home",["class" => "grey-text"]); ?>
		    </div>
		</div>
		<!--/.Panel-->
	</div>

	</div>

<?php include('footer.php'); ?>