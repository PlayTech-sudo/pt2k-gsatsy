<?php
	function getData($conn, $table){
		$sql = "SELECT * FROM $table";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function insertpos($conn,$edate,$customer,$qty,$ctype){
		$sql1 = "SELECT DISTINCT * FROM tax WHERE gasname='$ctype'";
		$result1 = mysqli_query($conn, $sql1);
		$res = mysqli_fetch_array($result1);
		$p = $res[2];
		$gst = $res[3];
		$vat = $res[4];
		$t = $res[5];
		$qtotal = $qty*$t;
		$sl = getsl($conn, "slno", "pos");
		$sql2 = "INSERT INTO pos (slno,edate, customer, ctype, qty, price,gst,vat,total,qtotal) VALUES('".$sl."','".$edate."','".$customer."','".$ctype."','".$qty."','".$p."','".$gst."','".$vat."','".$t."','".$qtotal."')";
		if (mysqli_query($conn, $sql2)) {
			return true;
		}else{
			return false;
		}
	}

	

	function getDataById($conn, $table, $id){
		$sql = "SELECT * FROM $table where id=$id";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}


	function countData($conn, $count, $table, $where, $value){
		$sql = "SELECT count($count) FROM $table WHERE $where = '$value'";
		$res = mysqli_query($conn, $sql) or die ("Invalid query: " . mysql_error());
    	$result = mysqli_fetch_row($res);
    	return $result;
	}


	function updateStatus($conn, $sl){
		$sql = "UPDATE cylinder SET iostatus = 'Out' WHERE sl = '$sl'";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}else{
			return $result;
		}
	}


 	function getTopFilled($conn){
		$sql = "SELECT * FROM filled ORDER BY id desc LIMIT 7";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}else{
			return $result;
		}
	}

	function getTopstat($conn){
		$sql = "SELECT * FROM stat ORDER BY id desc LIMIT 7";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}else{
			return $result;
		}
	}

	function insertfdr($conn, $edate, $ctype, $qty, $action){
		$sl = getsl($conn, "id", "filled");
		$sql = "INSERT INTO filled (id, edate, ctype, qty, action) VALUES('".$sl."','".$edate."','".$ctype."','".$qty."','".$action."')";
		if (mysqli_query($conn, $sql)) {
			return true;
		}else{
			return false;
		}
	}

	function insertf1dr($conn, $edate,$ctype,$action,$sku){
		$sl = getsl($conn, "id", "stat");
		$sql = "INSERT INTO stat (id, sku, pname, status, edate) VALUES('".$sl."','".$sku."','".$ctype."','".$action."',
		'".$edate."')";
		if (mysqli_query($conn, $sql)) {
			return true;
		}else{
			return false;
		}
	}

	function getfill($conn,$edate,$ctype){
		$sql = "SELECT * FROM filled WHERE ctype = '$ctype' AND edate = '$edate'";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}else{
			return $result;
		}
	}

	

	function insertGasData($conn, $edate, $ctype, $stock, $empty, $filled, $checkin, $checkout, $damaged, $repaired){
		$sl = getsl($conn, "id", "gasdata");
		$sql = "INSERT INTO gasdata (id, edate, ctype, stock, empty, filled, checkin, checkout, damaged, repaired) VALUES('".$sl."','".$edate."','".$ctype."','".$stock."','".$empty."','".$filled."','".$checkin."','".$checkout."','".$damaged."','".$repaired."')";
		if (mysqli_query($conn, $sql)) {
			return true;
		}else{
			return false;
		}
	}

	function makerentry($conn, $cid, $tdate, $gas, $qty, $action){
		$id = getsl($conn,"id", "rentry");
		$sql = "INSERT INTO rentry VALUES('".$id."','".$cid."','".$tdate."','".$gas."','".$qty."','".$action."')";
		if (mysqli_query($conn, $sql)) {
			return true;
		}else{
			return false;
		}
	}

	function insertcdata($conn, $sl, $rcid, $rcname, $ctype, $tdate, $qty, $action){
		if($action == "Out"){
			$sql = "SELECT * FROM gasdata WHERE ctype = '$ctype' AND edate = (SELECT MAX(edate) FROM gasdata WHERE ctype = '$ctype')";
			$res = mysqli_query($conn, $sql);
			$res = mysqli_fetch_array($res);
			if($res['filled']>=$qty){ 
				$sql = "INSERT INTO cdata (id, cid, cname, udate, ctype, checkin, checkout, stock) VALUES ('".$sl."','".$rcid."','".$rcname."','".$tdate."','".$ctype."','0','".$qty."','".$qty."')";
				if (mysqli_query($conn, $sql)) {
					if($res['edate'] < $tdate){ //if date is previous, copy data & update it with current date 
						//in gasdata table
						$checkin = 0;
						$damaged = $res['damaged'];
						$repaired = 0;
						$empty = $res['empty'];
						$stock = $res['stock'] - $qty;
						$filled = $res['filled'] - $qty;
						$checkout = $qty;
						$res3 = insertGasData($conn, $tdate, $ctype, $stock, $empty, $filled, $checkin, $checkout, $damaged, $repaired);
						if($res3) {
							$temp = makerentry($conn, $rcid, $tdate, $ctype, $qty, $action);
							return $msg = 2; //successfull checkout
						}
					}else{//just update it if current date is present
						$stock = $res['stock'] - $qty;
						$filled = $res['filled'] - $qty;
						$checkout = $res['checkout'] + $qty;
						$sql = "UPDATE gasdata SET stock = '$stock', filled = '$filled', checkout = '$checkout' WHERE edate = '$tdate' AND ctype = '$ctype'";
						if (mysqli_query($conn, $sql)) {
							$temp = makerentry($conn, $rcid, $tdate, $ctype, $qty, $action);
							return $msg = 2; //successfull checkout
						}
					}
				}else{
					return false;
				}
			}else{ //filled cylinders are none
				return $msg = 1; //send alert
			}
		}elseif($action == "In"){
			$stock = 0 - $qty;
			$sql = "SELECT * FROM gasdata WHERE ctype = '$ctype' AND edate = (SELECT MAX(edate) FROM gasdata WHERE ctype = '$ctype')";
			$res = mysqli_query($conn, $sql);
			$res = mysqli_fetch_array($res);
			//inserting in cdata
			$sql = "INSERT INTO cdata (id, cid, cname, udate, ctype, checkin, checkout, stock) VALUES ('".$sl."','".$rcid."','".$rcname."','".$tdate."','".$ctype."','".$qty."','0','".$stock."')";
			if (mysqli_query($conn, $sql)) {
				if($res['edate'] < $tdate){ //if date is previous, copy data & update it with current date 
					//in gasdata table
					$checkin = $res['checkin'] + $qty;
					$damaged = $res['damaged'];
					$repaired = 0;
					$empty = $res['empty'] + $qty;
					$stock = $res['stock'] + $qty;
					$filled = $res['filled'];
					$checkout = 0;
					$res3 = insertGasData($conn, $tdate, $ctype, $stock, $empty, $filled, $checkin, $checkout, $damaged, $repaired);
					if($res3) {
						$temp = makerentry($conn, $rcid, $tdate, $ctype, $qty, $action);
						return $msg = 3; //successfull checkin
					}
				}else{//just update it if current date is present
					$checkin = $res['checkin'] + $qty;
					$empty = $res['empty'] + $qty;
					$stock = $res['stock'] + $qty;
					$sql = "UPDATE gasdata SET checkin = '$checkin', empty = '$empty', stock = '$stock' WHERE edate = '$tdate' AND ctype = '$ctype'";
					if (mysqli_query($conn, $sql)) {
						$temp = makerentry($conn, $rcid, $tdate, $ctype, $qty, $action);
						return $msg = 3; //successfull checkin
					}
				}
			}else{
				return false;
			}
		}
	}

	function updatecdata($conn, $sl, $cid, $cname, $ctype, $tdate, $qty, $action, $flag){
		$sql = "SELECT * FROM cdata WHERE cid = '$cid' AND ctype = '$ctype' AND udate = (SELECT MAX(udate) FROM cdata WHERE ctype = '$ctype' AND cid = '$cid')";
		$res1 = mysqli_query($conn, $sql);
		$res1 = mysqli_fetch_array($res1);
		$sql = "SELECT * FROM gasdata WHERE ctype = '$ctype' AND edate = (SELECT MAX(edate) FROM gasdata WHERE ctype = '$ctype')";
		$res = mysqli_query($conn, $sql);
		$res = mysqli_fetch_array($res);
		if($flag == 2){ //today date not present so insert new data
			if($action == "In"){
				$stock = $res1['stock'] - $qty;
				$sql = "INSERT INTO cdata (id, cid, cname, udate, ctype, checkin, checkout, stock) VALUES ('".$sl."','".$cid."','".$cname."','".$tdate."','".$ctype."','".$qty."','0','".$stock."')";
				if (mysqli_query($conn, $sql)) {
					if($res['edate'] < $tdate){ //if date is previous, copy data & update it with current date 
						//in gasdata table
						$checkin = $qty;
						$damaged = $res['damaged'];
						$repaired = 0;
						$empty = $res['empty'] + $qty;
						$stock = $res['stock'] + $qty;
						$filled = $res['filled'];
						$checkout = 0;
						$res3 = insertGasData($conn, $tdate, $ctype, $stock, $empty, $filled, $checkin, $checkout, $damaged, $repaired);
						if($res3) {
							$temp = makerentry($conn, $cid, $tdate, $ctype, $qty, $action);
							return $msg = 3; //successfull checkin
						}
					}else{//just update it if current date is present
						$checkin = $res['checkin'] + $qty;
						$empty = $res['empty'] + $qty;
						$stock = $res['stock'] + $qty;
						$sql = "UPDATE gasdata SET checkin = '$checkin', empty = '$empty', stock = '$stock' WHERE edate = '$tdate' AND ctype = '$ctype'";
						if (mysqli_query($conn, $sql)) {
							$temp = makerentry($conn, $cid, $tdate, $ctype, $qty, $action);
							return $msg = 3; //successfull checkin
						}
					}
				}
			}elseif($action == "Out"){
				$stock = $res1['stock'] + $qty;
				if($res['filled']>=$qty){ 
					$sql = "INSERT INTO cdata (id, cid, cname, udate, ctype, checkin, checkout, stock) VALUES ('".$sl."','".$cid."','".$cname."','".$tdate."','".$ctype."','0','".$qty."','".$stock."')";
					if (mysqli_query($conn, $sql)) {
						if($res['edate'] < $tdate){ //if date is previous, copy data & update it with current date 
							//in gasdata table
							$checkin = 0;
							$damaged = $res['damaged'];
							$repaired = 0;
							$empty = $res['empty'];
							$stock = $res['stock'] - $qty;
							$filled = $res['filled'] - $qty;
							$checkout = $qty;
							$res3 = insertGasData($conn, $tdate, $ctype, $stock, $empty, $filled, $checkin, $checkout, $damaged, $repaired);
							if($res3) {
								$temp = makerentry($conn, $cid, $tdate, $ctype, $qty, $action);
								return $msg = 2; //successfull checkout
							}
						}else{//just update it if current date is present
							$stock = $res['stock'] - $qty;
							$filled = $res['filled'] - $qty;
							$checkout = $res['checkout'] + $qty;
							$sql = "UPDATE gasdata SET stock = '$stock', filled = '$filled', checkout = '$checkout' WHERE edate = '$tdate' AND ctype = '$ctype'";
							if (mysqli_query($conn, $sql)) {
								$temp = makerentry($conn, $cid, $tdate, $ctype, $qty, $action);
								return $msg = 2; //successfull checkout
							}
						}
					}
				}else{
					return $msg = 1; //alert for no filled cylinders
				}
			}
		}elseif($flag == 1){ //today date & gas is present so update current data
			if($action == "Out"){
				if($res['filled']>=$qty){ 
					$stock = $res1['stock'] + $qty;
					$checkout = $res1['checkout'] + $qty;
					$sql = "UPDATE cdata SET checkout = '$checkout', stock = '$stock' WHERE cid = '$cid' AND udate = '$tdate' AND ctype = '$ctype'";
					if (mysqli_query($conn, $sql)) {
						if($res['edate'] < $tdate){ //if date is previous, copy data & update it with current date 
							//in gasdata table
							$checkin = 0;
							$damaged = $res['damaged'];
							$repaired = 0;
							$empty = $res['empty'];
							$stock = $res['stock'] - $qty;
							$filled = $res['filled'] - $qty;
							$checkout = $qty;
							$res3 = insertGasData($conn, $tdate, $ctype, $stock, $empty, $filled, $checkin, $checkout, $damaged, $repaired);
							if($res3) {
								$temp = makerentry($conn, $cid, $tdate, $ctype, $qty, $action);
								return $msg = 2; //successfull checkout
							}
						}else{//just update it if current date is present
							$stock = $res['stock'] - $qty;
							$filled = $res['filled'] - $qty;
							$checkout = $res['checkout'] + $qty;
							$sql = "UPDATE gasdata SET stock = '$stock', filled = '$filled', checkout = '$checkout' WHERE edate = '$tdate' AND ctype = '$ctype'";
							if (mysqli_query($conn, $sql)) {
								$temp = makerentry($conn, $cid, $tdate, $ctype, $qty, $action);
								return $msg = 2; //successfull checkout
							}
						}
					}
				}else{
					return $msg = 1; //alert for no filled cylinders
				}
			}elseif($action == "In"){
				$checkin = $res1['checkin'] + $qty;
				$stock = $res1['stock'] - $qty;
				$sql = "UPDATE cdata SET stock = '$stock', checkin = '$checkin' WHERE cid = '$cid' AND udate = '$tdate' AND ctype = '$ctype'";
				if (mysqli_query($conn, $sql)) {
					if($res['edate'] < $tdate){ //if date is previous, copy data & update it with current date 
						//in gasdata table
						$checkin = $qty;
						$damaged = $res['damaged'];
						$repaired = 0;
						$empty = $res['empty'] + $qty;
						$stock = $res['stock'] + $qty;
						$filled = $res['filled'];
						$checkout = 0;
						$res3 = insertGasData($conn, $tdate, $ctype, $stock, $empty, $filled, $checkin, $checkout, $damaged, $repaired);
						if($res3) {
							$temp = makerentry($conn, $cid, $tdate, $ctype, $qty, $action);
							return $msg = 3; //successfull checkin
						}
					}else{//just update it if current date is present
						$checkin = $res['checkin'] + $qty;
						$empty = $res['empty'] + $qty;
						$stock = $res['stock'] + $qty;
						$sql = "UPDATE gasdata SET checkin = '$checkin', empty = '$empty', stock = '$stock' WHERE edate = '$tdate' AND ctype = '$ctype'";
						if (mysqli_query($conn, $sql)) {
							$temp = makerentry($conn, $cid, $tdate, $ctype, $qty, $action);
							return $msg = 3; //successfull checkin
						}
					}
				}
			}
		}
	}

	function getCStock($conn, $cid){
		$stock = 0;
		$sql = "SELECT MAX(udate), ctype FROM cdata WHERE cid = '$cid' group by ctype";
		$res = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($res)){
			$date = $row[0];
			$gas = $row[1];
			$sql = "SELECT stock FROM cdata WHERE cid = '$cid' AND udate = '$date' AND ctype = '$gas'";
			$result = mysqli_query($conn, $sql);
			$rows = mysqli_fetch_array($result);
			$stock = $stock + $rows[0];
		}
		return $stock;
	}


	function datewiseCustomReport($conn, $cid, $from, $to){
		$sql = "SELECT * FROM cdata WHERE cid = '$cid' AND udate BETWEEN '$from' AND '$to' order by udate asc";
		$res = mysqli_query($conn, $sql) or die ("Invalid query: " . mysql_error());
    return $res;
	}

	function pReport($conn, $from, $to){
		$sql = "SELECT SUM(qty), edate, ctype from filled where action = 'Filled' AND edate between '$from' AND '$to' group by edate, ctype";
		$res = mysqli_query($conn, $sql) or die ("Invalid query: " . mysql_error());
    return $res;

	}

	function sReport($conn, $from, $to){
		$sql = "SELECT * FROM gasdata WHERE edate between '$from' AND '$to'";
		$res = mysqli_query($conn, $sql) or die ("Invalid query: " . mysql_error());
    return $res;

	}

?>