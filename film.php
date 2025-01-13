<?php

class Film {
    public $id;
    public $titel;
    public $omschrijving;
    public $releaseDatum;
    public $genre;
    public $duur;
    public $posterUrl;

    public function __construct($id, $titel, $omschrijving, $releaseDatum, $genre, $duur, $posterUrl) {
        $this->id = $id;
        $this->titel = $titel;
        $this->omschrijving = $omschrijving;
        $this->releaseDatum = $releaseDatum;
        $this->genre = $genre;
        $this->duur = $duur;
        $this->posterUrl = $posterUrl;
    }

    
}
?>
