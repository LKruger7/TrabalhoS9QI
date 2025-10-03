<?php 

if ( isset($_GET["id"] ) ) {
    require_once "src/FuncionarioDAO.php";
    $bd = new FuncionarioDAO();
    $id = intval($_GET["id"]);

    try {
        $bd->apagar($id);
        echo"<script>
        alert('✅ Funcionário(a) Excluido(a) com sucesso!');
                window.location.replace('');
            </script>";
    } catch(Exception $erro) {
        echo "<script>
                alert('❌ Ocorreu algum erro...');
                window.location.replace('');
        </script>";
}

} else {
    header("locarion: ...");
}