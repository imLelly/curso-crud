<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro cursos</title>
    <?php include('config.php'); ?>
    <style>
        body {
            font-family: sans-serif;
        }
        h2 {
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
        .center {
            text-align: center;
        }
    </style>
</head>
<body>
    <nav-bar></nav-bar>
<h2 class="center">Cadastro de Cursos</h2>
    <form action="cursa.php" method="post">
        <label for="turma">Turma:</label>
        <input type="text" id="turma" name="turma" required>

        <label for="ano">Ano:</label>
        <input type="number" id="ano" name="ano" required>

        <label for="nota1">Nota 1:</label>
        <input type="number" id="nota1" name="nota1" step="0.01" required>

        <label for="nota2">Nota 2:</label>
        <input type="number" id="nota2" name="nota2" step="0.01" required>

        <label for="faltas">Faltas:</label>
        <input type="number" id="faltas" name="faltas" required>

        <label for="aluno_codigo">Aluno:</label>
        <select id="aluno_codigo" name="aluno_codigo" required>
            <option value=""></option>
            <?php
            $sql = "SELECT CODIGO, NOME FROM aluno";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=\"" . $row['CODIGO'] . "\">" . $row['NOME'] . "</option>";
                }
            } else {
                echo "<option value=\"\">Nenhum aluno disponível</option>";
            }
            ?>
        </select>

        <label for="disciplina_codigo">Disciplina:</label>
        <select id="disciplina_codigo" name="disciplina_codigo" required>
            <option value=""></option>
            <?php
            $sql = "SELECT CODIGO, NOME FROM disciplina";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=\"" . $row['CODIGO'] . "\">" . $row['NOME'] . "</option>";
                }
            } else {
                echo "<option value=\"\">Nenhuma disciplina disponível</option>";
            }
            ?>
        </select>

        <input type="submit" value="Gravar" name="botao">


    
        </div>
    </form>
    <?php
include('config.php');

if (isset($_POST['botao']) && $_POST['botao'] == "Gravar") {
    $turma = $_POST['turma'];
    $ano = $_POST['ano'];
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $faltas = $_POST['faltas'];
    $aluno_codigo = $_POST['aluno_codigo'];
    $disciplina_codigo = $_POST['disciplina_codigo'];

    // Verificar se a turma já tem 20 alunos
    $queryTotalTurma = "SELECT COUNT(*) as total FROM cursa WHERE turma = ?";
    $stmt = $mysqli->prepare($queryTotalTurma);
    $stmt->bind_param("s", $turma);
    $stmt->execute();
    $result = $stmt->get_result();
    $totalTurma = $result->fetch_assoc();

    if ($totalTurma['total'] < 20) {
        // Verificar se o aluno já está cursando a disciplina no mesmo ano
        $queryDisciplinaAno = "SELECT COUNT(*) as total FROM cursa WHERE aluno_codigo = ? AND disciplina_codigo = ? AND ano = ?";
        $stmt = $mysqli->prepare($queryDisciplinaAno);
        $stmt->bind_param("iii", $aluno_codigo, $disciplina_codigo, $ano);
        $stmt->execute();
        $result = $stmt->get_result();
        $totalDisciplinaAno = $result->fetch_assoc();

        if ($totalDisciplinaAno['total'] == 0) {
            // Verificar se o aluno já foi aprovado na disciplina
            $queryAprovado = "SELECT COUNT(*) as total FROM cursa WHERE aluno_codigo = ? AND disciplina_codigo = ? AND nota1 >= 5 AND nota2 >= 5";
            $stmt = $mysqli->prepare($queryAprovado);
            $stmt->bind_param("ii", $aluno_codigo, $disciplina_codigo);
            $stmt->execute();
            $result = $stmt->get_result();
            $totalAprovado = $result->fetch_assoc();

            if ($totalAprovado['total'] == 0) {
                // Inserir os dados
                $insere = "INSERT INTO cursa (turma, ano, nota1, nota2, faltas, aluno_codigo, disciplina_codigo) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $mysqli->prepare($insere);
                $stmt->bind_param("siiddii", $turma, $ano, $nota1, $nota2, $faltas, $aluno_codigo, $disciplina_codigo);
                if ($stmt->execute()) {
                    echo "<script>alert('Dados inseridos com sucesso!')</script>";
                } else {
                    echo "<script>alert('Erro ao inserir os dados!')</script>";
                }
            } else {
                echo "<script>alert('O aluno já foi aprovado nesta disciplina!')</script>";
            }
        } else {
            echo "<script>alert('O aluno já cursou esta disciplina no mesmo ano!')</script>";
        }
    } else {
        echo "<script>alert('A turma já está cheia!')</script>";
    }
}
?>
<script src='./index.js'></script>

</body>
</html>
