<?php


namespace reflection\resolveInterfaceByName;

/**
 * Interface   to resolve the class which instances an specific interface  by using the name of the  it.
 * Class IResolverInterfaceByName
 * @package reflection\ResolverInterfaceByName
 */
interface IResolveInterfaceByName {

    /**
     * Returns  the name of the class with its namespace
     * @param $sClassNameOrInterface
     * @return mixed
     */
    public function getClassName($sClassNameOrInterface);

}