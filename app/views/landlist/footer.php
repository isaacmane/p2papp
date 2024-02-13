  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span><?php echo date("Y"); ?></span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://datadealhub.com/">DataDealHub</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?=ASSETS?>vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?=ASSETS?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=ASSETS?>vendor/chart.js/chart.min.js"></script>
  <script src="<?=ASSETS?>vendor/echarts/echarts.min.js"></script>
  <script src="<?=ASSETS?>vendor/quill/quill.min.js"></script>
  <script src="<?=ASSETS?>vendor/simple-datatables/simple-datatables.js"></script>
  <!-- <script src="<?=ASSETS?>vendor/tinymce/tinymce.min.js"></script>-->
  <script src="<?=ASSETS?>vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?=ASSETS?>js/main.js"></script>

</body>

<script>
  window.addEventListener('beforeunload', function() {
  // Send an AJAX request to the server to let it know the user is leaving
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'end_session.php', false);
  xhr.send();
});
</script>

</html>