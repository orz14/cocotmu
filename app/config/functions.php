<?php
// koneksi
$koneksi = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

function query($query)
{
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function daftar($data)
{
	global $koneksi;
	$nama = htmlspecialchars($data["nama"]);
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
	$password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
	$jk = $data["jk"];
	if (!$jk || $data["jk"] === "") {
		echo "<script>
				alert('Pilih Jenis Kelamin Terlebih Dahulu !');
			</script>";
		return false;
	}
	$wa = htmlspecialchars($data["wa"]);
	$fpDefault = "profilDefault.png";
	if ($_FILES['fp']['error'] === 4) {
		$fp = $fpDefault;
	} else {
		$fp = uploadFp();
	}
	$verif = "false";
	$geek = "false";
	// cek username sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT username FROM users_tb WHERE username = '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('Username Sudah Terdaftar !');
			</script>";
		return false;
	}
	// cek konfirmasi password
	if ($password !== $password2) {
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
	mysqli_query($koneksi, "INSERT INTO users_tb VALUES(null, '$nama', '$username', '$password', '$jk', '$wa', '$fp', '$verif', '$geek')");
	return mysqli_affected_rows($koneksi);
}

function editProfil($data)
{
	global $koneksi;
	$username = $data["username"];
	$nama = htmlspecialchars($data["nama"]);
	$jk = $data["jk"];
	$wa = htmlspecialchars($data["wa"]);
	$fpLama = $data["fpLama"];
	if ($_FILES['fp']['error'] === 4) {
		$fp = $fpLama;
	} else {
		$fp = uploadFp();
	}
	$query = "UPDATE users_tb SET nama='$nama', jk='$jk', wa='$wa', fp='$fp' WHERE username = '$username'";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}

function posting($usernameUser, $teks, $timePosting)
{
	global $koneksi;
	$imgDefault = "";
	if ($_FILES['img']['error'] === 4) {
		$img = $imgDefault;
	} else {
		$img = uploadImg();
	}
	$suspend = "false";
	if (strlen($teks) > 1021) {
		echo "<script>
				alert('Postingan tidak boleh melebihi 1000 karakter.');
			</script>";
		return false;
	} else if (!$teks && !$img) {
		echo "<script>
				alert('Postingan tidak boleh kosong.');
			</script>";
		return false;
	} else {
		mysqli_query($koneksi, "INSERT INTO cocotan_tb VALUES(null, '$usernameUser', '$teks', '$img', '$timePosting', '$suspend')");
	}
	return mysqli_affected_rows($koneksi);
}

function editPost($data)
{
	global $koneksi;
	$id = $data["id"];
	$teks = $data["teks"];
	$imgLama = $data["imgLama"];
	if ($_FILES['img']['error'] === 4) {
		$img = $imgLama;
	} else {
		$img = uploadImg();
	}
	if (strlen($teks) > 1021) {
		echo "<script>
				alert('Postingan tidak boleh melebihi 1000 karakter.');
			</script>";
		return false;
	} else {
		$query = "UPDATE cocotan_tb SET teks='$teks', img='$img' WHERE id = $id";
		mysqli_query($koneksi, $query);
	}
	return mysqli_affected_rows($koneksi);
}

function ngelike($id_post, $usernameUser)
{
	global $koneksi;
	$dataLike = mysqli_query($koneksi, "SELECT id FROM like_tb WHERE id_post='$id_post' AND username = '$usernameUser'");
	if (mysqli_num_rows($dataLike) === 1) {
		return false;
	} else {
		mysqli_query($koneksi, "INSERT INTO like_tb VALUES(null, '$id_post', '$usernameUser')");
	}
	return mysqli_affected_rows($koneksi);
}

function ngomen($id_post, $usernameUser, $komen, $timePosting)
{
	global $koneksi;
	if (strlen($komen) > 1021) {
		echo "<script>
				alert('Komentar tidak boleh melebihi 1000 karakter.');
			</script>";
		return false;
	} else if (!$komen) {
		echo "<script>
				alert('Komentar tidak boleh kosong.');
			</script>";
		return false;
	} else {
		mysqli_query($koneksi, "INSERT INTO komen_tb VALUES(null, '$id_post', '$usernameUser', '$komen', '$timePosting')");
	}
	return mysqli_affected_rows($koneksi);
}

function uploadFp()
{
	$namaFile = $_FILES['fp']['name'];
	$ukuranFile = $_FILES['fp']['size'];
	$error = $_FILES['fp']['error'];
	$tmpName = $_FILES['fp']['tmp_name'];
	// cek apakah yang diupload adalah file gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('Format Gambar Tidak Didukung! Format Yang Didukung (jpg/jpeg/png).');
			</script>";
		return false;
	}
	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 5000000) {
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

function uploadImg()
{
	$namaFile = $_FILES['img']['name'];
	$ukuranFile = $_FILES['img']['size'];
	$error = $_FILES['img']['error'];
	$tmpName = $_FILES['img']['tmp_name'];
	// cek apakah yang diupload adalah file gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('Format Gambar Tidak Didukung! Format Yang Didukung (jpg/jpeg/png).');
			</script>";
		return false;
	}
	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 5000000) {
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
