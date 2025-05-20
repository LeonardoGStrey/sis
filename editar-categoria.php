<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$id = $_GET['id'] ?? null;
$categoria = null;

if ($id) {
    $sql = "SELECT * FROM categorias WHERE CategoriaID = $id";
    $resultado = mysqli_query($conn, $sql);
    $categoria = mysqli_fetch_assoc($resultado);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE categorias SET Nome = '$nome', Descricao = '$descricao' WHERE CategoriaID = $id";
    if (mysqli_query($conn, $sql)) {
        header('Location: lista-categorias.php');
        exit;
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conn);
    }
}
?>

<div class="container">
    <h1>Editar Categoria</h1>
    <?php if ($categoria): ?>
        <form method="post">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $categoria['Nome']; ?>" required>

            <label>Descrição:</label>
            <input type="text" name="descricao" value="<?php echo $categoria['Descricao']; ?>" required>

            <button type="submit" class="btn btn-edit">Salvar Alterações</button>
            <a href="lista-categorias.php" class="btn btn-cancel">Cancelar</a>
        </form>
    <?php else: ?>
        <p>Categoria não encontrada.</p>
    <?php endif; ?>
</div>

<?php include_once './include/footer.php'; ?>
