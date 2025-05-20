<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$id = $_GET['id'] ?? null;
$ordem = null;

// Buscar ordem
if ($id) {
    $sql = "SELECT * FROM ordens_producao WHERE OrdemID = $id";
    $resultado = mysqli_query($conn, $sql);
    $ordem = mysqli_fetch_assoc($resultado);
}

// Carregar listas para selects
$produtos = mysqli_query($conn, "SELECT ProdutoID, Nome FROM produtos");
$funcionarios = mysqli_query($conn, "SELECT FuncionarioID, Nome FROM funcionarios");
$clientes = mysqli_query($conn, "SELECT ClienteID, Nome FROM clientes");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto = $_POST['produto'];
    $funcionario = $_POST['funcionario'];
    $cliente = $_POST['cliente'];
    $data_producao = $_POST['data_producao'];
    $data_entrega = $_POST['data_entrega'];

    $sql = "UPDATE ordens_producao 
            SET ProdutoID = $produto, FuncionarioID = $funcionario, ClienteID = $cliente, DataProducao = '$data_producao', DataEntrega = '$data_entrega'
            WHERE OrdemID = $id";

    if (mysqli_query($conn, $sql)) {
        header('Location: lista-producao.php');
        exit;
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conn);
    }
}
?>

<div class="container">
    <h1>Editar Ordem de Produção</h1>

    <?php if ($ordem): ?>
        <form method="post">
            <label>Produto:</label>
            <select name="produto" required>
                <?php while ($p = mysqli_fetch_assoc($produtos)): ?>
                    <option value="<?= $p['ProdutoID'] ?>" <?= $ordem['ProdutoID'] == $p['ProdutoID'] ? 'selected' : '' ?>>
                        <?= $p['Nome'] ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label>Funcionário:</label>
            <select name="funcionario" required>
                <?php while ($f = mysqli_fetch_assoc($funcionarios)): ?>
                    <option value="<?= $f['FuncionarioID'] ?>" <?= $ordem['FuncionarioID'] == $f['FuncionarioID'] ? 'selected' : '' ?>>
                        <?= $f['Nome'] ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label>Cliente:</label>
            <select name="cliente" required>
                <?php while ($c = mysqli_fetch_assoc($clientes)): ?>
                    <option value="<?= $c['ClienteID'] ?>" <?= $ordem['ClienteID'] == $c['ClienteID'] ? 'selected' : '' ?>>
                        <?= $c['Nome'] ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label>Data de Produção:</label>
            <input type="date" name="data_producao" value="<?= $ordem['DataProducao'] ?>" required>

            <label>Data de Entrega:</label>
            <input type="date" name="data_entrega" value="<?= $ordem['DataEntrega'] ?>" required>

            <button type="submit" class="btn btn-edit">Salvar Alterações</button>
            <a href="listar-ordens.php" class="btn btn-cancel">Cancelar</a>
        </form>
    <?php else: ?>
        <p>Ordem não encontrada.</p>
    <?php endif; ?>
</div>

<?php include_once './include/footer.php'; ?>
