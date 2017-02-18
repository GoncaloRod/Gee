  <div class="container caixa">
    <h1>Gerir Homepage</h1>

    <?php if ($alerta) { ?>
      <div class="alert alert-<?php echo $alerta['class'] ?>">
        <?php echo $alerta['mensagem']; ?>
      </div>
    <?php } ?>

    &nbsp;
    <form action="<?php echo base_url('Admin/GerirHomepage') ?>" method="post">
      <input type="hidden" name="captcha">

      <h3>Produtos em Destaque</h2>
      <?php if (count($produtos) < 4) { ?>
      <div class="alert alert-danger">
        São necessários pelo menos 4 produtos na base de dados para configurar os destaques!
      </div>
      <?php } else {?>
      <div class="row">
        <div class="col-md-3 form-group">
          <label for="SelectPdr1">Posição 1</label>
          <select class="form-control" id="SelectPdr1" name="selectPdr1">
            <?php for ($i=0; $i < count($produtos); $i++) { ?>
            <option value="<?php $nome = $produtos[$i]; echo $nome['PDR_ID']; ?>"><?php echo $nome['PDR_Nome']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-3 form-group">
          <label for="SelectPdr2">Posição 2</label>
          <select class="form-control" id="SelectPdr2" name="selectPdr2">
            <?php for ($i=0; $i < count($produtos); $i++) { ?>
            <option value="<?php $nome = $produtos[$i]; echo $nome['PDR_ID']; ?>"><?php echo $nome['PDR_Nome']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-3 form-group">
          <label for="SelectPdr3">Posição 3</label>
          <select class="form-control" id="SelectPdr3" name="selectPdr3">
            <?php for ($i=0; $i < count($produtos); $i++) { ?>
            <option value="<?php $nome = $produtos[$i]; echo $nome['PDR_ID']; ?>"><?php echo $nome['PDR_Nome']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-3 form-group">
          <label for="SelectPdr4">Posição 4</label>
          <select class="form-control" id="SelectPdr4" name="selectPdr4">
            <?php for ($i=0; $i < count($produtos); $i++) { ?>
            <option value="<?php $nome = $produtos[$i]; echo $nome['PDR_ID']; ?>"><?php echo $nome['PDR_Nome']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <?php } ?>
      &nbsp;
      <h3>Produtos em Promoções</h2>
      <?php if (count($produtosDesconto) < 4) { ?>
      <div class="alert alert-danger">
        São necessários pelo menos 4 produtos com desconto para configurar as promoções!
      </div>
      <?php } else {?>
      <div class="row">
        <div class="col-md-3 form-group">
          <label for="SelectPdrDesconto1">Posição 1</label>
          <select class="form-control" id="SelectPdrDesconto1" name="selectPdrDesconto1">
            <?php for ($i=0; $i < count($produtosDesconto); $i++) { ?>
            <option value="<?php $nome = $produtosDesconto[$i]; echo $nome['PDR_ID']; ?>"><?php echo $nome['PDR_Nome']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-3 form-group">
          <label for="SelectPdrDesconto2">Posição 2</label>
          <select class="form-control" id="SelectPdrDesconto2" name="selectPdrDesconto2">
            <?php for ($i=0; $i < count($produtosDesconto); $i++) { ?>
            <option value="<?php $nome = $produtosDesconto[$i]; echo $nome['PDR_ID']; ?>"><?php echo $nome['PDR_Nome']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-3 form-group">
          <label for="SelectPdrDesconto3">Posição 3</label>
          <select class="form-control" id="SelectPdrDesconto3" name="selectPdrDesconto3">
            <?php for ($i=0; $i < count($produtosDesconto); $i++) { ?>
            <option value="<?php $nome = $produtosDesconto[$i]; echo $nome['PDR_ID']; ?>"><?php echo $nome['PDR_Nome']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-3 form-group">
          <label for="SelectPdrDesconto4">Posição 4</label>
          <select class="form-control" id="SelectPdrDesconto4" name="selectPdrDesconto4">
            <?php for ($i=0; $i < count($produtosDesconto); $i++) { ?>
            <option value="<?php $nome = $produtosDesconto[$i]; echo $nome['PDR_ID']; ?>"><?php echo $nome['PDR_Nome']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <?php } ?>

      <button type="submit" class="btn btn-primary pull-right" name="guardar" value="guardar" <?php if ((count($produtos) < 4) || (count($produtosDesconto) < 4)) echo 'disabled'?>>Guardar</button>
    </form>
    <a href="<?php echo base_url('Admin') ?>"><button class="btn btn-default pull-right" style="margin-right: 10px;">Cancelar</button></a>
  </div>
</body>
</html>
