<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$id = $_GET['id'] ?? null;
$produto = null;

if ($id) {
    $sql = "SELECT * FROM produtos WHERE ProdutoID = $id";
    $resultado = mysqli_query($conn, $sql);
    $produto = mysqli_fetch_assoc($resultado);
}

// Buscar categorias para o select
$categorias = mysqli_query($conn, "SELECT CategoriaID, Nome FROM categorias");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $referencia = $_POST['referencia'];
    $descricao = $_POST['descricao'];
    $peso = $_POST['peso'];
    $categoria = $_POST['categoria'];

    $sql = "UPDATE produtos 
            SET Nome = '$nome', Preco = $preco, Referencia = '$referencia', Descricao = '$descricao', Peso = '$peso', CategoriaID = $categoria 
            WHERE ProdutoID = $id";

    if (mysqli_query($conn, $sql)) {
        header('Location: lista-produtos.php');
        exit;
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conn);
    }
}
?>

<div class="container">
    <h1>Editar Produto</h1>
    <?php if ($produto): ?>
        <form method="post">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $produto['Nome']; ?>" required>

            <label>Preço:</label>
            <input type="number" step="0.01" name="preco" value="<?php echo $produto['Preco']; ?>" required>

            <label>Referência:</label>
            <input type="text" name="referencia" value="<?php echo $produto['Referencia']; ?>" required>

            <label>Descrição:</label>
            <textarea name="descricao" required><?php echo $produto['Descricao']; ?></textarea>

            <label>Peso:</label>
            <input type="text" name="peso" value="<?php echo $produto['Peso']; ?>" required>

            <label>Categoria:</label>
            <select name="categoria" required>
                <?php while ($cat = mysqli_fetch_assoc($categorias)): ?>
                    <option value="<?php echo $cat['CategoriaID']; ?>" <?php echo $produto['CategoriaID'] == $cat['CategoriaID'] ? 'selected' : ''; ?>>
                        <?php echo $cat['Nome']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit" class="btn btn-edit">Salvar Alterações</button>
            <a href="listar-produtos.php" class="btn btn-cancel">Cancelar</a>
        </form>
    <?php else: ?>
        <p>Produto não encontrado.</p>
    <?php endif; ?>
</div>

<?php include_once './include/footer.php'; ?>
