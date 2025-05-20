<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$id = $_GET['id'] ?? null;
$funcionario = null;

if ($id) {
    $sql = "SELECT * FROM funcionarios WHERE FuncionarioID = $id";
    $resultado = mysqli_query($conn, $sql);
    $funcionario = mysqli_fetch_assoc($resultado);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $data = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $ramal = $_POST['ramal'];
    $cargo = $_POST['cargo_id'];
    $setor = $_POST['setor_id'];
    $salario = $_POST['salario'];
    $sexo = $_POST['sexo'];
    $altura = $_POST['altura'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];

    $sql = "UPDATE funcionarios SET 
                Nome = '$nome',
                DataNascimento = '$data',
                Email = '$email',
                Ramal = '$ramal',
                CargoID = '$cargo',
                SetorID = '$setor',
                Salario = '$salario',
                Sexo = '$sexo',
                Altura = '$altura',
                Cpf = '$cpf',
                RG = '$rg'
            WHERE FuncionarioID = $id";

    if (mysqli_query($conn, $sql)) {
        header('Location: lista-funcionarios.php');
        exit;
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conn);
    }
}
?>

<div class="container">
    <h1>Editar Funcionário</h1>
    <?php if ($funcionario): ?>
        <form method="post">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $funcionario['Nome']; ?>" required>

            <label>Data de Nascimento:</label>
            <input type="date" name="data_nascimento" value="<?php echo $funcionario['DataNascimento']; ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $funcionario['Email']; ?>" required>

            <label>Ramal:</label>
            <input type="text" name="ramal" value="<?php echo $funcionario['Ramal']; ?>" required>

            <label>Cargo ID:</label>
            <input type="number" name="cargo_id" value="<?php echo $funcionario['CargoID']; ?>" required>

            <label>Setor ID:</label>
            <input type="number" name="setor_id" value="<?php echo $funcionario['SetorID']; ?>" required>

            <label>Salário:</label>
            <input type="number" name="salario" step="0.01" value="<?php echo $funcionario['Salario']; ?>" required>

            <label>Sexo:</label>
            <input type="text" name="sexo" value="<?php echo $funcionario['Sexo']; ?>" required>

            <label>Altura:</label>
            <input type="text" name="altura" value="<?php echo $funcionario['Altura']; ?>" required>

            <label>CPF:</label>
            <input type="text" name="cpf" value="<?php echo $funcionario['Cpf']; ?>" required>

            <label>RG:</label>
            <input type="text" name="rg" value="<?php echo $funcionario['RG']; ?>" required>

            <button type="submit" class="btn btn-edit">Salvar Alterações</button>
            <a href="listar-funcionarios.php" class="btn btn-cancel">Cancelar</a>
        </form>
    <?php else: ?>
        <p>Funcionário não encontrado.</p>
    <?php endif; ?>
</div>

<?php include_once './include/footer.php'; ?>
