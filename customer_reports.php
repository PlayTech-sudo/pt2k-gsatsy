<?php
	session_start();
	$title = "Customer Reports";
	$acc_code = "C06";
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
				      <i class="material-icons">list</i>
				    </div>
				    <h4 class="card-title">Inactive Users</h4>
				  </div>
				  <div class="card-body">
				  	<a href="rep1.php?inactive=true" class="btn btn-success">Access List</a>
				  </div>
				</div>
	    </div>
	    <div class="col-md-4">
    		<div class="card">
				  <div class="card-header card-header-success card-header-icon">
				    <div class="card-icon">
				      <i class="material-icons">assignment</i>
				    </div>
				    <h4 class="card-title">Customer Reports</h4>
				  </div>
				  <div class="card-body">
				  	<form name="form2" action="rep1.php" method="POST">
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
					    <input type="hidden" name="cname" value="<?php echo $cname; ?>">
					    <div class="form-group bmd-form-group">
		            <input type="text" name="from" class="form-control datepicker" value="" placeholder="From">
		          </div>
		          <div class="form-group bmd-form-group">
		            <input type="text" name="to" class="form-control datepicker" value="" placeholder="To">
		          </div>  
	            <button type="submit" name="creport" class="btn btn-success">Reports</button>
				  	</form>
				  </div>
				</div>
    	</div>
	  </div>              
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
?>