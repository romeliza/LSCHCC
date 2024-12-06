<!-- Footer -->
<footer id="footer" class="footer">
  <div class="copyright">
    <span id="currentYear"></span> <strong><span>LAKE SEBU COMMUNITY HEALTH CARE COMPLEX</span></strong>. 
  </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= base_url() ?>public/assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url() ?>public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>public/assets/vendor/chart.js/chart.umd.js"></script>
<script src="<?= base_url() ?>public/assets/vendor/echarts/echarts.min.js"></script>
<script src="<?= base_url() ?>public/assets/vendor/quill/quill.js"></script>
<script src="<?= base_url() ?>public/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="<?= base_url() ?>public/assets/vendor/php-email-form/validate.js"></script>

<script src="<?= base_url() ?>public/assets/js/xlsx.full.min.js"></script>
<!-- jQuery and DataTables JS -->

<script src="<?= base_url() ?>public/assets/js/filter.js"></script>
<script src="<?= base_url() ?>public/assets/js/jquery.dataTables.min.js"></script>

<script src="<?= base_url() ?>public/assets/js/select2.min.js"></script>
<script src="<?= base_url() ?>public/assets/js/flatpickr.js"></script>
<script src="<?= base_url() ?>public/assets/js/gridjs.umd.min.js"></script>
<script>
$(document).ready(function () {
  $('#MIMTable').DataTable({
    "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
    "ordering": false,
    "pageLength": 10,
    "dom": '<"row mb-3"<"col-md-6"l><"col-md-6"f>>tr' +
           '<"row mt-3"<"col-md-5"i><"col-md-7"p>>',
  
});
    $('.select2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%',
        
    });
});
</script>

<script src="<?= base_url() ?>public/assets/js/main.js"></script>
<script src="<?= base_url() ?>public/assets/js/datetime.js"></script>
</body>
</html>
