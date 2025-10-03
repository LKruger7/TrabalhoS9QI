<?php 

require_once("src/ProdutoDAO.php");
require_once("src/Produto.php");

$bd = new ProdutoDAO();


session_start();

if(isset($_SESSION["estoque"])) {
    $_SESSION["estoque"] = null;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST["marca"];
    $data_hora = $_POST["data_hora"];
    $quantidade = $_POST["quantidade"];
    $preco = $_POST["preco"];

    $produto = new Produto(
        marca: $marca,
        data_hora: $data_hora,
        quantidade: $quantidade,
        preco: $preco
    );

    try {
        if ($_POST["id"] != null || $_POST["id"] != "") {
            $id = $_POST["id"];
            $result = $bd->editar(intval($id), $produto);
            $_SESSION["estoque"] = "Produto Editado!";
    } else {
    $bd->salvar($produto);
    $_SESSION["estoque"] = "Produto Registrado!";
    }
} catch(Exception $erro) {
    $_SESSION["estoque"] = "Ocorreu algum erro...";
}

echo "<script> 
        alert('{$_SESSION["estoque"]}');

</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo_estoque.css">
    <title>ESTOQUE</title>
</head>
<body>
      <header>
  <img src="WhatsApp_Image_2025-09-17_at_20.56.56-removebg-preview.png" alt="Logo do site" class="logo">
  <h2>Controle de Estoque:</h2>
</header>

<main>
        <h1 id="titulo">Registrar Produto:</h1>
    <form action="#" method="post">
        <div id="box">
            <div>
                <label for="produto">Marca:</label>
                <input type="text" name="marca" id="marca" required>
            </div>

            <div>
                <label for="data_hora">Data e hora: </label>
                <input type="time" name="data_hora" id="data_hora">
            </div>
            <div>
                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade" min="1" required>
                <div>
                    <label for="preco">Preço:</label>
                    <input type="number" name="preco" id="preco" min="1" required>

                </div>
            </div>
        </div>
        <input type="submit" value="Registrar produto">
    </form>

     <hr>

    <section id="lista">
    <h3>Lista de produtos:</h3>

    <table>
        <thead>
            <th>ITEM</th>
            <th>MARCA</th>
            <th>DATA/HORA</th>
            <th>QUANTIDADE</th>
            <th>PREÇO</th>
            <th></th>
            <th></th>
            <table>
                 </thead>
        <tbody>
            <?php foreach ( $bd->listarTodos() as $pd) : ?>
                <tr>
                    <td> <?= $pd[0] ?> </td>
                    <td> <?= $pd[1] ?> </td>
                    <td> <?= $pd[2] ?> </td>
                    <td> <?= $pd[3] ?> </td>
                    <td> <?= $pd[4] ?> </td>
                    <td> <?= $pd[5] ?> </td>
                    <td>
                        <button onclick="editar(
                                        <?= $pd[0] ?>,
                                        '<?= $pd[1] ?>',
                                        '<?= $pd[2] ?>',
                                        <?= $pd[3] ?>,
                                        <?= $pd[4] ?>,
                                        <?= $pd[5] ?>
                                      )">Alterar</button>
                    </td>
                    <td>
                        <button onclick="excluir(<?= $pd[0] ?>, '<?= $pd[1] ?>')">Excluir</button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
            </table>
    </section>

    <script>
         const titulo = document.getElementById("titulo");
         const campoId = document.getElementById("id");
        const campoMarca = document.getElementById("marca");
        const campoData = document.getElementById("data_hora");
        const campoQuantidade = document.getElementById("quantidade");
        const campoPreco = document.getElementById("preco");
        const btnSubmit = document.getElementById("btn-submit");
        const btnCancelar = document.getElementById("btn-cancelar");
        const lista = document.getElementById("lista");


        btnCancelar.style.display = "none";
            
        function editar(id, marca, data_hora, quantidade, preco){
        btnCancelar.style.display = "inline";
        titulo.innerHTML = "Editar produto";
        btnSubmit.value = "Atualizar";
        campoId.value = id;
        campoMarca = marca;
        campoData = data_hora;
        campoQuantidade = quantidade;
        campoPreco = preco;
        }

        function restaurar() {
            window.location.reload();
        }

        function excluir(id, nome) {
            if( confirm("Excluir o personagem "+ nome +"?") ) {
                window.location.replace("exclui-produto.php?id=" + id)
            }
        }


    </script>
       

        