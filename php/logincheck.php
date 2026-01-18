<?PHP

	require_once("inc_config.php");

	if(isset($_SESSION['user']) && $_SESSION['user']['login']==true){header("location:index.php");}

	if($_SERVER["REQUEST_METHOD"] != "POST"){header("Location:logout.php"); exit;}

	$username	= p('username');
	$password	= p('password');

	if($username == '' || $username == null || $password == '' || $password == null){
		$_SESSION['alert']['warning'] = 'BİLGİLER EKSİK!';
		header("Location:login.php");
		exit;
	}

	$user = mysqli_fetch_assoc($mysqli->query("select * from cashier where username='$username'"));
	if(!$user){
		$_SESSION['alert']['warning'] = 'KULLANICI ADI VEYA PAROLA HATALI !1';
		header("Location:login.php");
		exit;
	}

	if($user['password']!==$password){
		$_SESSION['alert']['warning'] = 'KULLANICI ADI VEYA PAROLA HATALI !2';
		header("Location:login.php");
		exit;
	}

	if(!$user['status']){
		$_SESSION['alert']['warning'] = 'KULLANICI AKTİF DEĞİL!';
		header("Location:login.php");
		exit;
	}

	$_SESSION['user'] = [
		"login" => true,
		"id" => $user['id'],
		"name" => $user['name'],
		"username" => $user['username'],
		"lastlogin" => $user['lastlogin']
	];

	header("Location:index.php");

	exit;

?>