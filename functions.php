<?php 
require_once 'Banco.class.php';

if(isset($_POST["Import"])){
    $filename=$_FILES["file"]["tmp_name"];       
    // $csv = array_map('str_getcsv', file('data.csv'));

    if($_FILES["file"]["size"] > 0){
        $ler = read_csv_to_array($filename);
        // print_r($ler);
        foreach ($ler as $item) {
        
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO contatos (nome, telefone) VALUES(?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($item['nome'],$item['telefone']));
            
        }
        if(!isset($q)){
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
        
        // fclose($file); 
    }
}     

function read_csv_to_array($filename = '', $delimiter = ','){
    
    if (!file_exists($filename) || !is_readable($filename)) return false;
    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
            if (!$header) $header = $row;
            else $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}