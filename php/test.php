<?PHP
	ob_start();

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


    $myQuery = "SELECT `id`, `name`, `mail`, `phone`, `description` FROM `doctor`";


    $sql = $mysqli->query($myQuery);

    while($rs = mysqli_fetch_array($sql)){
        echo $rs['name'].'<br>';
    }

?>