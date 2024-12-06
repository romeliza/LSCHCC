<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>LSCHCC  | <?= $title ?></title>

  <link rel="icon" href="<?= base_url() ?>public/image/LSCHCC.ico">
  <link href="<?= base_url() ?>public/assets/font/font.css" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/boxicons/css/boxicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/quill/quill.snow.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/quill/quill.bubble.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/remixicon/remixicon.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendor/simple-datatables/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/style.css">

  <style>
    /* Ensure that the HTML and body take full height */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    /* Ensure the section takes the full height of the viewport */
    .section.register {
      min-height: 100%;
    }

    /* Ensure the container takes full width and doesn't overflow */
    .container-fluid {
      height: 100%;
      width: 100%;
      padding: 0;
    }

    .gradient-text {
      color: #3498db; /* Blue color for text */
    }

    .gradient-border {
      position: relative;
      border-radius: 0.5rem;
      border: 2px solid #3498db; /* Blue border */
    }

    .gradient-border::before {
      content: '';
      position: absolute;
      top: -2px;
      left: -2px;
      right: -2px;
      bottom: -2px;
      border-radius: 0.5rem;
      background: #3498db; /* Blue border effect */
      z-index: -1;
    }

    /* New CSS class for the button */
    .gradient-btn {
      background-color: #3498db; /* Blue background for button */
      border: none;
      color: #fff;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 0.5rem;
      transition: background 0.4s ease-in-out;
    }

    .gradient-btn:hover {
      background-color: #2980b9; /* Darker blue on hover */
    }

    .input-gradient-border:focus {
      outline: none;
      border-color: transparent;
      box-shadow: 0 0 0 2px #3498db, 0 0 0 4px #2980b9; /* Blue focus box-shadow */
      transition: box-shadow 0.3s ease-in-out;
    }
  </style>

</head>

<body>