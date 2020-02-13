<?php
	session_start();
	
	$title = "Dashboard";
	$acc_code = "INDEX";
	require "./functions/access.php";
	require_once "./template/header.php";
	require_once "./template/sidebar.php";
?>
<!-- MAIN CONTENT START -->
<div class="content" style="min-height: calc(100vh - 160px);">
	<div class="container-fluid">
	  <div class="row">
	    <div class="col-md-12">
	      WELCOME..
	    </div>
	  </div>              
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
	ini_set('display_errors',0);
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

?>