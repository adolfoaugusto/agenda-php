<?php 

if(isset($_POST["Import"])){
    $filename=$_FILES["file"]["tmp_name"];       
 
    if($_FILES["file"]["size"] > 0){
        $file = fopen($filename, "r");
        while (($getData = fgetcsv($file, 10000, ";")) !== FALSE){

            $sql = "INSERT INTO contatos (nome,telefone) values ('".$getData[0]."','".$getData[1]."')";
            $result = mysqli_query($conexao, $sql);
            if(!isset($result)){
                echo "<script type=\"text/javascript\">
                        alert(\"Arquivo inválido: Por favor Upload de arquivo CSV.\");
                        window.location = \"index.php\"
                </script>";       
            } else {
                echo "<script type=\"text/javascript\">
                    alert(\"arquivo CSV importado.\");
                    window.location = \"index.php\"
                </script>";
            }
        }
        
        fclose($file); 
    }
}    
 