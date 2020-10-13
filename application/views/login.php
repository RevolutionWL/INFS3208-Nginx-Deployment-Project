<!DOCTYPE html>
<html>

<head>

    <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    <style type="text/css">
        body {
            background-color: #343a40;
        }

        .container h1 {
            margin-top: 60px;
            color: #fff;
        }

        .content {
            width: 50%;
            margin: 0 auto;
            border-radius: 3px;
            background: #f2f3f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 50px 30px;
        }

        .form-group:nth-child(2) {
            margin-bottom: 15px;
        }

        .g-recaptcha {
            margin-bottom: 20px;
        }

        .form-row a:first-child {
            color: grey;
        }
    </style>

    <title>RevoTube Login</title>

</head>

<body>
    <?php $this->load->view('header') ?>
    <div class="container">

        <br />
        <h1 align="center">RevoTube Login</h1>
        <br />

        <div class="content">

            <?php
            if ($this->session->flashdata('error')) {

                echo '<div class="alert alert-warning">
                                    ' . $this->session->flashdata("error") . '
                                </div>';
            } else if ($this->session->flashdata('message')) {

                echo '<div class="alert alert-success">
                                    ' . $this->session->flashdata("message") . '
                                </div>';
            }
            ?>

            <form method="post" action="<?php echo base_url(); ?>login/validation">

                <div class="form-group">
                    <label>Email address</label>
                    <input type="text" name="user_email" class="form-control" value="<?php if (get_cookie('email')) {
                                                                                            echo get_cookie('email');
                                                                                        } ?>" placeholder="Email Address">
                    <span class="text-danger"><?php echo form_error('user_email'); ?></span>

                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="user_pass" class="form-control" value="<?php if (get_cookie('password')) {
                                                                                            echo get_cookie('password');
                                                                                        } ?>" placeholder="Password">
                    <span class="text-danger"><?php echo form_error('user_pass'); ?></span>

                </div>
                <div class="form-group">
                    <input type="checkbox" name="setremember" value="remember" <?php if (get_cookie('email')) { ?> checked="checked" <?php } ?>> Remember me
                </div>
                <div class="g-recaptcha" data-sitekey="6LfCkP0UAAAAAPDtls0s0jcuB9Pi9SuzHKCQ-5rB"></div>
                <div class="form-row d-flex align-items-center">

                    <div class="mr-auto p-2"><a href="<?php echo base_url(); ?>forgot">Forgot Password?</a></div>
                    <a class="p-2" href="<?php echo base_url(); ?>register">Register</a>
                    <div class="p-2"><input type="submit" name="login" value="Login" class="btn btn-primary" /></div>

                </div>

            </form>

        </div>

    </div>

    </div>

</body>

</html>