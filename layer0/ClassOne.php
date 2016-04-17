<?php

namespace layer0;

class ClassOne  implements IClassOne{

    private $sTxt;

    public function __construct($sTxt=null){

        echo "the constructor of Layer0->ClassOne was called  <br>";
        if($sTxt!=null){
            $this->sTxt=$sTxt;
        }else{
            $this->sTxt="Layer0->ClassOne->Method1 was called";
        }

    }


    public function returnText(){

        return $this->sTxt;

    }

}