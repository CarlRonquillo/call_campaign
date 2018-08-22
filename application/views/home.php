<?php include('header.php'); ?>

	<?php
		//$countDVD = 0;
		$countNetwork = 0;
		$countBrochure = 0;
		$countEnvelope =0;
		$countCompleted =0;
		$countClosed =0;
		$countNoOrder =0;
		foreach($records as $record)
		{
			//$countDVD += $record->DVD;
			$countNetwork += $record->Network;
			$countBrochure += $record->Brochure;
			$countEnvelope += $record->Envelope;
			$countCompleted += $record->Completed;
			$countClosed += $record->Closed;
			$countNoOrder += ($record->Completed - $record->Closed);
		}
	?>

	<div class="container-fluid"><br>
		<div id="headCount" class="card">
			<div class="card-body mx-4">
				<div class="text-center">
					
					<div class="row align-items-center">
						<div class="col">
					    	<h4><strong>NETWORK</strong></h4>
					    	<h2 id="countNetwork"><?php echo $countNetwork; ?></h2>
					    </div>
					    <!--<div class="col">
					    	<h4><strong>CATALOG</strong></h4>
					    	<h2 id="countCatalog"><?php echo $countCatalog; ?></h2>
					    </div>-->
					    <div class="col">
					    	<h4><strong>BROCHURE</strong></h4>
					      	<h2 id="countBrochure"><?php echo $countBrochure; ?></h2>
					    </div>
					    <div class="col">
					      	<h4><strong>ENVELOPE</strong></h4>
					      	<h2 id="countEnvelope"><?php echo $countEnvelope; ?></h2>
					    </div>
					    <div class="col">
					    	<h4><strong>COMPLETED</strong></h4>
					    	<h2 id="countCompleted"><?php echo $countCompleted; ?></h2>
					    </div>
					    <div class="col-md-2">
					    	<h4><strong>NO ORDER</strong></h4>
					    	<h2 id="countNoOrder"><?php echo $countNoOrder; ?></h2>
					    </div>
					    <div class="col">
					    	<h4 class="mb-0" ><strong>CLOSED</strong></h4>
					      <p class="amber-text mb-0" style="font-size: 80px;"><b id="countClosed"><?php echo $countClosed; ?></b></p>
					    </div>
					</div>
					<div class="progress mb-0">
						<?php if($countCompleted != 0)
						{
							$percentVal = round(($countClosed/$countCompleted)*100);
						}
						else
						{
							$percentVal = 0;
						} ?>
		  				<div id="percentage" class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $percentVal; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $percentVal; ?>%</div>
					</div>
				</div>
				<div class="collapse" id="collapseExample">
					<br>
					<div class="card">
					    <div class="card-header text-center yellow darken-2">
					        <a class="white-text" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Search Record</a>
					    </div>
					    <div class="card-body">
					    	<?php echo form_open("report/search",['class' => 'form-inline justify-content-md-center','method' => 'post','id' => 'frm_search']); ?>
					        	<div class="row justify-content-md-center">
					        		<div class="col-xs-2 md-form form-group">
					        			<i class="fa fa-calendar prefix"></i>
										<input type="text" name ="dateFrom" id="date1" class="date form-control floating-label" placeholder="From">
										<label for="date1" class="">Date range</label>
									</div>
									<div class="col-xs-2 md-form form-group">
										<i class="fa fa-calendar prefix"></i>
										<input type="text" name ="dateTo" id="date2" class="date form-control floating-label" placeholder="To">
									</div>
								    <div class="col-xs-3 md-form form-group">
								    	<i class="fa fa-user prefix"></i>
									    <input type="text" name ="Name" id="form1" class="form-control"></input>
									    <label for="form1" class="">Name</label>
								    </div>
								    <div class="col-xs-3 form-group">
									    <label for="CallerID" class="grey-text">Caller</label>
									    <?php
				                            $callers_info = array('');
				                            foreach($callers as $caller)
				                            {
				                            $callers_info[$caller->ID]=$caller->Name;
				                            }
				                            echo form_dropdown(['id' => 'CallerID','name' => 'CallerID', 'class' => 'form-control','autocomplete' => 'off'],$callers_info);
				                        ?>
									    <!--<select class="form-control" id="CallerID" name="CallerID">
			      							<option value="Afghanistan" >Afghanistan</option>
			      							<option value="Afghanistan" >AfghanistanAfghanistanAfghanistan</option>
			      							<option value="Afghanistan" >Afghanistan</option>
										</select>-->
								    </div>
					        	</div>
								<button type="submit" class="btn btn-default">Submit</button>
							<?php echo form_close(); ?>
					    </div>
					</div>
				</div>
				<br>

				<?php $record_count = count($records); ?>
				<p class='mb-0'><b id="count"><?php echo $record_count; ?></b> record(s)</p>

				<?php
					if(isset($isSearched))
					{ ?>

					<div>
						<p>
							<span><?php echo anchor("report/index","<i class='fa fa-remove text-danger'></i> ") ?>Search: </span>
							<?php if(!empty($searched_from) or !empty($searched_to)) { ?>
								<span><i class="fa fa-calendar"></i> <?php echo $searched_from.' to '.$searched_to; ?></span>
							<?php }	?>
							<?php if(!empty($searched_name)) { ?>
								| <span><i class="fa fa-user"></i> <?php echo $searched_name; ?></span>
							<?php }	?>
							<?php if(!empty($searched_caller)) { ?>
								| <span><i class="fa fa-phone"></i> <?php echo $searched_caller; ?></span>
							<?php }	?>
						</p>
					</div>

				<?php	}	?>
				<table class="table table-sm table-hover table-striped table-responsive">
				 	<thead class="bg-default">
					<tr class="text-white">
				    	<th>Name</th>
				     	<th>State</th>
				    	<th>Contact No</th>
				    	<th>Email Address</th>
				    	<th>Date Saved</th>
				    	<!--<th>DVD</th>
				    	<th>Catalog</th>-->
				    	<th>Brochure</th>
				    	<th>Envelope</th>
				    	<th>Caller</th>
				    	<th>Completed</th>
				    	<th>Closed</th>
				    	<?php
                            if($this->session->userdata('Username') == 'admin')
                            {
                                echo "<th style='width: 1px;'></th>";
                                echo "<th style='width: 1px;'></th>";
                            }
                        ?>
				    </tr>
				  </thead>
				  <tbody id="record-body">
				    <tr>
				    	<?php if(count($record_count)):
	  						foreach($records as $record) { ?>
			    			<tr>
			    				<td><?php echo $record->FirstName.' '.$record->LastName; ?></td>
			    				<td><?php echo $record->State; ?></td>
			    				<td><?php echo $record->PhoneNo; ?></td>
			    				<?php
			    					$email = $record->Email;
			    					if(strlen($email) > 25)
			    					{
			    						$email = substr($record->Email, 0, 25) . '...';
			    					}
			    				?>
			    				<td title="<?php echo $record->Email; ?>"><?php echo $email; ?></td>
			    				<td><?php echo $record->DateOrdered; ?></td>
			    				<!--<td><?php echo $record->DVD; ?></td>
			    				<td><?php echo $record->Catalog; ?></td>-->
			    				<td><?php echo $record->Brochure; ?></td>
			    				<td><?php echo $record->Envelope; ?></td>
			    				<td><?php echo $record->Name; ?></td>
			    				<td><i class="<?php circle_icon($record->Completed); ?>"></i></td>
			    				<td><i class="<?php circle_icon($record->Closed); ?>"></i></td>
			    				
			    				<?php
                                    if($this->session->userdata('Username') == 'admin')
                                    {
                                    	$controller = '';
                                    	if($record->Closed)
                                    	{
                                    		$controller = 'edit_order';
                                    	}
                                    	else
                                    	{
                                    		$controller = 'edit_completed';
                                    	}

                                    	echo "<td>";
                                        echo anchor("report/{$controller}/{$record->ID}","<i class='fa fa-pencil text-warning'></i>",["class"=>"nav-link waves-effect waves-light"]);
                                        echo "</td>";
                                    	echo "<td>";
                                        echo anchor("report/delete/{$record->ID}","<i class='fa fa-remove text-danger'></i>",["class"=>"nav-link waves-effect waves-light","onclick" => "return confirm('Are you sure you want delete this record?')"]);
                                        echo "</td>";
                                    }
                                ?>

			    			<tr>
				    		<?php } else: ?>
								<tr>No Records Found!</tr>
							<?php endif; ?>
				    </tr>
				  </tbody>
				</table>
			</div>
		</div>

	</div>

		<?php
			function circle_icon($bool)
			{
				if($bool)
				{
					$Icon = "fa fa-circle text-success";
				}
				else
				{
					$Icon = "fa fa-circle text-danger";
				}
				echo $Icon;
			}

			$dateTime = date('Y-m-d H:i:s');
		?>

		<script type="text/javascript">
		/*function dateTimePicker()
		{
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
		}*/
		$(document).ready(function()
		{
			var isiPad = navigator.userAgent.match(/iPad/i) != null;

			if(isiPad)
			{
				setInterval(function() {
					location.reload();
				}, 900000);
			}
			else
			{
				//dateTimePicker();
				// For todays date; 2017-09-12 02:37:01 |LastSync: 29/09/2017 @ 22:09:59
				/*Date.prototype.today = function () { 
				    return ((this.getDate() < 10)?"0":"") + this.getFullYear() +"-"+(((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1) +"-"+ this.getDate();
				}

				// For the time now
				Date.prototype.timeNow = function () {
				     return ((this.getHours() < 10)?"0":"") + this.getHours() +":"+ ((this.getMinutes() < 10)?"0":"") + this.getMinutes() +":"+ ((this.getSeconds() < 10)?"0":"") + this.getSeconds();
				}

				var newDate = new Date();
				var datetime = newDate.today() + " " + newDate.timeNow();*/

				var lastcheck = "<?php echo $dateTime ?>"; 
				//alert(lastcheck);
			    setInterval(function() {
			        $.ajax({
			            url:    "<?php echo base_url('index.php/report/get_latestrecord');?>", 
			            type:   'POST',
			            data:   {'lastcheck':lastcheck},
			            success: function(result){ 
			                if (result!='nothing_new'){
			                	
			                	function icon(bool)
							  	{
							  		if(bool == 1)
								  	{
								  		return "<i class='fa fa-circle text-success'></i>";
								  	}
								  	else
								  	{
								  		return "<i class='fa fa-circle text-danger'></i>";
								  	}
							  	}

			                	obj = JSON.parse(result);
			                    lastcheck=obj.lastcheck; /*Update lastcheck*/
			                    //console.log(obj);

			                    //$("#record-body").prepend('<tr><td>#</td><td>'+obj.records.FirstName +' '+obj.records.LastName+'</td><td>'+obj.records.State+'</td><td>'+obj.records.PhoneNo+'</td><td>'+obj.records.Email+'</td><td>'+obj.records.DateOrdered+'</td><td>'+obj.records.DVD+'</td><td>'+obj.records.Catalog+'</td><td>'+obj.records.Brochure+'</td><td>'+obj.records.Envelope+'</td><td>'+obj.records.Name+'</td><td>'+icon(obj.records.Completed)+'</td><td>'+icon(obj.records.Closed)+'</td></tr>');
			                    //var data=result.records;

			                    var admin= "";

			                    if(<?php echo $this->session->userdata('Username') ?> == 'admin')
			                    {
			                    	admin ="<td><a class='nav-link waves-effect waves-light'><i class='fa fa-remove text-danger'></i></a></td>";
			                    }

			                    $.each(obj.records, function(i,val){
			                    	$("#record-body").prepend('<tr><td>'+obj.records[i].FirstName +' '+obj.records[i].LastName+'</td><td>'+obj.records[i].State+'</td><td>'+obj.records[i].PhoneNo+'</td><td>'+obj.records[i].Email+'</td><td>'+obj.records[i].DateOrdered+'</td><td>'+obj.records[i].Brochure+'</td><td>'+obj.records[i].Envelope+'</td><td>'+obj.records[i].Name+'</td><td>'+icon(obj.records[i].Completed)+'</td><td>'+icon(obj.records[i].Closed)+'</td>'+admin+'</tr>');
			                    });

			                    //$("#countDVD").html(obj.summary[0].countDVD);
			                    //$("#countCatalog").html(obj.summary[0].countCatalog);
			                    $("#count").html(obj.summary[0].Completed);
			                    $("#countNetwork").html(obj.summary[0].Network);
			                    $("#countBrochure").html(obj.summary[0].Brochure);
			                    $("#countEnvelope").html(obj.summary[0].Envelope);
			                    $("#countClosed").html(obj.summary[0].Closed);
			                    $("#countNoOrder").html(obj.summary[0].NoOrder);
			                    $("#countCompleted").html(obj.summary[0].Completed);
			                    $("#percentage").html(obj.summary[0].percentage);
			                    
			                    document.getElementById("percentage").style.width = "'" + obj.summary[0].percentage + "'";
			                }
			                else
			                {
			                	//console.log(lastcheck+' No record!');
			                }
			            },error: function(xhr, status, error) {
			              console.log(error);
			            },
			        });

			    }, 10000 /* This will check each 15 seconds, you can change it*/ );
			}

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
		});
		</script>

	<!--<script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>-->

		<script>
  /*var socket = io.connect( 'http://'+window.location.hostname+':3000' );

  socket.on( 'new_count_record', function( data ) {
      $( "#new_count_record" ).html( data.new_count_record );
  });

  socket.on( 'new_record', function( data ) {

  	function icon(bool)
  	{
  		if(bool == 1)
	  	{
	  		return "<i class='fa fa-circle text-success'></i>";
	  	}
	  	else
	  	{
	  		return "<i class='fa fa-circle text-danger'></i>"
	  	}
  	}

  	
      $( "#record-body" ).prepend('<tr><td>1</td><td>'+data.FirstName+'</td><td>'+data.State+'</td><td>'+data.PhoneNo+'</td><td>'+data.Email+'</td><td>'+data.DateOrdered+'</td><td>'+data.DVD+'</td><td>'+data.Catalog+'</td><td>'+data.Brochure+'</td><td>'+data.Envelope+'</td><td>'+data.Name+'</td><td>'+icon(data.Completed)+'</td><td>'+icon(data.Closed)+'</td></tr>');
  });

</script>

<?php include('footer.php'); ?>