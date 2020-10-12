<!DOCTYPE html>
<html>

<head>

    <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        body {
            color: #fff;
            background: #343a40;
        }

        .container h1 {
            margin-top: 60px;
            margin-bottom: 40px;
        }

        .content {
            width: 700px;
            margin: 0 auto;
            color: black;
            border-radius: 3px;
            background: #f2f3f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 50px 30px 20px 30px;
        }
    </style>

    <title>Reset Password - Revotube</title>

</head>

<body>
    <?php $this->load->view('header') ?>
    <div class="container">
        <h1 align="center">Reset Password</h1>
        <div class="content">
            <?php
            if ($this->session->flashdata('error')) {

                echo '<div class="alert alert-warning">
                                ' . $this->session->flashdata("error") . '
                                </div>';
            }
            ?>
            <form method="post" action="<?php echo base_url(); ?>forgot/reset" role="form">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Password</label>
                    <div class="col-lg-9">
                        <input type="password" name="password" class="form-control" value="<?php echo set_value('password'); ?>" />
                        <span class="text-danger"><?php echo form_error('password'); ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Re-enter Password</label>
                    <div class="col-lg-9">
                        <input type="password" name="rpassword" class="form-control" value="<?php echo set_value('rpassword'); ?>" />
                        <span class="text-danger"><?php echo form_error('rpassword'); ?></span>
                    </div>
                </div>
                <div align="right">
                    <input type="submit" class="btn btn-primary" value="Confirm">
                </div>
            </form>
        </div>
    </div>
</body>

</html>