<?php include_once './include/logado.php'; ?>
<?php include_once './include/header.php'; ?>
<?php include_once './include/conexao.php'; ?>

<main>
    <div class="container">
        <h1>Lista de Usuários</h1>
        <a href="./salvar-usuario.php" class="btn btn-add">Incluir</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Usuário</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT UsuarioID, Nome, Usuario, Email FROM usuarios ORDER BY UsuarioID ASC";
                $resultado = mysqli_query($conn, $sql);

                while ($usuario = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>{$usuario['UsuarioID']}</td>";
                    echo "<td>{$usuario['Nome']}</td>";
                    echo "<td>{$usuario['Usuario']}</td>";
                    echo "<td>{$usuario['Email']}</td>";
                    echo "<td>
                        <a href='#' class='btn btn-edit'>Editar</a>
                        <a href='#' class='btn btn-delete'>Excluir</a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php include_once './include/footer.php'; ?>
