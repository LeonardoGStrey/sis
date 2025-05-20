<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$id = $_GET['id'] ?? null;
$setor = null;

if ($id) {
    $sql = "SELECT * FROM setor WHERE SetorID = $id";
    $resultado = mysqli_query($conn, $sql);
    $setor = mysqli_fetch_assoc($resultado);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $andar = $_POST['andar'];
    $cor = $_POST['cor'];

    $sql = "UPDATE setor SET Nome = '$nome', Andar = $andar, Cor = '$cor' WHERE SetorID = $id";
    if (mysqli_query($conn, $sql)) {
        header('Location: lista-setores.php');
        exit;
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conn);
    }
}
?>

<div class="container">
    <h1>Editar Setor</h1>
    <?php if ($setor): ?>
        <form method="post">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $setor['Nome']; ?>" required>

            <label>Andar:</label>
            <input type="number" name="andar" value="<?php echo $setor['Andar']; ?>" required>

            <label>Cor:</label>
            <input type="text" name="cor" value="<?php echo $setor['Cor']; ?>" required>

            <button type="submit" class="btn btn-edit">Salvar Alterações</button>
            <a href="listar-setores.php" class="btn btn-cancel">Cancelar</a>
        </form>
    <?php else: ?>
        <p>Setor não encontrado.</p>
    <?php endif; ?>
</div>

<?php include_once './include/footer.php'; ?>
