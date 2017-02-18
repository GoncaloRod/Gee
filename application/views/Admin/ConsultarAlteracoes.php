<div class="container caixa">
  <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>ID Administrador</th>
          <th>Data</th>
          <th>ID Produto</th>
          <th>Tipo de Alteração</th>
        </tr>
      </thead>
      <?php for ($i=0; $i < count($alteracoes); $i++) { $alteracoa = $alteracoes[$i]; ?>
      <tbody>
        <tr>
          <td><?php echo $alteracoa['ALT_ID']; ?></td>
          <td><?php echo $alteracoa['ADM_ID']; ?></td>
          <td><?php echo $alteracoa['ALT_Data']; ?></td>
          <td><?php echo $alteracoa['PDR_ID']; ?></td>
          <td><?php echo $alteracoa['ALT_Tipo']; ?></td>
        </tr>
      </tbody>
      <?php } ?>
  </table>
</div>
</body>
</html>
