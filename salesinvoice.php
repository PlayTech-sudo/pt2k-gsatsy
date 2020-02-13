<?php
	session_start();
	$title = "Sales Invoice";
	$acc_code = "S01";
	$table = true;
	require "./functions/access.php";
	require_once "./template/header.php";
	require_once "./template/sidebar.php";
	require "functions/dbconn.php";
	require "functions/dbfunc.php";
	require "functions/general.php";	
?>
<!-- MAIN CONTENT START -->
<?php
	if(isset($_POST['rin'])){
		$cid = $_POST['cid'];
		$res = getDataById($conn, "customer", $cid);
		$cinfo = mysqli_fetch_array($res);
		$_SESSION['rcid'] = $cinfo['id'];
		$_SESSION['rcname'] = $cinfo['name'];
		$_SESSION['rcmob'] = $cinfo['con'];
	}
?>
<div class="content" style="min-height: calc(100vh - 160px);">
	<div class="container-fluid">
		<?php 
			if(!$_SESSION['rcid']){
		?>
		<div class="row">
			<div class="col-md-3 ml-auto mr-auto">
				<div class="card">
				  <div class="card-header card-header-primary card-header-icon">
				    <div class="card-icon">
				      <i class="material-icons">supervised_user_circle</i>
				    </div>
				    <h4 class="card-title">Customer</h4>
				  </div>
				  <div class="card-body"><center>
			  		<form name="form1" action="salesinvoice.php" method="POST">
				  		<div class="row">
				  			<div class="col-md-12">
					  			<div class="form-group">
						        <select class="selectpicker" data-style="select-with-transition" title="Select Customer" data-size="7" tabindex="-98" name="cid" required="">
						        	 <?php
	                      $result = getData($conn, "customer");
	                      while ($row = mysqli_fetch_array($result)) {
	                          $cid = $row['id'];
	                          $cname = $row['name'];
	                          echo "<option value='$cid'>$cname</option>";
	                      }
	                     ?> 
				            </select>
							    </div> 
							  </div>
				  		</div>
				  		<div class="row">
				  			<div class="col-md-12">
				  				<input type="submit" name="rin" value="Proceed" class="btn btn-success">
				  			</div>
				  		</div>
				  	</form></center>
				  </div>
				</div>
			</div>
		</div>
		<?php
			}else{	//if customer is selected 				
		?>
		<div class="row">
					<div class="col-md-3">
						<div class="card">
						  <div class="card-header card-header-info">
						    <h4 class="card-title">Customer Info</h4>
						  </div>
						  <div class="card-body">
						  		<div class="row">
						  			<div class="col-md-12">
						  				<h4>Name: <span><?php echo $_SESSION['rcname']; ?></span></h4>
									  </div>
						  		</div>
						  		<div class="row">
						  			<div class="col-md-12">
						  				<h4>Contact No: <span><?php echo $_SESSION['rcmob']; ?></span></h4>
						  			</div>
						  		</div>
						  </div>
						</div>
					</div>
				</div>
		<div class="row">
			<div class="col-md-12">
	    	<div class="card">
				  <div class="card-header card-header-primary card-header-icon">
				    <div class="card-icon">
				      <i class="material-icons">list</i>
				    </div>
				    <h4 class="card-title">Invoice</h4>
				  </div>
				  <div class="card-body">
				  	<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
			        <thead>
			          <tr>
			            <th>Sl No</th>
			            <th>Gas</th>
			            <th>Quantity</th>
			            <th>Price</th>
			            <th>GST %</th>
			            <th>VAT %</th>
			            <th>Total</th>
			          
			            <!-- <th class="disabled-sorting text-center">Actions</th> -->
			          </tr>
			        </thead>
			        <tbody>
			          <?php
			          	$tdate = date("Y-m-d");
			          	$cname = $_SESSION['rcname'];
			          	echo "<script type='text/javascript'>var printMsg = 'Customer Transaction Receipt  for ".$cname." Date: ".$tdate."';</script>";
			          	$sl = 0;
			          	$cid = $_SESSION['rcid'];
	        				// $res = getSpecificData2($conn, "cdata", "cid", $_SESSION['rcid'], "udate", $tdate);
	        				$sql = "SELECT distinct c.ctype,c.checkin,t.price,t.gst,t.vat,(t.total*c.checkin) as total FROM cdata as c,tax as t WHERE cid = '$cid' AND udate = '$tdate' AND c.ctype=t.gasname";
									$res = mysqli_query($conn, $sql) or die ("Invalid query: " . mysql_error());
	        				while ($info = mysqli_fetch_array($res)) {
	        					$sl++;
	        			?>
		          		<tr>
				            <td><?php echo $sl; ?></td>
				            <td><?php echo $info['ctype']; ?></td>
				            <td><?php echo $info['checkin']; ?></td>
				            <td><?php echo $info['price']; ?></td>
				            <td><?php echo $info['gst']; ?></td>
				            <td><?php echo $info['vat']; ?></td>
				            <td><?php echo $info['total']; ?></td>

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

		            </tr>
		        	</tfoot>
			      </table>
				  </div>
				</div>
	    </div>
			
		</div>
		<!-- end of row -->
		<?php
			} //end of else for checking customer is selected or not
			if($_GET['msg']==1){
				// echo "<script type='text/javascript'>showNotification('top','right','Check In Data Updated', 'success');</script>";
				echo "<script type='text/javascript'>showNotification('top','right','Cannot Check Out. Filled Cylinders are less.', 'danger');</script>";
			}
			if($_GET['msg']==2){
			// echo "<script type='text/javascript'>showNotification('top','right','Cannot Check Out. Filled Cylinders are less.', 'danger');</script>";
			echo "<script type='text/javascript'>showNotification('top','right','Cylinders Checked Out', 'success');</script>";
			}
			if($_GET['msg']==3){
			// echo "<script type='text/javascript'>showNotification('top','right','Entry Already Exist', 'warning');</script>";
			echo "<script type='text/javascript'>showNotification('top','right','Check In Data Updated', 'success');</script>";
			}
			if($_GET['msg']==4){
			echo "<script type='text/javascript'>showNotification('top','right','Entry Deleted', 'success');</script>";
			}
			if($_GET['msg']==5){
			echo "<script type='text/javascript'>showNotification('top','right','Cylinders Checked Out', 'success');</script>";
			}
			if($_GET['msg']==6){
				echo "<script type='text/javascript'>showNotification('top','right','Cylinder is Checked Out', 'danger');</script>";
			}
			if($_GET['msg']==7){
				echo "<script type='text/javascript'>showNotification('top','right','Cylinder is Damaged', 'warning');</script>";
			}
		?>    
		<?php
			if($medal){
		?>
			<script type="text/javascript">
	    	$(window).on('load',function(){
	        $('#myModal').modal('show');
	    	});
			</script>
		<?php
			}
		?>
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
?>