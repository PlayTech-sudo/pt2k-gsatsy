<?php
	session_start();
	$title = "Administration";
	$acc_code = "A01";
	require "./functions/access.php";
	require_once "./template/header.php";
	require_once "./template/sidebar.php";
?>
<!-- MAIN CONTENT START -->
<div class="content" style="min-height: calc(100vh - 160px);">
	<div class="container-fluid">
	  <div class="row">
	    <div class="col-md-12">

	    </div>
	  </div>              
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
?>SSS