<?php
include_once './include/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha']; // Em produção, use password_hash()

    $sql = "INSERT INTO usuarios (Nome, Usuario, Email, Senha) 
            VALUES ('$nome', '$usuario', '$email', '$senha')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
        exit();
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conn);
    }
}
?>
