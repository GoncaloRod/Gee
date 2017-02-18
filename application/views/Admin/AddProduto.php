  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 caixa">
        <h1>Adicionar Produto</h1>

        <?php
          if (isset($alerta))
          {
        ?>
        <div class="alert alert-<?php echo $alerta['class'] ?>">
          <?php echo $alerta['mensagem']; ?>
        </div>
        <?php
          }
        ?>

        <?php echo form_open_multipart('Admin/AddPdr');?>
          <input type="hidden" name="captcha">

          <!-- Nome do produto -->
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label for="Nome">Nome</label>
                <input type="text" class="form-control" id="Nome" placeholder="Nome" name="nome" required>
              </div><!-- .col-md-6 -->
            </div><!-- .row -->
          </div><!-- .form-group -->

          <!-- Marca -->
          <div class="form-group">
            <label>Marca</label>
            <div class="row">
              <div class="col-md-6">
                <label class="radio-inline">
                  <input type="radio" name="RadioMarca" id="RadioMarcaExistente" value="marcaExistente" <?php if (!count($marcas)) { echo'disabled'; } ?>> Marca Existente
                </label>
                <select class="form-control" name="selectMarca" <?php if (!count($marcas)) { echo'disabled'; } ?>>
                  <?php for ($i=0; $i < count($marcas); $i++) { ?>
                  <option value="<?php $nome = $marcas[$i]; echo $nome['PDR_Marca']; ?>"><?php echo $nome['PDR_Marca']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6">
                <label class="radio-inline">
                  <input type="radio" name="RadioMarca" id="RadioMarcaNova" value="marcaNova"> Marca Nova
                </label>
                <input type="text" class="form-control" placeholder="Marca" name="marcaNova">
              </div><!-- .col-md-6 -->
            </div><!-- .row -->
          </div><!-- .form-group -->

          <!-- Subcategoria -->
          <div class="form-group">
            <label>Subcategoria</label>
            <div class="row">
              <div class="col-md-6">
                <label class="radio-inline">
                  <input type="radio" name="RadioSubCat" id="RadioSubCatExistente" value="subCatExistente" <?php if (!count($subCategorias)) { echo'disabled'; } ?>> Subcategoria Existente
                </label>
                <select class="form-control" name="selectSubCat" <?php if (!count($subCategorias)) { echo'disabled'; } ?>>
                  <?php for ($i=0; $i < count($subCategorias); $i++) { ?>
                  <option value="<?php $nome = $subCategorias[$i]; echo $nome['SCT_Nome']; ?>"><?php echo $nome['SCT_Nome']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6">
                <label class="radio-inline">
                  <input type="radio" name="RadioSubCat" id="RadioSubCatNova" value="subCatNova"> Subcategoria Nova
                </label>
                <input type="text" class="form-control" placeholder="Subcategoria" name="subCategoriaNova">
                <div class="row">
                  <div class="col-md-6">
                    <label class="radio-inline">
                      <input type="radio" name="RadioCat" id="RadioCatExistente" value="catExistente" <?php if(!count($categorias)) { echo "disabled"; } ?>> Categoria Existente
                    </label>
                    <select class="form-control" name="selectCat" <?php if(!count($categorias)) { echo "disabled"; } ?>>
                      <?php for ($i=0; $i < count($categorias); $i++) { ?>
                      <option value="<?php $nome = $categorias[$i]; echo $nome['CAT_Nome']; ?>"><?php echo $nome['CAT_Nome']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="radio-inline">
                      <input type="radio" name="RadioCat" id="RadioCatNova" value="catNova"> Categoria Nova
                    </label>
                    <input type="text" class="form-control" placeholder="Categoria" name="categoriaNova">
                  </div><!-- .col-md-6 -->
                </div><!-- .row -->
              </div><!-- .col-md-6 -->
            </div><!-- .row -->
          </div><!-- .form-group -->

          <!-- Preco -->
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label for="Preco">Preço</label>
                <input type="text" class="form-control" id="Preco" placeholder="Preço" name="preco" required>
              </div><!-- .col-md-6 -->
            </div><!-- .row -->
          </div><!-- .form-group -->

          <!-- IVA -->
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label for="PercentagemIVA">Percentagem IVA</label>
                <input type="text" class="form-control" id="PercentagemIVA" placeholder="Percentagem IVA" name="percentagemIVA" required>
              </div><!-- .col-md-6 -->
            </div><!-- .row -->
          </div><!-- .form-group -->

          <!-- Quantidade -->
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label for="Quantidade">Quantidade</label>
                <input type="text" class="form-control" id="Quantidade" placeholder="Quantidade" name="quantidade" required>
              </div><!-- .col-md-6 -->
            </div><!-- .row -->
          </div><!-- .form-group -->

          <!-- Imagem -->
          <div class="form-group">
            <label for="Imagem">Imagem</label>
            <input type="file" id="Imagem" name="imagem" value="upload" required>
            <p class="help-block">A imagem tem de ter obrigatoriamente tamanho 400x400</p>
          </div>

          <button type="submit" class="btn btn-primary pull-right" name="confirmar" value="confirmar">Confirmar</button>
        </form>

        <a href="<?php echo base_url('Admin/GerirPdr'); ?>"><button type="button" class="btn btn-default pull-right" style="margin-right: 10px;">Cancelar</button></a>

      </div><!-- .col-md-6 .col-md-offset-3 .caixa -->
    </div><!-- .row -->
  </div><!-- .container -->
</body>
</html>
