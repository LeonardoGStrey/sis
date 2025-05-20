<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>

<div class="container">
    <h1>Lista de Produtos</h1>
    <a href="./salvar-produtos.php" class="btn btn-add">Incluir</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Referência</th>
                <th>Descrição</th>
                <th>Peso</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Corrigindo a conexão (mysql_query está obsoleto, use mysqli_query)
            $sql = "SELECT p.ProdutoID, p.Nome, c.Nome AS CategoriaNome, 
                           p.Preco, p.Referencia, p.Descricao, p.Peso 
                    FROM produtos p
                    INNER JOIN categorias c ON p.CategoriaID = c.CategoriaID";
            
            $resultados = mysqli_query($conn, $sql);
            
            if ($resultados && mysqli_num_rows($resultados) > 0) {
                while($produto = mysqli_fetch_assoc($resultados)) {
            ?>
                    <tr>
                        <td><?php echo $produto['ProdutoID']; ?></td>
                        <td><?php echo $produto['Nome']; ?></td>
                        <td><?php echo $produto['CategoriaNome']; ?></td> <!-- Nome da categoria em vez do ID -->
                        <td>R$ <?php echo number_format($produto['Preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $produto['Referencia']; ?></td>
                        <td><?php echo substr($produto['Descricao'], 0, 50) . '...'; ?></td> <!-- Mostra apenas parte da descrição -->
                        <td><?php echo $produto['Peso']; ?> kg</td>
                        <td>
                        <a href="editar-produto.php?id=<?php echo $produto['ProdutoID']; ?>" class="btn btn-edit">Editar</a>
                        <a href="excluir-produto.php?id=<?php echo $produto['ProdutoID']; ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
                        </td>
                    </tr>
            <?php
                }
            } else
            ?>
        </tbody>
    </table>
</div>

<?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>