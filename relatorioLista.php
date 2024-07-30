<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatorio lista de alunos</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #80E7AB;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .center {
            text-align: center;
        }

    </style>
</head>
<body>
<nav-bar></nav-bar>

<h2>Lista</h2>
<?php
include('config.php'); // Conexão com o banco de dados

// Consulta SQL para obter os dados dos alunos
$query = "
    SELECT 
        NOME, 
        EMAIL, 
        TELEFONE
    FROM 
        Aluno
    ORDER BY 
        NOME;
";

// Executa a consulta
$result = mysqli_query($mysqli, $query);

// Verifica se a consulta foi bem-sucedida
if ($result && mysqli_num_rows($result) > 0) {
    // Cria a tabela HTML para exibir os resultados
    echo "<table border='1'>";
    echo "
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
    </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["NOME"] . "</td>";
        echo "<td>" . $row["EMAIL"] . "</td>";
        echo "<td>" . $row["TELEFONE"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum aluno encontrado.";
}

// Fecha a conexão com o banco de dados
mysqli_close($mysqli);
?>
  
    <script src='./index.js'></script>

</body>
</html>
