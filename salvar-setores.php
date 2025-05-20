<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
  // Conecta ao banco de dados (supondo que $conn já está definido)
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Make sure $conn is properly initialized
    $nome = $conn->real_escape_string($_POST['nome'] ?? '');
    $Andar = $conn->real_escape_string($_POST['Andar'] ?? '0');
    $Cor = $conn->real_escape_string($_POST['Cor'] ?? '');
    
    // Corrected SQL to match your actual table structure
    $sql = "INSERT INTO setor (nome, Andar, Cor) VALUES ('$nome', '$Andar', '$Cor')";
    $result = $conn->query($sql);
    
    if (!$result) {
        echo "<div class='error'>Error: " . $conn->error . "</div>";
    } else {
        echo "<div class='success'>Setor cadastrado com sucesso!</div>";
    }
}
?>

<main>
<div id="setores" class="tela">
    <form class="crud-form" action="" method="post">
        <h2>Cadastro de Setores</h2>
        <input type="text" name="nome" placeholder="Nome do Setor"
            value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>" required>
        <input type="number" name="Andar" placeholder="Andar" step="1"
            value="<?php echo htmlspecialchars($_POST['Andar'] ?? ''); ?>" required>
        <input type="text" name="Cor" placeholder="Cor (ex: Roxo, Amarelo, Azul)"
            value="<?php echo htmlspecialchars($_POST['Cor'] ?? ''); ?>" required>
        <button type="submit" name="acao" value="salvar">Salvar</button>
    </form>
</div>
</main>

  <?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>