<?php
session_start();
include_once './include/conexao.php';

$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE Email = '$email' AND Senha = '$senha'";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        $_SESSION['usuario_id'] = $usuario['UsuarioID'];
        $_SESSION['usuario_nome'] = $usuario['Nome'];
        header("Location: lista-usuarios.php");
        exit;
    } else {
        $erro = "Email ou senha incorretos.";
    }
}
?>

<h2>Login</h2>
<?php if ($erro) echo "<p style='color: red;'>$erro</p>"; ?>

<form method="post">
    <label>E-mail:</label><br>
    <input type="text" name="email"><br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha"><br><br>

    <input type="submit" value="Entrar">
</form>

<p>Ainda não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
