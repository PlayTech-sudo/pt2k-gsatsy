<?php
	session_start();
	$title = "Cylinder Status based on SKU";
	$acc_code = "M01";
	require "./functions/access.php";
	require_once "./template/header.php";
	require_once "./template/sidebar.php";
	require "functions/dbconn.php";
	require "functions/dbfunc.php";
	require "functions/general.php";
?>
<!-- MAIN CONTENT START -->
<?php
$edate = date("Y-m-d");
if(isset($_POST['fill'])){
	$sku = $_POST['sku'];
	//rentry and gasdata to be updated
	$sql = "SELECT gd.* FROM gasdata as gd LEFT JOIN product as p ON (p.sku = gd.sku) WHERE p.sku = '$sku' AND edate = (SELECT MAX(edate) FROM gasdata )";
	$res = mysqli_query($conn, $sql);
	$res = mysqli_fetch_array($res);
	$ct = "SELECT * FROM product as p WHERE p.sku = '$sku'";
	$r = mysqli_query($conn, $ct);
	$ctype = mysqli_fetch_array($r);
	if($ctype['5']=='in')
	{
		if($ctype['4']=='Empty'||$ctype['4']=='Repaired')
		{
			$sql = "UPDATE product SET status='Filled'";
			$res = mysqli_query($conn,$sql);
			if($res['empty']>=$qty){
		$empty = $res['empty'] - $qty;
		$filled = $res['filled'] + $qty;
		
		$res2 = insertf1dr($conn, $edate, $ctype[1],"Filled",$sku);
		if($res2){
			if($res['edate'] < $edate){ //if date is previous, copy data & update it with current date
				$stock = $res['stock'];
				$checkin = 0;
				$checkout = 0;
				$damaged = $res['damaged'];
				$repaired = 0;
				$res3 = insertGasData($conn, $edate, $ctype[1], $stock, $empty, $filled, $checkin, $checkout, $damaged, $repaired);
				if($res3) {
					echo "<script type='text/javascript'>showNotification('top','right','Cylindera are Filled', 'success');</script>";
				}
			}else{//just update it if current date is present
				$sql = "UPDATE gasdata SET empty = '$empty', filled = '$filled' WHERE edate = '$edate' AND ctype = '$ctype[1]'";
				if (mysqli_query($conn, $sql)) {
					echo "<script type='text/javascript'>showNotification('top','right','Cylinders are Filled', 'success');</script>";
				}
			}
		}
	}else{
		echo "<script type='text/javascript'>showNotification('top','right','There are enough empty cylinders.', 'warning');</script>";
	}

		}
		else if($ctype['4']=="Damaged")
		{
			echo "<script type='text/javascript'>showNotification('top','right','Cylinder is damaged. Repaire it', 'warning');</script>";

		}
		else if($ctype['4']=="Filled")
		{
			echo "<script type='text/javascript'>showNotification('top','right','Cylinder is already filled', 'warning');</script>";

		}


	}
	else
	{
		echo "<script type='text/javascript'>showNotification('top','right','Cylinder is out', 'warning');</script>";

	}
	
}

if(isset($_POST['damage'])){
	$sku= $_POST['sku'];
	//rentry and gasdata to be updated
	$sql = "SELECT gd.* FROM gasdata as gd LEFT JOIN product as p ON (p.sku = gd.sku) WHERE p.sku = '$sku' AND edate = (SELECT MAX(edate) FROM gasdata )";
	$res = mysqli_query($conn, $sql);
	$res = mysqli_fetch_array($res);
	$ct = "SELECT * FROM product as p WHERE p.sku = '$sku'";
	$r = mysqli_query($conn, $ct);
	$ctype = mysqli_fetch_array($r);
	if($ctype['5']=='in')
	{
		if($ctype['4']=='Empty')
		{
	if($res['empty']>=$qty){
		$empty = $res['empty'] - $qty;
		$damaged = $res['damaged'] + $qty;
		$res2 = insertf1dr($conn, $edate, $ctype[1],"Damaged",$sku);
		if($res['edate'] < $edate){ //if date is previous, copy data & update it with current date
			$stock = $res['stock'];
			$checkin = 0;
			$checkout = 0;
			$filled = $res['filled'];
			$repaired = 0;
			$res3 = insertGasData($conn, $edate, $ctype[1], $stock, $empty, $filled, $checkin, $checkout, $damaged, $repaired);
			if($res) {
				echo "<script type='text/javascript'>showNotification('top','right','Cylinders Added to Damage section', 'info');</script>";
			}
		}else{//just update it if current date is present
			$sql = "UPDATE gasdata SET empty = '$empty', damaged = '$damaged' WHERE edate = '$edate' AND ctype = '$ctype[1]'";
			if (mysqli_query($conn, $sql)) {
				echo "<script type='text/javascript'>showNotification('top','right','Cylinder Added to Damage section', 'info');</script>";
			}
		}
	}else{
		echo "<script type='text/javascript'>showNotification('top','right','There are enough empty cylinders.', 'warning');</script>";
	}
	}
	else if($ctype['4']=='Filled')
	{
		echo "<script type='text/javascript'>showNotification('top','right','Cylinder is filled', 'warning');</script>";
	}
	else if($ctype['4']=='Repaired')
	{
		echo "<script type='text/javascript'>showNotification('top','right','Cylinder is repaired', 'warning');</script>";
	}
}
else
{
	echo "<script type='text/javascript'>showNotification('top','right','Cylinder is out', 'warning');</script>";
}

}

if(isset($_POST['repair'])){
	$ctype = $_POST['ctype'];
	$sku = $_POST['sku'];
	//rentry and gasdata to be updated
	$sql = "SELECT gd.* FROM gasdata as gd LEFT JOIN product as p ON (p.sku = gd.sku) WHERE p.sku = '$sku' AND edate = (SELECT MAX(edate) FROM gasdata )";
	$res = mysqli_query($conn, $sql);
	$res = mysqli_fetch_array($res);
	$ct = "SELECT * FROM product as p WHERE p.sku = '$sku'";
	$r = mysqli_query($conn, $ct);
	$ctype = mysqli_fetch_array($r);
	if($ctype['5']=='in')
	{
		if($ctype['4']=='Damaged')
		{
	if($res['damaged']>=$qty){
		$damaged = $res['damaged'] - $qty;
		$repaired = $res['repaired'] + $qty;
		$empty = $res['empty'] + $qty;
		$res2 = insertf1dr($conn, $edate, $ctype[1],"Repaired",$sku);
		if($res['edate'] < $edate){ //if date is previous, copy data & update it with current date
			$stock = $res['stock'];
			$checkin = 0;
			$checkout = 0;
			$filled = $res['filled'];
			$res3 = insertGasData($conn, $edate, $ctype[1], $stock, $empty, $filled, $checkin, $checkout, $damaged, $repaired);
			if($res) {
				echo "<script type='text/javascript'>showNotification('top','right','Cylinders Added to Repaired section', 'info');</script>";
			}
		}else{//just update it if current date is present
			$sql = "UPDATE gasdata SET empty = '$empty', damaged = '$damaged', repaired = '$repaired' WHERE edate = '$edate' AND ctype = '$ctype[1]' AND sku='$sku'";
			if (mysqli_query($conn, $sql)) {
				echo "<script type='text/javascript'>showNotification('top','right','Cylinders Added to Repaired section', 'info');</script>";
			}
		}
	}else{
		echo "<script type='text/javascript'>showNotification('top','right','There are no damaged cylinders.', 'warning');</script>";
	}
}
else if($ctype['4']=='Filled')
	{
		echo "<script type='text/javascript'>showNotification('top','right','Cylinder is filled', 'warning');</script>";
	}
	else if($ctype['4']=='Repaired')
	{
		echo "<script type='text/javascript'>showNotification('top','right','Cylinder is already repaired', 'warning');</script>";
	}
}
else
{
	echo "<script type='text/javascript'>showNotification('top','right','Cylinder is out', 'warning');</script>";

}
}
	


?>
<div class="content" style="min-height: calc(100vh - 160px);">
	<div class="container-fluid">
	  <div class="row">
	  	<div class="col-md-6">
	  		<div class="row">
			  	<div class="col-md-5">
			    	<div class="card">
						  <div class="card-header card-header-success">
						    <h4 class="card-title">Filled Cylinder Entry</h4>
						  </div>
						  <div class="card-body">
						  	<form name="form1" action="manufacture.php" method="POST">
							    <div class="form-group">
							        <input type="text" name="sku" class="form-control usn_input" required="" placeholder="SKU" value="" autofocus="autofocus">
							    </div>  
							    <button type="submit" name="fill" class="btn btn-success">Submit</button> 
								</form>
						  </div>
						</div>
			    </div>
					<div class="col-md-5">
						<div class="card">
						  <div class="card-header card-header-warning">
						    <h4 class="card-title">Damaged Cylinder Entry</h4>
						  </div>
						  <div class="card-body">
						  	<form name="form1" action="manufacture.php" method="POST">
							    <div class="form-group">
							        <input type="text" name="sku" class="form-control usn_input" required="" placeholder="SKU" value="" autofocus="autofocus">
							    </div> 
							    <button type="submit" name="damage" class="btn btn-warning">Submit</button>
								</form>
						  </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<div class="card">
						  <div class="card-header card-header-success">
						    <h4 class="card-title">Repaired Cylinder Entry</h4>
						  </div>
						  <div class="card-body">
						  	<form name="form3" action="manufacture.php" method="POST">
							    <div class="form-group">
							        <input type="text" name="sku" class="form-control usn_input" required="" placeholder="SKU" value="" autofocus="autofocus">
							    </div> 
							    <button type="submit" name="repair" class="btn btn-success">Submit</button>
								</form>
						  </div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
				  <div class="card-header card-header-info">
				    <h4 class="card-title">Recent Activities</h4>
				  </div>
				  <div class="card-body">
				  	<table class="table table-striped table-hover">
				  		<thead>
				  			<th>Date</th>
				  			<th>Gas</th>
				  			<th>SKU</th>
				  			<th>Status</th>
				  			
				  		</thead>
				  		<tbody>
				  			<?php
				  				$res = getTopstat($conn);
				  				while($row = mysqli_fetch_array($res)){
				  					echo "<tr><td>".$row[4]."</td>";
				  					echo "<td>".$row[2]."</td>";
				  					echo "<td>".$row[1]."</td>";
				  					if($row['3']=="Filled"){
				  					echo "<td class='bootstrap-tagsinput success-badge'><span class='tag badge'>".$row[3]."</span></td></tr>";
				  					}elseif($row['3']=="Damaged"){
				  						echo "<td class='bootstrap-tagsinput warning-badge'><span class='tag badge'>".$row[3]."</span></td></tr>";
				  					}elseif($row['3']=="Repaired"){
				  						echo "<td class='bootstrap-tagsinput info-badge'><span class='tag badge'>".$row[3]."</span></td></tr>";
				  					}
				  				}

				  			?>
				  		</tbody>
				  	</table>
				  </div>
				</div>
			</div>
	  </div>   
	  <?php
	  	if($_GET['msg']==1){
				echo "<script type='text/javascript'>showNotification('top','right','Cylindera are Filled', 'success');</script>";
			}
			if($_GET['msg']==2){
				echo "<script type='text/javascript'>showNotification('top','right','Cylinder Added to Damage List', 'info');</script>";
			}
			if($_GET['msg']==3){
				echo "<script type='text/javascript'>showNotification('top','right','Cylinder is Repaired', 'success');</script>";
			}

	  ?>           
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
?>