<?php
/**
 @todo Refatorar o código abaixo
 * Faças as alterações que achar necessário, mas o resultado em tela deve ser o mesmo.
 * Leve em consideração a sua interpretação de um código limpo e organizado.
 */
class Pessoas {

    public $idPessoa;
    public $NomePessoa;

    public function salvar_Pessoa($nome, Array &$listaPessoas ) {
        $this->idPessoa   = rand();
        $this->NomePessoa = $nome;

        array_push( $listaPessoas, 
            array(
                'id' => $this->idPessoa, 
                'nome' => $this->NomePessoa
            )
        );
    }

    public function addAniPss($nomeAnimal, $especie, $raca, $id_pessoa, $cor) {

        $animal = new Animal();

        $animal->nome_animal = $nomeAnimal;
        $animal->Especie     = $especie;
        $animal->raca        = $raca;
        $animal->idPessoa    = $id_pessoa;

        $animal->Salvar();
    }

    public function listPss($listaPessoas, $listaAnimais) {
        foreach ($listaPessoas as $campo) { ?>

            <h2>Proprietário</h2>
            <strong>id :</strong> <?= $campo['id'] ?><br />
            <strong>Nome :</strong> <?= $campo['nome'] ?>
            
            <h2>Seus Animais cadastrados</h2>
            <?php foreach ($listaAnimais[$campo['id']] as $animal) { ?>
                <strong>Nome Animal :</strong> <?= $animal['nome_animal'] ?><br />
                <strong>Especie :</strong> <?= $animal['Especie'] ?><br />
                <strong>Raca :</strong> <?= $animal['Raca'] ?><br />
                
                <?php if ($animal['Especie'] == 'cachorro') { ?>
                    <strong>nome Tecnico :</strong> Canino<br />
                <?php } if ($animal['Especie'] == 'gato') { ?>
                    <strong>nome Tecnico :</strong> Felino<br />
                <?php } else { ?>
                    <strong>nome Tecnico :</strong> Indefenido<br />
                    <?php
                }
            } ?>
        <hr /><?php
        }
    }

}

class Animal {

    public $nome_animal;
    public $Especie;
    public $Raca;
    public $idPessoa;

    /**
     * Salva Animal
     * @return type
     */
    public function salvar(Array &$listaAnimais = array()) {

        $listaAnimais[$this->idPessoa][] = array(
            'nome_animal' => $this->idPessoa,
            'Especie'     => $this->Especie,
            'Raca'        => $this->Raca
        );
    }

}

$pessoa       = new Pessoas();
$listaPessoas = array();

$pessoa->salvar_Pessoa('Fulano', $listaPessoas);

$animais              = new Animal();
$listaAnimais         = array();

$animais->nome_animal = 'toto';
$animais->Raca        = 'Australiano';
$animais->Especie     = 'Periquito';
$animais->idPessoa    = $pessoa->idPessoa;

$animais->salvar($listaAnimais);
?>

<html>
    <body>
    <?php $pessoa->listPss($listaPessoas, $listaAnimais); ?>
    </body>
</html>
