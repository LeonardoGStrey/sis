<?php
include_once './include/logado.php';
include_once './include/conexao.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM cargos WHERE CargoID = $id";
    if (mysqli_query($conn, $sql)) {
        header('Location: lista-cargos.php');
        exit;
    } else {
        echo "Erro ao excluir: " . mysqli_error($conn);
    }
} else {
    echo "ID inválido.";
}
?>
