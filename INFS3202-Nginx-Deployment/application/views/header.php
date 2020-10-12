<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand" href="<?= base_url() . 'home' ?>">RevoTube</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url() . 'home' ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <!-- php syntax for if log in -->
                <?php if (isset($_SESSION['id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() . 'upload' ?>">Upload</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['name']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?= base_url() . 'profile' ?>">My Profile</a>
                            <a class="dropdown-item" href="<?= base_url() . 'home/logout' ?>">Log Out</a>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() . 'login' ?>">Login <span class="sr-only">(current)</span></a>
                    </li>
                <?php } ?>

        </div>
    </div>
</nav>