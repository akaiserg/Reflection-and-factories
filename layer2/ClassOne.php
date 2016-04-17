<?php


namespace layer2;
use layer1;

class ClassOne implements  IClassOne{

    private $oClassOne;
    private $oClassTwo;

    public function __construct(layer1\IClassOne $oClassOne, layer1\IClassTwo $oClassTwo ){


        $this->oClassOne=$oClassOne;
        $this->oClassTwo=$oClassTwo;

    }

    public function returnTextDependencyLayer1ClassOne(){

        return $this->oClassOne->returnTextDependencyLayer0();


    }


    public function returnTextDependencyLayer1ClassTwo(){

        return $this->oClassTwo->returnTextDependencyLayer0();

    }

}