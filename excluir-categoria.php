<?php
include_once './include/logado.php';
include_once './include/conexao.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM categorias WHERE CategoriaID = $id";
    if (mysqli_query($conn, $sql)) {
        header('Location: lista-categorias.php');
        exit;
    } else {
        echo "Erro ao excluir: " . mysqli_error($conn);
    }
} else {
    echo "ID inválido.";
}
