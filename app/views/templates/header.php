  </head>
  <body>
    <?php
    if(isset($_SESSION['cocotmulogin'])){
      $username = $_SESSION['cocotmuuser'];
      $user = query("SELECT nama, fp, verified, geek FROM users_tb WHERE username = '$username'")[0];
    }
    ?>
    <div class="wrapper mx-auto">
      <div class="container">
        <!-- Header -->
        <header class="d-flex justify-content-between align-items-center mt-3">
          <div>
            <a href="<?= BASEURL; ?>"><img src="https://cdn.jsdelivr.net/gh/orz14/cocotmu@main/public/img/logo/cocotmulogo-v2.png" class="logo-img" alt="cocotMU" /></a>
          </div>
          <?php if(!isset($_SESSION['cocotmulogin'])) : ?>
          <!-- Belum Login -->
          <div class="btn-top">
            <button type="button" class="btn btn-orz clickk" data-bs-toggle="modal" data-bs-target="#modalLogin">
              <span class="jejer"><i class="bx bx-log-in-circle icon-left"></i>Login</span>
            </button>
            <button type="button" class="btn btn-orz clickk" data-bs-toggle="modal" data-bs-target="#modalDaftar">
              <span class="jejer"><i class="bx bx-edit-alt icon-left"></i>Daftar</span>
            </button>
          </div>
          <?php endif; ?>
          <?php if(isset($_SESSION['cocotmulogin'])) : ?>
          <!-- Sudah Login -->
          <div class="btn-top menu-mobile">
            <a class="btn btn-orz clickk" href="<?= BASEURL; ?>" role="button"
              ><span class="jejer"><i class="bx bx-home icon-left"></i>Beranda</span></a
            >
          </div>
          <div class="btn-top">
            <div class="dropdown">
              <button class="btn-profil dropdown-toggle clickk" type="button" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <img src="<?= BASEURL; ?>/img/profil/<?= $user["fp"]; ?>" class="profilku" alt="<?= $user["nama"]; ?>" />
                <span class="namaku"><?= $user["nama"]; ?></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-orz dropdown-menu-end text-center">
                <li class="mt-3">
                  <img src="<?= BASEURL; ?>/img/profil/<?= $user["fp"]; ?>" class="dropdown-img" alt="<?= $user["nama"]; ?>" />
                </li>
                <li class="mt-3">
                  <span class="dropdown-nama jejer justify-content-center"><?= $user["nama"]; ?><?php if($user["verified"] === "true") : ?><i class="bx bxs-badge-check icon-right" style="color: #3897f0"></i><?php endif; ?><?php if($user["geek"] === "true") : ?><i class='bx bxs-bot bx-tada icon-right' style='color:#dc3545' ></i><?php endif; ?></span>
                </li>
                <li class="mb-3"><span class="dropdown-username">@<?= $username; ?></span></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item clickk" href="<?= BASEURL; ?>/profil">Lihat Profil</a></li>
                <li><a class="dropdown-item clickk" href="<?= BASEURL; ?>/profil/password">Ganti Password</a></li>
                <li><a class="dropdown-item dropdown-item-logout clickk" data-bs-toggle="modal" data-bs-target="#modalLogout" role="button">Logout</a></li>
              </ul>
            </div>
          </div>
          <?php endif; ?>
        </header>
        <div class="clear"></div>
        