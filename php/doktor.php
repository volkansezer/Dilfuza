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


 $id = $_GET['id'];


 $myQuery = "SELECT * FROM `doctor` WHERE id='$id'";

 $result = $mysqli->query($myQuery);

 $doctor = mysqli_fetch_assoc($result);

 

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

    <hr>

<style>
    body{padding-top:30px;}

.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

small {
display: block;
line-height: 1.428571429;
color: #999;
}
</style>



    <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
 
                    <div class="col-sm-6 col-md-8">
                        <h4><?=$doctor['name'];?></h4>
                        <small><cite title="San Francisco, USA"><?=$doctor['description'];?> <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i><?=$doctor['mail'];?>
                            <br />
                            <i class="glyphicon glyphicon-globe"></i><a href="tel:<?=$doctor['phone'];?>"><?=$doctor['phone'];?></a>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>June 02, 1988</p>
                        <!-- Split button -->

                        <form action="actions.php" method="post" onsubmit="return confirm('Doktor <?=$doctor['name'];?> kaydını silmek istediğinize emin misiniz?');">
                         <div class="btn-group">
                            <button type="submit" class="btn btn-danger">SİL</button>                           
                        </div>
                        <input type="hidden" name="action" value="deletedoctor">
                        <input type="hidden" name="id" value="<?= $doctor['id'];?>">
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<hr>



<form action="actions.php" method="post">
    <input type="text" name="doctorname" id="doctorname" require placeholder="Doktor ismi..." value="<?=$doctor['name'];?>" ><br>
    <input type="mail" name="doctormail" id="doctormail" require placeholder="Doktor e-posta..." value="<?=$doctor['mail'];?>" ><br>
    <input type="password" name="password" id="password" require placeholder="Doktor parola..." value="<?=$doctor['password'];?>" ><br> <!-- parola hassasiyetini şimdilik görmezden geliyoruz  -->
    <input type="phone" name="phone" id="phone" require placeholder="Doktor telefon..." value="<?=$doctor['phone'];?>" ><br>
    <input type="text" name="description" id="description" require placeholder="Doktor hakkında..." value="<?=$doctor['description'];?>" ><br>
    <button type="submit" class="btn btn-primary">DÜZENLE</button>                    
    <input type="hidden" name="action" value="editdoctor">
    <input type="hidden" name="id" value="<?= $doctor['id'];?>">
</form>




	</body>
</html>