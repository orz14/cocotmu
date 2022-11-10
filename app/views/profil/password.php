        <?php
        // Ganti Password
        global $koneksi;
        if(isset($_POST["edit"])){
            $user = $_SESSION['cocotmuuser'];
            $pwLama = $_POST["pwLama"];
            $pwBaru1 = mysqli_real_escape_string($koneksi, $_POST["pwBaru1"]);
            $pwBaru2 = mysqli_real_escape_string($koneksi, $_POST["pwBaru2"]);
            $data = mysqli_query($koneksi, "SELECT password FROM users_tb WHERE username='$user'");
            if(mysqli_num_rows($data) === 1){
                $row = mysqli_fetch_assoc($data);
                if(password_verify($pwLama, $row["password"])){
                    if($pwBaru1 !== $pwBaru2){
                    echo "<script>
                            alert('Konfirmasi Password Baru Tidak Sesuai !');
                            document.location.href = '" . BASEURL ."/profil/password';
                            </script>";
                    return false;
                    }
                    $password = password_hash($pwBaru1, PASSWORD_DEFAULT);
                    mysqli_query($koneksi, "UPDATE users_tb SET password='$password' WHERE username='$user'");
                    $berhasil = true;
                }else if($pwLama !== $row["password"]){
                    $plama = true;
                }
            }
        }
        ?>
        <!-- Edit Password -->
        <div class="box mt-3">
          <div class="title mb-4">Ganti Password</div>
          <form action="" method="post">
          <input type="hidden" name="username" value="<?= $username; ?>" />
          <?php if(isset($berhasil)) : ?>
          <div id='preloader'>
           <div id='loader' class='spinner'>
            <div id='d1'></div>
            <div id='d2'></div>
            <div id='d3'></div>
            <div id='d4'></div>
            <div id='d5'></div>
           </div>
          </div>
          <meta http-equiv="refresh" content="2;url='<?= BASEURL; ?>/profil'">
          <?php endif; ?>
          <?php if(isset($plama)) : ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
           Password Lama Tidak Sesuai !
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php endif; ?>
          <div class="form-floating mb-3">
            <input type="password" name="pwLama" class="form-control" id="floatingPassword1" placeholder="Masukkan Password Lama" required />
            <label for="floatingPassword1">Password Lama</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="pwBaru1" class="form-control" id="floatingPassword2" placeholder="Masukkan Password Baru" required />
            <label for="floatingPassword2">Password Baru</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="pwBaru2" class="form-control" id="floatingPassword3" placeholder="Konfirmasi Password Baru" required />
            <label for="floatingPassword3">Konfirmasi Password Baru</label>
          </div>
          <div class="text-center">
            <a class="btn btn-secondary clickk mb-1" href="<?= BASEURL; ?>/profil" role="button"
              ><span class="jejer"><i class="bx bxs-left-arrow icon-left"></i>Kembali</span></a
            >
            <button type="submit" name="edit" class="btn btn-orz clickk mb-1">
              <span class="jejer"><i class="bx bxs-save icon-left"></i>Simpan</span>
            </button>
          </div>
          </form>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="mt-4"></div>
    