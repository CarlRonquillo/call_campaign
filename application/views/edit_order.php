<?php include('header.php'); ?>

	<div class="container-fluid"><br>
		<div class="row justify-content-md-center">
			<div class="card" style="width: 35rem;">
			    <div class="card-header text-center bg-amber white-text">
			        Edit December Campaign Order Form
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
					<?php echo form_open("report/update_order/{$record->ID}",['type' => 'POST','class' => 'form-horizontal']); ?>
						<div class="row">
							<div class="col-md-6 md-form">
						        <i class="fa fa-cube prefix grey-text"></i>
						        <input value="<?php echo $record->Brochure; ?>" type="number" id="Brochure" name="Brochure" class="form-control" required>
						        <label for="Brochure">NCM Brochure</label>
						    </div>
						    <div class="col-md-5 md-form">
						        <input value="<?php echo $record->Envelope; ?>" type="number" id="Envelope" name="Envelope" class="form-control" required>
						        <label for="Envelope">NCM Offering Envelope</label>
						    </div>
					    </div>
					    <div class="row">
						    <div class="col-md-6 md-form">
						        <i class="fa fa-user prefix grey-text"></i>
						        <input value="<?php echo $record->FirstName; ?>" type="text" id="FirstName" name="FirstName" class="form-control" required>
						        <label for="FirstName">First Name</label>
						    </div>
						    <div class="col-md-5 md-form">
						        <input value="<?php echo $record->LastName; ?>" type="text" id="LastName" name="LastName" class="form-control" required>
						        <label for="LastName">Last Name</label>
						    </div>
					    </div>
					    <div class="row">
						    <div class="col-md-12 md-form">
						        <i class="fa fa-globe prefix grey-text"></i>
						        <input value="<?php echo $record->Street_Address; ?>" type="text" id="Street_Address" name="Street_Address" class="form-control">
						        <label for="Street_Address">Street Address</label>
						    </div>
						</div>
						<div class="row">
							<div class="col-md-1"></div>
						    <div class="col-md-11 md-form">
						        <input value="<?php echo $record->Address2; ?>" type="text" id="Address2" name="Address2" class="form-control">
						        <label for="Address2">Adress Line 2</label>
						    </div>
						</div>
						<div class="row">
							<div class="col-md-1"></div>
						    <div class="col-md-6 md-form">
						        <input value="<?php echo $record->City; ?>" type="text" id="City" name="City" class="form-control" required>
						        <label for="City">City</label>
						    </div>
						    <div class="col-md-5 md-form">
						        <input value="<?php echo $record->State; ?>" type="text" id="State" name="State" class="form-control" required>
						        <label for="State">State</label>
						    </div>
						</div>
						<div class="row">
							<div class="col-md-1"></div>
						    <div class="col-md-5 md-form">
						        <input value="<?php echo $record->PostalCode; ?>" type="number" id="PostalCode" name="PostalCode" class="form-control" required>
						        <label for="PostalCode">Postal Code</label>
						    </div>
						    <div class="col-md-6 form-group">
							    <label for="Country" class="grey-text">Country</label>
							    <select value="<?php echo $record->Country; ?>" class="form-control" id="Country" name="Country" required>
	      							<option value="Afghanistan" >Afghanistan</option>
									<option value="Albania" >Albania</option>
									<option value="Algeria" >Algeria</option>
									<option value="Andorra" >Andorra</option>
									<option value="Antigua and Barbuda" >Antigua and Barbuda</option>
									<option value="Argentina" >Argentina</option>
									<option value="Armenia" >Armenia</option>
									<option value="Australia" >Australia</option>
									<option value="Austria" >Austria</option>
									<option value="Azerbaijan" >Azerbaijan</option>
									<option value="Bahamas" >Bahamas</option>
									<option value="Bahrain" >Bahrain</option>
									<option value="Bangladesh" >Bangladesh</option>
									<option value="Barbados" >Barbados</option>
									<option value="Belarus" >Belarus</option>
									<option value="Belgium" >Belgium</option>
									<option value="Belize" >Belize</option>
									<option value="Benin" >Benin</option>
									<option value="Bhutan" >Bhutan</option>
									<option value="Bolivia" >Bolivia</option>
									<option value="Bosnia and Herzegovina" >Bosnia and Herzegovina</option>
									<option value="Botswana" >Botswana</option>
									<option value="Brazil" >Brazil</option>
									<option value="Brunei" >Brunei</option>
									<option value="Bulgaria" >Bulgaria</option>
									<option value="Burkina Faso" >Burkina Faso</option>
									<option value="Burundi" >Burundi</option>
									<option value="Cambodia" >Cambodia</option>
									<option value="Cameroon" >Cameroon</option>
									<option value="Canada" >Canada</option>
									<option value="Cape Verde" >Cape Verde</option>
									<option value="Central African Republic" >Central African Republic</option>
									<option value="Chad" >Chad</option>
									<option value="Chile" >Chile</option>
									<option value="China" >China</option>
									<option value="Colombia" >Colombia</option>
									<option value="Comoros" >Comoros</option>
									<option value="Congo" >Congo</option>
									<option value="Costa Rica" >Costa Rica</option>
									<option value="Côte d'Ivoire" >Côte d'Ivoire</option>
									<option value="Croatia" >Croatia</option>
									<option value="Cuba" >Cuba</option>
									<option value="Cyprus" >Cyprus</option>
									<option value="Czech Republic" >Czech Republic</option>
									<option value="Denmark" >Denmark</option>
									<option value="Djibouti" >Djibouti</option>
									<option value="Dominica" >Dominica</option>
									<option value="Dominican Republic" >Dominican Republic</option>
									<option value="East Timor" >East Timor</option>
									<option value="Ecuador" >Ecuador</option>
									<option value="Egypt" >Egypt</option>
									<option value="El Salvador" >El Salvador</option>
									<option value="Equatorial Guinea" >Equatorial Guinea</option>
									<option value="Eritrea" >Eritrea</option>
									<option value="Estonia" >Estonia</option>
									<option value="Ethiopia" >Ethiopia</option>
									<option value="Fiji" >Fiji</option>
									<option value="Finland" >Finland</option>
									<option value="France" >France</option>
									<option value="Gabon" >Gabon</option>
									<option value="Gambia" >Gambia</option>
									<option value="Georgia" >Georgia</option>
									<option value="Germany" >Germany</option>
									<option value="Ghana" >Ghana</option>
									<option value="Greece" >Greece</option>
									<option value="Grenada" >Grenada</option>
									<option value="Guatemala" >Guatemala</option>
									<option value="Guinea" >Guinea</option>
									<option value="Guinea-Bissau" >Guinea-Bissau</option>
									<option value="Guyana" >Guyana</option>
									<option value="Haiti" >Haiti</option>
									<option value="Honduras" >Honduras</option>
									<option value="Hong Kong" >Hong Kong</option>
									<option value="Hungary" >Hungary</option>
									<option value="Iceland" >Iceland</option>
									<option value="India" >India</option>
									<option value="Indonesia" >Indonesia</option>
									<option value="Iran" >Iran</option>
									<option value="Iraq" >Iraq</option>
									<option value="Ireland" >Ireland</option>
									<option value="Israel" >Israel</option>
									<option value="Italy" >Italy</option>
									<option value="Jamaica" >Jamaica</option>
									<option value="Japan" >Japan</option>
									<option value="Jordan" >Jordan</option>
									<option value="Kazakhstan" >Kazakhstan</option>
									<option value="Kenya" >Kenya</option>
									<option value="Kiribati" >Kiribati</option>
									<option value="North Korea" >North Korea</option>
									<option value="South Korea" >South Korea</option>
									<option value="Kuwait" >Kuwait</option>
									<option value="Kyrgyzstan" >Kyrgyzstan</option>
									<option value="Laos" >Laos</option>
									<option value="Latvia" >Latvia</option>
									<option value="Lebanon" >Lebanon</option>
									<option value="Lesotho" >Lesotho</option>
									<option value="Liberia" >Liberia</option>
									<option value="Libya" >Libya</option>
									<option value="Liechtenstein" >Liechtenstein</option>
									<option value="Lithuania" >Lithuania</option>
									<option value="Luxembourg" >Luxembourg</option>
									<option value="Macedonia" >Macedonia</option>
									<option value="Madagascar" >Madagascar</option>
									<option value="Malawi" >Malawi</option>
									<option value="Malaysia" >Malaysia</option>
									<option value="Maldives" >Maldives</option>
									<option value="Mali" >Mali</option>
									<option value="Malta" >Malta</option>
									<option value="Marshall Islands" >Marshall Islands</option>
									<option value="Mauritania" >Mauritania</option>
									<option value="Mauritius" >Mauritius</option>
									<option value="Mexico" >Mexico</option>
									<option value="Micronesia" >Micronesia</option>
									<option value="Moldova" >Moldova</option>
									<option value="Monaco" >Monaco</option>
									<option value="Mongolia" >Mongolia</option>
									<option value="Montenegro" >Montenegro</option>
									<option value="Morocco" >Morocco</option>
									<option value="Mozambique" >Mozambique</option>
									<option value="Myanmar" >Myanmar</option>
									<option value="Namibia" >Namibia</option>
									<option value="Nauru" >Nauru</option>
									<option value="Nepal" >Nepal</option>
									<option value="Netherlands" >Netherlands</option>
									<option value="New Zealand" >New Zealand</option>
									<option value="Nicaragua" >Nicaragua</option>
									<option value="Niger" >Niger</option>
									<option value="Nigeria" >Nigeria</option>
									<option value="Norway" >Norway</option>
									<option value="Oman" >Oman</option>
									<option value="Pakistan" >Pakistan</option>
									<option value="Palau" >Palau</option>
									<option value="Panama" >Panama</option>
									<option value="Papua New Guinea" >Papua New Guinea</option>
									<option value="Paraguay" >Paraguay</option>
									<option value="Peru" >Peru</option>
									<option value="Philippines" >Philippines</option>
									<option value="Poland" >Poland</option>
									<option value="Portugal" >Portugal</option>
									<option value="Puerto Rico" >Puerto Rico</option>
									<option value="Qatar" >Qatar</option>
									<option value="Romania" >Romania</option>
									<option value="Russia" >Russia</option>
									<option value="Rwanda" >Rwanda</option>
									<option value="Saint Kitts and Nevis" >Saint Kitts and Nevis</option>
									<option value="Saint Lucia" >Saint Lucia</option>
									<option value="Saint Vincent and the Grenadines" >Saint Vincent and the Grenadines</option>
									<option value="Samoa" >Samoa</option>
									<option value="San Marino" >San Marino</option>
									<option value="Sao Tome and Principe" >Sao Tome and Principe</option>
									<option value="Saudi Arabia" >Saudi Arabia</option>
									<option value="Senegal" >Senegal</option>
									<option value="Serbia and Montenegro" >Serbia and Montenegro</option>
									<option value="Seychelles" >Seychelles</option>
									<option value="Sierra Leone" >Sierra Leone</option>
									<option value="Singapore" >Singapore</option>
									<option value="Slovakia" >Slovakia</option>
									<option value="Slovenia" >Slovenia</option>
									<option value="Solomon Islands" >Solomon Islands</option>
									<option value="Somalia" >Somalia</option>
									<option value="South Africa" >South Africa</option>
									<option value="Spain" >Spain</option>
									<option value="Sri Lanka" >Sri Lanka</option>
									<option value="Sudan" >Sudan</option>
									<option value="Suriname" >Suriname</option>
									<option value="Swaziland" >Swaziland</option>
									<option value="Sweden" >Sweden</option>
									<option value="Switzerland" >Switzerland</option>
									<option value="Syria" >Syria</option>
									<option value="Taiwan" >Taiwan</option>
									<option value="Tajikistan" >Tajikistan</option>
									<option value="Tanzania" >Tanzania</option>
									<option value="Thailand" >Thailand</option>
									<option value="Togo" >Togo</option>
									<option value="Tonga" >Tonga</option>
									<option value="Trinidad and Tobago" >Trinidad and Tobago</option>
									<option value="Tunisia" >Tunisia</option>
									<option value="Turkey" >Turkey</option>
									<option value="Turkmenistan" >Turkmenistan</option>
									<option value="Tuvalu" >Tuvalu</option>
									<option value="Uganda" >Uganda</option>
									<option value="Ukraine" >Ukraine</option>
									<option value="United Arab Emirates" >United Arab Emirates</option>
									<option value="United Kingdom" >United Kingdom</option>
									<option value="United States" selected="selected">United States</option>
									<option value="Uruguay" >Uruguay</option>
									<option value="Uzbekistan" >Uzbekistan</option>
									<option value="Vanuatu" >Vanuatu</option>
									<option value="Vatican City" >Vatican City</option>
									<option value="Venezuela" >Venezuela</option>
									<option value="Vietnam" >Vietnam</option>
									<option value="Yemen" >Yemen</option>
									<option value="Zambia" >Zambia</option>
									<option value="Zimbabwe" >Zimbabwe</option>
								</select>
	    					</div>
    					</div>
    					<div class="row">
						    <div class="col-md-6 md-form">
						        <i class="fa fa-phone prefix grey-text"></i>
						        <input value="<?php echo $record->PhoneNo; ?>" type="text" id="PhoneNo" name="PhoneNo" class="form-control" required>
						        <label for="PhoneNo">Phone</label>
						    </div>
					    </div>
					   	<div class="row">
						    <div class="col-md-8 md-form">
						        <i class="fa fa-at prefix grey-text"></i>
						        <input value="<?php echo $record->Email; ?>" type="email" id="Email" name="Email" class="form-control">
						        <label for="Email">Email</label>
					    	</div>
					    </div>
					    <div class="md-form">
						    <i class="fa fa-comment-o prefix grey-text"></i>
						    <textarea type="text" id="Comments" name="Comments" class="md-textarea"><?php echo $record->Comments; ?></textarea>
						    <label for="Comments">Comments</label>
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
					        <button type="submit" id="submit" class="btn bg-amber">UPDATE</button>
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
				/*$('.date').bootstrapMaterialDatePicker
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

				$.material.init()*/

								//WEBSOCKETsss!
		    	/*$("#submit").click(function(){
		    		alert();

		       var dataString = { 
		       			Brochure: $("#Brochure").val(),
		              Envelope: $("#Envelope").val(),
		              FirstName : $("#FirstName").val(),
		              LastName : $("#LastName").val(),
		              Street_Address: $("#Street_Address").val(),
		              Address2: $("#Address2").val(),
		              City : $("#City").val(),
		              State : $("#State").val(),
		              PhoneNo : $("#PhoneNo").val(),
		              Email : $("#Email").val(),
		              //DateOrdered : $("#DateOrdered").val(),
		              Comments: $("#Comments").val()
		            };

		            console.log(dataString);

		        $.ajax({
		            type: "POST",
		            url: "<?php echo base_url('index.php/report/save_order');?>",
		            data: dataString,
		            dataType: "json",
		            cache : false,
		            success: function(data){

		              if(data.success == true){
		              	alert('true!');

		                //$("#notif").html(data.notif);

		                var socket = io.connect( 'http://'+window.location.hostname+':3000' );

		                socket.emit('new_count_record', { 
		                  new_count_record: data.new_count_record
		                });

		                /*socket.emit('new_record', {
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
		                });*/
		                alert('finish!');

		              /*} else if(data.success == false){
		              	alert('false!');

		                $("#FirstName").val(data.FirstName);
			            $("#LastName").val(data.LastName);
			            $("#State").val(data.State);
			            $("#PhoneNo").val(data.PhoneNo);
			            $("#Email").val(data.Email);
			            $("#DateOrdered").val(data.DateOrdered);*/

		            /*}
		          
		            } ,error: function(xhr, status, error) {
		              alert(error);
		            },

		        });

		    	});
			});
		</script>

<?php include('footer.php'); ?>