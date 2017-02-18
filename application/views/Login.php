<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4 caixa">
      <h3>Login</h3>

      <?php if ($alerta) { ?>
        <div class="alert alert-<?php echo $alerta['class'] ?>">
          <?php echo $alerta['mensagem']; ?>
        </div>
      <?php } ?>

      <form action="<?php echo base_url('Conta/Entrar') ?>" method="post">
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
          <button type="submit" class="btn btn-primary pull-right" name="entrar" value="entrar">Entrar</button>
        </div>
      </form>

      <a href="<?php echo base_url(); ?>"><button class="btn btn-default pull-right" name="button" style="margin-right: 10px;">Cancelar</button></a>
		</div> <!-- .col-md-6 .col-md-offset-3 .caixa -->
	</div> <!-- .row -->
</div> <!-- .container -->
