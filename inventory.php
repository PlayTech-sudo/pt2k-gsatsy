<?php
	session_start();
	$title = "Inventory";
	$acc_code = "I01";
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
	    <div class="col-md-3">
	    	<div class="card">
				  <div class="card-header card-header-primary card-header-icon">
				    <div class="card-icon">
				      <i class="material-icons">assignment</i>
				    </div>
				    <h4 class="card-title">Enter Data</h4>
				  </div>
				  <div class="card-body">
				  	<form name="form1" action="inventory.php" method="POST">
					    <div class="form-group">
				        <select class="selectpicker" data-style="select-with-transition" title="Select Gas" data-size="7" tabindex="-98" name="ctype" required="">
				        	 <?php
                    $result = getData($conn, "ctype");
                    while ($row = mysqli_fetch_array($result)) {
                        $ctype = $row['ctype'];
                        echo "<option value='$ctype'>$ctype</option>";
                    }
                   ?> 
		            </select>
					    </div> 
					    <button type="submit" name="fill" class="btn btn-success">Submit</button>
					    </form>  
				  </div>
				</div>
			</div>
			<div class="col-md-6">
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
			            <th>Gas</th>
			            <th>Filled</th>
			            <th>Damaged</th>
			            <th>Repaired</th>
			          
			            <!-- <th class="disabled-sorting text-center">Actions</th> -->
			          </tr>
			        </thead>
			        <tbody>
			          <?php
			          if(isset($_POST['fill'])){
			          	$edate = date("Y-m-d");
			          	$ctype = $_POST['ctype'];
			          	$re = getfill($conn,$edate,$ctype);
			          	$cf = 0;
			          	$cd = 0;
			          	$cr = 0;
			          	
			          	echo "<tr><td>".$ctype."</td>";
			          	
			          	while($row1 = mysqli_fetch_array($re)){
			          		if($row1['4']=="Filled")
			          		{
			          			$cf = $cf+$row1[3];
			          		}
			          		else if($row1['4']=="Damaged")
			          		{
			          			$cd = $cd+$row1[3];
			          		}
			          		else if($row1['4']=="Repaired")
			          		{
			          			$cr = $cr+$row1[3];
			          		}
						
			          	}
			          	echo "<td>".$cf."</td>";
			          	echo "<td>".$cd."</td>";
			          	echo "<td>".$cr."</td></tr>";
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
			
		</div>
		<!-- end of row -->
		<?php
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