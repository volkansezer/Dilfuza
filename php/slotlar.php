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

	<h2>SLOTLAR</h2>
	<hr>

<table class="table table-sm table-striped  table-hover">
<?PHP
    $tarih = new DateTime();

   // $tarih = mktime(0,0,0,$now->mont)



	//echo "Önümüzdeki 20 Gün:\n".$tarih;

    for ($i = 0; $i <= 20; $i++) {
		// Her döngüde tarihe 1 gün ekle
		$tarih->modify('+1 day');
		
		// İstediğin formatta ekrana yazdır (Gün.Ay.Yıl)
		$date = $tarih->format('d.m.Y');
?>
<tr>

    <td><?=$date;?></td>
    <td>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="switchCheckChecked" checked disabled>
            <label class="form-check-label" for="switchCheckChecked">10:00</label>
        </div>
    </td>
    <td>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="switchCheckChecked" disabled>
            <label class="form-check-label" for="switchCheckChecked">11:00</label>
        </div>
    </td>
    <td>
        <form action="actions.php" method="post">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="slotstatus" role="switch" id="switchCheckChecked" onchange="this.form.submit();">
                <label class="form-check-label" for="switchCheckChecked">12:00</label>
            </div>
            <input type="hidden" name="action" value="setslot">
            <input type="hidden" name="slottime" value="<?=$date;?> 12:00">
        </form>
    </td>
    <td>
        <form action="actions.php" method="post">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="slotstatus" role="switch" id="switchCheckChecked" checked onchange="this.form.submit();">
            <label class="form-check-label" for="switchCheckChecked">13:00</label>
        </div>
         <input type="hidden" name="action" value="setslot">
        <input type="hidden" name="slottime" value="<?=$date;?> 13:00">
        </form>
    </td>
</tr>




<?PHP } ?>

</table>



	</body>
</html>