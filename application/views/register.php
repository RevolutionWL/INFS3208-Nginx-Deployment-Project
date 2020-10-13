<!DOCTYPE html>
<html>

<head>
    <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Script for refreshing captcha -->
    <script>
        $(document).ready(function() {
            $('.refreshCaptcha').on('click', function() {
                $.get('<?php echo base_url() . 'register/refresh'; ?>', function(data) {
                    $('#captImg').html(data);
                });
            });
        });
    </script>

    <style type="text/css">
        body {
            background: #343a40;
        }

        .panel-head {
            width: 50%;
            margin: 0 auto;
            border-radius: 3px;
            margin-bottom: 15px;
            background: #f2f3f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .panel-head h3 {
            color: #636363;
            margin: 0 0 15px;
            position: relative;
            text-align: center;
        }

        .panel-head h3:before,
        .panel-head h3:after {
            content: "";
            height: 2px;
            width: 20%;
            background: #d4d4d4;
            position: absolute;
            top: 50%;
            z-index: 2;
        }

        .panel-head h3:before {
            left: 0;
        }

        .panel-head h3:after {
            right: 0;
        }

        h1 {
            color: #fff;
            margin-top: 60px;
        }
    </style>

    <title>RevoTube Register</title>

</head>

<body>
    <?php $this->load->view('header') ?>
    <div class="container">
        <h1 class="mb-4" align="center">Register An Account</h1>

        <div class="panel-head">

            <div class="panel-body">
                <?php
                if ($this->session->flashdata('message')) {

                    echo '<div class="alert alert-success">
                                ' . $this->session->flashdata("message") . '
                                </div>';
                } else if ($this->session->flashdata('error')) {

                    echo '<div class="alert alert-danger">
                                ' . $this->session->flashdata("error") . '
                                </div>';
                }
                ?>

                <form method="post" action="<?php echo base_url(); ?>register/validation">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="user_name" class="form-control" value="<?php echo set_value('user_name'); ?>" />
                        <span class="text-danger"><?php echo form_error('user_name'); ?></span>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" name="user_email" class="form-control" value="<?php echo set_value('user_email'); ?>" />
                        <span class="text-danger"><?php echo form_error('user_email'); ?></span>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="user_pass" class="form-control" value="<?php echo set_value('user_pass'); ?>" />
                        <small class="form-text text-muted">Passwords must contain at least a symbol, uppercase and lower case letters, and a number. </small>
                        <span class="text-danger"><?php echo form_error('user_pass'); ?></span>
                    </div>
                    <hr class="mb-3" />
                    <div class="form-group">
                        <label>To continue, type the characters you see in the picture.</label>
                        <div id="captImg"><?php echo $captchaImg; ?></div>
                        <small class="text-muted">Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</small>
                        <input type="text" class="form-control" name="captcha" value="" />
                    </div>

                    <div class="form-group">
                        <input type="submit" name="register" class="btn btn-primary" value="Register" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo base_url(); ?>login">Login</a>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>