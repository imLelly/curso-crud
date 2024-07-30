# Sistema Organizador de Cursos

Este sistema foi desenvolvido como parte de uma atividade prática, proposta em sala de aula, foi utilizado como base o arquivo em pdf para criar uma solução básica de organização de cursos. O sistema permite o cadastro de alunos, cursos, UF, Municipios, além de fornecer relatórios para análise.

## Funcionalidades

- **Cadastro de Uf**
- **Cadastro de Município**
- **Cadastro de Aluno**
- **Cadastro de Disciplina**
- **Cadastro de Curso**
- **Relatórios de Alunos**
- **Relatório de Região**
- **Relatório lista**

## Tecnologias Utilizadas

- **PHP**
- **XAMPP**

## Estrutura do Projeto

O projeto está organizado nas seguintes páginas:
- `uf.php`: Interface e lógica para cadastro de UF.
- `municipio.php`: Interface e lógica para cadastro de município.
- `aluno.php`: Interface e lógica para cadastro de aluno.
- `index.html`: Página inicial.
- `disciplina.php`: Interface e lógica para cadastro de disciplina.
- `cursa.php`: Interface e lógica para registro de informações de cursos dos alunos.
- `relatorioAluno.php`: Interface e lógica para visualização do relatório de informações dos alunos.
- `relatorioRegiao.php`: Interface e lógica para visualização do relatório de região.
- `relatorioLista.php`: Interface e lógica para visualização do relatório de lista

## Como Configurar e Rodar o Projeto

1. **Instale o XAMPP**: Faça o download e instale o XAMPP a partir do site oficial [Apache Friends](https://www.apachefriends.org/index.html).
2. **Clone o Repositório**: Clone este repositório em seu ambiente local na pasta `htdocs` do XAMPP.
   ```bash
   git clone https://github.com/imLelly/curso-crud.git
   ```
3. **Configure o Ambiente**: Inicie os módulos Apache e MySQL no painel de controle do XAMPP.
4. **Crie o Banco de Dados**: Utilize o código do arquivo `migration.sql`. 
5. **Acesse o Projeto**: Abra um navegador e digite `localhost/curso-crud/index.html` para começar a usar o sistema.


