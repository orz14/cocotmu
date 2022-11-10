        <?php
        // Session Username
        $username = $_SESSION['cocotmuuser'];
        $user = query("SELECT nama, jk, wa, fp FROM users_tb WHERE username = '$username'")[0];
        // Edit Profil
        if(isset($_POST["edit"])){
          if(editProfil($_POST) > 0){
              $berhasilEdit = true;
          } else{
              $gagalEdit = true;
          }
        }
        ?>
        <!-- Edit Profil -->
        <div class="box mt-3">
          <div class="title mb-4">Edit Profil</div>
          <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="username" value="<?= $username; ?>" />
          <input type="hidden" name="jk" value="<?= $user["jk"]; ?>" />
          <input type="hidden" name="fpLama" value="<?= $user["fp"]; ?>" />
          <?php if(isset($berhasilEdit)) : ?>
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
          <?php if(isset($gagalEdit)) : ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
           Gagal Menyimpan Perubahan.
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php endif; ?>
          <div class="text-center mb-3">
            <img src="<?= BASEURL; ?>/img/profil/<?= $user["fp"]; ?>" class="pp-edit" alt="<?= $user["nama"]; ?>" />
          </div>
          <div class="was-validated form-floating mb-3">
            <input type="text" name="nama" class="form-control" id="floatingInput1" placeholder="Masukkan Nama Akun" value="<?= $user["nama"]; ?>" required />
            <label for="floatingInput1">Nama Akun</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput2" value="<?= $username; ?>" disabled />
            <label for="floatingInput2">Username</label>
          </div>
          <div class="was-validated form-floating mb-3">
            <select name="jk" class="form-select" required id="floatingSelect" aria-label="Jenis Kelamin">
              <option selected disabled>Pilih Jenis Kelamin (Default: <?= $user["jk"]; ?>)</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
            <label for="floatingSelect">Jenis Kelamin</label>
          </div>
          <div class="was-validated form-floating mb-2">
            <input type="text" name="wa" class="form-control" id="floatingInput4" placeholder="Masukkan Nomor WhatsApp" value="<?= $user["wa"]; ?>" required />
            <label for="floatingInput4">Nomor WhatsApp</label>
          </div>
          <div class="mb-3">
            <label for="formFile" class="form-label">Ganti Foto Profil</label>
            <input class="form-control" type="file" name="fp" id="formFile" />
          </div>
          <div class="text-center">
            <a class="btn btn-secondary clickk mb-1" href="<?= BASEURL; ?>/profil" role="button"
              ><span class="jejer"><i class="bx bxs-left-arrow icon-left"></i>Kembali</span></a
            >
            <button type="submit" name="edit" class="btn btn-orz clickk mb-1">
              <span class="jejer"><i class="bx bxs-save icon-left"></i>Simpan Perubahan</span>
            </button>
          </div>
          </form>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="mt-4"></div>
    