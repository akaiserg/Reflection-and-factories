<?php

namespace layer1;
use layer0;
class ClassTwo  implements IClassTwo{

    private $oClassTwo;

    public function __construct(layer0\IClassTwo $oClassTwo){

        echo "the constructor of Layer1->ClassTwo was called<br>";
        $this->oClassTwo=$oClassTwo;

    }

    public function returnTextDependencyLayer0(){

        return $this->oClassTwo->returnText();


    }

}