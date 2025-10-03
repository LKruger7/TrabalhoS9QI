<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
        <title>CADASTRO</title>
     <main>
        <img src="logo-removebg-preview.png" alt="Logo da empresa" id="logo_cadastro">
        <h1>Cadastre-se</h1>
        <form action="cadastro.html" method="post">
            <input type="text" name="nome_cadastro" id="nome_cadastro" placeholder="Digite seu nome" required>
            <input type="email" name="email" id="email" placeholder="Digite seu email" required>
            <input type="number" name="numero" id="numero" placeholder="Digite seu número" min="1" max="12" required>
            <input type="number" name="cpf" id="cpf" placeholder="Digite seu CPF"  min="1" max="11" required>
            <input type="password" name="pass" id="pass" placeholder="Crie sua senha" required>

            <a href="index.php"><input type="submit" value="Cadastre-se"></a>
            

        </form>
    <footer>
        <small> Nenhum direito reservado &copy;</small>
    </footer>
    </main>
</head>
</body>
</html>