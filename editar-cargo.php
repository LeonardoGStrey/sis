<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$id = $_GET['id'] ?? null;
$cargo = null;

if ($id) {
    $sql = "SELECT * FROM cargos WHERE CargoID = $id";
    $resultado = mysqli_query($conn, $sql);
    $cargo = mysqli_fetch_assoc($resultado);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $teto = $_POST['teto'];

    $sql = "UPDATE cargos SET Nome = '$nome', TetoSalarial = $teto WHERE CargoID = $id";
    if (mysqli_query($conn, $sql)) {
        header('Location: lista-cargos.php');
        exit;
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conn);
    }
}
?>

<div class="container">
    <h1>Editar Cargo</h1>
    <?php if ($cargo): ?>
        <form method="post">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $cargo['Nome']; ?>" required>

            <label>Teto Salarial:</label>
            <input type="number" step="0.01" name="teto" value="<?php echo $cargo['TetoSalarial']; ?>" required>

            <button type="submit" class="btn btn-edit">Salvar Alterações</button>
            <a href="listar-cargos.php" class="btn btn-cancel">Cancelar</a>
        </form>
    <?php else: ?>
        <p>Cargo não encontrado.</p>
    <?php endif; ?>
</div>

<?php include_once './include/footer.php'; ?>
