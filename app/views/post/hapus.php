        <?php
        // Postingan
        $id = $data['id'];
        $post = query("SELECT username FROM cocotan_tb WHERE id = $id")[0];
        ?>
        <!-- Edit Postingan -->
        <div class="box mt-3">
          <meta http-equiv="refresh" content="2;url='<?= BASEURL; ?>'">
          <?php if($post["username"] !== $_SESSION["cocotmuuser"]) : ?>
          <div class="text-center">
            Anda akan dialihkan ke halaman beranda...
          </div>
          <?php endif; ?>
          <?php if($post["username"] === $_SESSION["cocotmuuser"]) : ?>
          <?php
          // Hapus Postingan
          global $koneksi;
          mysqli_query($koneksi, "DELETE FROM cocotan_tb WHERE id = $id");
          mysqli_query($koneksi, "DELETE FROM like_tb WHERE id_post = $id");
          mysqli_query($koneksi, "DELETE FROM komen_tb WHERE id_post = $id");
          ?>
          <div class="text-center">
            Menghapus postingan...
          </div>
          <?php endif; ?>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="mt-4"></div>
    