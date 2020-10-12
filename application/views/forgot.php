<!DOCTYPE html>
<html>

<head>

    <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet">

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
            if ($this->session->flashdata('message')) {

                echo '<div class="alert alert-success">
                                ' . $this->session->flashdata("message") . '
                                </div>';
            }
            ?>
            <form method="post" action="<?php echo base_url(); ?>forgot/sendlink" role="form">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                    <div class="col-lg-9">
                        <input type="text" name="user_email" class="form-control" value="<?php echo set_value('user_email'); ?>" />
                        <span class="text-danger"><?php echo form_error('user_email'); ?></span>
                        <small class="text-muted">Please enter your email address so that we can send you a link to reset your password. </small>
                    </div>
                </div>

                <div align="right">
                    <input type="submit" class="btn btn-primary" value="Send">
                </div>
            </form>
        </div>
    </div>
</body>

</html>