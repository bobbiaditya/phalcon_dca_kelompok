<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <title>DCA | Dwi Citra Anugerah</title> -->
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->assets->outputCss() ?>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        td,
        th {
            white-space: nowrap;
            width: 1%;
        }
    </style>
</head>

<title>Pemilik Truk</title>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed" style="font-size: 21px;">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="fas fa-user"></i>&nbsp;&nbsp;<?= $this->session->get('auth')['username'] ?>&nbsp;</a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-info"
                        aria-labelledby="navbarDropdownMenuLink-4">
                        <?php if ($this->session->get('auth')['username'] === 'master') { ?>
                        <a class="dropdown-item" href="<?= $this->url->get('user') ?>">List User</a>
                        <?php } ?>
                        <a class="dropdown-item" href="<?= $this->url->get('session/logout') ?>">Log out</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <span class="font-weight-bold brand-link" style="color:#343A40; background:#7CB1A6; padding-left: 13px;">
                <?= $this->tag->image(['img/DCA.png', 'class' => 'brand-image img-circle elevation-3', 'style' => 'opacity: .8']) ?>
                <span class="brand-text font-weight-bold" style="padding-left: 15%;">DCA</span>
            </span>
            <!-- Sidebar -->
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <?php if ($this->session->get('auth')['tipe'] === 'master') { ?>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clipboard"></i>
                                <p>
                                    Pendaftaran
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= $this->url->get('pemiliktruk') ?>" class="nav-link">
                                        <!-- <i class="nav-icon fas fa-truck"></i> -->
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Pemilik Truk
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= $this->url->get('supirtruk') ?>" class="nav-link">
                                        <!-- <i class="nav-icon fas fa-user-tie"></i> -->
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Supir
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= $this->url->get('pabrik') ?>" class="nav-link">
                                        <!-- <i class="nav-icon fas fa-warehouse"></i> -->
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Pabrik
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php } else { ?>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clipboard"></i>
                                <p>
                                    User Admin
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>  
                        </li>
                        
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            

<div class="container">
    <div class="card">
        <div class="card-header text-center" style="background-color:#343A40; color: #FFFFFF;">
            <strong>Pemilik Truk</strong>
        </div>
        <div class="card-header">
            <a href="<?= $this->url->get('/pemiliktruk/tambah') ?>" class="btn btn-primary btn-sm float-left"><span class="fas fa-plus"
                    style="padding-right: 7px;"></span>Input</a>
        </div>
        <div class="card-header text-success text-center">
            <?= $this->flashSession->output() ?>
        </div>
        <div class="card-body table-responsive p-0" style="height: 500px;">
            <table class="table table-bordered table-hover table-striped table-head-fixed">
                <thead>
                    <tr>
                        <th>Nama Pemilik Truk</th>
                        <th>OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pemilik as $p) { ?>
                    <tr>
                        <td><?= $p->nama_pemilik ?></td>
                        <td>
                            <a href="<?= $this->url->get('pemiliktruk/edit/' . $p->id_pemilik) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= $this->url->get('pemiliktruk/hapus/' . $p->id_pemilik) ?>"
                                class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

        </div>
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- jQuery -->
        <?= $this->assets->outputJs() ?>

</body>


</html>