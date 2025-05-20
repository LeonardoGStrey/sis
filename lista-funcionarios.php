<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>

<main>

  <div class="container">
      <h1>Lista de Funcionários</h1>
      <a href="./salvar-funcionarios.php" class="btn btn-add">Incluir</a> 
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>DataNascimento</th>
            <th>Email</th>
            <th>Ramal</th>
            <th>CargoID</th>
            <th>SetorID</th>
            <th>Salario</th>
            <th>Sexo</th>
            <th>Altura</th>
            <th>Cpf</th>
            <th>RG</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
        <?php
// Consulta SQL corrigida com JOINs para cargos e setores
$sql = "SELECT f.FuncionarioID, f.Nome, f.DataNascimento, f.Email, f.Ramal, 
               c.Nome AS CargoNome, 
               s.Nome AS SetorNome,
               f.Salario, f.Sexo, f.Altura, f.Cpf, f.RG
        FROM funcionarios f
        LEFT JOIN cargos c ON f.CargoID = c.CargoID
        LEFT JOIN setor s ON f.SetorID = s.SetorID";

$resultados = mysqli_query($conn, $sql);

if (!$resultados) {
    die("Erro na consulta: " . mysqli_error($conn));
}

while($funcionario = mysqli_fetch_assoc($resultados)) {
?>
<tr>
    <td><?php echo $funcionario['FuncionarioID']; ?></td>
    <td><?php echo $funcionario['Nome']; ?></td>
    <td><?php echo $funcionario['DataNascimento']; ?></td>
    <td><?php echo $funcionario['Email']; ?></td>
    <td><?php echo $funcionario['Ramal']; ?></td>
    <td><?php echo $funcionario['CargoNome'] ?? 'N/A'; ?></td>
    <td><?php echo $funcionario['SetorNome'] ?? 'N/A'; ?></td>
    <td><?php echo number_format($funcionario['Salario'], 2, ',', '.'); ?></td>
    <td><?php echo $funcionario['Sexo']; ?></td>
    <td><?php echo $funcionario['Altura']; ?></td>
    <td><?php echo $funcionario['Cpf']; ?></td>
    <td><?php echo $funcionario['RG']; ?></td>
    <td>
      <a href="editar-funcionario.php?id=<?php echo $funcionario['FuncionarioID']; ?>" class="btn btn-edit">Editar</a>
       <a href="excluir-funcionario.php?id=<?php echo $funcionario['FuncionarioID']; ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">Excluir</a>
    </td>
</tr>
<?php } ?>
       




      
        </tbody>
      </table>
    </div>

<?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>