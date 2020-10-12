<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .btn {
            width: 100%;
        }

        .center {
            margin: 0 auto;
        }
    </style>
</head>

<body class="bg-light">
    <?php $this->load->view('header'); ?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Profile</h2>
            <p class="lead">Update your details by filling in the fields below.</p>
        </div>
        <div class="col-md-9 order-md-2 center">
            <h4 class="mb-3">Update Profile</h4>
            <form method="post" action="<?php echo base_url(); ?>profile/save" role="form">
            <?php
            if ($this->session->flashdata('success')) {

                echo '<div class="alert alert-success">
                                ' . $this->session->flashdata("success") . '
                                </div>';
            }
            ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input class="form-control" type="text" name="firstname" value="<?php echo $_SESSION['firstname']; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input class="form-control" name="lastname" type="text" value="<?php echo $_SESSION['lastname']; ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input class="form-control" type="text" id="username" value="<?php echo $_SESSION['name']; ?>" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" value="<?php echo $_SESSION['email']; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="address">Contact</label>
                    <input class="form-control" name="contact" type="text" value="<?php echo $_SESSION['contact']; ?>">
                    <span class="text-danger"><?php echo form_error('contact'); ?></span>
                </div>
                <hr class="mb-4">
                <div class="form-group row">
                    <div class="col-md-6 mb-3">
                        <input type="reset" class="btn btn-info" value="Cancel">
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2020 RevoTube</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.5/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="https://getbootstrap.com/docs/4.5/dist/js/bootstrap.bundle.js"></script>
</body>

</html>