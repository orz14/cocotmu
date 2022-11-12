        <?php
        global $koneksi;
        if(isset($_SESSION['cocotmulogin'])){
          $username = $_SESSION['cocotmuuser'];
          $user = query("SELECT geek FROM users_tb WHERE username = '$username'")[0];
        }else{
          $user["geek"] = false;
        }
        $post = query("SELECT id, username, teks, img, time, suspend FROM cocotan_tb ORDER BY id DESC");
        ?>
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
        <script type="text/javascript">
          //<![CDATA[
            // Transition
            !function(t){var o=t(window);t.fn.visible=function(i,e,r,f){if(!(this.length<1)){r=r||"both";var n=this.length>1?this.eq(0):this,l=void 0!==f&&null!==f,h=l?t(f):o,g=l?h.position():0,u=n.get(0),p=h.outerWidth(),s=h.outerHeight(),b=!0!==e||u.offsetWidth*u.offsetHeight;if("function"==typeof u.getBoundingClientRect){var a=u.getBoundingClientRect(),c=l?a.top-g.top>=0&&a.top<s+g.top:a.top>=0&&a.top<s,v=l?a.bottom-g.top>0&&a.bottom<=s+g.top:a.bottom>0&&a.bottom<=s,d=l?a.left-g.left>=0&&a.left<p+g.left:a.left>=0&&a.left<p,m=l?a.right-g.left>0&&a.right<p+g.left:a.right>0&&a.right<=p,w=i?c||v:c&&v,y=i?d||m:d&&m;w=a.top<0&&a.bottom>s||w,y=a.left<0&&a.right>p||y;if("both"===r)return b&&w&&y;if("vertical"===r)return b&&w;if("horizontal"===r)return b&&y}else{var z=l?0:g,B=z+s,C=h.scrollLeft(),H=C+p,R=n.position(),W=R.top,j=W+n.height(),q=R.left,L=q+n.width(),Q=!0===i?j:W,k=!0===i?W:j,x=!0===i?L:q,A=!0===i?q:L;if("both"===r)return!!b&&k<=B&&Q>=z&&A<=H&&x>=C;if("vertical"===r)return!!b&&k<=B&&Q>=z;if("horizontal"===r)return!!b&&A<=H&&x>=C}}}}(jQuery);
            // Transition Option
            var win=$(window),allMods=$(".module");allMods.each(function(l,i){$(i).visible(!0)&&$(i).addClass("already-visible")}),win.scroll(function(l){allMods.each(function(l,i){(i=$(i)).visible(!0)?i.addClass("come-in"):i.removeClass("come-in already-visible")})});
          //]]>
        </script>