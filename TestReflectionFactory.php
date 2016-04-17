<?php

require_once"vendor/autoload.php";


$sDefaultTxt="<b>Default txt passed to the factory</b>";

$aMapFactoryNameSpace= array();
$aMapFactoryNameSpace["layer0"]= new reflection\mapperFactoryNameSpace\FactoryNameSpaceLayer0(new layer0\Layer0Factory($sDefaultTxt));
$oReflector= new reflection\ResolverByNameSpace(new reflection\resolveInterfaceByName\ResolveInterfaceByNameFirstLetter(),$aMapFactoryNameSpace);

try{
    $oClassOne=$oReflector->getInstanceOf("layer0\\ClassOne");
    echo $oClassOne->returnText();
}catch(Exception $e){
    echo $e->getMessage();
}

echo "<br><br>------------------------------<br><br>";


try{
    $oClassTwo=$oReflector->getInstanceOf("layer0\\ClassTwo");
    echo $oClassTwo->returnText();
}catch(Exception $e){
    echo $e->getMessage();
}

echo "<br><br>------------------------------<br><br>";


try{
    $oClassOne=$oReflector->getInstanceOf("layer1\\ClassOne");
    echo $oClassOne->returnTextDependencyLayer0();
}catch(Exception $e){
    echo $e->getMessage();
}

echo "<br><br>------------------------------<br><br>";

try{
    $oClassOne=$oReflector->getInstanceOf("layer2\\ClassOne");
    echo $oClassOne->returnTextDependencyLayer1ClassOne();
}catch(Exception $e){
    echo $e->getMessage();
}