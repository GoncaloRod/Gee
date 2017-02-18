  <div class="container">
    <div class="col-md-4 col-md-offset-4 caixa">
      <h1>Registar Admin</h1>
      <?php if ($alerta) { ?>
        <div class="alert alert-<?php echo $alerta['class'] ?>">
          <?php echo $alerta['mensagem']; ?>
        </div>
      <?php } ?>
      &nbsp;
      <form action="<?php echo base_url('Admin/Registar'); ?>" method="post">
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
          <label for="Password">Password</label>
          <input type="password" class="form-control" id="Password" placeholder="Password" name="password" required>
        </div>

        <div class="form-group">
          <label for="ConfirmarPassword">Confirmar Password</label>
          <input type="password" class="form-control" id="ConfirmarPassword" placeholder="Confirmar Password" name="confirmarPassword" required>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" name="adminMaster" value="true"> Permissões Master
          </label>
        </div>

        <button type="submit" class="btn btn-primary pull-right" name="registar" value="registar">Registar</button>
      </form>

      <a href="<?php echo base_url('Admin'); ?>"><button type="button" class="btn btn-default pull-right" style="margin-right: 10px;">Cancelar</button></a>
    </div>
  </div>

</body>
</html>
