<?php 
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $conn->real_escape_string($_POST['nome'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!empty($nome) && !empty($email) && !empty($senha)) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (Nome, Email, Senha) 
                VALUES ('$nome', '$email', '$senha_hash')";

        if ($conn->query($sql)) {
            echo "<div class='success'>Usuário cadastrado com sucesso!</div>";
        } else {
            echo "<div class='error'>Erro: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='error'>Preencha todos os campos.</div>";
    }
}
?>

<main>
<div class="tela container">
    <form class="crud-form" method="post">
        <h2>Cadastro de Usuários</h2>

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" required
                value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required
                value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="senha" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn-salvar">Cadastrar</button>
        </div>
    </form>
</div>
</main>

<?php 
include_once './include/footer.php';
?>
