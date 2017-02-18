<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GeeK Store Admin - Dashboard</title>

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
          <a class="navbar-brand" href="<?php echo base_url('Admin'); ?>"><img src="<?php echo base_url('assets/img/GeeK-Store-Admin.png') ?>" height="100%"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="menuprincipal">
          <ul class="nav navbar-nav">
            <!-- Menu Items -->

            <!-- Inicio -->
            <li>
              <a href="<?php echo base_url('Admin'); ?>">
                <i class="fa fa-home fa-lg" aria-hidden="true"></i>
              </a>
            </li>

            <!-- Gerir Produtos -->
            <li>
              <a href="<?php echo base_url('Admin/GerirPdr'); ?>">Gerir Produtos</a>
            </li>

            <!-- Encomendas -->
            <li>
              <a href="<?php echo base_url('Admin/Encomendas'); ?>">Encomendas</span></a>
            </li>

            <!-- Gerir Homepage -->
            <li>
              <a href="<?php echo base_url('Admin/GerirHomepage'); ?>">Gerir Homepage</a>
            </li>

            <?php if ($this->session->userdata('admin_master')){ ?>
            <!-- Adicionar Administradores -->
            <li>
              <a href="<?php echo base_url('Admin/Registar'); ?>">Adicionar Administradores</a>
            </li>
            <!-- Consultar Alteracoes -->
            <li>
              <a href="<?php echo base_url('Admin/ConsultarAlteracoes'); ?>">Consultar Alterações</a>
            </li>
            <?php } ?>
          </ul>

          <!-- Utilizador logado -->
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle-o fa-lg" aria-hidden="true"></i> <?php echo $this->session->userdata('admin_nome') .' '. $this->session->userdata('admin_apelido'); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu conta-opcoes">
                <li><a href="<?php echo base_url('Admin/Sair'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Terminar Sessão</a></li>
              </ul>
            </li>
          </ul>

        </div><!-- .collapse .navbar-collapse #menuprincipal -->
      </div><!-- .container-fluid -->
    </nav><!-- .navbar .navbar-default -->
