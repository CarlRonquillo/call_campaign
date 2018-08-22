<?php include('header.php'); ?>

	<div class="container-fluid"><br>
		<div class="row justify-content-md-center">
			<div class="card" style="width: 30rem;">
			    <div class="card-header text-center success-color white-text">
			        Edit Completed
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
					<?php echo form_open("report/update_completed/{$record->ID}",['type' => 'POST','class' => 'form-horizontal']); ?>
					    <div class="md-form">
					        <i class="fa fa-user prefix grey-text"></i>
					        <input value="<?php echo $record->FirstName; ?>" type="text" id="FirstName" name="FirstName" class="form-control" required>
					        <label for="FirstName">First Name</label>
					    </div>
					    <div class="md-form">
					        <i class="fa fa-user prefix grey-text"></i>
					        <input value="<?php echo $record->LastName; ?>" type="text" id="LastName" name="LastName" class="form-control" required>
					        <label for="LastName">Last Name</label>
					    </div>
					    <div class="md-form">
					        <i class="fa fa-globe prefix grey-text"></i>
					        <input value="<?php echo $record->State; ?>" type="text" id="State" name="State" class="form-control" required>
					        <label for="State">State</label>
					    </div>
					    <div class="md-form">
					        <i class="fa fa-phone prefix grey-text"></i>
					        <input value="<?php echo $record->PhoneNo; ?>" type="text" id="PhoneNo" name="PhoneNo" class="form-control" required>
					        <label for="PhoneNo">Phone</label>
					    </div>
					    <div class="md-form">
					        <i class="fa fa-envelope prefix grey-text"></i>
					        <input value="<?php echo $record->Email; ?>" type="email" id="Email" name="Email" class="form-control">
					        <label for="Email">Email</label>
					    </div>
					    <!--<div class="md-form">
					        <i class="fa fa-calendar prefix grey-text"></i>
					        <input type="text" id="DateOrdered" class="date form-control" value="<?php echo date("Y-m-d")?>" required>
					        <label for="DateOrdered">Order Date</label>
					    </div>-->
					    <div class="md-form">
					    	<i class="fa fa-group prefix grey-text"></i>
						    <label class="form-check-label grey-text">
						    	<input <?php echo ($record->Network==1 ? 'checked' : '');?> type="checkbox" id="Network" name="Network" class="form-check-input" value="1">
						    	NCM Network
							</label>
						</div><br><br>

					    <div class="text-center">
					        <button type="submit" id="submit" class="btn success-color">UPDATE</button>
					    </div>
					</form>

					<?php echo anchor("","<i class='fa fa-home'></i> back to Home",["class" => "grey-text"]); ?>
			    </div>
			</div>
		</div><br>
	</div>

	<script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>

		<script>
			$(document).ready(function(){
				$('.date').bootstrapMaterialDatePicker
				({
					time: false,
					clearButton: true
				});

				$('#time').bootstrapMaterialDatePicker
				({
					date: false,
					shortTime: false,
					format: 'HH:mm'
				});

				$('#date-format').bootstrapMaterialDatePicker
				({
					format: 'dddd DD MMMM YYYY - HH:mm'
				});
				$('#date-fr').bootstrapMaterialDatePicker
				({
					format: 'DD/MM/YYYY HH:mm',
					lang: 'fr',
					weekStart: 1, 
					cancelText : 'ANNULER',
					nowButton : true,
					switchOnClick : true
				});

				$('#date-end').bootstrapMaterialDatePicker
				({
					weekStart: 0, format: 'DD/MM/YYYY HH:mm'
				});
				$('#date-start').bootstrapMaterialDatePicker
				({
					weekStart: 0, format: 'DD/MM/YYYY HH:mm', shortTime : true
				}).on('change', function(e, date)
				{
					$('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
				});

				$('#min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });

				$.material.init()

								//WEBSOCKETsss!
		    	/*$("#submit").click(function(){

		       var dataString = { 
		              FirstName : $("#FirstName").val(),
		              LastName : $("#LastName").val(),
		              State : $("#State").val(),
		              PhoneNo : $("#PhoneNo").val(),
		              Email : $("#Email").val()
		            };

		        $.ajax({
		            type: "POST",
		            url: "<?php echo base_url('index.php/report/save_completed');?>",
		            data: dataString,
		            dataType: "json",
		            cache : false,
		            success: function(data){

		            	$("#FirstName").val('');
			            $("#LastName").val('');
			            $("#State").val('');
			            $("#PhoneNo").val('');
			            $("#Email").val('');

		              if(data.success == true){

		              	$("#notif").html(data.notif);

		                var socket = io.connect( 'http://'+window.location.hostname+':3000' );

		                socket.emit('new_count_record', { 
		                  new_count_record: data.new_count_record
		                });

		                socket.emit('new_record', {
		                  FirstName: data.FirstName,
		                  LastName: data.LastName,
		                  State: data.State,
		                  PhoneNo: data.PhoneNo,
		                  Email: data.Email,
		                  DateOrdered: data.DateOrdered,
		                  DVD: data.DVD,
		                  Catalog: data.Catalog,
		                  Brochure: data.Brochure,
		                  Envelope: data.Envelope,
		                  Name: data.Name,
		                  Completed: data.Completed,
		                  Closed: data.Closed
		                });

		              } else if(data.success == false){

		                $("#FirstName").val(data.FirstName);
			            $("#LastName").val(data.LastName);
			            $("#State").val(data.State);
			            $("#PhoneNo").val(data.PhoneNo);
			            $("#Email").val(data.Email);
		              }
		          
		            } ,error: function(xhr, status, error) {
		              alert(error);
		            },

		        });

		    	});*/
			});
		</script>

<?php include('footer.php'); ?>