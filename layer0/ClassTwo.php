<?php

namespace layer0;

class ClassTwo  implements IClassTwo{

    private $sTxt;

    public function __construct($sTxt=null){

        echo "the constructor of Layer0->ClassTwo was called<br>";
        if($sTxt!=null){
            $this->sTxt=$sTxt;
        }else{
            $this->sTxt= "Layer0->ClassTwo->Method2 was called";
        }

    }


    public function returnText(){

        return $this->sTxt;

    }

}