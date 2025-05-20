<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';





?>
  <main>

    <div class="container">
        <h1>Lista de Cargos</h1>
        <a href="./salvar-cargos.php" class="btn btn-add">Incluir</a>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Teto Salárial</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
             
          <?php
            $sql = "SELECT CargoID, Nome, TetoSalarial FROM cargos";
            $resultados = mysqli_query($conn, $sql);
          while($cargo = mysqli_fetch_assoc($resultados)) {
?>
    <tr>
        <td><?php echo $cargo['CargoID']; ?></td>
        <td><?php echo $cargo['Nome']; ?></td>
        <td><?php echo $cargo['TetoSalarial']; ?></td>
        <td>
        <a href="editar_cargo.php?id=<?php echo $cargo['CargoID']; ?>" class="btn btn-edit">Editar</a>
        <a href="excluir-cargo.php?id=<?php echo $cargo['CargoID']; ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este cargo?');">Excluir</a>
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