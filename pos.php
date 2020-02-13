<?php
	session_start();
	$title = "Point of Sale";
	$acc_code = "S03";
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
			  		<form name="form1" action="pos.php" method="POST">
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
				  <div class="card-header card-header-primary card-header-icon">
				    <div class="card-icon">
				      <i class="material-icons">assignment</i>
				    </div>
				    <h4 class="card-title">Add product</h4>
				  </div>
				  <div class="card-body">
				  	<form name="form1" action="pos.php" method="POST">
				  		<div class="form-group">
					      <input type="text" name="qty" class="form-control usn_input" required="" placeholder="Enter Quantity" value="" autofocus="autofocus">
					    </div>
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
		            <button type="submit" name="add" class="btn btn-success">ADD</button>
		            
		        	</form>
		        </div>
		          </div>
		          <form name="form1" action="pos.php" method="POST">
				  	<button type="submit" name="sub" class="btn btn-success">SUBMIT</button>
				  </form>
				  </div>
				  
			<div class="col-md-6">
		      					<div class="card">
								  	<div class="card-header card-header-rose card-header-icon">
								    	<div class="card-icon">
								      		<i class="material-icons">assignment</i>
								    	</div>
								    	<h4 class="card-title">Product List</h4>
								  	</div>
								  	<div class="card-body">
								    	<div class="table-responsive">
								      		<table class="table">
								        		<thead>
								          			<tr>
											            <th>Slno</th>
											            <th>Product</th>
											            <th>Quantity</th>
											            <th>Price</th>
											            <th>GST</th>
											            <th>VAT</th>
											            <th>Total</th>
								          			</tr>
								        		</thead>
								        		<tbody>
								        			<?php
								        			$edate = date("Y-m-d");
								        			
								        			if(isset($_POST['add'])){
								        				$customer = $_SESSION['rcname'];
								        				$qty = $_POST['qty'];
								        				$ctype = $_POST['ctype'];
								        				$res = insertpos($conn,$edate,$customer,$qty,$ctype);
								        				if($res){
								        				$sql = "SELECT * FROM pos WHERE edate='$edate' AND customer='$customer' ";
								        				$res = mysqli_query($conn, $sql);
														
								        				while($row = mysqli_fetch_array($res)){
								        			?>
									          		<tr>
											            <td><?php echo $row[0]; ?></td>
											            <td><?php echo $row[3]; ?></td>
											            <td><?php echo $row[4]; ?></td>
											            <td><?php echo $row[5]; ?></td>
											            <td><?php echo $row[6]; ?></td>
											            <td><?php echo $row[8]; ?></td>
											            <td><?php echo $row[9]; ?></td>
											            
									          		</tr>
									          		<?php
									          	}
									          			
									          			}

									          		}

									          		
									          		?>
								        		</tbody>
								      		</table>
								    	</div>
								  	</div>



								</div>
		      				</div>
		      				
		</div>
		<div class="row">
			
			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
						<tr><th>Grand total:</th>
						<?php
						$customer = $_SESSION['rcname'];
						$edate = date("Y-m-d");
						$gd = 0;
						$sql = "SELECT qtotal FROM pos WHERE edate='$edate' AND customer='$customer' ";
						$res = mysqli_query($conn, $sql);
													
						while($row = mysqli_fetch_array($res)){
							$gd=$gd+$row[0];

						}
						?>
						<td><?php echo $gd;?></td>
						

					</table>

				</div>
			</div>
			<?php
				if(isset($_POST['sub'])){
						$sql1 = "DELETE FROM pos";
						$res = mysqli_query(sql1);
					 }
			?>



			</div>
		<!-- end of row -->
		<?php
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