<?php

namespace reflection\mapperFactoryNameSpace;

use layer0;

/**
 * Handler for  the factory of  the layer0
 * Class FactoryNameSpaceLayer0
 * @package reflection\mapperFactoryNameSpace
 */
class FactoryNameSpaceLayer0 implements  IFactoryNameSpace {

    /**
     * Instance of the layer0 factory
     * @var \layer0\Layer0Factory
     */
    private $oLayer0Factory;


    /**
     * Constructor of the class
     * @param layer0\Layer0Factory $oLayer0Factory
     */
    public function __construct(layer0\Layer0Factory $oLayer0Factory){


        $this->oLayer0Factory=$oLayer0Factory;

    }


    /**
     * Calls of the method of the factory in order to get the instance of one class
     * @param $sNameClass
     * @param null $mExtraParam
     * @return mixed
     * @throws \Exception|Exception
     */
    public function getInstanceOf($sNameClass,$mExtraParam=null){

        try{

            return $this->oLayer0Factory->getInstanceOfClass($sNameClass);
        }catch(Exception $e){
            throw $e;
        }

    }

}