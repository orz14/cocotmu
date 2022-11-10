        <?php
        // Postingan
        $id = $data['id'];
        $post = query("SELECT username, teks, img, time, suspend FROM cocotan_tb WHERE id = $id")[0];
        $users = $post["username"];
        $detail = query("SELECT nama, fp, verified, geek FROM users_tb WHERE username='$users'")[0];
        $namaDepan = explode(' ',trim($detail["nama"]))[0];
        // Edit Postingan
        if(isset($_POST["edit"])){
          if(editPost($_POST) > 0){
              $berhasilEdit = true;
          } else{
              $gagalEdit = true;
          }
        }
        ?>
        <!-- Edit Postingan -->
        <div class="box mt-3">
          <?php if($post["username"] !== $_SESSION["cocotmuuser"]) : ?>
          <div class="text-center">
            Anda akan dialihkan ke halaman beranda...
          </div>
          <meta http-equiv="refresh" content="2;url='<?= BASEURL; ?>'">
          <?php endif; ?>
          <?php if($post["username"] === $_SESSION["cocotmuuser"]) : ?>
          <div class="title mb-4">Edit Postingan</div>
          <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $id; ?>" />
          <input type="hidden" name="imgLama" value="<?= $post["img"]; ?>" />
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
          <meta http-equiv="refresh" content="2;url='<?= BASEURL; ?>'">
          <?php endif; ?>
          <?php if(isset($gagalEdit)) : ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
           Gagal Menyimpan Perubahan.
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php endif; ?>
          <div class="d-flex align-items-center">
            <div class="d-flex align-items-center">
              <div>
                <img src="<?= BASEURL; ?>/img/profil/<?= $detail['fp']; ?>" class="pp-post" alt="<?= $detail['nama']; ?>" />
              </div>
              <div class="ms-3">
                <span class="namauser"><?= $detail['nama']; ?><?php if($detail["verified"] === "true") : ?><i class="bx bxs-badge-check icon-right" style="color: #3897f0"></i><?php endif; ?><?php if($detail["geek"] === "true") : ?><i class='bx bxs-bot bx-tada icon-right' style='color:#dc3545' ></i><?php endif; ?></span><br />
                <span class="tglpost"><?= $post["time"]; ?><?php if($detail["geek"] === "true") : ?> #<?= $id; ?><?php endif; ?></span>
              </div>
            </div>
          </div>
          <?php if($post["suspend"] === "true") : ?>
          <div class="alert alert-danger mt-3" role="alert">Kami menangguhkan postingan Anda karena terlalu sensitif!</div>
          <?php endif; ?>
          <?php if($post["suspend"] === "false") : ?>
          <div class="mt-3">
            <input id="teks" type="hidden" name="teks" value="<?= $post["teks"]; ?>" autofocus>
            <trix-editor class="trix-editpost" input="teks" autofocus></trix-editor>
          </div>
          <?php if($post["img"]) : ?>
          <div class="mt-3 text-center">
            <img src="<?= BASEURL; ?>/img/post/<?= $post["img"]; ?>" class="img-post" alt="Images" />
          </div>
          <?php endif; ?>
          <div class="mt-2">
            <?php if(!$post["img"]) : ?>
            <label for="formFile" class="form-label">Upload Gambar (Opsional)</label>
            <?php endif; ?>
            <?php if($post["img"]) : ?>
            <label for="formFile" class="form-label">Ganti Gambar (Opsional)</label>
            <?php endif; ?>
            <input class="form-control" type="file" name="img" id="formFile" />
          </div>
          <?php endif; ?>
          <div class="text-center mt-3">
            <a class="btn btn-secondary clickk mb-1" href="<?= BASEURL; ?>" role="button"
              ><span class="jejer"><i class="bx bxs-left-arrow icon-left"></i>Kembali</span></a
            >
            <?php if($post["suspend"] === "false") : ?>
            <button type="submit" name="edit" class="btn btn-orz clickk mb-1">
              <span class="jejer"><i class="bx bxs-save icon-left"></i>Simpan Perubahan</span>
            </button>
            <?php endif; ?>
          </div>
          </form>
          <?php endif; ?>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="mt-4"></div>
    