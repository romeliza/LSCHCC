<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Manage your dashboard with ease using NiceAdmin.">
  <meta name="keywords" content="dashboard, admin, bootstrap, template">
  <title>ERROR 404 | <?= $title ?></title>

  <!-- Favicons -->
  <link rel="icon" href="<?= base_url() ?>public/assets/favicon.ico">

  <link href="<?= base_url() ?>/public/assets/font/font.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/boxicons/css/boxicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/quill/quill.snow.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/quill/quill.bubble.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/remixicon/remixicon.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/simple-datatables/style.css">
  <!-- Main CSS File -->
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/style.css">
</head>

<body>

  <main>
    <div class="container">

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>404</h1>
        <h2>The page you are looking for doesn't exist.</h2>
        <h2>
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                <?= lang('Errors.sorryCannotFind') ?>
            <?php endif; ?>
        </h2>

        <!-- Just show the back button -->
        <p>If you are having trouble, please contact support.</p>
        <a class="btn" href="<?= base_url() ?>">Back to home</a>

      </section>

    </div>
  </main><!-- End #main -->

  <!-- Vendor JS Files -->
  <script src="<?= base_url() ?>public/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= base_url() ?>public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>public/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<?= base_url() ?>public/assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?= base_url() ?>public/assets/vendor/quill/quill.js"></script>
  <script src="<?= base_url() ?>public/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= base_url() ?>public/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= base_url() ?>public/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url() ?>public/assets/js/main.js"></script>

</body>

</html>
