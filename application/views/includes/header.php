<!DOCTYPE html>
<html lang="pt-pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>
            <?php if(defined('TITLE')) { echo TITLE;  } else { echo "GeeK Store";} ?>
        </title>

        <!-- Bootstrap -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet">

        <!-- Bootstrap Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

        <!-- Custom Libaries -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/custom-bootstrap-menu.css'); ?>?<?php echo date('l jS \of F Y h:i:s A'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/custom-style.css'); ?>?<?php echo date('l jS \of F Y h:i:s A'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dropdown-login.css'); ?>?<?php echo date('l jS \of F Y h:i:s A'); ?>">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/img/favicon.ico'); ?>"/>

        <!-- Dropdown Submenu Script -->
        <script src="<?php echo base_url('assets/js/dropdown-submenu.js'); ?>"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menuprincipal" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/img/GeeK-Store-Logo.png'); ?>" height="100%"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="menuprincipal">
                    <ul class="nav navbar-nav">
                        <!-- Menu Items -->
                        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a></li><!-- Início -->
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <?php
                                if (!$this->session->userdata('logged_in'))
                                {
                            ?>
                            <a class="dropdown-toggle" data-toggle="dropdown">Login <span class="caret"></span></a>
                            <ul id="login-dp" class="dropdown-menu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form" role="form" method="post" action="<?php echo base_url('Conta/Entrar') ?>" accept-charset="UTF-8" id="login-nav">
                                                <input type="hidden" name="captcha">
                                                <div class="form-group">
                                                    <label for="Email">Email</label>
                                                    <input type="email" class="form-control" id="Email" placeholder="Email" name="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Password">Password</label>
                                                    <input type="password" class="form-control" id="Password" placeholder="Password" name="password" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-block" name="entrar" value="entrar">Iniciar Sessão</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="bottom text-center">
                                            <a href="<?php echo base_url('Conta/Registar'); ?>"><button class="btn btn-default btn-block">Registar</button></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <?php
                                }
                                else
                                {
                            ?>

                            <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle-o fa-lg" aria-hidden="true"></i> <?php echo $this->session->userdata('nome') .' '. $this->session->userdata('apelido'); ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu conta-opcoes">
                                <li><a href="<?php echo base_url('Conta/Sair'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Terminar Sessão</a></li>
                            </ul>

                            <?php
                                }
                            ?>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
