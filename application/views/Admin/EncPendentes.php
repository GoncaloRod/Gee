  <div class="container caixa">
    <h3>Encomendas Pendentes</h3>

    <?php
      if ($encomendas)
      {
        echo "Hello";
      }
     ?>

    <!-- Paginacao -->
    <nav>
      <ul class="pagination">
        <?php if ($pagina > 1) { ?>
        <li>
          <a href="<?php echo base_url('/Admin/EncomendasPendentes/'. ($pagina + 1)); ?>" aria-label="Anterior">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <?php } ?>
      </ul>
    </nav>
  </div>
</body>
</html>
