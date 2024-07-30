

<html>
<head>
    <title>Cadastro de Alunos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    <h2>Cadastro de Alunos</h2>
    <form action="aluno.php" method="post" name="aluno">
        <div> 
        <label for="nome">nome:</label>
        <input type="text" id="nome" name="nome" >
        </div>
        
        <div>
        <label for="data_ncto">Data de Nascimento:</label>
        <input type="date" id="data_ncto" name="data_ncto" >
        </div>

        <div> 
        <label for="email">email:</label>
        <input type="text" id="email" name="email" >
        </div>

        <div> 
        <label for="telefone">telefone:</label>
        <input type="text" id="telefone" name="telefone" >
        </div>

        <div> 
        <label for="municipio_codigo">Município:</label>
        <select type="text" id="municipio_codigo" name="municipio_codigo" required>
            <option value="" ></option> 
        <?php
        $sql = "SELECT CODIGO, NOME FROM municipio";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            // Gerar as opções do select
            while ($row = $result->fetch_assoc()) {
                echo "<option value=\"" . $row['CODIGO'] . "\">" . $row['NOME'] . "</option>";
            }
        } else {
            echo "<option value=\"\">Nenhum municipio disponível</option>";
        }
        ?>
        </select>

        </div>

         <div>
         <input type="submit" value="Gravar" name="botao">
         </div>
        
     
    </div>

        </form>

    <?php include('config.php'); 

if (@$_POST['botao'] == "Gravar") {
   
    $nome = $_POST['nome'];
    $data_ncto = $_POST['data_ncto'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $municipio_codigo = $_POST['municipio_codigo'];

    $insere = "INSERT INTO aluno(nome, data_ncto, email, telefone, municipio_codigo) 
    VALUES ('$nome', '$data_ncto', '$email', '$telefone', '$municipio_codigo')";
    mysqli_query($mysqli, $insere) or die ("Não foi possivel inserir os dados");
}
?>

<script src='./index.js'></script>

  
</body>
</html>


