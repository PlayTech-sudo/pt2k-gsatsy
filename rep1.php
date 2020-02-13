<?php
	session_start();
	$title = "Reports";
	$acc_code = "";
	$table = true;
	require "./functions/access.php";
	require_once "./template/header.php";
	require_once "./template/sidebar.php";
	require "functions/dbconn.php";
	require "functions/dbfunc.php";
	require "functions/general.php";	
?>
<!-- MAIN CONTENT START -->
<div class="content" style="min-height: calc(100vh - 160px);">
	<div class="container-fluid">
	  <div class="row">
    	<?php
    	if(isset($_POST['creport'])){
    		if($_POST['cid']){
    			$cid = $_POST['cid'];
    		}else{
    			$cid = $_SESSION['rcid'];
    		}
    		$cname = $_POST['cname'];
    		$from = $_POST['from'];
    		$from = str_replace('/', '-', $from);
    		$from = date("Y-m-d", strtotime($from));
    		$to = $_POST['to'];
    		$to = str_replace('/', '-', $to);
    		$to = date("Y-m-d", strtotime($to));
				$rep = datewiseCustomReport($conn, $cid, $from, $to);
			?>
			<div class="col-md-7 ml-auto mr-auto">
				<div class="card">
				  <div class="card-header card-header-primary card-header-icon">
				    <div class="card-icon">
				      <i class="material-icons">list</i>
				    </div>
				    <h4 class="card-title">Cylinder List</h4>
				  </div>
				  <div class="card-body">
	    			<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
	        <thead>
	          <tr>
	            <th>Date</th>
	            <th>Gas</th>
	            <th>Inward</th>
	            <th>Outward</th>
	            <th>stock</th>
	            <!-- <th class="disabled-sorting text-center">Actions</th> -->
	          </tr>
	        </thead>
	        <tbody>
	          <?php
	          	$tdate = date("Y-m-d");
	          	echo "<script type='text/javascript'>var printMsg = 'Customer Transaction Reports for ".$cname."';</script>";
      				while ($info = mysqli_fetch_array($rep)) {
      			?>
          		<tr>
		            <td><?php echo $info['udate']; ?></td>
		            <td><?php echo $info['ctype']; ?></td>
		            <td><?php echo $info['checkin']; ?></td>
		            <td><?php echo $info['checkout']; ?></td>
		            <td><?php echo $info['stock']; ?></td>

          		</tr>
        		<?php
        			}
        		?>
	        </tbody>
	        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        	</tfoot>
	      		</table>
	      	</div>
	      </div>
	    </div>
	    <!-- End of first report -->
      <?php
    		}elseif($_GET['daily']){
    	?>	
    			<div class="col-md-7 ml-auto mr-auto">
						<div class="card">
						  <div class="card-header card-header-primary card-header-icon">
						    <div class="card-icon">
						      <i class="material-icons">list</i>
						    </div>
						    <h4 class="card-title">Today's Report</h4>
						  </div>
						  <div class="card-body">
			    			<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
					        <thead>
					          <tr>
					            <th>Gas</th>
					            <th>Filled</th>
					            <th>Empty</th>
					            <th>Damaged</th>
					            <th>stock</th>
					            <!-- <th class="disabled-sorting text-center">Actions</th> -->
					          </tr>
					        </thead>
					        <tbody>
					          <?php
					          	$tdate = date("Y-m-d");
					          	echo "<script type='text/javascript'>var printMsg = 'Daily Report for ".$tdate."';</script>";
					          	$sql = "SELECT MAX(edate), ctype FROM gasdata group by ctype";
											$res = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($res)){
												$date = $row[0];
												$gas = $row[1];
												$sql = "SELECT * FROM gasdata WHERE edate = '$date' AND ctype = '$gas'";
												$result = mysqli_query($conn, $sql);
												$rows = mysqli_fetch_array($result);
										?>
													<tr>
								            <td><?php echo $rows['ctype']; ?></td>
								            <td><?php echo $rows['filled']; ?></td>
								            <td><?php echo $rows['empty']; ?></td>
								            <td><?php echo $rows['damaged']; ?></td>
								            <td><?php echo $rows['stock']; ?></td>
								          </tr>
								    <?php
											}
				      			?>
					        </tbody>
					        <tfoot>
				            <tr>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				            </tr>
				        	</tfoot>
			      		</table>
			      	</div>
			      </div>
			    </div>
    	<!-- end of second report -->
    	<?php
    		}elseif($_GET['inactive']){
    	?>
		    	<div class="col-md-9 ml-auto mr-auto">
						<div class="card">
						  <div class="card-header card-header-primary card-header-icon">
						    <div class="card-icon">
						      <i class="material-icons">list</i>
						    </div>
						    <h4 class="card-title">Inactive User List</h4>
						  </div>
						  <div class="card-body">
			    			<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
			        <thead>
			          <tr>
			            <th>Last Date</th>
			            <th>Name</th>
			            <th>Email</th>
			            <th>Mob No</th>
			            <th>Address</th>
			            <!-- <th class="disabled-sorting text-center">Actions</th> -->
			          </tr>
			        </thead>
			        <tbody>
			          <?php
			          	$tdate = date("Y-m-d");
			          	echo "<script type='text/javascript'>var printMsg = 'Inactive User List';</script>";
			          	$sql = "SELECT MAX(udate), cid From cdata where udate < (CURDATE() - INTERVAL 30 DAY ) GROUP BY cid";
									$res = mysqli_query($conn, $sql);
									while($row = mysqli_fetch_array($res)){
										$cid = $row[1];
										$ldate = $row[0];
										$sql = "SELECT * FROM customer WHERE id = '$cid'";
										$result = mysqli_query($conn, $sql);
										$rows = mysqli_fetch_array($result);
								?>
											<tr>
						            <td><?php echo $ldate; ?></td>
						            <td><?php echo $rows['name']; ?></td>
						            <td><?php echo $rows['mail']; ?></td>
						            <td><?php echo $rows['con']; ?></td>
						            <td><?php echo $rows['address']; ?></td>
						          </tr>
						    <?php
									}
		      			?>
			        </tbody>
			        <tfoot>
		            <tr>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		            </tr>
		        	</tfoot>
			      		</table>
			      	</div>
			      </div>
			    </div>
    		<!-- end of third report -->
    	<?php
    		}elseif(isset($_POST['preport'])){
    			$from = $_POST['from'];
		  		$from = str_replace('/', '-', $from);
		  		$from = date("Y-m-d", strtotime($from));
		  		$to = $_POST['to'];
		  		$to = str_replace('/', '-', $to);
		  		$to = date("Y-m-d", strtotime($to));
					$rep = pReport($conn, $from, $to);
    	?>
    			<div class="col-md-7 ml-auto mr-auto">
						<div class="card">
						  <div class="card-header card-header-primary card-header-icon">
						    <div class="card-icon">
						      <i class="material-icons">list</i>
						    </div>
						    <h4 class="card-title">Production Reports</h4>
						  </div>
						  <div class="card-body">
			    			<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
			        <thead>
			          <tr>
			            <th>Date</th>
			            <th>Gas</th>
			            <th>QTY</th>
			            <th>Status</th>
			            <!-- <th class="disabled-sorting text-center">Actions</th> -->
			          </tr>
			        </thead>
			        <tbody>
			          <?php
			          	$tdate = date("Y-m-d");
			          	echo "<script type='text/javascript'>var printMsg = 'Production Reports';</script>";
		      				while ($info = mysqli_fetch_array($rep)) {
		      			?>
		          		<tr>
				            <td><?php echo $info[1]; ?></td>
				            <td><?php echo $info[2]; ?></td>
				            <td><?php echo $info[0]; ?></td>
				            <td>Filled</td>

		          		</tr>
		        		<?php
		        			}
		        		?>
			        </tbody>
			        <tfoot>
		            <tr>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		            </tr>
		        	</tfoot>
			      		</table>
			      	</div>
			      </div>
			    </div>
    	<!-- End of production report -->
    	<?php
    		}elseif(isset($_POST['sreport'])){
    			$from = $_POST['from'];
		  		$from = str_replace('/', '-', $from);
		  		$from = date("Y-m-d", strtotime($from));
		  		$to = $_POST['to'];
		  		$to = str_replace('/', '-', $to);
		  		$to = date("Y-m-d", strtotime($to));
					$rep = sReport($conn, $from, $to);
    	?>
    			<div class="col-md-7 ml-auto mr-auto">
						<div class="card">
						  <div class="card-header card-header-primary card-header-icon">
						    <div class="card-icon">
						      <i class="material-icons">list</i>
						    </div>
						    <h4 class="card-title">Sales Report</h4>
						  </div>
						  <div class="card-body">
			    			<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
			        <thead>
			          <tr>
			            <th>Date</th>
			            <th>Gas</th>
			            <th>Inwaard</th>
			            <th>Outward</th>
			            <!-- <th class="disabled-sorting text-center">Actions</th> -->
			          </tr>
			        </thead>
			        <tbody>
			          <?php
			          	$tdate = date("Y-m-d");
			          	echo "<script type='text/javascript'>var printMsg = 'Transaction Reports';</script>";
		      				while ($info = mysqli_fetch_array($rep)) {
		      			?>
		          		<tr>
				            <td><?php echo $info['edate']; ?></td>
				            <td><?php echo $info['ctype']; ?></td>
				            <td><?php echo $info['checkin']; ?></td>
				            <td><?php echo $info['checkout']; ?></td>
		          		</tr>
		        		<?php
		        			}
		        		?>
			        </tbody>
			        <tfoot>
		            <tr>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		            </tr>
		        	</tfoot>
			      		</table>
			      	</div>
			      </div>
			    </div>
    	<!-- end of sales report -->
    	<?php
    		}elseif(isset($_POST['areport'])){
    			$from = $_POST['from'];
		  		$from = str_replace('/', '-', $from);
		  		$from = date("Y-m-d", strtotime($from));
		  		$to = $_POST['to'];
		  		$to = str_replace('/', '-', $to);
		  		$to = date("Y-m-d", strtotime($to));
					$rep = sReport($conn, $from, $to);
    	?>
    			<div class="col-md-9 ml-auto mr-auto">
						<div class="card">
						  <div class="card-header card-header-primary card-header-icon">
						    <div class="card-icon">
						      <i class="material-icons">list</i>
						    </div>
						    <h4 class="card-title">All In One Report</h4>
						  </div>
						  <div class="card-body">
			    			<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
			        <thead>
			          <tr>
			            <th>Date</th>
			            <th>Gas</th>
			            <th>Filled</th>
			            <th>Empty</th>
			            <th>Inward</th>
			            <th>Outward</th>
			            <th>Damaged</th>
			            <th>Repaired</th>
			            <th>Stock</th>
			            <!-- <th class="disabled-sorting text-center">Actions</th> -->
			          </tr>
			        </thead>
			        <tbody>
			          <?php
			          	$tdate = date("Y-m-d");
			          	echo "<script type='text/javascript'>var printMsg = 'All In One Reports';</script>";
		      				while ($info = mysqli_fetch_array($rep)) {
		      			?>
		          		<tr>
				            <td><?php echo $info['edate']; ?></td>
				            <td><?php echo $info['ctype']; ?></td>
				            <td><?php echo $info['filled']; ?></td>
				            <td><?php echo $info['empty']; ?></td>
				            <td><?php echo $info['checkin']; ?></td>
				            <td><?php echo $info['checkout']; ?></td>
				            <td><?php echo $info['damaged']; ?></td>
				            <td><?php echo $info['repaired']; ?></td>
				            <td><?php echo $info['stock']; ?></td>
		          		</tr>
		        		<?php
		        			}
		        		?>
			        </tbody>
			        <tfoot>
		            <tr>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		            </tr>
		        	</tfoot>
			      		</table>
			      	</div>
			      </div>
			    </div>
    	<!-- ENd of all in one report -->
    	<?php
    		}
    	?>
	  </div>              
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
?>