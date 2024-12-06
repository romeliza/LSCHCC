<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LSCHCC | <?= $title?></title>

  <!-- Favicons -->
  <link rel="icon" href="<?= base_url() ?>public/image/LSCHCC.ico">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/boxicons/css/boxicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/quill/quill.snow.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/quill/quill.bubble.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/remixicon/remixicon.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/simple-datatables/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/mermaid.min.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/sweetalert2/sweetalert.min.css">
  <script src="<?= base_url() ?>public/assets/vendor/sweetalert2/sweetalert@11.min.js"></script>
<!-- Include Flatpickr CSS -->
<link rel="stylesheet" href="<?= base_url() ?>public/assets/css/flatpickr.min.css">


  <!-- DataTables CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/bootstrap/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/bootstrap/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/flatpickr/flatpickr.min.css">
  <script src="<?= base_url() ?>public/assets/vendor/flatpickr/flatpickr.min.js"></script>
  <script src="<?= base_url() ?>public/assets/js/jquery.min.js"></script>
  <style>
    .sidebar-nav .active {
        background-color: #f0f0f0; /* or any other background color you prefer */
        border-left: 3px solid #337ab7; /* or any other border style you prefer */
    }

    /* Gradient Background for Header */
    #header {
        background: linear-gradient(90deg, #188DE0, #4e54c8, #8f94fb); /* Adjust colors as needed */
        color: #ffffff; /* Change text color for better contrast */
    }

    /* Make text in the header white */
    #header a {
        color: #ffffff; /* White text color for links */
        text-decoration: none; /* Optional: removes underline */
    }

    /* Optional: Change button color */
    #sidebarToggleBtn {
        color: #ffffff; /* White color for the toggle button icon */
    }

    /* Optional: Change button background on hover */
    #sidebarToggleBtn:hover {
        background-color: rgba(255, 255, 255, 0.1); /* Lighten button on hover */
    }
    .dropdown-menu {
    border-radius: 0.5rem; /* Rounded corners */
}

.dropdown-item {
    transition: background-color 0.3s; /* Smooth background color change */
}

.dropdown-item:hover {
    background-color: #f0f0f0; /* Change background on hover */
}
    /* Larger checkboxes */
    .checkbox-lg {
        width: 15px;
        height: 15px;
        transform: scale(1.5); /* Make the checkbox 1.5 times bigger */
        margin: auto; /* Center the checkbox in the cell */
    }

    /* Styling for the select all checkbox */
    #selectAllCheckbox {
        margin: 0;
    }

    /* Add some space around checkboxes */
    td input[type="checkbox"] {
        margin: 0;
    }

    /* Add some padding to the table cells to make the checkboxes look centered */
    td {
        padding: 10px;
    }

    /* Optional: Styling the select dropdown to match the checkboxes' design */
    select.form-select {
        font-size: 14px;
        padding: 5px;
    }
</style>

  <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/select2.min.css">
</head>
<body>
<?php include 'partials/navbar.php'; ?>

