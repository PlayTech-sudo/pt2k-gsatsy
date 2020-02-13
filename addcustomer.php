<?php
	session_start();
	$title = "Add Customer";
	$acc_code = "C04";
	require "./functions/access.php";
	require_once "./template/header.php";
	require_once "./template/sidebar.php";
	require "functions/dbconn.php";
	require "functions/dbfunc.php";
?>
<!-- MAIN CONTENT START -->
<div class="content" style="min-height: calc(100vh - 160px);">
	<div class="container-fluid">
		<div class="row">
	    <div class="col-lg-3 col-md-3 col-sm-12">
		    <div class="card">
					<div class="card-header card-header-rose card-header-icon">
				  	<div class="card-icon">
				    	<i class="material-icons">add_circle_outline</i>
				    </div>
				    <h4 class="card-title">Add Customer</h4>
					</div>
					<div class="card-body">
						<form method="POST" action="process/operations/operations.php" name="form2" enctype="multipart/form-data">
						  <div class="row">
						  	<div class="col-md-12">
		          		<div class="form-group bmd-form-group">
		            		<label class="bmd-label-floating">Name</label>
		            		<input type="text" class="form-control" name="cname" required="" autofocus="">
		          		</div>
			        	</div>
			        </div>
						  <div class="row">
						  	<div class="col-md-12">
			          		<div class="form-group bmd-form-group">
			            		<label class="bmd-label-floating">Address</label>
			            		<input type="text" class="form-control" name="addr" required="">
			          		</div>
			        	</div>
			        </div>
			        <div class="row">
						  	<div class="col-md-12">
			          		<div class="form-group bmd-form-group">
			            		<label class="bmd-label-floating">Email</label>
			            		<input type="text" class="form-control" name="mail" required="">
			          		</div>
			        	</div>
			        </div>
			        <div class="row">
						  	<div class="col-md-12">
			          		<div class="form-group bmd-form-group">
			            		<label class="bmd-label-floating">Contact No.</label>
			            		<input type="text" class="form-control" name="mob" required="">
			          		</div>
			        	</div>
			        </div>
		     			<button type="submit" name="addCustomer" class="btn btn-success">Submit</button>
		     			<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-12">
				
			</div>
	  </div>              
	</div>
	<?php
		if($_GET['msg']==1){
			echo "<script type='text/javascript'>showNotification('top','right','Customer Added Successfully', 'success');</script>";
		}
	?>             
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
?>