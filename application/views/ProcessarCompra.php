<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8 caixa">
			<h3>Concluir a compra</h3>
			&nbsp;
			<h4>Produtos:</h4>
			<h5>
				<?php
					echo $produto['PDR_Nome'];
				?>
			</h5>
			&nbsp;
			<h4>Valor a Pagar:</h4>
			<h5>
				<?php
					echo $produto['PDR_Preco'] - ($produto['PDR_Preco'] * ($produto['PDR_Desconto'] / 100)). ' €';
				?>
			</h5>
			&nbsp;

			<a href="<?php echo base_url('Loja/ConcluirCompra/'). $produto['PDR_ID']; ?>"><button class="btn btn-primary pull-right"><i class="fa fa-times" aria-hidden="true"></i> Concluir Compra</button></a>
			<a href="<?php echo base_url(); ?>"><button class="btn btn-default pull-right" style="margin-right: 10px;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar Compra</button></a>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>
