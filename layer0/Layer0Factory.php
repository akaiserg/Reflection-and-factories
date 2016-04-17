<?php



namespace layer0;


 class  Layer0Factory {


    private $sText=null;


    public function __construct($sText=null){

        $this->sText=$sText;

    }


    public function getInstanceOfClass($sClassName){

        $sNameSpaceWithClass="layer0\\".$sClassName;
        return $this->getInstanceOf($sNameSpaceWithClass);

    }

     public function getInstanceOfClassWithNameSpace($sClassWithNameSpace){

         return $this->getInstanceOf($sClassWithNameSpace);

     }

     private function getInstanceOf($sClassWithNameSpace){

         if(class_exists($sClassWithNameSpace)){
             return new $sClassWithNameSpace($this->sText);
         }else{
             throw new \Exception("Class: ".$sClassWithNameSpace.", wasn't found .");
         }

     }

}