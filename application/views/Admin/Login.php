<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GeeK Store Admin - Login</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/img/favicon.ico'); ?>"/>

    <style>
      body {
        margin-top: 5%;
        background-color: #333;
      }

      .caixa {
        background-color: #EEE;
        border-radius: 10px;
        padding-top: 20px;
        padding-bottom: 20px;
      }

      .btn-primary,
      .btn-primary:hover,
      .btn-primary:active,
      .btn-primary:visited {
      	background-color: #005298;
      	border-color: #005298;
      }

      .btn-default,
      .btn-default:hover,
      .btn-default:active,
      .btn-default:visited {
      	background-color: #FFF;
      	border-color: #005298;
      	color: #005298;
        margin-right: 10px;
      }

      @media (max-width: 767px) {
        body {
          background-color: #EEE;
        }
      }

    </style>

  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4 caixa">
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <img src="<?php echo base_url('assets/img/GeeK-Store-Admin.png') ?>" width="100%">

              &nbsp;

              <?php
                if (isset($alerta))
                {
              ?>
              <div class="alert alert-<?php echo $alerta['class'] ?>">
    						<?php echo $alerta['mensagem']; ?>
    					</div>
              <?php
                }
              ?>

              <form action="<?php echo base_url('Admin') ?>" method="post">
                <input type="hidden" name="captcha">

                <div class="form-group">
                  <label for="id_admin">ID Administrador</label>
                  <input type="text" class="form-control" id="id_admin" placeholder="ID Administrador" name="id_admin" required>
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary pull-right" name="entrar" value="entrar">Entrar</button>
                </div>
              </form>

              <a href="<?php echo base_url(); ?>"><button class="btn btn-default pull-right" name="button">Cancelar</button></a>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
  </body>
</html>
