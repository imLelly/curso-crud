<!DOCTYPE html>
<html>
<head>
    <title>Relatório Completo de Alunos</title>
    <?php include('config.php'); ?>
    <meta charset="UTF-8">
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


    <h1>Relatório Completo de Alunos</h1>

    <?php
    // Conexão com o banco de dados
    include('config.php');

    // Consulta SQL para obter os dados dos alunos
    $query = "SELECT 
                a.NOME AS nome_aluno,
                TIMESTAMPDIFF(YEAR, a.DATA_NCTO, CURDATE()) AS idade,
                m.NOME AS municipio,
                uf.SIGLA AS uf,
                d.NOME AS disciplina,
                c.FALTAS AS faltas,
                d.MENSALIDADE AS mensalidade
              FROM
                Aluno AS a
              JOIN
                Municipio AS m ON a.MUNICIPIO_CODIGO = m.CODIGO
              JOIN
                UF AS uf ON m.UF_CODIGO = uf.CODIGO
              JOIN
                Cursa AS c ON a.CODIGO = c.ALUNO_CODIGO
              JOIN
                Disciplina AS d ON c.DISCIPLINA_CODIGO = d.CODIGO";

    $result = mysqli_query($mysqli, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table>
              <tr>
                <th>Nome do Aluno</th>
                <th>Idade</th>
                <th>Município</th>
                <th>UF</th>
                <th>Disciplina</th>
                <th>Faltas</th>
                <th>Mensalidade</th>
              </tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                  <td>' . $row['nome_aluno'] . '</td>
                  <td>' . $row['idade'] . '</td>
                  <td>' . $row['municipio'] . '</td>
                  <td>' . $row['uf'] . '</td>
                  <td>' . $row['disciplina'] . '</td>
                  <td>' . $row['faltas'] . '</td>
                  <td>' . $row['mensalidade'] . '</td>
                </tr>';
        }
        echo '</table>';
    } else {
        echo '<p class="center">Nenhum dado encontrado.</p>';
    }
    ?>

   
    <script src='./index.js'></script>

</body>
</html>
