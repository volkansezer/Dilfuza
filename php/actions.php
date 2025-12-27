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
	
	//bağlantı sağlandı, dil formatını UTF8 olarak tanımlıyoruz
	mysqli_query($mysqli ,"SET NAMES UTF8");	


	$action = $_POST['action'];

	echo $action."<hr>";

	$name = "Dilfuza";



	//Doktor ekleme işlemi bu bölümde yapılacak
	if($action=='adddoctor'){
		echo 'doktor eklenecek<br>';

		$doctorname = $_POST['doctorname'];
		$doctormail = $_POST['doctormail'];
		$password = $_POST['password'];
		$phone = $_POST['phone'];
		$description = $_POST['description'];

		echo $doctorname.' > '.$doctormail.' > '.$password.' > '.$phone.' > '.$desc;

		$result = $mysqli->query("INSERT INTO `doctor` (`name`, `mail`, `password`, `phone`, `description`, `status`)
						VALUES ('$doctorname', '$doctormail', '$password', '$phone', '$desc', '1');");

		if($result){
			//echo 'Tebrikler eklendi';
			header("Location:index.php");
			exit;
		}else{
			echo 'Bir hata oluştu! '.$mysql->error;
			exit;
		}

	}


	if($action=="editdoctor"){

		echo 'doktor düzenlenecek';

	}


?>