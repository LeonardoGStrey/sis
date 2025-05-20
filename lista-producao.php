<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

?>
  <main>

    <div class="container">
        <h1>Lista de Produções</h1>
        <a href="./salvar-producao.php" class="btn btn-add">Incluir</a> 
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Produto</th>
              <th>Funcionario</th>
              <th>Cliente</th>
              <th>Data Produção</th>
              <th>Data Entrega</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $sql = "SELECT p.ProducaoID, 
          pr.Nome AS NomeProduto, 
          f.Nome AS NomeFuncionario, 
          c.Nome AS NomeCliente, 
          p.DataProducao, 
          p.DataEntrega 
          FROM producao p
          INNER JOIN produtos pr ON p.ProdutoID = pr.ProdutoID
          INNER JOIN funcionarios f ON p.FuncionarioID = f.FuncionarioID
          INNER JOIN clientes c ON p.ClienteID = c.ClienteID
         ORDER BY p.ProducaoID ASC";
            $resultados = mysqli_query($conn, $sql);
            while($producao = mysqli_fetch_assoc($resultados)) {
?>
    <tr>
        <td><?php echo $producao['ProducaoID']; ?></td>
        <td><?php echo $producao['NomeProduto']; ?></td>
        <td><?php echo $producao['NomeFuncionario']; ?></td>
        <td><?php echo $producao['NomeCliente']; ?></td>
        <td><?php echo $producao['DataProducao']; ?></td>
        <td><?php echo $producao['DataEntrega']; ?></td>

        <td>
        <td>
            <a href="editar-ordem.php?id=<?php echo $ordem['OrdemID']; ?>" class="btn btn-edit">Editar</a>
            <a href="excluir-ordem.php?id=<?php echo $ordem['OrdemID']; ?>" class="btn btn-delete" onclick="return confirm('Deseja realmente excluir esta ordem?');">Excluir</a>
</td>

        </td>
    </tr>
<?php } ?>    
      
          
          
          
          
            
          </tbody>
        </table>
      </div>


   
  </main>

  <?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>