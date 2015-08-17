    <footer id="site-footer">
      <div class="container">
        <div class="row">
          <!--<span class="divider grey"></span>-->
          <h4><?php apply_filters('iosys_footerCopyRight', null); ?></h4>
<!--          <h4>2014 Bond<span class="brandy">y</span> Agency.</h4>
          <h5>by <a href="http://www.scoopthemes.com" target="_blank">ScoopThemes</a></h5>-->
          <a href="#" class="scroll-top"><img src="img/top.png" alt="" class="top"></a>
        </div>
      </div>
    </footer>
  </div>
  <!--/wrap-->
  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/stellar.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/jquery.easypiechart.min.js"></script>

  <!-- jQuery REVOLUTION Slider  -->
  <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
  <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

  <script src="js/waypoints.min.js"></script>

<!--  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc&sensor=false"></script>-->
  <script src="js/script.js"></script>

  <script>
  $(document).ready(function() {
      appMaster.preLoader();
      appMaster.smoothScroll();
      appMaster.animateScript();
      appMaster.navSpy();
      appMaster.revSlider();
      appMaster.stellar();
      appMaster.skillsChart();
      appMaster.maps();
      appMaster.isoTop();
      appMaster.canvasHack();

      $('.home-ad .close').on('click', function(){
          $(this).parent().toggle('fast');
      });
  });
  </script>

<?php wp_footer(); ?>
</body>

</html>