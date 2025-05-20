<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome'] ?? '');
    $TetoSalarial = $conn->real_escape_string($_POST['TetoSalarial'] ?? '0');
    
    $sql = "INSERT INTO cargos (nome, TetoSalarial) VALUES ('$nome', '$TetoSalarial')";
    $result = $conn->query($sql); }
?>

<main>
    <div id="cargos" class="tela">
        <form class="crud-form" action="" method="post">
            <h2>Cadastro de Cargos</h2>
            <input type="text" name="nome" placeholder="Nome do Cargo" 
                   value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>
            <input type="number" name="TetoSalarial" placeholder="Teto Salarial" step="0.01"
                   value="<?= htmlspecialchars($_POST['TetoSalarial'] ?? '') ?>" required>
            <button type="submit" name="acao" value="salvar">Salvar</button>
        </form>
    </div>
</main>


  <?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>
