  <div class="container caixa">
    <h2>Filtros</h2>
    <form class="" action="<?php echo base_url('Admin/GerirPdr') ?>" method="post">
      <div class="row">
        <!-- Select Marca -->
        <div class="col-md-2 form-group">
          <label for="SelectMarca">Marca</label>
          <select class="form-control" id="SelectMarca" name="selectMarca">
            <option value="Todas">Todas</option>
            <?php for ($i=0; $i < count($marcas); $i++) { ?>
            <option value="<?php $nome = $marcas[$i]; echo $nome['PDR_Marca']; ?>"><?php echo $nome['PDR_Marca']; ?></option>
            <?php } ?>
          </select>
        </div><!-- .col-md-2 .form-group -->

        <!-- Select Subcategoria -->
        <div class="col-md-2 form-group">
          <label for="SelectSubCat">Subcategoria</label>
          <select class="form-control" id="SelectSubCat" name="selectSubCat">
            <option value="Todas">Todas</option>
            <?php for ($i=0; $i < count($subCategorias); $i++) { ?>
            <option value="<?php $nome = $subCategorias[$i]; echo $nome['SCT_Nome']; ?>"><?php echo $nome['SCT_Nome']; ?></option>
            <?php } ?>
          </select>
        </div><!-- .col-md-2 .form-group -->

        <!-- Butao Confirmar -->
        <div class="col-md-2 form-group">
          <label for="Confirmar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
          <button type="submit" class="btn btn-primary" id="Confirmar" name="confirmar" value="confirmar">Confirmar</button>
        </div>
      </div><!-- .row -->
    </form>
    <a href="<?php echo base_url('Admin/AddPdr'); ?>"><button class="btn btn-default">Adicionar Produto</button></a>

    <?php if(!count($produtos)) { ?>
    <h1>Nenhum Produto para Mostrar</h1>
    <?php } else { ?>

    <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Marca</th>
            <th>Preço</th>
            <th>IVA</th>
            <th>Quantidade</th>
            <th>Desconto</th>
            <th>Imagem</th>
            <th>Subcategoria</th>
            <th>Ações</th>
          </tr>
        </thead>
        <?php for ($i=0; $i < count($produtos); $i++) { $produto = $produtos[$i]; ?>
          <tbody>
            <tr>
              <td><?php echo $produto['PDR_ID']; ?></td>
              <td><?php echo $produto['PDR_Nome']; ?></td>
              <td><?php echo $produto['PDR_Marca']; ?></td>
              <td><?php echo $produto['PDR_Preco']; ?>€</td>
              <td><?php echo $produto['PDR_IVA']; ?>%</td>
              <td><?php echo $produto['PDR_Quantidade']; ?> Unidades</td>
              <td><?php echo $produto['PDR_Desconto']; ?>%</td>
              <td><?php echo $produto['PDR_Imagem']; ?></td>
              <td><?php $subCat = $this->Admins->GetSctNome($produto['SCT_ID']); if ($subCat) { echo $subCat; }  ?></td>
              <td>
                <a href="<?php echo base_url('Admin/EditarPdr/'). $produto['PDR_ID']; ?>"><button class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                <a href="<?php echo base_url('Admin/RemoverPdr/'). $produto['PDR_ID']; ?>" onclick="return confirm('Tem a certeza de que deseja apagar este produto permanentemente?')"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
              </td>
            </tr>
          </tbody>
        <?php } ?>
    </table>

    <?php } ?>

  </div>
</body>
</html>
