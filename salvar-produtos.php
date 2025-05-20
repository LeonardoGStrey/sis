<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter e sanitizar os dados do formulário
    $nome = $conn->real_escape_string($_POST['nome'] ?? '');
    $preco = $conn->real_escape_string($_POST['preco'] ?? '');
    $peso = $conn->real_escape_string($_POST['peso'] ?? '');
    $descricao = $conn->real_escape_string($_POST['descricao'] ?? '');
    $categoria_id = $conn->real_escape_string($_POST['categoria_id'] ?? '');

    // Inserção no banco
    $sql = "INSERT INTO produtos (Nome, Preco, Peso, Descricao, CategoriaID) 
            VALUES ('$nome', '$preco', '$peso', '$descricao', '$categoria_id')";

    $result = $conn->query($sql);

    if (!$result) {
        echo "<div class='error'>Erro: " . $conn->error . "</div>";
    } else {
        echo "<div class='success'>Produto cadastrado com sucesso!</div>";
    }
}
?>

<main>
<div id="produtos" class="tela">
    <form class="crud-form" action="" method="post">
        <h2>Cadastro de Produtos</h2>
        
        <div class="form-group">
            <label>Nome do Produto</label>
            <input type="text" name="nome" placeholder="Digite o nome do produto"
                value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input type="number" step="0.01" name="preco" placeholder="R$ 0,00"
                value="<?php echo htmlspecialchars($_POST['preco'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label>Peso (g)</label>
            <input type="number" name="peso" placeholder="Ex: 500"
                value="<?php echo htmlspecialchars($_POST['peso'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <textarea name="descricao" placeholder="Descreva o produto" rows="4"><?php echo htmlspecialchars($_POST['descricao'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label>Categoria</label>
            <select name="categoria_id" required>
                <option value="">Selecione uma categoria</option>
                <?php
                if (isset($conn)) {
                    $categorias = $conn->query("SELECT CategoriaID, Nome FROM categorias");
                    if ($categorias && $categorias->num_rows > 0) {
                        while ($categoria = $categorias->fetch_assoc()) {
                            $selected = (($_POST['categoria_id'] ?? '') == $categoria['CategoriaID']) ? 'selected' : '';
                            echo "<option value='{$categoria['CategoriaID']}' $selected>{$categoria['Nome']}</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhuma categoria cadastrada</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn-salvar">Salvar Produto</button>
        </div>
    </form>
</div>
</main>

<?php 
include_once './include/footer.php';
?>
