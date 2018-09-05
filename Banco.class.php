<?php

class Banco
{
    private static $dbNome = 'agenda';
    private static $dbHost = 'localhost:3306';
    private static $dbUsuario = 'root';
    private static $dbSenha = '1234';
    
    private static $conexao = null;
    
    public function __construct(){
        die('A função Init nao é permitido!');
    }
    
    public static function conectar()
    {
        if(null == self::$conexao)
        {
            try
            {
                self::$conexao =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbNome, self::$dbUsuario, self::$dbSenha); 
            }
            catch(PDOException $exception)
            {
                die($exception->getMessage());
            }
        }
        return self::$conexao;
    }
    
    public static function desconectar()
    {
        self::$conexao = null;
    }
}

?>
