<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório por Região e Disciplina</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        table.a-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-bottom: 20px;
        }
        table.a-table, th, td {
            border: 1px solid #ddd;
        }
        table.a-table th, table.a-table td {
            padding: 10px;
            text-align: left;
        }
        table.a-table th {
            background-color: #80E7AB;
            color: white;
        }
        table.a-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .center {
            text-align: center;
        }
     
    </style>
</head>
<body>
<nav-bar></nav-bar>

    <h1>Relatório mensalidade agrupada por região e disciplina</h1>

<?php
include('config.php'); // Conexão com o banco de dados

$query = "
    SELECT 
        uf.REGIAO,
        d.NOME AS DISCIPLINA,
        SUM(d.MENSALIDADE) AS TOTAL_MENSALIDADE
    FROM 
        Cursa c
    INNER JOIN Aluno a ON c.ALUNO_CODIGO = a.CODIGO
    INNER JOIN Municipio m ON a.MUNICIPIO_CODIGO = m.CODIGO
    INNER JOIN UF uf ON m.UF_CODIGO = uf.CODIGO
    INNER JOIN Disciplina d ON c.DISCIPLINA_CODIGO = d.CODIGO
    WHERE 
        c.ANO = 2024 
        AND m.POPULACAO > 100000
    GROUP BY 
        uf.REGIAO, d.NOME
    ORDER BY 
        uf.REGIAO, d.NOME;
";

// Executa a consulta
$result = mysqli_query($mysqli, $query);

// Verifica se a consulta foi bem-sucedida
if ($result && mysqli_num_rows($result) > 0) {
    // Cria a tabela HTML para exibir os resultados
    echo "<table class='a-table' border='1'>";
    echo "
    <tr>
        <th>Região</th>
        <th>Disciplina</th>
        <th>Total Mensalidade</th>
    </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["REGIAO"] . "</td>";
        echo "<td>" . $row["DISCIPLINA"] . "</td>";
        echo "<td>" . $row["TOTAL_MENSALIDADE"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum resultado encontrado.";
}

// Fecha a conexão com o banco de dados
mysqli_close($mysqli);
?>

    <script src='./index.js'></script>

</body>
</html>