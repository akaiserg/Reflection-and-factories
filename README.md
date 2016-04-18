# Reflection and Factories in PHP	

When you're working with a DIC framework, it takes the control of the instantiation of the classes  but sometimes   it's good to separate the layers of the system, so  you don't  have a DIC framework that controls the instantiation of the  whole system. For instance,  I have two layers  where each one has its own  composer file and  the lower layer  just shares a factory class, therefore,  the DI container can't keep applying reflection  when  reaches the factory that you should  use to get an instances of DAO object.



In order to solve this problem,  I  associate  a factory with  a specific namespace, so  when the  object that does reflection  at constructors  finds   this specific  namespaces,  it asks for the factory which builds the objects of that  namespace.


```PHP
$aMapFactoryNameSpace= array();
$aMapFactoryNameSpace["layer0"]= new reflection\mapperFactoryNameSpace\FactoryNameSpaceLayer0(new layer0\Layer0Factory($sDefaultTxt));
$oReflector= new reflection\ResolverByNameSpace(new reflection\resolveInterfaceByName\ResolveInterfaceByNameFirstLetter(),$aMapFactoryNameSpace);

```

In this case the namespace 'layer0'  has a factory.



```PHP
private  function checkMapFactoryNameSpace(array &$oFactoryNameSpace,$sInterfaceNameWithNameSpace,$aArg=null){

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
```




The reflection class  just looks for the namespace inside of the array and if  it  finds  the namespace, it will use it to get the instance needed  and stop the   recursion at the constructor.
