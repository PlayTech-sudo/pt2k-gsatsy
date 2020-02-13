<?php
	session_start();
	$title = "Definations";
	$acc_code = "A07";
	require "./functions/access.php";
	require_once "./template/header.php";
	require_once "./template/sidebar.php";
	require "functions/dbconn.php";
	require "functions/dbfunc.php";
	require "functions/general.php";	
?>
<!-- MAIN CONTENT START -->
<?php
	if(isset($_POST['ectype'])){
		$id = getsl($conn, "id", "ctype");
		$sql = "INSERT INTO ctype (id, ctype, stock) VALUES ('".$id."','".$_POST['ectype']."','0') ";
		if (mysqli_query($conn, $sql)) {
			header('location:definations.php?msg=1');
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}

	if(isset($_POST['update'])){
		$stock = $_POST['stock'];
		$ctype = $_POST['ctype'];
		$edate = date("Y-m-d");
		$sl = getsl($conn, "id", "stockupdate");
		$sql = "INSERT INTO stockupdate (id, edate, ctype, stock) VALUES('".$sl."','".$edate."','".$ctype."','".$stock."')";
		if (mysqli_query($conn, $sql)) {
			$sql = "UPDATE ctype SET stock = '$stock' WHERE ctype = '$ctype'"; //updating ctype table
			if (mysqli_query($conn, $sql)) {
				$sql = "SELECT * FROM gasdata WHERE ctype = '$ctype' AND edate = (SELECT MAX(edate) FROM gasdata WHERE ctype = '$ctype')";
				$res = mysqli_query($conn, $sql);
				$res = mysqli_fetch_array($res);
				if($res[0]){ //gas is already in table gasdata
					$tstock = $stock + $res['stock'];
					$empty = $stock + $res['empty'];
					$sql = "UPDATE gasdata SET stock = '$tstock', empty = '$empty' WHERE ctype = '$ctype'";
					if (mysqli_query($conn, $sql)) {
						$sql = "UPDATE ctype SET stock = '$tstock' WHERE ctype = '$ctype'"; //updating ctype table
						if (mysqli_query($conn, $sql)) {
							header('location:definations.php?msg=2');
						}
					}
				}else{ // gas is not present in gasdata
					$sl = getsl($conn, "id", "gasdata");
					$sql = "INSERT INTO gasdata (id, edate, ctype, stock, empty, filled, checkin, checkout, damaged, repaired) VALUES('".$sl."','".$edate."','".$ctype."','".$stock."','".$stock."','0','0','0','0','0')";
					if (mysqli_query($conn, $sql)) {
						header('location:definations.php?msg=2');
					}
				}
			}
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
?>
<div class="content" style="min-height: calc(100vh - 160px);">
	<div class="container-fluid">
	  <div class="row">
	    <div class="col-md-6">
	    	<div class="row">
	    		<div class="col-md-12">
	    			<div class="card">
						  <div class="card-header card-header-success card-header-icon">
						    <div class="card-icon">
						      <i class="material-icons">assignment</i>
						    </div>
						    <h4 class="card-title">Add Gas Type</h4>
						  </div>
						  <div class="card-body">
						  	<form name="form1" action="definations.php" method="POST">
								    <div class="form-group">
								        <input type="text" name="ectype" class="form-control usn_input" required="" placeholder="Enter Gas Type" value="" autofocus="autofocus">
								    </div>    
								</form>
						  </div>
						</div>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-12">
	    			<div class="card">
						  <div class="card-header card-header-warning">
						    <h4 class="card-title">Gas Types</h4>
						  </div>
						  <div class="card-body">
						  	<table class="table table-striped table-hover">
						  		<thead>
						  			<th>ID</th>
						  			<th>Gas Type</th>
						  			<th>Stock</th>
						  		</thead>
						  		<tbody>
						  			<?php
						  				$res = getData($conn, "ctype");
						  				while($row = mysqli_fetch_array($res)){
						  					echo "<tr><td>".$row[0]."</td>";
						  					echo "<td>".$row[1]."</td>";
						  					echo "<td>".$row[2]."</td></tr>";
						  				}
						  			?>
						  		</tbody>
						  	</table>
						  </div>
						</div>
	    		</div>
	    	</div>
	    </div>
	    <div class="col-md-6">
	    	<div class="row">
	    		<div class="col-md-6">
	    			<div class="card">
						  <div class="card-header card-header-success card-header-icon">
						    <div class="card-icon">
						      <i class="material-icons">assignment</i>
						    </div>
						    <h4 class="card-title">Update Stock</h4>
						  </div>
						  <div class="card-body">
						  	<form name="form2" action="definations.php" method="POST">
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
							    <div class="form-group">
							      <input type="text" name="stock" class="form-control usn_input" required="" placeholder="Update the stock" value="" autofocus="autofocus">
							    </div>    
							    <input type="submit" class="btn btn-success" name="update" value="Update">
								</form>
						  </div>
						</div>
	    		</div>
	    	</div>
	    </div>	
	  </div>  
	  <?php
			if($_GET['msg']==1){
				echo "<script type='text/javascript'>showNotification('top','right','Gas Type Added', 'success');</script>";
			}
			if($_GET['msg']==2){
				echo "<script type='text/javascript'>showNotification('top','right','Gas Stock Updated', 'info');</script>";
			}
		?>            
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
?>