  <div class="container">
    <div class="row">
      <div class="col-md-4 caixa col-md-offset-4">
        <h1>Editar Produto</h1>

        <?php if ($alerta) { ?>
          <div class="alert alert-<?php echo $alerta['class'] ?>">
            <?php echo $alerta['mensagem']; ?>
          </div>
        <?php } ?>

          <?php if ($produto) { ?>
            <form action="<?php echo base_url('Admin/EditarPdr/'). $produto['PDR_ID']; ?>" method="post">
              <input type="hidden" name="captcha">
              <input type="hidden" name="id_produto" value="<?php echo $produto['PDR_ID'] ?>">

              <div class="form-group">
                <label for="Nome">Nome</label>
                <input type="text" class="form-control" id="Nome" name="nome" value="<?php echo $produto['PDR_Nome']; ?>" required>
              </div>
              <div class="form-group">
                <label for="Preco">Preço</label>
                <input type="text" class="form-control" id="Preco" name="preco" value="<?php echo $produto['PDR_Preco']; ?>" required>
              </div>
              <div class="form-group">
                <label for="IVA">IVA</label>
                <input type="text" class="form-control" id="IVA" name="percentagemIVA" value="<?php echo $produto['PDR_IVA']; ?>" required>
              </div>
              <div class="form-group">
                <label for="Quantidade">Quantidade</label>
                <input type="text" class="form-control" id="Quantidade" name="quantidade" value="<?php echo $produto['PDR_Quantidade']; ?>" required>
              </div>
              <div class="form-group">
                <label for="Desconto">Desconto</label>
                <input type="text" class="form-control" id="Desconto" name="desconto" value="<?php echo $produto['PDR_Desconto']; ?>" required>
              </div>

              <button type="submit" class="btn btn-primary pull-right" name="guardar" value="guardar">Guardar</button>
            </form>

            <a href="<?php echo base_url('Admin/GerirPdr'); ?>"><button type="button" class="btn btn-default pull-right" style="margin-right: 10px;">Cancelar</button></a>
          <?php } ?>
      </div>
    </div>
  </div>
</body>
</html>
