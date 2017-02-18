<div class="container caixa">
  <?php if ($alerta) { ?>
    <div class="alert alert-<?php echo $alerta['class'] ?>">
      <?php echo $alerta['mensagem']; ?>
    </div>
  <?php } ?>

  <a href="<?php echo base_url(); ?>"><button type="button" class="btn btn-primary pull-right">OK</button></a>
</div>
