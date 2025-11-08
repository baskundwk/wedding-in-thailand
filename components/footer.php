<footer class="wit-footer">
  <button class="wit-footer-backtotop">
    <i class="ph ph-caret-up"></i>
  </button>
  <div class="wit-footer-upper">
    <div class="container flex flex-col gap-4">
      <div class="wit-footer-logo">
        <a href="/"><img src="/assets/images/logo.svg" alt="Wedding in Thailand" title="Go to home page"/></a>
      </div>
      <div class="wit-footer-social">
        <a href="#"><img src="/assets/images/facebook.png" alt="Facebook" /></a>
        <a href="#"><img src="/assets/images/line.png" alt="Line" /></a>
        <a href="#"><img src="/assets/images/instagram.png" alt="Instagram" /></a>
        <a href="#"><img src="/assets/images/tiktok.png" alt="TikTok" /></a>
        <a href="#"><img src="/assets/images/lemon8.png" alt="Lemon8" /></a>
      </div>
      <nav class="wit-footer-menu">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'footer',
          'container' => false,
          'fallback_cb' => false,
          'items_wrap' => '<ul>%3$s</ul>',
        ));
        ?>
        
      </nav>
    </div>
  </div>
  <div class="wit-footer-lower">
    <div class="container">
      <div class="flex gap-x-6 gap-y-2 max-xl:flex-col">
        <a href="tel:063474811">063-474-811</a>
        <a href="mailto:marketing@weddinglist.co.th">marketing@weddinglist.co.th</a>
      </div>
      <p>©2025 Weddinglist. All right reserved.</p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>