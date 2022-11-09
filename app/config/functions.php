<?php
// koneksi
$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$db_name = DB_NAME;
$koneksi = mysqli_connect($host, $user, $pass, $db_name);

function query($query){
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}

function daftar($data){
    global $koneksi;
	$nama = htmlspecialchars($data["nama"]);
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
	$password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $jk = $data["jk"];
    if(!$jk || $data["jk"] === ""){
        echo "<script>
				alert('Pilih Jenis Kelamin Terlebih Dahulu !');
			</script>";
		return false;
    }
    $wa = htmlspecialchars($data["wa"]);
    $fpDefault = "profilDefault.png";
	if($_FILES['fp']['error'] === 4){
		$fp = $fpDefault;
	} else{
		$fp = uploadFp();
	}
	$verif = "false";
	$geek = "false";
	// cek username sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT username FROM users_tb WHERE username = '$username'");
	if(mysqli_fetch_assoc($result)){
		echo "<script>
				alert('Username Sudah Terdaftar !');
			</script>";
			return false;
	}
	// cek konfirmasi password
	if($password !== $password2){
		echo "<script>
				alert('Konfirmasi Password Tidak Sesuai !');
			</script>";
			return false;
	}
	// login
	$_SESSION['cocotmulogin'] = true;
    $_SESSION['cocotmuuser'] = $username;
	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	// tambahkan user baru ke database
	mysqli_query($koneksi, "INSERT INTO users_tb VALUES('', '$nama', '$username', '$password', '$jk', '$wa', '$fp', '$verif', '$geek')");
	return mysqli_affected_rows($koneksi);
}

function editProfil($data){
	global $koneksi;
	$username = $data["username"];
	$nama = htmlspecialchars($data["nama"]);
	$jk = $data["jk"];
	$wa = htmlspecialchars($data["wa"]);
	$fpLama = $data["fpLama"];
	if($_FILES['fp']['error'] === 4){
		$fp = $fpLama;
	} else{
		$fp = uploadFp();
	}
	$query = "UPDATE users_tb SET nama='$nama', jk='$jk', wa='$wa', fp='$fp' WHERE username = '$username'";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}

function posting($data){
    global $koneksi;
	$username = $data["username"];
	$teks = htmlspecialchars($data["teks"]);
    $imgDefault = "";
	if($_FILES['img']['error'] === 4){
		$img = $imgDefault;
	} else{
		$img = uploadImg();
	}
	$time = $data["time"];
	$suspend = "false";
	mysqli_query($koneksi, "INSERT INTO cocotan_tb VALUES('', '$username', '$teks', '$img', '$time', '$suspend')");
	return mysqli_affected_rows($koneksi);
}

function editPost($data){
	global $koneksi;
	$id = $data["id"];
	$teks = htmlspecialchars($data["teks"]);
	$imgLama = $data["imgLama"];
	if($_FILES['img']['error'] === 4){
		$img = $imgLama;
	} else{
		$img = uploadImg();
	}
	$query = "UPDATE cocotan_tb SET teks='$teks', img='$img' WHERE id = $id";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}

function ngelike($data){
    global $koneksi;
	$id_post = $data['id_post'];
	$username = $data['username'];
	$dataLike = mysqli_query($koneksi, "SELECT id FROM like_tb WHERE id_post='$id_post' AND username = '$username'");
		if(mysqli_num_rows($dataLike) === 1){
			return true;
		}else{
            mysqli_query($koneksi, "INSERT INTO like_tb VALUES('', '$id_post', '$username')");
		}
	return mysqli_affected_rows($koneksi);
}

function uploadFp(){
	$namaFile = $_FILES['fp']['name'];
	$ukuranFile = $_FILES['fp']['size'];
	$error = $_FILES['fp']['error'];
	$tmpName = $_FILES['fp']['tmp_name'];
	// cek apakah yang diupload adalah file gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
		echo "<script>
				alert('Format Gambar Tidak Didukung! Format Yang Didukung (jpg/jpeg/png).');
			</script>";
		return false;
	}
	// cek jika ukurannya terlalu besar
	if($ukuranFile > 5000000){
		echo "<script>
				alert('Ukuran File Terlalu Besar!');
			</script>";
		return false;
	}
	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = 'profil-';
	$namaFileBaru .= uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	move_uploaded_file($tmpName, LOCALURL . '/img/profil/' . $namaFileBaru);
	return $namaFileBaru;
}

function uploadImg(){
	$namaFile = $_FILES['img']['name'];
	$ukuranFile = $_FILES['img']['size'];
	$error = $_FILES['img']['error'];
	$tmpName = $_FILES['img']['tmp_name'];
	// cek apakah yang diupload adalah file gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
		echo "<script>
				alert('Format Gambar Tidak Didukung! Format Yang Didukung (jpg/jpeg/png).');
			</script>";
		return false;
	}
	// cek jika ukurannya terlalu besar
	if($ukuranFile > 5000000){
		echo "<script>
				alert('Ukuran File Terlalu Besar!');
			</script>";
		return false;
	}
	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = 'img-';
	$namaFileBaru .= uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	move_uploaded_file($tmpName, LOCALURL . '/img/post/' . $namaFileBaru);
	return $namaFileBaru;
}
?>