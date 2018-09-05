<?php include_once 'header.php'; ?>
    <body>
        <div class="jumbotron">
        <div class="container">
            <div class="row">
                <h1> Agenda - Adolfo</h1>
            </div>
            </br>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Adicionar</a>
                </p>

                <div style="border: 1px solid black">
                    <form class="form-horizontal" action="functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
                        importar contatos via CSV: 
                        <input type="file" name="file" id="file" class="input-large">
                        <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Adicionar</button>
                    </form>
                </div><br>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = 'SELECT * FROM contatos ORDER BY id DESC';
                        
                        foreach($pdo->query($sql)as $row)
                        {
                            echo '<tr>';
                            echo '<td>'. $row['nome'] . '</td>';
                            echo '<td>'. $row['telefone'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'">Listar</a>';
                            echo ' ';
                            echo '<a class="btn btn-warning" href="update.php?id='.$row['id'].'">Atualizar</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Excluir</a>';
                            echo '</td>';
                            echo '<tr>';
                        }
                        Banco::desconectar();
                        ?>
                    </tbody>                   
                </table>               
            </div>
            <?php
               get_all_records();
            ?>
        </div>
        </div>
    </body>
</html>
