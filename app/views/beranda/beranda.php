        <?php
        global $koneksi;
        $date = date('Y-m-d H:i:s');
        $time = date('d F Y H:i');
        if(isset($_SESSION['cocotmulogin'])){
          $username = $_SESSION['cocotmuuser'];
          $user = query("SELECT nama, fp, geek FROM users_tb WHERE username = '$username'")[0];
          $namaDepan = explode(' ',trim($user["nama"]))[0];
        }else{
          $user["nama"] = "null";
          $namaDepan = "null";
          $user["fp"] = "profilDefault.png";
          $user["geek"] = false;
          $_SESSION["cocotmuuser"] = "";
        }
        // Memposting
        if(isset($_POST["post"])){
          $usernameUser = $username;
          $teks = $_POST['teks'];
          $timePosting = $time;
          if(posting($usernameUser, $teks, $timePosting) > 0){
              $berhasilPosting = true;
          }else{
              $gagalPosting = true;
          }
        }
        // Postingan
        $post = query("SELECT id, username, teks, img, time, suspend FROM cocotan_tb ORDER BY id DESC");
        // Like
        if(isset($_POST["like"])){
          $id_post = $_POST['id_post'];
          $usernameUser = $username;
          if(ngelike($id_post, $usernameUser) > 0){
              echo "
                <script>
                  document.location.href = '".BASEURL."/#".$id_post."';
                </script>
              ";
          }else{
              $gagalLike = false;
          }
        }
        // Komen
        if(isset($_POST["kirimkomen"])){
          $id_post = $_POST['idpost'];
          $usernameUser = $username;
          $komen = $_POST['komen'];
          $timePosting = $time;
          if(ngomen($id_post, $usernameUser, $komen, $timePosting) > 0){
              echo "
                <script>
                  document.location.href = '".BASEURL."/#".$id_post."';
                </script>
              ";
          }else{
              $gagalKomen = false;
          }
        }
        // Daftar
        if(isset($_POST["daftar"])){
          if(daftar($_POST) > 0){
              $berhasilDaftar = true;
          }else{
              $gagalDaftar = true;
          }
        }
        // Login
        if(isset($_POST["login"])){
          $username = $_POST["username"];
          $password = $_POST["password"];
          $result = mysqli_query($koneksi, "SELECT id, nama, username, password FROM users_tb WHERE username = '$username'");
          // cek username
          if(mysqli_num_rows($result) === 1){
            // cek password
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row["password"])){
              // set session
              $_SESSION['cocotmulogin'] = true;
              $_SESSION['cocotmuuser'] = $row["username"];
              // recent login
              $nama = $row["nama"];
              mysqli_query($koneksi, "INSERT INTO login_tb VALUES('', '$nama', '$date')");
              echo "
                <script>
                  document.location.href = '".BASEURL."/set';
                </script>
              ";
              exit;
            }else{
              $xPassword = true;
            }
          }else{
            $xUsername = true;
          }
        }
        ?>
        <?php if(isset($berhasilDaftar)) : ?>
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
        <?php if(isset($gagalDaftar)) : ?>
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
          Gagal Mendaftar.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php if(isset($berhasilPosting)) : ?>
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
        <?php if(isset($gagalPosting)) : ?>
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
          Gagal Memposting.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php if(isset($xUsername)) : ?>
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
          Username tidak ditemukan.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php if(isset($xPassword)) : ?>
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
          Password yang anda masukkan salah.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php if(!isset($_SESSION['cocotmulogin'])) : ?>
        <!-- Welcome -->
        <div class="box text-center mt-3">
          <span class="welcome">
            Selamat datang di cocotMU<br />
            Silahkan <a class="underline" data-bs-toggle="modal" data-bs-target="#modalLogin" role="button">Login</a> untuk menyampaikan keluh kesah kalian 😈
          </span>
        </div>
        <div class="clear"></div>
        <?php endif; ?>
        <?php if(!isset($_SESSION['cocotmulogin'])) : ?>
        <!-- Property Buat Status -->
        <div class="box box-update mt-4">
          <div class="d-flex">
            <div class="flex-shrink-0">
              <img src="<?= BASEURL; ?>/img/profil/profilDefault.png" class="pp-status" alt="null" />
            </div>
            <div class="flex-grow-1 ms-3">
              <div>
                <input id="teks" type="hidden">
                <trix-editor class="trix-beranda" input="teks"></trix-editor>
              </div>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                  <label class="btn btn-upload-foto mb-1">
                    <span class="jejer"><i class="bx bx-image-add icon-left" style="font-size: 21px"></i><span class="txt-image-add">Foto/Gambar</span></span><input type="file" style="display: none">
                  </label>
                </div>
                <div class="ms-2">
                  <button type="button" class="btn btn-orz mb-1">
                    <span class="jejer">Publikasi<i class="bx bx-send icon-right"></i></span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="clear"></div>
        <?php endif; ?>
        <?php if(isset($_SESSION['cocotmulogin'])) : ?>
        <!-- Buat Status -->
        <div class="box mt-3">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="d-flex">
              <div class="flex-shrink-0">
                <img src="<?= BASEURL; ?>/img/profil/<?= $user["fp"]; ?>" class="pp-status" alt="<?= $user["nama"]; ?>" />
              </div>
              <div class="flex-grow-1 ms-3">
                <div>
                  <input id="teks" type="hidden" name="teks" autofocus>
                  <trix-editor class="trix-beranda" input="teks" autofocus></trix-editor>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <div>
                    <label class="btn btn-upload-foto clickk mb-1">
                      <span class="jejer"><i class="bx bx-image-add icon-left" style="font-size: 21px"></i><span class="txt-image-add">Foto/Gambar</span></span><input type="file" name="img" style="display: none">
                    </label>
                  </div>
                  <div class="ms-2">
                    <button type="submit" name="post" class="btn btn-orz clickk mb-1">
                      <span class="jejer">Publikasi<i class="bx bx-send icon-right"></i></span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="clear"></div>
        <?php endif; ?>
        <!-- Status -->
        <div class="postingan">
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
                <img src="<?= BASEURL; ?>/img/profil/<?= $detail["fp"]; ?>" class="pp-post" alt="<?= $detail["nama"]; ?>" />
              </div>
              <div class="ms-3">
                <span class="namauser"><a href="<?= BASEURL; ?>/p/<?= $users; ?>"><?= $detail["nama"]; ?></a><?php if($detail["verified"] === "true") : ?><i class="bx bxs-badge-check icon-right" style="color: #3897f0"></i><?php endif; ?><?php if($detail["geek"] === "true") : ?><i class='bx bxs-bot bx-tada icon-right' style='color:#dc3545' ></i><?php endif; ?></span><br />
                <span class="tglpost"><?= $postingan["time"]; ?><?php if($user["geek"] === "true") : ?> #<?= $postingan["id"]; ?><?php endif; ?></span>
              </div>
            </div>
            <?php if($postingan["username"] === $_SESSION["cocotmuuser"]) : ?>
            <div>
              <div class="dropdown dropdown-orz">
                <button class="btn-option dropdown-toggle clickk" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-horizontal-rounded"></i></button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <?php if($postingan["suspend"] === "false") : ?>
                  <li>
                    <a class="dropdown-item clickk" href="<?= BASEURL; ?>/post/edit/<?= $postingan["id"]; ?>"
                      ><span class="jejer"><i class="bx bx-edit"></i>&nbsp;Edit Post</span></a
                    >
                  </li>
                  <?php endif; ?>
                  <li>
                    <a class="dropdown-item clickk" href="<?= BASEURL; ?>/post/hapus/<?= $postingan["id"]; ?>" onclick="return confirm('Yakin ingin menghapus data ?');"><span class="jejer"><i class="bx bx-trash"></i>&nbsp;Hapus Post</span></a
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
              <button class="btn btn-post-action btn-post-like clickk"><span class="jejer"><i class='bx bxs-heart icon-left' ></i><?= $likes; ?></span></button>
            <?php else : ?>
            <form action="" method="POST">
              <input type="hidden" name="id_post" value="<?= $postingan["id"]; ?>">
              <button type="submit" name="like" class="btn btn-post-action btn-post-like clickk"><span class="jejer"><i class='bx bx-heart icon-left' ></i><?= $likes; ?></span></button>
            </form>
            <?php endif; ?>
            <a class="btn btn-post-action btn-post-comment clickk" onClick="komen_modal('<?= $postId; ?>');"><span class="jejer"><i class='bx bx-message-square-dots icon-left'></i>Comment</span></a>
            <?php else : ?>
              <button class="btn btn-post-action btn-post-like clickk" data-bs-toggle="modal" data-bs-target="#modalLogin"><span class="jejer"><i class='bx bx-heart icon-left' ></i><?= $likes; ?></span></button>
              <button class="btn btn-post-action btn-post-comment clickk" data-bs-toggle="modal" data-bs-target="#modalLogin"><span class="jejer"><i class='bx bx-message-square-dots icon-left'></i>Comment</span></button>
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
                  <img src="<?= BASEURL; ?>/img/profil/<?= $detailUserKomen["fp"]; ?>" class="pp-post" alt="<?= $detailUserKomen["nama"]; ?>" />
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
    </div>
    <div class="clear"></div>
    <div class="mt-4"></div>
    <?php if(!isset($_SESSION['cocotmulogin'])) : ?>
    <!-- Modal Login -->
    <div class="modal fade" id="modalLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-login">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalLoginLabel">Login cocotMU</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
              <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="floatingInput1" placeholder="Masukkan Username" required />
                <label for="floatingInput1">Username</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword1" placeholder="Masukkan Password" required />
                <label for="floatingPassword1">Password</label>
              </div>
              <div class="d-grid">
                <button class="btn btn-orz clickk" type="submit" name="login">
                  <span class="jejer justify-content-center"><i class="bx bx-log-in-circle icon-left"></i>Login</span>
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer text-center">
            <span class="disable-link"><a href="#" role="button">Lupa Password?</a>(Coming Soon)</span>
            <br />
            Belum punya akun?<a class="underline" data-bs-toggle="modal" data-bs-target="#modalDaftar" role="button">Daftar</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Daftar -->
    <div class="modal fade" id="modalDaftar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDaftarLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-login">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalDaftarLabel">Daftar cocotMU</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="was-validated form-floating mb-3">
                <input type="text" name="nama" maxlength="100" class="form-control" id="floatingInput2" placeholder="Masukkan Nama Akun" required />
                <label for="floatingInput2">Nama Akun</label>
              </div>
              <div class="was-validated form-floating mb-3">
                <input type="text" name="username" minlength="4" maxlength="20" class="form-control" id="floatingInput3" placeholder="Masukkan Username" required />
                <label for="floatingInput3">Username</label>
              </div>
              <div class="was-validated form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword2" placeholder="Masukkan Password" required />
                <label for="floatingPassword2">Password</label>
              </div>
              <div class="was-validated form-floating mb-3">
                <input type="password" name="password2" class="form-control" id="floatingPassword3" placeholder="Masukkan Konfirmasi Password" required />
                <label for="floatingPassword3">Konfirmasi Password</label>
              </div>
              <div class="was-validated form-floating mb-3">
                <select name="jk" class="form-select" required id="floatingSelect" aria-label="Jenis Kelamin">
                  <option value="" selected disabled>Pilih Jenis Kelamin</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
                <label for="floatingSelect">Jenis Kelamin</label>
              </div>
              <div class="was-validated form-floating mb-2">
                <input type="number" name="wa" minlength="10" maxlength="15" class="form-control" id="floatingInput4" placeholder="Masukkan Nomor WhatsApp" required />
                <label for="floatingInput4">Nomor WhatsApp</label>
              </div>
              <div class="mb-3">
                <label for="formFileDaftar" class="form-label">Upload Foto Profil (Opsional)</label>
                <input class="form-control" type="file" name="fp" id="formFileDaftar" />
              </div>
              <div class="was-validated form-check mb-3">
                <input type="checkbox" class="form-check-input" id="validationFormCheck1" required />
                <label class="form-check-label" for="validationFormCheck1">Saya setuju mendaftar dan data yang saya masukkan sudah benar</label>
              </div>
              <div class="d-grid">
                <button class="btn btn-orz clickk" type="submit" name="daftar">
                  <span class="jejer justify-content-center"><i class="bx bx-edit-alt icon-left"></i>Daftar</span>
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer text-center">Sudah punya akun?<a class="underline" data-bs-toggle="modal" data-bs-target="#modalLogin" role="button">Login</a></div>
        </div>
      </div>
    </div>
    <?php endif; ?>
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
              <div>
                <input id="komen" type="hidden" name="komen">
                <trix-editor class="trix-editpost" input="komen"></trix-editor>
              </div>
              <div class="d-grid mt-3">
                <button class="btn btn-orz clickk" type="submit" name="kirimkomen">
                  <span class="jejer justify-content-center">Kirim<i class="bx bx-send icon-right"></i></span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    