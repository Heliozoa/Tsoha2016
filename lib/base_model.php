<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $errors = array_merge($errors, $this->{$validator}());
      }
      return $errors;
    }
    
    //luo taulukon tietokannan rivin tai muun listan pohjalta. $class on luokan nimi ja taulukkoon otetaan mukaan vain ne attribuutit, joille löytyy vastine $class-luokan määrittelystä.
    public static function array_from_row($row, $class){
        $array = array();
        foreach(get_class_vars($class) as $var => $null){
            if(array_key_exists($var, $row)){
                $array[$var] = $row[$var];
            }
        }
        return $array;
    }
    
    //palauttaa olion muuttujat ilman id ja validators kenttiä
    public function vars(){
        $vars = get_object_vars($this);
        unset($vars['id']);
        unset($vars['validators']);
        return $vars;
    }

  }
