<?php

namespace reflection\resolveInterfaceByName;

/**
 * Erases  the first letter   if the class passed is an interface
 * Class ResolveInterfaceByNameFirstLetter
 * @package reflection\ResolveInterfaceByName
 */
class ResolveInterfaceByNameFirstLetter implements IResolveInterfaceByName {

    /**
     * Return the name of the class with its namespace
     * @param $sClassNameOrInterface
     * @return string
     */
    public function getClassName($sClassNameOrInterface){

        if (class_exists($sClassNameOrInterface)) {
            return $sClassNameOrInterface;
        }else{
            // separates   by \
            $aNameSpaceAndInterfaceName=explode("\\",$sClassNameOrInterface);
            $iCount= sizeof($aNameSpaceAndInterfaceName);
            $sInterfaceNameWithoutNameSpace=$aNameSpaceAndInterfaceName[$iCount-1];
            $sNameOfTheClass = substr($sInterfaceNameWithoutNameSpace, 1);
            $aNameSpaceAndInterfaceName[$iCount-1]=$sNameOfTheClass;
            return implode("\\", $aNameSpaceAndInterfaceName);
        }

    }

}