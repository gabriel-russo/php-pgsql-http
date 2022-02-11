<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema Distribuido</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alatsi&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <main>
        <div class="titulo">
            <h1>Seção de comentários da aula de Sistemas Distribuidos</h1>
            <div>
                <img src="img/270D.svg" alt="Mão e Caneta" width="45"/>
                <img src="img/1F310.svg" alt="Internet" width="45"/>
                <img src="img/1F468-200D-1F3EB.svg" alt="Professor" width="45"/>
            </div>
        </div>

        <div class="formulario-container">
            <h3>Participe aqui!</h3>

            <div class="formulario">
                <form method="post">
                    <div class="formulario-input">
                        <label for="nome">Nome:</label>
                        <input type="text" size="10" maxlength="40" id="nome" name="nome" /><br />
                    </div>

                    <div class="formulario-input">
                        <label for="comentario">Comentário:</label>
                        <textarea placeholder="Escreva..." id="comentario" cols="30" rows="5" name="comentario"></textarea>
                    </div>

                    <input type="submit" value="Enviar!!" class="botao" />
                </form>
            </div>
        </div>

        <?php
            $host = "psql";
            $port = "5432";
            $dbname = "postgres";
            $senha = "docker";
            $usuario = "docker";
            $conn_string = "host=$host port=$port dbname=$dbname user=$usuario password=$senha";
            $conn = pg_connect($conn_string) or
            die ("Não foi possível conectar ao servidor pgSQL");

            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $nome = $_POST["nome"];
                $comentario = $_POST["comentario"];
                $query = pg_insert($conn,"comentarios",array('nome'=>$nome,'comentario'=>$comentario));
                pg_fetch_all($query);
            }
        ?>

        <div class="comentarios-container">
            <div class="comentarios-titulo">
                <h2>Os comentários:</h2>
                <img src="img/1F4DD.svg" alt="Papel e Caneta" width="45"/>
            </div>

        <?php
                $host = "psql";
                $port = "5432";
                $dbname = "postgres";
                $senha = "docker";
                $usuario = "docker";
                $conn_string = "host=$host port=$port dbname=$dbname user=$usuario password=$senha";
                $conn = pg_connect($conn_string) or
                die ("Não foi possível conectar ao servidor pgSQL");

                $query = pg_query($conn, "SELECT nome,comentario FROM comentarios;");

                while ($resultado = pg_fetch_assoc($query)) {

                    echo <<<HTML
                        <div class="comentarios">
                            <span class="comentarios-nome"> {$resultado["nome"]} </span>
                            <span class="comentarios-msg"> {$resultado["comentario"]} </span>
                        </div>
                HTML;
                }
                ?>
        </div>
    </main>
</body>
</html>