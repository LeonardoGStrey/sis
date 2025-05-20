<?php
include_once './include/conexao.php';

$id = $_GET['id'];
$sql = "DELETE FROM setor WHERE SetorID = $id";
mysqli_query($conn, $sql);

header("Location: lista-setores.php");
exit;
