<?php include_once 'header.php'; ?>
    
    <body>
        <div class="container">
            <div clas="span10 offset1">
                <div class="row">
                    <h3 class="well"> Adicionar Contato </h3>
                    <form class="form-horizontal" action="create.php" method="post">
                        
                        <div class="control-group <?php echo !empty($nomeErro)?'error ' : '';?>">
                            <label class="control-label">Nome</label>
                            <div class="controls">
                                <input size= "50" name="nome" type="text" placeholder="Nome" required="" value="<?php echo !empty($nome)?$nome: '';?>">
                                <?php if(!empty($nomeErro)): ?>
                                    <span class="help-inline"><?php echo $nomeErro;?></span>
                                <?php endif;?>
                            </div>
                        </div>
                        
                        <div class="control-group <?php echo !empty($telefoneErro)?'error ': '';?>">
                            <label class="control-label">Telefone</label>
                            <div class="controls">
                                <input size="35" name="telefone" type="number" placeholder="Telefone" required="" value="<?php echo !empty($telefone)?$telefone: '';?>">
                                <?php if(!empty($telefoneErro)): ?>
                                    <span class="help-inline"><?php echo $telefoneErro;?></span>
                                <?php endif;?>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <br/>
                            <button type="submit" class="btn btn-success">Adicionar</button>
                            <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                        </div>

                    </form>
                </div>
        </div>
    </body>
</html>


<?php
    if(!empty($_POST)){
        //Acompanha os erros de validação
        $nomeErro = null;
        $telefoneErro = null;
        
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        
        //Validaçao dos campos:
        $validacao = true;
        if(empty($nome) || ctype_digit($nome) ){
            $nomeErro = 'Por favor digite o seu nome, somente letras!';
            $validacao = false;
        }
        
        if(empty($telefone) || !is_numeric($telefone)){
            $telefoneErro = 'Por favor digite o número do telefone!';
            $validacao = false;
        }
        
        //Inserindo no Banco:
        if($validacao){
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO contatos (nome, telefone) VALUES(?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$telefone));
            Banco::desconectar();
            header("Location: index.php");
        }
    }
?>
