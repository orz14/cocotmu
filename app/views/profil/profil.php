        <?php
        global $koneksi;
        $time = date('d F Y H:i');
        // Session Username
        $username = $_SESSION['cocotmuuser'];
        $user = query("SELECT nama, jk, wa, fp, geek FROM users_tb WHERE username = '$username'")[0];
        // Postingan
        $post = query("SELECT id, username, teks, img, time, suspend FROM cocotan_tb WHERE username = '$username' ORDER BY id DESC");
        $jumlahPost = count($post);
        // Like
        if(isset($_POST["like"])){
          $postId = $_POST['id_post'];
          if(ngelike($_POST) > 0){
              echo "
                <script>
                  document.location.href = '".BASEURL."/profil/#".$postId."';
                </script>
              ";
          }else{
              $gagalLike = false;
          }
        }
        // Komen
        if(isset($_POST["kirimkomen"])){
          $postId = $_POST['idpost'];
          if(ngomen($_POST) > 0){
              echo "
                <script>
                  document.location.href = '".BASEURL."/profil/#".$postId."';
                </script>
              ";
          }else{
              $gagalKomen = false;
          }
        }
        ?>
        <!-- Profil -->
        <div class="box mt-3">
          <div class="row row-cols-1 row-cols-md-3">
            <div class="col col1">
              <img src="<?= BASEURL; ?>/img/profil/<?= $user["fp"]; ?>" class="img-profil" alt="<?= $user["nama"]; ?>" />
              <div class="mt-3">
                <a class="btn btn-orz" href="<?= BASEURL; ?>/profil/edit" role="button">Edit Profil</a>
              </div>
            </div>
            <div class="col deskripsi-profil">
              <p class="b1">Nama Akun</p>
              <p class="b2"><?= $user["nama"]; ?></p>
              <p class="b1 mt-2">Username</p>
              <p class="b2"><?= $username; ?></p>
              <p class="b1 mt-2">Jenis Kelamin</p>
              <p class="b2"><?= $user["jk"]; ?></p>
              <p class="b1 mt-2">Nomor WhatsApp</p>
              <p class="b2"><?= $user["wa"]; ?></p>
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
        $postId = $postingan["id"];
        $detail = query("SELECT nama, fp, verified, geek FROM users_tb WHERE username='$users'")[0];
        $likes = count(query("SELECT id FROM like_tb WHERE id_post=$postId"));
        $comments = query("SELECT id, username, komen, time FROM komen_tb WHERE id_post=$postId");
        ?>
        <div class="box module mt-4" id="<?= $postingan["id"]; ?>">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <div>
                <img data-src="<?= BASEURL; ?>/img/profil/<?= $detail["fp"]; ?>" src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="pp-post lazy" alt="<?= $detail["nama"]; ?>" />
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
            <img data-src="<?= BASEURL; ?>/img/post/<?= $postingan["img"]; ?>" src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="img-post lazy" alt="Images" />
          </div>
          <?php endif; ?>
          <div class="post-action d-flex mt-2 gap-2">
            <?php
            if(!isset($_SESSION['cocotmulogin'])){
              $username = "null";
            }
            $dataLike = mysqli_query($koneksi, "SELECT id FROM like_tb WHERE id_post='$postId' AND username = '$username'");
            ?>
            <?php if(isset($_SESSION['cocotmulogin'])) : ?>
            <?php if(mysqli_num_rows($dataLike) === 1) : ?>
              <button class="btn btn-post-action btn-post-like"><span class="jejer"><i class='bx bxs-heart icon-left' ></i><?= $likes; ?></span></button>
            <?php else : ?>
            <form action="" method="POST">
              <input type="hidden" name="id_post" value="<?= $postingan["id"]; ?>">
              <input type="hidden" name="username" value="<?= $_SESSION["cocotmuuser"]; ?>">
              <button type="submit" name="like" class="btn btn-post-action btn-post-like"><span class="jejer"><i class='bx bx-heart icon-left' ></i><?= $likes; ?></span></button>
            </form>
            <?php endif; ?>
            <a class="btn btn-post-action btn-post-comment" onClick="komen_modal('<?= $postId; ?>');"><span class="jejer"><i class='bx bx-message-square-dots icon-left'></i>Comment</span></a>
            <?php else : ?>
              <button class="btn btn-post-action btn-post-like" data-bs-toggle="modal" data-bs-target="#modalLogin"><span class="jejer"><i class='bx bx-heart icon-left' ></i><?= $likes; ?></span></button>
              <button class="btn btn-post-action btn-post-comment" data-bs-toggle="modal" data-bs-target="#modalLogin"><span class="jejer"><i class='bx bx-message-square-dots icon-left'></i>Comment</span></button>
            <?php endif; ?>
          </div>
        </div>
        <div class="clear"></div>
        <div class="box-comment-wrapper align-items-end float-end module">
        <?php foreach($comments as $komen) : ?>
        <?php
        $usersKomen = $komen["username"];
        $detailUserKomen = query("SELECT nama, fp, verified, geek FROM users_tb WHERE username='$usersKomen'")[0];  
        ?>
          <div class="box box-comment module mt-4">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center">
                <div>
                  <img data-src="<?= BASEURL; ?>/img/profil/<?= $detailUserKomen["fp"]; ?>" src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="pp-post lazy" alt="<?= $detailUserKomen["nama"]; ?>" />
                </div>
                <div class="ms-3">
                  <span class="namauser"><a href="<?= BASEURL; ?>/p/<?= $usersKomen; ?>"><?= $detailUserKomen["nama"]; ?></a><?php if($detailUserKomen["verified"] === "true") : ?><i class="bx bxs-badge-check icon-right" style="color: #3897f0"></i><?php endif; ?><?php if($detailUserKomen["geek"] === "true") : ?><i class='bx bxs-bot bx-tada icon-right' style='color:#dc3545' ></i><?php endif; ?></span><br />
                  <span class="tglpost"><?= $komen["time"]; ?><?php if($user["geek"] === "true") : ?> #<?= $komen["id"]; ?><?php endif; ?></span>
                </div>
              </div>
              <!-- <?php if($komen["username"] === $_SESSION["cocotmuuser"]) : ?>
              <div>
                <div class="dropdown dropdown-orz">
                  <button class="btn-option dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-horizontal-rounded"></i></button>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <?php if($komen["suspend"] === "false") : ?>
                    <li>
                      <a class="dropdown-item" href="<?= BASEURL; ?>/post/edit/<?= $komen["id"]; ?>"
                        ><span class="jejer"><i class="bx bx-edit"></i>&nbsp;Edit Post</span></a
                      >
                    </li>
                    <?php endif; ?>
                    <li>
                      <a class="dropdown-item" href="<?= BASEURL; ?>/post/hapus/<?= $komen["id"]; ?>" onclick="return confirm('Yakin ingin menghapus data ?');"><span class="jejer"><i class="bx bx-trash"></i>&nbsp;Hapus Post</span></a
                      >
                    </li>
                  </ul>
                </div>
              </div>
              <?php endif; ?> -->
            </div>
            <div class="mt-2">
              <?= $komen["komen"]; ?>
            </div>
          </div>
          <div class="clear"></div>
        <?php endforeach; ?>
        </div>
        <div class="clear"></div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="clear"></div>
    <div class="mt-4"></div>
    <?php if(isset($_SESSION['cocotmulogin'])) : ?>
    <!-- Modal Komen -->
    <div class="modal fade" id="modalKomen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalKomenLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-login">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalKomenLabel">Comment</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
              <input type="hidden" name="idpost" id="ambil_id" value="#">
              <input type="hidden" name="username" value="<?= $_SESSION["cocotmuuser"]; ?>">
              <input type="hidden" name="time" value="<?= $time; ?>">
              <div>
                <input id="komen" type="hidden" name="komen">
                <trix-editor class="trix-editpost" input="komen"></trix-editor>
              </div>
              <div class="d-grid mt-3">
                <button class="btn btn-orz" type="submit" name="kirimkomen">
                  <span class="jejer justify-content-center">Kirim<i class="bx bx-send icon-right"></i></span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    