<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>
  <main>

    <div class="container">
        <h1>Lista de Setores</h1>
        <a href="./salvar-setores.php" class="btn btn-add">Incluir</a>
        
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Andar</th>
              <th>Cor</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $sql = "SELECT SetorID, Nome, Andar, Cor FROM setor";
            $resultados = mysqli_query($conn, $sql);
            while($setor = mysqli_fetch_assoc($resultados)) {
?>
    <tr>
        <td><?php echo $setor['SetorID']; ?></td>
        <td><?php echo $setor['Nome']; ?></td>
        <td><?php echo $setor['Andar']; ?></td>
        <td><?php echo $setor['Cor']; ?></td>
        <td>
            <a href="editar-setor.php?id=<?php echo $setor['SetorID']; ?>" class="btn btn-edit">Editar</a>
            <a href="excluir-setor.php?id=<?php echo $setor['SetorID']; ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este setor?');">Excluir</a>

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