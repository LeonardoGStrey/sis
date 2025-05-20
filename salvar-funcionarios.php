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
    $data_nascimento = $conn->real_escape_string($_POST['data_nascimento'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $ramal = $conn->real_escape_string($_POST['ramal'] ?? '');
    $salario = $conn->real_escape_string($_POST['salario'] ?? '');
    $sexo = $conn->real_escape_string($_POST['sexo'] ?? '');
    $altura = $conn->real_escape_string($_POST['altura'] ?? '');
    $cpf = $conn->real_escape_string($_POST['cpf'] ?? '');
    $rg = $conn->real_escape_string($_POST['rg'] ?? '');
    $cargo_id = $conn->real_escape_string($_POST['cargo_id'] ?? '');
    $setor_id = $conn->real_escape_string($_POST['setor_id'] ?? '');

    // Converter data para formato MySQL
    $data_mysql = date('Y-m-d', strtotime(str_replace('/', '-', $data_nascimento)));

    // Consulta SQL para inserir funcionário
    $sql = "INSERT INTO funcionarios 
            (Nome, DataNascimento, Email, Ramal, Salario, Sexo, Altura, Cpf, RG, CargoID, SetorID) 
            VALUES 
            ('$nome', '$data_mysql', '$email', '$ramal', '$salario', '$sexo', '$altura', '$cpf', '$rg', '$cargo_id', '$setor_id')";

    $result = $conn->query($sql);

    if (!$result) {
        echo "<div class='error'>Erro: " . $conn->error . "</div>";
    } else {
        echo "<div class='success'>Funcionário cadastrado com sucesso!</div>";
    }
}
?>

<main>
<div id="funcionarios" class="tela">
    <form class="crud-form" action="" method="post">
        <h2>Cadastro de Funcionários</h2>
        
        <div class="form-group">
            <label>Nome completo</label>
            <input type="text" name="nome" placeholder="Digite o nome completo"
                value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Data de Nascimento (dd/mm/aaaa)</label>
            <input type="text" name="data_nascimento" placeholder="00/00/0000"
                value="<?php echo htmlspecialchars($_POST['data_nascimento'] ?? ''); ?>" required>
        </div>
        
        <div class="form-group">
            <label>E-mail</label>
            <input type="email" name="email" placeholder="exemplo@empresa.com"
                value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Ramal</label>
            <input type="text" name="ramal" placeholder="Número do ramal"
                value="<?php echo htmlspecialchars($_POST['ramal'] ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label>Salário</label>
            <input type="number" step="0.01" name="salario" placeholder="R$ 0,00"
                value="<?php echo htmlspecialchars($_POST['salario'] ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label>Selecione o sexo</label>
            <select name="sexo" required>
                <option value="">Selecione...</option>
                <option value="M" <?php echo (($_POST['sexo'] ?? '') == 'M') ? 'selected' : ''; ?>>Masculino</option>
                <option value="F" <?php echo (($_POST['sexo'] ?? '') == 'F') ? 'selected' : ''; ?>>Feminino</option>
                <option value="O" <?php echo (($_POST['sexo'] ?? '') == 'O') ? 'selected' : ''; ?>>Outro</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Altura (metros)</label>
            <input type="number" step="0.01" name="altura" placeholder="Ex: 1.75"
                value="<?php echo htmlspecialchars($_POST['altura'] ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label>CPF</label>
            <input type="text" name="cpf" placeholder="000.000.000-00"
                value="<?php echo htmlspecialchars($_POST['cpf'] ?? ''); ?>" required>
        </div>
        
        <div class="form-group">
            <label>RG</label>
            <input type="text" name="rg" placeholder="00.000.000-0"
                value="<?php echo htmlspecialchars($_POST['rg'] ?? ''); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Selecione o Cargo</label>
            <select name="cargo_id" required>
                <option value="">Selecione um cargo</option>
                <?php
                if(isset($conn)) {
                    $cargos = $conn->query("SELECT CargoID, Nome FROM cargos");
                    if($cargos && $cargos->num_rows > 0) {
                        while ($cargo = $cargos->fetch_assoc()) {
                            $selected = (($_POST['cargo_id'] ?? '') == $cargo['CargoID']) ? 'selected' : '';
                            echo "<option value='{$cargo['CargoID']}' $selected>{$cargo['Nome']}</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhum cargo cadastrado</option>";
                    }
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Selecione o Setor</label>
            <select name="setor_id" required>
                <option value="">Selecione um setor</option>
                <?php
                if(isset($conn)) {
                    $setores = $conn->query("SELECT SetorID, Nome FROM setor");
                    if($setores && $setores->num_rows > 0) {
                        while ($setor = $setores->fetch_assoc()) {
                            $selected = (($_POST['setor_id'] ?? '') == $setor['SetorID']) ? 'selected' : '';
                            echo "<option value='{$setor['SetorID']}' $selected>{$setor['Nome']}</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhum setor cadastrado</option>";
                    }
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn-salvar">Salvar Cadastro</button>
        </div>
    </form>
</div>
</main>

<?php 
include_once './include/footer.php';
?>
