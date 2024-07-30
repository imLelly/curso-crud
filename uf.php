<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UF</title>
    <?php include('config.php'); ?>
    <style>
        body {
            font-family: sans-serif;
        }

        h2{
            text-align: center;}

        form {
            width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="tel"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<nav-bar></nav-bar>

    <h2>Cadastro de UF</h2>
    <form action="uf.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="sigla">Sigla:</label>
        <input type="text" id="sigla" name="sigla" required>
        <label for="regiao">Região:</label>
        <input type="text" id="regiao" name="regiao">
        <input type="submit" value="Gravar" name="botao">
   
    </form>
  
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['botao']) && $_POST['botao'] == "Gravar") {
        $nome = $_POST['nome'];
        $sigla = $_POST['sigla'];
        $regiao = $_POST['regiao'];

        // Conexão com o banco de dados
        include('config.php');

        // Consulta preparada para evitar SQL injection
        $stmt = $mysqli->prepare("INSERT INTO UF (NOME, SIGLA, REGIAO) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $sigla, $regiao);

        if ($stmt->execute()) {
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro ao inserir os dados: " . $stmt->error;
        }
        $stmt->close();
    }
    ?>
    <script src='./index.js'></script>

</body>
</html>
