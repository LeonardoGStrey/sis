<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter e sanitizar os dados do formulário
    $funcionario_id = $conn->real_escape_string($_POST['funcionario_id'] ?? '');
    $produto_id = $conn->real_escape_string($_POST['produto_id'] ?? '');
    $data_producao = $conn->real_escape_string($_POST['data_producao'] ?? '');
    $data_entrega = $conn->real_escape_string($_POST['data_entrega'] ?? '');

    // Converter datas para formato MySQL
    $data_producao_mysql = date('Y-m-d', strtotime(str_replace('/', '-', $data_producao)));
    $data_entrega_mysql = date('Y-m-d', strtotime(str_replace('/', '-', $data_entrega)));

    // Consulta SQL para inserir produção
    $sql = "INSERT INTO producao (FuncionarioID, ProdutoID, DataProducao, DataEntrega)
            VALUES ('$funcionario_id', '$produto_id', '$data_producao_mysql', '$data_entrega_mysql')";

    $result = $conn->query($sql);

    if (!$result) {
        echo "<div class='error'>Erro: " . $conn->error . "</div>";
    } else {
        echo "<div class='success'>Produção registrada com sucesso!</div>";
    }
}
?>

<main>
<div id="producao" class="tela">
    <form class="crud-form" action="" method="post">
        <h2>Cadastro de Produção de Produtos</h2>

        <div class="form-group">
            <label>Funcionário</label>
            <select name="funcionario_id" required>
                <option value="">Selecione um funcionário</option>
                <?php
                $funcionarios = $conn->query("SELECT FuncionarioID, Nome FROM funcionarios");
                while ($f = $funcionarios->fetch_assoc()) {
                    $selected = (($_POST['funcionario_id'] ?? '') == $f['FuncionarioID']) ? 'selected' : '';
                    echo "<option value='{$f['FuncionarioID']}' $selected>{$f['Nome']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Produto</label>
            <select name="produto_id" required>
                <option value="">Selecione um produto</option>
                <?php
                $produtos = $conn->query("SELECT ProdutoID, Nome FROM produtos");
                while ($p = $produtos->fetch_assoc()) {
                    $selected = (($_POST['produto_id'] ?? '') == $p['ProdutoID']) ? 'selected' : '';
                    echo "<option value='{$p['ProdutoID']}' $selected>{$p['Nome']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Data da produção</label>
            <input type="text" name="data_producao" placeholder="dd/mm/aaaa"
                value="<?php echo htmlspecialchars($_POST['data_producao'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label>Data da entrega</label>
            <input type="text" name="data_entrega" placeholder="dd/mm/aaaa"
                value="<?php echo htmlspecialchars($_POST['data_entrega'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn-salvar">Salvar</button>
        </div>
    </form>
</div>
</main>

<?php 
include_once './include/footer.php';
?>
