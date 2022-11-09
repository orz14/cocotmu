<?php
global $koneksi;
// Cek cookie
if(isset($_COOKIE['port']) && isset($_COOKIE['key'])){
    $port = $_COOKIE['port'];
    $key = $_COOKIE['key'];
    // Ambil username berdasarkan port
    $resultDB = mysqli_query($koneksi, "SELECT username FROM users_tb WHERE id = $port");
    if(mysqli_num_rows($resultDB) === 1){
        $userLogin = mysqli_fetch_assoc($resultDB);
        // Cek cookie dan username
        if($key === hash('sha256', $userLogin['username'])){
            $_SESSION['cocotmulogin'] = true;
            $_SESSION['cocotmuuser'] = $userLogin["username"];
        }else{
            setcookie('port', '', 0, '/');
            setcookie('key', '', 0, '/');
            header("Location:" . BASEURL . "/logout");
            exit;
        }
    }else{
        setcookie('port', '', 0, '/');
        setcookie('key', '', 0, '/');
        header("Location:" . BASEURL . "/logout");
        exit;
    }
}
?>
