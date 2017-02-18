  <div class="container caixa">
    <h1>Remover Produto</h1>

    <?php if ($alerta) { ?>
      <div class="alert alert-<?php echo $alerta['class'] ?>">
        <?php echo $alerta['mensagem']; ?>
      </div>
    <?php } ?>

    <a href="<?php echo base_url('Admin/GerirPdr'); ?>"><button class="btn btn-default pull-right">Voltar</button></a>
  </div>
</body>
</html>
