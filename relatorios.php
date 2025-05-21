<?php include_once("./include/logado.php"); ?>
<?php include_once("./include/header.php"); ?>

<main class="container">
    <h1>Relatório de Construção do Projeto</h1>

    <section>
        <h2>1. Estrutura Inicial</h2>
        <p>O projeto foi iniciado com a criação de páginas PHP com inclusão de cabeçalhos, rodapés e conexão com banco de dados. A estrutura de diretórios foi organizada separando arquivos reutilizáveis como <code>header.php</code>, <code>footer.php</code>, e <code>conexao.php</code>.</p>
    </section>

    <section>
        <h2>2. Cadastro de Produção</h2>
        <p>Foi criada a funcionalidade de cadastro de produção de produtos, com campos relacionados a funcionário, produto, data de produção e data de entrega. Esses dados são armazenados na tabela <code>producao</code>.</p>
    </section>

    <section>
        <h2>3. Listagem de Produções</h2>
        <p>Uma página foi desenvolvida para listar as produções cadastradas, com JOINs entre as tabelas <code>produtos</code>, <code>funcionarios</code> e <code>clientes</code> para exibir os nomes relacionados.</p>
    </section>

    <section>
        <h2>4. Login de Usuário</h2>
        <p>Implementou-se um sistema de login baseado na tabela <code>usuarios</code>. A verificação é feita por e-mail e senha. O arquivo <code>logado.php</code> impede o acesso de usuários não autenticados.</p>
    </section>

    <section>
        <h2>5. Cadastro de Usuários</h2>
        <p>Foi criada a tela de cadastro de novos usuários com o formulário <code>cadastro.php</code>, que envia os dados para <code>salvar-usuario.php</code>.</p>
    </section>

    <section>
        <h2>6. Logout</h2>
        <p>Adicionou-se o link <code>Sair</code> que leva à página <code>logoff.php</code>, encerrando a sessão do usuário e redirecionando para a tela de login.</p>
    </section>

    <section>
        <h2>7. Segurança e Sessões</h2>
        <p>As páginas restritas são protegidas pelo arquivo <code>logado.php</code>, que verifica se há uma sessão ativa. Caso contrário, o usuário é redirecionado para <code>login.php</code>.</p>
    </section>

    <section>
        <h2>8. Estilo e Navegação</h2>
        <p>Foi aplicado um layout limpo com botões de ações como "Incluir", "Editar", "Excluir", além de navegação clara entre login, cadastro e listagens.</p>
    </section>
</main>

<?php include_once("./include/footer.php"); ?>
