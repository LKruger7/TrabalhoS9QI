<?php
require_once "src/FuncionarioDAO.php";
require_once "src/Funcionario.php";

$bd = new FuncionarioDAO();
session_start();

if (isset($_SESSION["estoque"])) {
    $_SESSION["estoque"] = null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $cpf = $_POST["cpf"];
    $senha = $_POST["senha"];

    $objFuncionario = new Funcionario(
        nome: $nome,
        email: $email,
        cpf: $cpf,
        senha: $senha
    );

    try {
        if (!empty($_POST["id"])) {
            $id = $_POST["id"];
            $result = $bd->editar(intval($id), $objFuncionario);
            $_SESSION["estoque"] = "Funcionário(a) editado(a)!";
        } else {
            $bd->salvar($objFuncionario);
            $_SESSION["estoque"] = "Funcionário(a) registrado(a)!";
        }
    } catch (Exception $erro) {
        $_SESSION["estoque"] = "Ocorreu algum erro.";
    }

    echo "<script>
        alert('{$_SESSION["estoque"]}');
        window.location.replace('funcionario.php');
    </script>";
}
?>





<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários Cadastrados</title>
</head>
<body>
        <header>
  <img src="WhatsApp_Image_2025-09-17_at_20.56.56-removebg-preview.png" alt="Logo do site" class="logo">
  </header>
<main>
    <a href="estoque.php">Voltar para estoque</a>

    <h1 id="titulo">Novo Funcionario</h1>
        <form action="cadastro.php" method="post">
  <input type="hidden" id="id" name="id">
  <label>Nome: <input type="text" id="nome" name="nome"></label><br>
  <label>Email: <input type="email" id="email" name="email"></label><br>
  <label>CPF: <input type="text" id="cpf" name="cpf"></label><br>
  <label>Senha: <input type="password" id="senha" name="senha"></label><br>
  <input type="submit" id="btn-submit" value="Cadastrar">
  <button type="button" id="btn-cancelar" onclick="restaurar()">Cancelar</button>
</form>
</main>
   <section id="lista">
    <h3>Lista de funcionarios:</h3>

    <table>
        <thead>
            <tr>
                     <th>NOME</th>
            <th>E-MAIL</th>
            <th>CPF</th>
            <th>SENHA</th>
            <th></th>
            <th></th> 
            </tr>
                 </thead>
        <tbody>
            <?php foreach ( $bd->listarTodos() as $fc) : ?>
                <tr>
                    <td> <?= $fc[0] ?> </td>
                    <td> <?= $fc[1] ?> </td>
                    <td> <?= $fc[2] ?> </td>
                    <td> <?= $fc[3] ?> </td>
                    <td> <?= $fc[4] ?> </td>
                    <td>
                        <button onclick="editar(
                                        <?= $fc[0] ?>,
                                        '<?= $fc[1] ?>',
                                        '<?= $fc[2] ?>',
                                        <?= $fc[3] ?>,
                                        <?= $fc[4] ?>
                                      )">Alterar</button>
                    </td>
                    <td>
                        <button onclick="excluir(<?= $fc[0] ?>, '<?= $fc[1] ?>')">Excluir</button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
            </table>
    </section>

    <script>
         const titulo = document.getElementById("titulo");
        const campoNome = document.getElementById("nome");
        const campoEmail = document.getElementById("email");
        const campoCpf = document.getElementById("cpf");
        const campoSenha = document.getElementById("senha");
        const btnAlterar = document.getElementById("btn-alterar");
        const btnSubmit = document.getElementById("btn-submit");
        const btnCancelar = document.getElementById("btn-cancelar");
        const lista = document.getElementById("lista");
        const campoId = document.getElementById("id");


        btnCancelar.style.display = "none";
            
        function editar(id, nome, email, cpf, senha){
        btnCancelar.style.display = "inline";
        titulo.innerHTML = "Editar funcionário(a)";
        btnSubmit.value = "Atualizar";
        campoId.value = id;
        campoNome.value = nome;
        campoEmail.value = email;
        campoCpf.value = cpf;
        campoSenha.value = senha;
        }

        function restaurar() {
            window.location.reload();
        }

        function excluir(id, nome) {
            if( confirm("Excluir o(a) funcionário(a) "+ nome +"?") ) {
                window.location.replace("exclui-produto.php?id=" + id)
            }
        }


    </script>
</body>
</html>