<?php include_once 'header.php'; 

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    
    if ( null==$id ) {
        header("Location: index.php");
    }
    
    if ( !empty($_POST)) {            
        
        $nomeErro = null;
        $telefoneErro = null;
        
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        
        //Validação
        $validacao = true;
        if(empty($nome) || ctype_digit($nome) ){
            $nomeErro = 'Por favor digite o seu nome, somente letras!';
            $validacao = false;
        }

        if (empty($telefone) || !is_numeric($telefone) ){
            $telefone = 'Por favor digite o telefone!';
            $validacao = false;
        }
        
        // update data
        if ($validacao) {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE contatos set nome = ?, telefone = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$telefone,$id));
            Banco::desconectar();
            header("Location: index.php");
        }
    } else {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM contatos where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $nome = $data['nome'];
        $telefone = $data['telefone'];
        Banco::desconectar();
    }
?>
 
<body>
    <div class="container">
        
        <div class="span10 offset1">
            <div class="row">
                <h3 class="well"> Atualizar Contato </h3>
            </div>
     
            <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
                
                <div class="control-group <?php echo !empty($nomeErro)?'error':'';?>">
                    <label class="control-label">Nome</label>
                    <div class="controls">
                        <input name="nome" size="50" type="text"  placeholder="Nome" value="<?php echo !empty($nome)?$nome:'';?>">
                        <?php if (!empty($nomeErro)): ?>
                            <span class="help-inline"><?php echo $nomeErro;?></span>
                        <?php endif; ?>
                    </div>
                </div>
                    
                <div class="control-group <?php echo !empty($telefoneErro)?'error':'';?>">
                    <label class="control-label">Telefone</label>
                    <div class="controls">
                        <input name="telefone" size="30" type="text"  placeholder="Telefone" value="<?php echo !empty($telefone)?$telefone:'';?>">
                        <?php if (!empty($telefoneErro)): ?>
                            <span class="help-inline"><?php echo $telefoneErro;?></span>
                        <?php endif; ?>
                    </div>
                </div>
                  
                <br/>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                    <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                </div>
            </form>
        </div>                 
     
    </div> 
  </body>
</html>

