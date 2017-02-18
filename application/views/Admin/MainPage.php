  <div class="container caixa">
    <h1>Tarefas</h1>
    <div class="row">
      <!-- Encomendas Pendentes -->
      <div class="col-md-4">
        <div class="row">
          <a href="<?php echo base_url('Admin/EncomendasPendentes/1') ?>">
            <div class="col-md-10 col-md-offset-1 mini-box laranja">
              <div class="row">
                <div class="col-md-3">
                  <i class="fa fa-clock-o fa-5x" aria-hidden="true"></i>
                </div>
                <div class="col-md-9 text-right">
                  <div class="texto-grande"><?php echo $tarefas['EncPendentes']; ?></div>
                  <div class="descricao">Encomendas Pendentes</div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!-- Produtos em Baixa -->
      <div class="col-md-4">
        <div class="row">
          <a href="<?php echo base_url('Admin/ProdutosBaixa'); ?>">
            <div class="col-md-10 col-md-offset-1 mini-box vermelho">
              <div class="row">
                <div class="col-md-3">
                  <i class="fa fa-level-down fa-5x" aria-hidden="true"></i>
                </div>
                <div class="col-md-9 text-right">
                  <div class="texto-grande"><?php echo $tarefas['PdrBaixa']; ?></div>
                  <div class="descricao">Produtos em Baixa</div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!--Encomendas para Envio  -->
      <div class="col-md-4">
        <div class="row">
          <a href="<?php echo base_url('Admin/EncomendasEnvio'); ?>">
            <div class="col-md-10 col-md-offset-1 mini-box verde">
              <div class="row">
                <div class="col-md-3">
                  <i class="fa fa-truck fa-5x" aria-hidden="true"></i>
                </div>
                <div class="col-md-9 text-right">
                  <div class="texto-grande"><?php echo $tarefas['EncEnvio']; ?></div>
                  <div class="descricao">Encomendas para Envio</div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

  </div>
</body>
</html>
