<?php
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kuala_Lumpur');

$date	= date('d-m-Y H:iA');
$conn 	= mysqli_connect('localhost', 'root', '', 'rkdb') or die('Connection failed: ' . $conn->connect_error);

if (isset($_POST['action'])) {

	if ($_POST['action'] == 'login') {

		$email = $_POST['email'];
		$password = md5($_POST['password']);

		$query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
		$result = mysqli_query($conn, $query);

		if ($result)
			echo json_encode(mysqli_fetch_assoc($result));
		else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'create') {
		if (
			(!empty($_POST['email'])) &&
			(!empty($_POST['password']))
		) {

			$email 		= $_POST['email'];
			$password 	= md5($_POST['password']);

			$query = "INSERT INTO user(role, email, password, datetime) VALUES('1','$email','$password','$date')";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				// auto login
				$query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
				$result = mysqli_query($conn, $query);

				if ($result)
					echo json_encode(mysqli_fetch_assoc($result));
				else
					echo json_encode('false');
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'update') {
		// check for empty form fields
		if (
			(!empty($_POST['email']))
		) {
			$email 		= $_POST['email'];
			$uid 		= $_POST['uid'];

			$query 	= "UPDATE user SET email = '$email' WHERE id = '$uid'";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				$query = "SELECT * FROM user WHERE id = '$uid'";
				echo json_encode(mysqli_fetch_row(mysqli_query($conn, $query)));
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'password') {
		// check for empty form fields
		if (
			(!empty($_POST['password']))
		) {

			$password 	= md5($_POST['password']);
			$uid 		= $_POST['uid'];

			$query 	= "UPDATE user SET password = '$password' WHERE id = '$uid'";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				$query = "SELECT * FROM user WHERE id = '$uid'";
				echo json_encode(mysqli_fetch_row(mysqli_query($conn, $query)));
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'get-driver') {
		$query = "SELECT * FROM driver JOIN user ON user.id = driver.user_id JOIN bus ON bus.id = driver.bus_id";
		$result = mysqli_query($conn, $query) or die($query);

		if ($result) {
			echo json_encode(mysqli_fetch_all($result));
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'create-driver') {
		if (
			(!empty($_POST['bus'])) &&
			(!empty($_POST['email']))
		) {
			$bus = $_POST['bus'];
			$email = $_POST['email'];

			$temp = explode('@', $email);
			$password = md5($temp[0] . '@rapid');

			$query = "INSERT INTO user(role, email, password, datetime) VALUES('2','$email','$password','$date')";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				$user_id = $conn->insert_id;
				$query = "INSERT INTO driver(user_id, bus_id, status) VALUES('$user_id','$bus','Active')";
				$result = mysqli_query($conn, $query) or die($query);

				if ($result)
					echo json_encode('true');
				else
					echo json_encode('false');
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'delete-driver') {
		if (
			(!empty($_POST['driverid']))
		) {

			$driverid = $_POST['driverid'];

			$query = "DELETE FROM user WHERE id = '$driverid'";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				echo json_encode('true');
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'get-bus') {
		$query = "SELECT * FROM bus";
		$result = mysqli_query($conn, $query) or die($query);

		if ($result) {
			echo json_encode(mysqli_fetch_all($result));
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'create-bus') {
		if (
			(!empty($_POST['bus'])) &&
			(!empty($_POST['route_to'])) &&
			(!empty($_POST['route_from']))
		) {

			$bus = $_POST['bus'];
			$route_to = $_POST['route_to'];
			$route_from = $_POST['route_from'];

			$route = $_POST['route_from'] . ' - ' . $_POST['route_to'];

			$query = "INSERT INTO bus(bus_no, route, status) VALUES('$bus','$route','Active')";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				echo json_encode('true');
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'delete-bus') {
		if (
			(!empty($_POST['busid']))
		) {

			$busid = $_POST['busid'];

			$query = "DELETE FROM bus WHERE id = '$busid'";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				echo json_encode('true');
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'get-today-route') {
		if (
			(!empty($_POST['uid']))
		) {
			$uid = $_POST['uid'];
			$date_today = date('d-m-Y');

			$query = "SELECT * FROM route WHERE date = '$date_today' AND user_id = '$uid'";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				echo json_encode(mysqli_fetch_assoc($result));
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'get-bus-detail') {
		if (
			!empty($_POST['uid'])
		) {
			$uid = $_POST['uid'];

			$query = "SELECT * FROM driver JOIN bus ON bus.id = driver.bus_id WHERE driver.user_id = '$uid'";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				echo json_encode(mysqli_fetch_assoc($result));
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'add-route') {
		if (
			!empty($_POST['route_perday']) &&
			!empty($_POST['current_location']) &&
			!empty($_POST['next_location']) &&
			!empty($_POST['arrival_time']) &&
			!empty($_POST['status']) &&
			!empty($_POST['bid']) &&
			!empty($_POST['uid'])
		) {
			$route_perday = $_POST['route_perday'];
			$current_location = $_POST['current_location'];
			$next_location = $_POST['next_location'];
			$arrival_time = $_POST['arrival_time'];
			$status = $_POST['status'];
			$bid = $_POST['bid'];
			$uid = $_POST['uid'];
			$date_today = date('d-m-Y');
			$time_today = date('H:i A');

			$query = "INSERT INTO route(bus_id, user_id, arrival_time, current_location, next_location, route_perday, date, time, status) VALUES('$bid','$uid','$arrival_time','$current_location','$next_location','$route_perday','$date_today','$time_today','$status')";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				echo json_encode('true');
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'get-all-route') {
		if (
			!empty($_POST['uid'])
		) {
			$uid = $_POST['uid'];
			$date_today = date('d-m-Y');

			$query = "SELECT * FROM route JOIN bus ON bus.id = route.bus_id WHERE route.user_id = '$uid' AND date != '$date_today'";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				echo json_encode(mysqli_fetch_assoc($result));
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'get-route-detail') {
		if (
			!empty($_POST['rid'])
		) {
			$rid = $_POST['rid'];

			$query = "SELECT * FROM route WHERE id = '$rid'";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				echo json_encode(mysqli_fetch_assoc($result));
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'update-route') {
		if (
			!empty($_POST['route_perday']) &&
			!empty($_POST['current_location']) &&
			!empty($_POST['next_location']) &&
			!empty($_POST['arrival_time']) &&
			!empty($_POST['status']) &&
			!empty($_POST['bid']) &&
			!empty($_POST['uid']) &&
			!empty($_POST['rid'])
		) {
			$route_perday = $_POST['route_perday'];
			$current_location = $_POST['current_location'];
			$next_location = $_POST['next_location'];
			$arrival_time = $_POST['arrival_time'];
			$status = $_POST['status'];
			$bid = $_POST['bid'];
			$uid = $_POST['uid'];
			$rid = $_POST['rid'];
			$date_today = date('d-m-Y');
			$time_today = date('H:i A');

			$query = "UPDATE route SET route_perday = '$route_perday', current_location = '$current_location', next_location = '$next_location', arrival_time = '$arrival_time', status = '$status', bus_id = '$bid', user_id = '$uid', date = '$date_today', time = '$time_today' WHERE id = '$rid'";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				echo json_encode('true');
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'get-route') {
		$date_today = date('d-m-Y');

		$query = "SELECT * FROM route JOIN bus ON bus.id = route.bus_id WHERE route.date = '$date_today'";
		$result = mysqli_query($conn, $query) or die($query);

		if ($result) {
			echo json_encode(mysqli_fetch_all($result));
		} else
			echo json_encode('false');
	}

	if ($_POST['action'] == 'get-bus-route') {
		if (
			!empty($_POST['busid'])
		) {
			$busid = $_POST['busid'];
			$date_today = date('d-m-Y');
			
			$query = "SELECT * FROM route JOIN bus ON bus.id = route.bus_id WHERE route.bus_id = '$busid' AND date = '$date_today'";
			$result = mysqli_query($conn, $query) or die($query);

			if ($result) {
				echo json_encode(mysqli_fetch_all($result));
			} else
				echo json_encode('false');
		} else
			echo json_encode('false');
	}

	// check existing email
	if ($_POST['action'] == 'check-email') {

		$email = $_POST['email'];

		$query = "SELECT id from user WHERE email = '$email'";
		$result = mysqli_query($conn, $query);

		if (
			$result &&
			mysqli_num_rows($result) > 0
		)
			echo json_encode(mysqli_fetch_assoc($result));
		else
			echo json_encode('false');
	}

	// check existing bus
	if ($_POST['action'] == 'check-bus') {

		$bus = $_POST['bus'];

		$query = "SELECT id from bus WHERE bus_no = '$bus'";
		$result = mysqli_query($conn, $query);

		if (
			$result &&
			mysqli_num_rows($result) > 0
		)
			echo json_encode(mysqli_fetch_assoc($result));
		else
			echo json_encode('false');
	}
} else {
	echo json_encode('false');
}
