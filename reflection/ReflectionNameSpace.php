<?php


namespace reflection;

use reflection\mapperFactoryNameSpace;

/**
 * Class which can return  the instance of a class by using reflection or  analyzing  maps of key-value for classes or interfaces.
 * Interfaces  have an relation the name of the interface and the class this is: IClassName -> ClassName;
 * if   an interface is passed as an argument to  the method getInstanceOf,  it  will remove the first letter of the interface (I)
 * Class ResolverByReflection
 * @package reflection
 */
class ResolverByNameSpace{


    /**
     * Array that contains the factories for namespaces
     * @var array|null
     */
    private $aFactoryNameSpaces=null;

    /**
     * Object  which can obtain the name of the class
     * @var IResolveInterfaceByName
     */
    private $oResolverInterface=null;

    /**
     * Constructor of the class
     * @param resolveInterfaceByName\IResolveInterfaceByName $oResolverInterface
     * @param array $aFactoryNameSpaces
     */
    public function  __construct( resolveInterfaceByName\IResolveInterfaceByName  $oResolverInterface=null,array$aFactoryNameSpaces=null){

        $this->aFactoryNameSpaces=$aFactoryNameSpaces;
        $this->oResolverInterface=$oResolverInterface;


    }

    /**
     * Returns the instance of the class or interfaces passed  by argument
     * @param $sClass  Name of the class or interface  with namespace
     * @return null|object
     */
    public function getInstanceOf($sClass){

        $oMatchMaps=$this->checkMapMapperFactoryNameSpace($this->aFactoryNameSpaces,$sClass);
        if($oMatchMaps!=null){
            return $oMatchMaps;
        }else{
            //If the class is not in the map, this starts to analyze  the constructor
            return $this->checkConstructor($sClass);
        }

    }

    /**
     * Checks if   the namespace  of the  class is mapped   inside the array with the factories in order to  get an instance.
     * @param array $oFactoryNameSpace
     * @param $sInterfaceNameWithNameSpace
     * @param null $aArg
     * @return null
     */
    private  function checkMapMapperFactoryNameSpace(array &$oFactoryNameSpace,$sInterfaceNameWithNameSpace,$aArg=null){

        $oInstance=null;
        if($oFactoryNameSpace!=null){
            foreach($oFactoryNameSpace as $sNameClassSpace=>$oFactory){
                if($sNameClassSpace==$this->getNameSpace($sInterfaceNameWithNameSpace)){
                    $oInstance= $oFactory->getInstanceOf($this->getNameClass($sInterfaceNameWithNameSpace),$aArg);
                }
            }
        }
        return $oInstance;

    }

    /**
     * Analyzes  the constructor  of the  class or interface  passed in order to see if it has  dependencies
     * @param $sClass
     * @return array|null|object
     */
    private function checkConstructor($sClass){

        $reflector = new \ReflectionClass($sClass);
        $constructor = $reflector->getConstructor();
        if($constructor==null){
            return new $sClass;
        }
        $parameters = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);
        if(is_array($dependencies)){
            return $reflector->newInstanceArgs($dependencies);
        }else{
            return $dependencies;
        }

    }


    /**
     * Checks the constructor's values which are  dependencies of the class
     * @param $aParameters
     * @return array
     */
    private function getDependencies($aParameters){

        $aDependencies = array();
        foreach($aParameters as $oParameter){
            $oDependency = $oParameter->getClass();
            if($oDependency==null){
                $aDependencies[] = $this->resolveNonClass($oParameter);
            }else{
                $oInstance=$this->checkMapMapperFactoryNameSpace($this->aFactoryNameSpaces,$oDependency->name);
                if($oInstance!=null){
                    $aDependencies[]=$oInstance;
                }else{
                    $aDependencies[] = $this->getInstanceOf($this->getNameImplementation($this->oResolverInterface,$oDependency->name));
                }
            }
        }
        return $aDependencies;

    }

    /**
     * Checks the  default value of a constructor  when  it has no dependencies
     * @param $oParameter
     * @return mixed
     * @throws Exception
     */
    private function resolveNonClass($oParameter){

        if($oParameter->isDefaultValueAvailable()){
            return $oParameter->getDefaultValue();
        }
        throw new Exception("Cannot resolve the Default value.");
    }

    /**
     * Returns just the name of the class without  its namespace
     * @param $sNameInterface
     * @return string
     */
    private function getNameClass($sNameInterface){

        $aNameSpaceAndInterfaceName=explode("\\",$sNameInterface);
        $iCount= sizeof($aNameSpaceAndInterfaceName);
        $sInterfaceNameWithoutNameSpace=$aNameSpaceAndInterfaceName[$iCount-1];
        if(class_exists($sNameInterface)){
            return $sInterfaceNameWithoutNameSpace;

        }else{
            return substr($sInterfaceNameWithoutNameSpace, 1);
        }

    }


    /**
     * Returns just the namespace
     * @param $sNameInterface
     * @return string
     */
    private function getNameSpace($sNameInterface){

        $aNameSpaceAndInterfaceName=explode("\\",$sNameInterface);
        $iCount= sizeof($sNameInterface);
        //print_r($aNameSpaceAndInterfaceName);
        unset($aNameSpaceAndInterfaceName[$iCount]);
        //print_r($aNameSpaceAndInterfaceName);
        $sReturn=implode("\\", $aNameSpaceAndInterfaceName);
        //echo "__-".$sReturn."-__";
        return $sReturn;
    }

    /**
     * Gets  the name of the class which implements  the interface passed  as an argument
     * @param resolveInterfaceByName $oResolverInterface the class   that resolves or obtains the name of the class
     * @param $sNameOfTheClass
     * @return mixed
     */
    private function getNameImplementation( $oResolverInterface =null, $sNameOfTheClass){

        if($oResolverInterface!=null  ){
            return $oResolverInterface->getClassName($sNameOfTheClass);
        }else{
            return $sNameOfTheClass;
        }

    }

}
