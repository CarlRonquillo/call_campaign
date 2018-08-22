<?php include('header.php'); ?>

<style>
	table th {
	  font-size: 1.8rem;
	}

	table td {
	  font-size: 1.8rem;
	}
</style>

	<div class="container" style="width: 50rem;"><br>
		<h2 id="text" class="mb-0">Summary</h2><br>
		<?php echo form_open("report/summary_search",['class' => 'form-inline justify-content-md-center','method' => 'post','id' => 'frm_SumSearch']); ?>
			<div class="row align-items-center">
				<div class="col-xs-3 md-form form-group">
					<i class="fa fa-calendar prefix"></i>
					<input type="text" name ="dateFrom" id="date1" class="date form-control floating-label" placeholder="From" value="<?php echo $searched_from; ?>">
					<label for="date1" class="">Date range</label>
				</div>
				<div class="col-xs-3 md-form form-group">
					<i class="fa fa-calendar prefix"></i>
					<input type="text" name ="dateTo" id="date2" class="date form-control floating-label" placeholder="To" value="<?php echo $searched_to; ?>">
				</div>
				<div class="col-xs-4 md-form form-group">
					<button type="submit" class="btn btn-default">Search</button>
				</div>
			</div>
		<?php echo form_close(); ?>
		<div class="row">
		    <table class="table table-sm table-hover table-striped" >
				<thead class="bg-default">
					<tr class="text-white">
				    	<th>#</th>
				    	<th>Name</th>
				     	<!--<th>DVD</th>
				    	<th>Catalog</th>-->
				    	<th>Brochure</th>
				    	<th>Envelope</th>
				    	<th>Completed</th>
				    	<th>Closed</th>
				    </tr>
				</thead>
				<tbody id="record-body">
				    <tr>
				    	<?php 	$count = 1;
				    			$sumBrochure = 0;
				    			$sumEnvelope = 0;
				    			$sumCompleted = 0;
				    			$sumClosed = 0;
				    		if(count($records)): ?>
	  					<?php foreach($records as $record) {
	  							$sumBrochure += $record->BrochureCount;
	  							$sumEnvelope += $record->EnvelopeCount;
	  							$sumCompleted += $record->CompletedCount;
	  							$sumClosed += $record->ClosedCount;
	  						 ?>
			    			<tr>
				    			<th scope="row"><?php echo $count++; ?></th>
			    				<td><?php echo $record->Name; ?></td>
			    				<!--<td><?php echo $record->DVDCount; ?></td>
			    				<td><?php echo $record->CatalogCount; ?></td>-->
			    				<td><?php echo $record->BrochureCount; ?></td>
			    				<td><?php echo $record->EnvelopeCount; ?></td>
			    				<td><?php echo $record->CompletedCount; ?></td>
			    				<td><?php echo $record->ClosedCount; ?></td>
			    			<tr>
				    		<?php } else: ?>
								<tr>No Records Found!</tr>
							<?php endif; ?>
				    </tr>
				</tbody>
				<tfoot class="table-warning">
				    <tr>
				    	<td></td>
				    	<td></td>
				    	<td><?php echo $sumBrochure; ?></td>
				    	<td><?php echo $sumEnvelope; ?></td>
				    	<td><?php echo $sumCompleted; ?></td>
				    	<td><?php echo $sumClosed; ?></td>
				    </tr>
			  	</tfoot>
			</table>
				<?php echo anchor("","<i class='fa fa-home'></i> back to Home",["class" => "grey-text"]); ?>
		</div>
	</div>

<?php include('footer.php');
$dateTime = date('Y-m-d H:i:s'); ?>

<script type="text/javascript">
$(document).ready(function()
{
	var isiPad = navigator.userAgent.match(/iPad/i) != null;

	if(isiPad)
	{
		setInterval(function() {
			location.reload();
		}, 300000);
	}
	/*else
	{
		var lastcheck = "<?php echo $dateTime ?>"; 
		setInterval(function() {
			$.getJSON("<?php echo base_url('index.php/report/get_latestSummary?lastcheck=');?>" + "'" + lastcheck + "'" , function(result){
				//alert(result.records[0].Name);
	        });
		}, 10000);
	}*/

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