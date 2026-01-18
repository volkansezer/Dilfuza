<?PHP

	session_start(); ob_start();

	// veri tabanı bağlantı bilgilerini tanımlıyoruz

    //local database settings
	$DbHost		= "mysql";
	$DbUser		= "admindilfuza";
	$DbPass		= "dilfuzakarimova";
	$DbName		= "hastaneotomasyon";

    //web server database settings
    $DbHost		= "localhost";
    $DbName		= "volkansezer";
    $DbUser		= "sezervolkan";
    $DbPass		= "Tamirci!34";

	//vertabanına bağlanıyoruz
	$mysqli = new mysqli($DbHost, $DbUser, $DbPass, $DbName);

	//bağlantı kurulamazsa hata dönüyoruz
	if($mysqli->connect_errno){
		printf("Bağlantı Hatası: %s\n", $mysqli->connect_error);
		exit();
	}
	
	//bağlantı sağlandı, dil formatını UTF8 olarak tanımlıyoruz
	mysqli_query($mysqli ,"SET NAMES UTF8");


    $sitename = "Hastane Otomasyon"; //değiştirilebilir tanımalma
    const _SiteName = "Hastane Otomasyon"; //değiştirilemez tanımlama
?>