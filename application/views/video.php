<html>

<head>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">

  <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <style type="text/css">
    .jumbotron {
      margin-bottom: 0;
      padding: 1% 0 0 0 !important;
      background-color: #fff;
    }

    @media (min-width: 768px) {
      .jumbotron {
        padding-bottom: 6rem;
      }
    }

    .jumbotron p:last-child {
      margin-bottom: 0;
    }

    .jumbotron h1 {
      font-weight: 300;
    }
    .btn {
      padding-left: 3% !important;
      padding-right: 3% !important;
    }

    footer {
      padding-top: 3rem;
      padding-bottom: 3rem;
    }

    footer p {
      margin-bottom: .25rem;
    }

    video {
      background: black;
    }
    .container {
      padding: 0 !important;
    }

    /* width */
    ::-webkit-scrollbar {
      width: 7px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #555;
    }
  </style>

  <title><?php echo $_SESSION['title']; ?></title>
</head>

<body>
  <?php $this->load->view('header') ?>
  <div class="container">

    <section class="jumbotron text-center mb-2">
      <video height=70% autoplay controls>
        <source src="<?= base_url() . 'uploads/' . $_SESSION['video'] ?>">
        <source src="<?= base_url() . 'uploads/' . $_SESSION['video'] ?>">
        Your browser does not support the video tag.
      </video>
    </section>
  </div>
  <div class="container mb-2">
    <div class="row justify-content-md-center">
      <a class="btn btn-outline-secondary mr-4" href="<?php echo base_url(); ?>video/download" role="button">Download</a>
      <a class="btn btn-secondary mr-4" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url(); ?>"target="_blank" role="button">Share on Facebook</a>
      <a class="btn btn-secondary" href="https://twitter.com/share?url=<?php echo current_url() . ' Look!'; ?>"target="_blank" role="button">Share on Twitter</a>
    </div>
  </div>

  <div class="py-5 bg-light" class="lg-8">
    <div class="container">
      <h1><?php echo ($_SESSION['title']) ?></h1>
      <h4 class="text-muted"><?php echo ($_SESSION['author']) ?></h4>
      <p class="lead text-muted"><?php echo ($_SESSION['description']) ?></p>
    </div>
    <!-- <?php var_dump($_SESSION) ?> -->
    <hr class="mb-4">
    <div class="container">
      <h4 class="mb-3">Comments</h4>
      <form method="post" action="<?php echo base_url(); ?>video/post">
        <div class="comment mb-4">
          <textarea name="comment" class="form-control mb-2" rows="2" placeholder="Add a comment..." required></textarea>
          <div class="d-flex flex-row-reverse">
            <input type="submit" class="btn btn-primary p-2" value="Post">
          </div>
        </div>
        <div id='allcomment'>
          <?php foreach (array_reverse($all_comment) as $comment) : ?>
            <div class="card mb-2">
              <div class="card-body">
                <h5 class="card-title"><?= $comment->user; ?></h5>
                <p class="card-text"><?= $comment->content; ?></p>
              </div>
            </div>
          <?php endforeach ?>
        </div>
    </div>
  </div>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>
  window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.5/js/vendor/jquery.slim.min.js"><\/script>')
</script>
<script src="https://getbootstrap.com/docs/4.5/dist/js/bootstrap.bundle.js"></script>

</html>