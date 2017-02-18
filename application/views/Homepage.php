<div class="container">
  <?php if ($destaques) { ?>
  <div class="row caixa">
    <h1>Destaques</h1>
    <?php for ($i=0; $i < count($destaques); $i++) { $produto = $destaques[$i]; ?>
    <div class="col-md-3">
        <img class="miniatura-produto"  src="<?php echo base_url('assets/img/Produtos/'). $produto['PDR_Imagem']; ?>"><br>

        <div class="item-caixa-produto">
            <?php echo $produto['PDR_Nome']; ?>
        </div>

        <div class="item-caixa-produto">
            <?php if (!$produto['PDR_Desconto']) { ?>
            <b><?php echo $produto['PDR_Preco']. '€'; ?></b>
            <?php } else { $procoDesconto = $produto['PDR_Preco'] - ($produto['PDR_Preco'] * ($produto['PDR_Desconto'] / 100)); ?>
            <del><?php echo $produto['PDR_Preco']. '€'; ?></del> <b><?php echo  $procoDesconto. '€' ?></b>
            <?php } ?>
        </div>

        <div class="item-caixa-produto">
            <span class="stock"><i class="fa fa-check-circle-o fa-lg" aria-hidden="true"></i> Disponível</span>
        </div>

        <div class="item-caixa-produto">
            <a href="<?php if($this->session->userdata('logged_in')) echo base_url('Loja/ProcessarCompra/'). $produto['PDR_ID']; else echo base_url('Conta/Entrar')?>"><button type="button" class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Comprar</button></a>
        </div>
    </div>
    <?php } ?>
  </div>
  <?php } ?>

  <?php if ($promocoes) { ?>
  <div class="row caixa">
    <h1>Promoções</h1>
    <?php for ($i=0; $i < count($promocoes); $i++) { $produto = $promocoes[$i]; ?>
    <div class="col-md-3">
        <img class="miniatura-produto"  src="<?php echo base_url('assets/img/Produtos/'). $produto['PDR_Imagem']; ?>"><br>

        <div class="item-caixa-produto">
            <?php echo $produto['PDR_Nome']; ?>
        </div>

        <div class="item-caixa-produto">
            <?php if (!$produto['PDR_Desconto']) { ?>
            <b><?php echo $produto['PDR_Preco']; ?></b>
            <?php } else { $procoDesconto = $produto['PDR_Preco'] - ($produto['PDR_Preco'] * ($produto['PDR_Desconto'] / 100)); ?>
            <del><?php echo $produto['PDR_Preco']. '€'; ?></del> <b><?php echo  $procoDesconto. '€' ?></b>
            <?php } ?>
        </div>

        <div class="item-caixa-produto">
            <span class="stock"><i class="fa fa-check-circle-o fa-lg" aria-hidden="true"></i> Disponível</span>
        </div>

        <div class="item-caixa-produto">
            <a href=""><button type="button" class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Comprar</button></a>
        </div>
    </div>
    <?php } ?>
  </div>
  <?php } ?>
</div>
