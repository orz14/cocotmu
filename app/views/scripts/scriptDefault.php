    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.4.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <a class="top-nav" title="Back To Top"></a>
    <script type="text/javascript">
      //<![CDATA[
      // Preloader
      $(window).load(function(){$(".spinner").fadeOut(),$("#preloader").delay(350).fadeOut("slow"),$("body").delay(350).css({overflow:"visible"})});

      // Ripple Effect Click
      !(function (e) {
        e(".clickk").click(function (c) {
          let a = e(this);
          0 === a.find(".orz-ripple-effect").length && a.append("<span class='orz-ripple-effect'></span>");
          let b = a.find(".orz-ripple-effect");
          if ((b.removeClass("animate"), !b.height() && !b.width())) {
            let d = Math.max(a.outerWidth(), a.outerHeight());
            b.css({ height: d, width: d });
          }
          d = c.pageX - a.offset().left - b.width() / 2;
          c = c.pageY - a.offset().top - b.height() / 2;
          b.css({ top: c + "px", left: d + "px" }).addClass("animate");
        });
      })(jQuery);

      document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
      });

      function komen_modal(id_post) {
        $('#modalKomen').modal('show', {backdrop: 'static'});
        document.getElementById('ambil_id').setAttribute('value' , id_post);
      }
      
      $(window).scroll(function () {
        if ($(this).scrollTop() > 305) {
          $(".top-nav").fadeIn();
        } else {
          $(".top-nav").fadeOut();
        }
      });
      $(".top-nav").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 0);
        return false;
      });

      // Auto Reload
      setInterval(function() { $(".postingan").load("<?= BASEURL; ?>/refresh").fadeIn("slow"); }, 20000);

      // let _0xf6cf = [
      //   "\x6C\x69\x6E\x6B",
      //   "\x63\x72\x65\x61\x74\x65\x45\x6C\x65\x6D\x65\x6E\x74",
      //   "\x68\x72\x65\x66",
      //   "\x64\x61\x74\x61\x3A\x74\x65\x78\x74\x2F\x63\x73\x73\x3B\x62\x61\x73\x65\x36\x34\x2C",
      //   "\x72\x65\x6C",
      //   "\x73\x74\x79\x6C\x65\x73\x68\x65\x65\x74",
      //   "\x68\x65\x61\x64",
      //   "\x67\x65\x74\x45\x6C\x65\x6D\x65\x6E\x74\x73\x42\x79\x54\x61\x67\x4E\x61\x6D\x65",
      //   "\x61\x70\x70\x65\x6E\x64\x43\x68\x69\x6C\x64",
      //   "\x49\x32\x5A\x76\x62\x33\x52\x6C\x63\x69\x77\x75\x59\x33\x4A\x6C\x5A\x47\x6C\x30\x65\x33\x5A\x70\x63\x32\x6C\x69\x61\x57\x78\x70\x64\x48\x6B\x36\x64\x6D\x6C\x7A\x61\x57\x4A\x73\x5A\x53\x46\x70\x62\x58\x42\x76\x63\x6E\x52\x68\x62\x6E\x52\x39\x49\x32\x5A\x76\x62\x33\x52\x6C\x63\x6E\x74\x6B\x61\x58\x4E\x77\x62\x47\x46\x35\x4F\x6D\x4A\x73\x62\x32\x4E\x72\x49\x57\x6C\x74\x63\x47\x39\x79\x64\x47\x46\x75\x64\x48\x30\x75\x59\x33\x4A\x6C\x5A\x47\x6C\x30\x65\x32\x52\x70\x63\x33\x42\x73\x59\x58\x6B\x36\x64\x57\x35\x7A\x5A\x58\x51\x68\x61\x57\x31\x77\x62\x33\x4A\x30\x59\x57\x35\x30\x66\x51\x3D\x3D",
      //   "\x66\x6F\x6F\x74\x65\x72",
      //   "\x71\x75\x65\x72\x79\x53\x65\x6C\x65\x63\x74\x6F\x72",
      //   "\x66\x6F\x6F\x74\x65\x72\x20\x2E\x63\x72\x65\x64\x69\x74",
      //   "\x50\x45\x52\x49\x4E\x47\x41\x54\x41\x4E\x21\x20\x54\x45\x52\x44\x45\x54\x45\x4B\x53\x49\x20\x4D\x45\x4E\x47\x48\x41\x50\x55\x53\x20\x43\x52\x45\x44\x49\x54\x20\x4C\x49\x4E\x4B\x2E",
      //   "\x6C\x6F\x63\x61\x74\x69\x6F\x6E",
      //   "\x68\x74\x74\x70\x73\x3A\x2F\x2F\x6F\x72\x7A\x64\x65\x73\x69\x67\x6E\x2E\x73\x69\x74\x65",
      //   "\x69\x6E\x6E\x65\x72\x48\x54\x4D\x4C",
      //   "\x3C\x61\x20\x68\x72\x65\x66\x3D\x27\x68\x74\x74\x70\x73\x3A\x2F\x2F\x6F\x72\x7A\x64\x65\x73\x69\x67\x6E\x2E\x73\x69\x74\x65\x27\x20\x74\x61\x72\x67\x65\x74\x3D\x27\x5F\x62\x6C\x61\x6E\x6B\x27\x3E\x4F\x52\x5A\x43\x4F\x44\x45\x3C\x2F\x61\x3E",
      // ];
      // function stone(_0xc76dx2) {
      //   const _0xc76dx3 = document[_0xf6cf[1]](_0xf6cf[0]);
      //   _0xc76dx3[_0xf6cf[2]] = _0xf6cf[3] + _0xc76dx2;
      //   _0xc76dx3[_0xf6cf[4]] = _0xf6cf[5];
      //   document[_0xf6cf[6]] = document[_0xf6cf[6]] || document[_0xf6cf[7]](_0xf6cf[6])[0];
      //   document[_0xf6cf[6]][_0xf6cf[8]](_0xc76dx3);
      // }
      // stone(_0xf6cf[9]);
      // const footer = document[_0xf6cf[11]](_0xf6cf[10]);
      // const credit = document[_0xf6cf[11]](_0xf6cf[12]);
      // if (!footer || !credit) {
      //   alert(_0xf6cf[13]);
      //   document[_0xf6cf[14]][_0xf6cf[2]] = _0xf6cf[15];
      // } else {
      //   credit[_0xf6cf[16]] = _0xf6cf[17];
      // }
      // LazyLoad
      function loadScript(d){var o=document.createElement("script");o.src=d,document.body.appendChild(o)}function downloadJSAtOnload(){loadScript("https://cdn.jsdelivr.net/gh/Arlina-Design/phantom@master/lazyarlinas.js")}window.addEventListener?window.addEventListener("load",downloadJSAtOnload,!1):window.attachEvent?window.attachEvent("onload",downloadJSAtOnload):window.onload=downloadJSAtOnload;
      // Transition
      !function(t){var o=t(window);t.fn.visible=function(i,e,r,f){if(!(this.length<1)){r=r||"both";var n=this.length>1?this.eq(0):this,l=void 0!==f&&null!==f,h=l?t(f):o,g=l?h.position():0,u=n.get(0),p=h.outerWidth(),s=h.outerHeight(),b=!0!==e||u.offsetWidth*u.offsetHeight;if("function"==typeof u.getBoundingClientRect){var a=u.getBoundingClientRect(),c=l?a.top-g.top>=0&&a.top<s+g.top:a.top>=0&&a.top<s,v=l?a.bottom-g.top>0&&a.bottom<=s+g.top:a.bottom>0&&a.bottom<=s,d=l?a.left-g.left>=0&&a.left<p+g.left:a.left>=0&&a.left<p,m=l?a.right-g.left>0&&a.right<p+g.left:a.right>0&&a.right<=p,w=i?c||v:c&&v,y=i?d||m:d&&m;w=a.top<0&&a.bottom>s||w,y=a.left<0&&a.right>p||y;if("both"===r)return b&&w&&y;if("vertical"===r)return b&&w;if("horizontal"===r)return b&&y}else{var z=l?0:g,B=z+s,C=h.scrollLeft(),H=C+p,R=n.position(),W=R.top,j=W+n.height(),q=R.left,L=q+n.width(),Q=!0===i?j:W,k=!0===i?W:j,x=!0===i?L:q,A=!0===i?q:L;if("both"===r)return!!b&&k<=B&&Q>=z&&A<=H&&x>=C;if("vertical"===r)return!!b&&k<=B&&Q>=z;if("horizontal"===r)return!!b&&A<=H&&x>=C}}}}(jQuery);
      // Transition Option
      var win=$(window),allMods=$(".module");allMods.each(function(l,i){$(i).visible(!0)&&$(i).addClass("already-visible")}),win.scroll(function(l){allMods.each(function(l,i){(i=$(i)).visible(!0)?i.addClass("come-in"):i.removeClass("come-in already-visible")})});
      //]]>
    </script>
    