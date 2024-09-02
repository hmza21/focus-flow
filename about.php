<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Organize your tasks and notes with ease in Focus Flow, completely for free!">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/common/base.css">
  <link rel="stylesheet" href="css/common/structure.css">
  <link rel="stylesheet" href="css/about.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka&display=swap" rel="stylesheet">


  <title>About - Focus Flow</title>

  <link rel="shortcut icon" href="assets/icons/favicon.ico" type="image/x-icon">

</head>

<body>

  <img src="assets/images/bg_2.jpg" alt="Background" id="background">

  <?php require 'components/header.php'; ?>

  <main id="content">

    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
          aria-label="Slide 4"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/demo/ss-logo.png" class="d-block w-100 pic" alt="Logo">
          <div class="carousel-caption d-none d-md-block">
        <h5>Welcome to the new productivity experience!</h5>
      </div>

        </div>
        <div class="carousel-item">
          <img src="assets/demo/ss-tasks.png" class="d-block w-100 pic" alt="Tasks">
          <div class="carousel-caption d-none d-md-block">
        <h5>Organize your tasks!</h5>
      </div>

        </div>
        <div class="carousel-item">
          <img src="assets/demo/ss-notes.png" class="d-block w-100 pic" alt="Notes">
          <div class="carousel-caption d-none d-md-block">
        <h5>Save notes on the go!</h5>
      </div>

        </div>
        <div class="carousel-item">
          <img src="assets/demo/ss-responsive.png" class="d-block w-100 pic" alt="Platforms">
          <div class="carousel-caption d-none d-md-block">
        <h5>Whether you're in the office or on the fly!</h5>
      </div>

        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <section class="text-grp">
      <p>
        Our unique sticky notes feature, Focus Flow, helps you stay on track with your tasks. By organizing your thoughts visually, you can prioritize and tackle your to-dos with ease.
      </p>
      <div class="demo-note">
        <h5><b>Sticky Notes!</b></h5>
        <h6 class="note-content">It's like having a personal productivity board right on your screen!</h6>
      </div>
    </section>

  </main>

  <?php require 'components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

</body>

</html>