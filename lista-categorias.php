<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>
  <main>

    <div class="container">
        <h1>Lista de Categorias</h1>
        <a href="./salvar-categorias.php" class="btn btn-add">Incluir</a>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Descriçao</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $sql = "SELECT CategoriaID, Nome, Descricao FROM categorias";
            $resultados = mysqli_query($conn, $sql);
            while($categoria = mysqli_fetch_assoc($resultados)) {
?>
    <tr>
        <td><?php echo $categoria['CategoriaID']; ?></td>
        <td><?php echo $categoria['Nome']; ?></td>
        <td><?php echo $categoria['Descricao']; ?></td>

        <td>
        <a href="editar-categoria.php?id=<?php echo $categoria['CategoriaID']; ?>" class="btn btn-edit">Editar</a>
        <a href="excluir-categoria.php?id=<?php echo $categoria['CategoriaID']; ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir esta categoria?');">Excluir</a>
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