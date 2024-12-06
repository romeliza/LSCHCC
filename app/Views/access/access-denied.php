<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>School Information System | <?= $title ?></title>

    <!-- Favicons -->
    <link rel="icon" href="<?= base_url() ?>public/image/LOGO_ICON.png">

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
    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Prevents scrolling */
        }

        body {
            background-color: #f8f9fa;
            color: #495057;
        }

        .error-404 {
            text-align: center;
            margin-top: 100px;
        }

        .error-404 h1 {
            font-size: 100px;
            font-weight: bold;
            color: #dc3545; /* Bootstrap danger color */
        }

        .error-404 h2 {
            font-size: 24px;
            margin: 20px 0;
        }

        .btn-primary {
            background-color: #007bff; /* Bootstrap primary color */
            border-color: #007bff;
            padding: 10px 20px;
            font-size: 18px;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker shade on hover */
            border-color: #0056b3;
        }

        .footer {
            margin-top: 50px;
            font-size: 14px;
            color: #868e96;
        }
    </style>
</head>

<body>

    <main>
        <div class="container">
            <section class="section error-404  d-flex flex-column align-items-center justify-content-center">
                <h1>Access Denied</h1>
                <p>You do not have permission to access this page.</p>
                <?php
$role = session()->get('userData')['Role'] ?? null;
$dashboardLink = '/'; // Default to the main page

if ($role === 'administrator') {
    $dashboardLink = 'dashboard';
} elseif ($role === 'dancer') {
    $dashboardLink = 'dancer/dashboard';
} elseif ($role === 'coach') {
    $dashboardLink = 'coach/dashboard';
}
?>

<a href="<?= base_url($dashboardLink); ?>" class="btn btn-primary">Go to Dashboard</a>

            </section>
        </div>
    </main>

</body>

</html>
