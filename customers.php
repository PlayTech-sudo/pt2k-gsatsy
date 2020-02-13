<?php
	session_start();
	$title = "Customers";
	$acc_code = "C05";
	$table = true;
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
			<div class="col-md-12">
				<div class="col-md-12">
		    	<div class="card">
					  <div class="card-header card-header-primary card-header-icon">
					    <div class="card-icon">
					      <i class="material-icons">assignment</i>
					    </div>
					    <h4 class="card-title">Customers</h4>
					  </div>
					  <div class="card-body">
					    <div class="toolbar">
					      <!--        Here you can write extra buttons/actions for the toolbar              -->
					    </div>
					    <div class="material-datatables">
					      <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
					        <thead>
					          <tr>
					            <th>Sl No</th>
					            <th>Name</th>
					            <th>Address</th>
					            <th>E-Mail</th>
					            <th>Contact No.</th>
					            <!-- <th class="disabled-sorting text-center">Actions</th> -->
					          </tr>
					        </thead>
					        <tbody>
					          <?php
			        				$res = getData($conn,"customer");
			        				echo "<script type='text/javascript'>var printMsg = 'Customer List';</script>";
			        				$sl = 0;
			        				foreach ($res as $info) {
			        			?>
				          		<tr>
						            <td><?php echo ++$sl; ?></td>
						            <td><?php echo $info['name']; ?></td>
						            <td><?php echo $info['address']; ?></td>
						            <td><?php echo $info['mail']; ?></td>
						            <td><?php echo $info['con']; ?></td>
						            <!-- <td class="text-center td-actions">
							            <a rel="tooltip" href="edit_user.php?edituser=<?php echo $info['id']; ?>" class="btn btn-success btn-link" title="Edit">
							              <i class="material-icons">edit</i>
							            </a>
							            <a rel="tooltip" href="process/admin/usr_process.php?deluser=<?php echo $info['id']; ?>" class="btn btn-danger btn-link" title="Delete">
							              <i class="material-icons">close</i>
							            </a>
						            </td> -->
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
		    </div>
			</div>
	  </div>              
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
?>