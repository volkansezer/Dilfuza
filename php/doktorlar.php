<?PHP
	session_start(); ob_start();

	// veri tabanı bağlantı bilgilerini tanımlıyoruz
	$DbHost		= "mysql";
	$DbUser		= "admindilfuza";
	$DbPass		= "dilfuzakarimova";
	$DbName		= "hastaneotomasyon";

	//vertabanına bağlanıyoruz
	$mysqli = new mysqli($DbHost, $DbUser, $DbPass, $DbName);

	//bağlantı kurulamazsa hata dönüyoruz
	if($mysqli->connect_errno){
		printf("Bağlantı Hatası: %s\n", $mysqli->connect_error);
		exit();
	}
	
	//bağlantı sağlandı, dil formatını UTF8 olarak tanımlıyoruz
	mysqli_query($mysqli ,"SET NAMES UTF8");	

?>
<html>
	<head>
		<title>Hastane Otomasyon</title>

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

	</head>
	<body>



	<header class="p-3 text-bg-dark">
		<div class="container">
			<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
				<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
					<svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
						<use xlink:href="#bootstrap"></use></svg>
				</a>
				<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
					<li><a href="uzmanliklar.php" class="nav-link px-2 text-white">Uzmanlıklar</a></li>
					<li><a href="doktorlar.php" class="nav-link px-2 text-white">Doktorlar</a></li>
					<li><a href="hastalar.php" class="nav-link px-2 text-white">Hastalar</a></li>
				</ul>
				<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
					<input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
				</form>
				<div class="text-end">
					<button type="button" class="btn btn-outline-light me-2">Login</button>
					<button type="button" class="btn btn-warning">Sign-up</button>
				</div>
			</div>
		</div>
	</header>

	<hr>

	<?PHP if(isset($_SESSION['alert'])){?>
	<div class="alert alert-success" role="alert"> <?=$_SESSION['alert'];?> </div>
	<?PHP unset($_SESSION['alert']); } ?>

	<h2>DOKTORLAR</h2>
	<hr>

	<form action="actions.php" method="post">
		<input type="text" name="doctorname" id="doctorname" require placeholder="Doktor ismi..." ><br>
		<input type="mail" name="doctormail" id="doctormail" require placeholder="Doktor e-posta..." ><br>
		<input type="password" name="password" id="password" require placeholder="Doktor parola..." ><br>
		<input type="phone" name="phone" id="phone" require placeholder="Doktor telefon..." ><br>
		<input type="text" name="description" id="description" require placeholder="Doktor hakkında..." ><br>
		<button type="submit">EKLE</button>
		<input type="hidden" name="action" value="adddoctor">
	</form>

	<hr>

	<table class="table table-striped  table-hover">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Doctor Name</th>
			<th scope="col">Mail</th>
			<th scope="col">Phone</th>
			<th scope="col">Description</th>
			<th scope="col">Status</th>
			<th scope="col">Date</th>
			</tr>
		</thead>
		<tbody>
<?PHP
$myQuery = "select id, name, mail, phone, description, status, createdtime from doctor";
$result = $mysqli->query($myQuery);
?>

<?PHP while($rs = mysqli_fetch_array($result)){?>
			<tr>
				<th scope="row"><?=$rs['id'];?></th>
				<td><a href="doktor.php?id=<?=$rs['id'];?>"><?PHP echo $rs['name'];?></a></td>
				<td><?=$rs['mail'];?></td>
				<td><?=$rs['phone'];?></td>
				<td><?=$rs['description'];?></td>
				<td><?=$rs['status'];?></td>
				<td><?=$rs['createdtime'];?></td>
			</tr>
<?PHP } ?>

		</tbody>
	</table>



	</body>
</html>