        <?php
        // Username
        $username = $data['username'];
        if($username === $_SESSION['cocotmuuser']){
            echo "
                <script>
                  document.location.href = '".BASEURL."/profil';
                </script>
              ";
            exit;
        }
        $user = query("SELECT nama, jk, fp, geek FROM users_tb WHERE username = '$username'")[0];
        // Postingan
        $post = query("SELECT id, username, teks, img, time, suspend FROM cocotan_tb WHERE username = '$username' ORDER BY id DESC");
        $jumlahPost = count($post);
        ?>
        <!-- Profil -->
        <div class="box mt-3">
          <div class="row row-cols-1 row-cols-md-3">
            <div class="col col1">
              <img src="<?= BASEURL; ?>/img/profil/<?= $user["fp"]; ?>" class="img-profil" alt="<?= $user["nama"]; ?>" />
            </div>
            <div class="col deskripsi-profil">
              <p class="b1">Nama Akun</p>
              <p class="b2"><?= $user["nama"]; ?></p>
              <p class="b1 mt-2">Username</p>
              <p class="b2"><?= $username; ?></p>
              <p class="b1 mt-2">Jenis Kelamin</p>
              <p class="b2"><?= $user["jk"]; ?></p>
            </div>
          </div>
        </div>
        <div class="clear"></div>
        <!-- Status -->
        <div class="box-clear d-flex align-items-center mt-4">
          <span class="jumlah-post jejer justify-content-center"><i class="bx bx-file icon-left"></i><?= $jumlahPost; ?> Postingan</span>
        </div>
        <div class="clear"></div>
        <?php foreach($post as $postingan) : ?>
        <?php
        $users = $postingan["username"];
        $detail = query("SELECT nama, fp, verified, geek FROM users_tb WHERE username='$users'")[0];
        ?>
        <div class="box mt-4">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <div>
                <img src="<?= BASEURL; ?>/img/profil/<?= $detail["fp"]; ?>" class="pp-post" alt="<?= $detail["nama"]; ?>" />
              </div>
              <div class="ms-3">
                <span class="namauser"><?= $detail["nama"]; ?><?php if($detail["verified"] === "true") : ?><i class="bx bxs-badge-check icon-right" style="color: #3897f0"></i><?php endif; ?><?php if($detail["geek"] === "true") : ?><i class='bx bxs-bot bx-tada icon-right' style='color:#dc3545' ></i><?php endif; ?></span><br />
                <span class="tglpost"><?= $postingan["time"]; ?><?php if($user["geek"] === "true") : ?> #<?= $postingan["id"]; ?><?php endif; ?></span>
              </div>
            </div>
            <?php if($postingan["username"] === $_SESSION["cocotmuuser"]) : ?>
            <div>
              <div class="dropdown dropdown-orz">
                <button class="btn-option dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-horizontal-rounded"></i></button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <?php if($postingan["suspend"] === "false") : ?>
                  <li>
                    <a class="dropdown-item" href="<?= BASEURL; ?>/post/edit/<?= $postingan["id"]; ?>"
                      ><span class="jejer"><i class="bx bx-edit"></i>&nbsp;Edit Post</span></a
                    >
                  </li>
                  <?php endif; ?>
                  <li>
                    <a class="dropdown-item" href="<?= BASEURL; ?>/post/hapus/<?= $postingan["id"]; ?>" onclick="return confirm('Yakin ingin menghapus data ?');"><span class="jejer"><i class="bx bx-trash"></i>&nbsp;Hapus Post</span></a
                    >
                  </li>
                </ul>
              </div>
            </div>
            <?php endif; ?>
          </div>
          <?php if($postingan["teks"]) : ?>
          <div class="mt-2">
            <?= $postingan["teks"]; ?>
          </div>
          <?php endif; ?>
          <?php if($postingan["img"]) : ?>
          <div class="mt-3 text-center">
            <img src="<?= BASEURL; ?>/img/post/<?= $postingan["img"]; ?>" class="img-post" alt="Images" />
          </div>
          <?php endif; ?>
        </div>
        <div class="clear"></div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="clear"></div>
    <div class="mt-4"></div>
    