<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome'] ?? '');
    $descricao = $conn->real_escape_string($_POST['descricao'] ?? '');

    if ($nome !== '') {
        $sql = "INSERT INTO categorias (Nome, Descricao) VALUES ('$nome', '$descricao')";
        $resultado = $conn->query($sql);

        if ($resultado) {
            echo "<div class='success'>Categoria cadastrada com sucesso!</div>";
        } else {
            echo "<div class='error'>Erro ao cadastrar: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='error'>O nome da categoria é obrigatório.</div>";
    }
}
?>

<main>
    <div class="container">
        <h1>Cadastro de Categorias</h1>
        <form method="post" action="">
            <input type="text" name="nome" placeholder="Nome da Categoria" 
                   value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>" required>
            <textarea name="descricao" placeholder="Descrição"><?php echo htmlspecialchars($_POST['descricao'] ?? ''); ?></textarea>
            <button type="submit">Salvar</button>
        </form>
    </div>
</main>

<?php include_once './include/footer.php'; ?>
