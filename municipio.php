<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Municipio</title>
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

<h2>Cadastro de Município</h2>
    <form action="municipio.php" method="post">
        <label for="NOME">Nome:</label>
        <input type="text" id="NOME" name="NOME" required>

        <label for="POPULACAO">População:</label>
        <input type="text" id="POPULACAO" name="POPULACAO" required>

        <label for="UF_CODIGO">UF:</label>
        <select type="text" id="UF_CODIGO" name="UF_CODIGO" required>
            <option value="" ></option> 
        <?php
        $sql = "SELECT CODIGO, NOME FROM uf";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            // Gerar as opções do select
            while ($row = $result->fetch_assoc()) {
                echo "<option value=\"" . $row['CODIGO'] . "\">" . $row['NOME'] . "</option>";
            }
        } else {
            echo "<option value=\"\">Nenhuma UF disponível</option>";
        }
        ?>
        </select>
    <input type="submit" value="Gravar" name="botao">

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['botao']) && $_POST['botao'] == "Gravar") {
        
        $nome = $_POST['NOME'];
        $POPULACAO = $_POST['POPULACAO'];
        $UF_CODIGO = $_POST['UF_CODIGO'];


$insere = "INSERT into municipio(NOME, POPULACAO, UF_CODIGO) VALUES ('$nome', '$POPULACAO', '$UF_CODIGO')";
mysqli_query($mysqli, $insere) or die ("Não foi possivel inserir os dados");
}

?>
       
    </form>
    <script src='./index.js'></script>

</body>
</html>
