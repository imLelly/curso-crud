<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro da disciplina</title>
    <style>
        body {
            font-family: sans-serif;
        }

        h2{
            text-align: center;
        }
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

    <h2>Cadastro de Disciplinas</h2>
    <form action="disciplina.php" method="post" name="disciplina">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" >

        <label for="nr_aulas">Número de Aulas:</label>
        <input type="number" id="nr_aulas" name="nr_aulas" >

        <label for="mensalidade">Mensalidade:</label>
        <input type="number" id="mensalidade" name="mensalidade" step="0.01" >

        
         <input type="submit" value="Gravar" name="botao">
         
    
    </form>

    <?php include('config.php'); 

if (@$_POST['botao'] == "Gravar") {
   
    $nome = $_POST['nome'];
    $nr_aulas = $_POST['nr_aulas'];
    $mensalidade = $_POST['mensalidade'];
 

    $insere = "INSERT INTO disciplina(nome, nr_aulas, mensalidade) 
    VALUES ('$nome', '$nr_aulas', '$mensalidade')";
    mysqli_query($mysqli, $insere) or die ("Não foi possivel inserir os dados");
}
?>
<script src='./index.js'></script>

</body>
</html>