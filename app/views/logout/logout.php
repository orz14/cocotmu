        <?php
        // Logout
        $_SESSION = [];
        session_unset();
        session_destroy();
        ?>
        <!-- Logout -->
        <div class="box mt-3">
          <meta http-equiv="refresh" content="2;url='<?= BASEURL; ?>'">
          <div class="text-center">
            Berhasil logout...
          </div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="mt-4"></div>
    