<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css">


    <style>
        .jumbotron {
            padding-top: 3rem;
            padding-bottom: 3rem;
            margin-bottom: 0;
            background-color: #fff;
        }

        @media (min-width: 768px) {
            .jumbotron {
                padding-top: 6rem;
                padding-bottom: 6rem;
            }
        }

        .jumbotron p:last-child {
            margin-bottom: 0;
        }

        .jumbotron h1 {
            font-weight: 300;
        }

        .jumbotron .container {
            max-width: 40rem;
        }

        .video-bg {
            background-color: #000;
            border-radius: 3px 3px 0 0;
        }
    </style>

    <title>RevoTube</title>

</head>

<body>
    <header>
        <?php $this->load->view('header'); ?>
    </header>

    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1>7 Please onnegai~~ Senpai</h1>
                <p class="lead text-muted">Search for any videos!</p>
                <form class="form-inline row justify-content-md-center" method="post" action="<?php echo base_url() . 'home/search'; ?>">
                    <input class="form-control col-8 mr-sm-2" type="search" name="keyword" placeholder="Search">
                    <input class="btn btn-outline-success col-3" type="submit" value="Search"></input>
                </form>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <?php if (isset($search)) { ?>
                    <h3 class="result">Search results for <?php echo $key ?>:</h3>
                <?php } ?>
                <?php if ($vid_list) { ?>
                    <div class="row">
                        <?php foreach (array_reverse($vid_list) as $vid) : ?>
                            <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <div class="video-bg">
                                        <a class="video" href="<?= base_url() . 'video/play/' . $vid->vid_id; ?>" target="_self"><video src="<?= base_url() . 'uploads/' . $vid->video; ?>" width="100%" height="225"></a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-truncate"><?= $vid->title; ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><?= $vid->author; ?></h6>
                                        <p class="card-text text-truncate"><?= $vid->description; ?></p>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php } else { ?>
                        <p class="lead text-muted">There are currently no videos available.</p>
                    </div>
                <?php } ?>
            </div>
        </div>

    </main>
    <?php if ($this->session->flashdata()) { ?>
        <script>
            if (Notification.permission === "granted") {
                var text = 'OWO you uploaded a video <?php echo $video ?>';
                var notification = new Notification('UwU', {
                    body: text
                });
            }
        </script>
    <?php } ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        Notification.requestPermission().then(function(result) {
            console.log(result);
        });
        window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.5/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="https://getbootstrap.com/docs/4.5/dist/js/bootstrap.bundle.js"></script>
</body>

</html>