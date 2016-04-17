<?php

namespace reflection\mapperFactoryNameSpace;

/**
 * Contract for  the factories which are passed into the Reflection class
 * Class IFactoryNameSpace
 * @package reflection\mapperFactoryNameSpace
 */
interface IFactoryNameSpace {


    /**
     * Returns  the instance of the class required
     * @param $sNameClass
     * @param null $aExtraParam
     * @return mixed
     */
    public function getInstanceOf($sNameClass,$aExtraParam=null);

}