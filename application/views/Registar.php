<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 caixa">
			<h3>Registar</h3>

			<?php if ($alerta) { ?>
        <div class="alert alert-<?php echo $alerta['class'] ?>">
          <?php echo $alerta['mensagem']; ?>
        </div>
      <?php } ?>

			<form class="form" role="form" method="post" action="<?php echo base_url('Conta/Registar') ?>" accept-charset="UTF-8" id="login-nav">
				<input type="hidden" name="captcha">
				<div class="form-group">
					<label for="Nome">Nome</label>
					<input type="text" class="form-control" id="Nome" placeholder="Nome" name="nome" required>
				</div>

				<div class="form-group">
					<label for="Apelido">Apelido</label>
					<input type="text" class="form-control" id="Apelido" placeholder="Apelido" name="apelido" required>
				</div>

				<div class="form-group">
					<label for="Email">Email</label>
					<input type="email" class="form-control" id="Email" placeholder="Email" name="email" required>
				</div>

				<div class="form-group">
					<label for="Password">Password</label>
					<input type="password" class="form-control" id="Password" placeholder="Password" name="password" required>
				</div>

				<div class="form-group">
					<label for="ConfirmarPassword">Confirmar Password</label>
					<input type="password" class="form-control" id="ConfirmarPassword" placeholder="Confirmar Password" name="confrimarPassword" required>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary pull-right" name="registar" value="registar">Registar</button>
				</div>
			</form>

			<a href="<?php echo base_url(); ?>"><button class="btn btn-default pull-right" name="button" style="margin-right: 10px;">Cancelar</button></a>
		</div> <!-- .col-md-6 .col-md-offset-3 .caixa -->
	</div> <!-- .row -->
</div> <!-- .container -->
