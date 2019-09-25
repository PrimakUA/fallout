<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/fallout/_db.php');

abstract class RecordGetter
{
    protected $link;
    public $id;

    public function __construct()
    {
        $this->link = Db::getDbLink();
    }

    public function getById($id)
    {
        $rQuery = mysqli_query($this->link, 'SELECT * FROM ' . $this->getTable() . ' where id = ' . $id);
       // var_dump($rQuery);
        $rQueryArray = mysqli_fetch_assoc($rQuery);
        foreach ($rQueryArray as $key => $value) {
            $this->$key = $value;
        }
      //  var_dump($rQueryArray);
    }

    public function getRandomPerson()
    {
        $allIdQuery = 'SELECT id FROM characters';
        $readAllId = mysqli_query($this->link, $allIdQuery);
        $charactersId = mysqli_fetch_all($readAllId);
        $pqsCharactersId = count($charactersId);
        $randomSelect = rand(0, ($pqsCharactersId - 1));
        $randomSelectId = $charactersId[$randomSelect];
//        $randomCharacter = $this->getById($randomSelectId[0]);
        $randomCharacter = $this->getCharacterById($randomSelectId[0]);

       // var_dump($randomCharacter);


        return $randomCharacter;
    }

    protected abstract function getTable();
}
