<?php


class ReflectionWithFactoryTest extends PHPUnit_Framework_TestCase {

    private $oResolver;
    private $sDefaultTxt="Test text from Factory";

    /**
     *called before the test functions will be executed
     *this function is defined in PHPUnit_TestCase and overwritten
     *here
     */
    function setUp() {


        $aMapFactoryNameSpace= array();
        $aMapFactoryNameSpace["layer0"]= new reflection\mapperFactoryNameSpace\FactoryNameSpaceLayer0(new layer0\Layer0Factory($this->sDefaultTxt));
        $this->oResolver= new reflection\ResolverByNameSpace(new reflection\resolveInterfaceByName\ResolveInterfaceByNameFirstLetter(),$aMapFactoryNameSpace);


    }

    /**
     * called after the test functions are executed
     * this function is defined in PHPUnit_TestCase and overwritten
     * here
     */
    function tearDown() {

    }


    /**
     * @test
     */
    public function testlayerOClassOne() {

        $sClassName='layer0\ClassOne';
        $sInterfaceName='layer0\IClassOne';
        $oGotten=$this->oResolver->getInstanceOf('layer0\ClassOne');
        $this->assertInstanceOf($sClassName,$oGotten,"The instance  gotten is not an instances of ".$sClassName);
        $this->assertInstanceOf($sInterfaceName,$oGotten,"The instance  gotten is not  an implementation of  ".$sInterfaceName);
        $this->assertEquals($this->sDefaultTxt,$oGotten->returnText(),"The text expected is ".$this->sDefaultTxt);

    }

    /**
     * @test
     */
    public function testlayerOClassTwo() {

        $sClassName='layer0\ClassTwo';
        $sInterfaceName='layer0\IClassTwo';
        $oGotten=$this->oResolver->getInstanceOf('layer0\ClassTwo');
        $this->assertInstanceOf($sClassName,$oGotten,"The instance  gotten is not an instances of ".$sClassName);
        $this->assertInstanceOf($sInterfaceName,$oGotten,"The instance  gotten is not  an implementation of  ".$sInterfaceName);
        $this->assertEquals($this->sDefaultTxt,$oGotten->returnText(),"The text expected is ".$this->sDefaultTxt);

    }

    /**
     * @test
     */
    public function testlayer1ClassOne() {

        $sClassName='layer1\ClassOne';
        $sInterfaceName='layer1\IClassOne';
        $oGotten=$this->oResolver->getInstanceOf('layer1\ClassOne');
        $this->assertInstanceOf($sClassName,$oGotten,"The instance  gotten is not an instances of ".$sClassName);
        $this->assertInstanceOf($sInterfaceName,$oGotten,"The instance  gotten is not  an implementation of  ".$sInterfaceName);
        $this->assertEquals($this->sDefaultTxt,$oGotten->returnTextDependencyLayer0(),"The text expected is ".$this->sDefaultTxt);

    }


    /**
     * @test
     */
    public function testlayer1ClassTwo() {

        $sClassName='layer1\ClassTwo';
        $sInterfaceName='layer1\IClassTwo';
        $oGotten=$this->oResolver->getInstanceOf('layer1\ClassTwo');
        $this->assertInstanceOf($sClassName,$oGotten,"The instance  gotten is not an instances of ".$sClassName);
        $this->assertInstanceOf($sInterfaceName,$oGotten,"The instance  gotten is not  an implementation of  ".$sInterfaceName);
        $this->assertEquals($this->sDefaultTxt,$oGotten->returnTextDependencyLayer0(),"The text expected is ".$this->sDefaultTxt);

    }

    /**
     * @test
     */
    public function testlayer2ClassOne() {

        $sClassName='layer2\ClassOne';
        $sInterfaceName='layer2\IClassOne';
        $oGotten=$this->oResolver->getInstanceOf('layer2\ClassOne');
        $this->assertInstanceOf($sClassName,$oGotten,"The instance  gotten is not an instances of ".$sClassName);
        $this->assertInstanceOf($sInterfaceName,$oGotten,"The instance  gotten is not  an implementation of  ".$sInterfaceName);
        $this->assertEquals($this->sDefaultTxt,$oGotten->returnTextDependencyLayer1ClassOne(),"The text expected is ".$this->sDefaultTxt);
        $this->assertEquals($this->sDefaultTxt,$oGotten->returnTextDependencyLayer1ClassTwo(),"The text expected is ".$this->sDefaultTxt);

    }


    /**
     * @test
     */
    public function testlayer0ClassOneWithMock() {

        $sClassName='layer0\ClassOne';
        $sInterfaceName='layer0\IClassOne';

        $aMapFactoryNameSpace= array();
        $aMapFactoryNameSpace["layer0"]= new reflection\mapperFactoryNameSpace\FactoryNameSpaceLayer0($this->createFactoryMock());
        $oResolver= new reflection\ResolverByNameSpace(new reflection\resolveInterfaceByName\ResolveInterfaceByNameFirstLetter(),$aMapFactoryNameSpace);
        $oGotten=$oResolver->getInstanceOf($sClassName);

        $this->assertInstanceOf($sClassName,$oGotten,"The instance  gotten is not an instances of ".$sClassName);
        $this->assertInstanceOf($sInterfaceName,$oGotten,"The instance  gotten is not  an implementation of  ".$sInterfaceName);
        $this->assertEquals($oGotten->returnText(),$this->sDefaultTxt,"The text expected is ".$this->sDefaultTxt);

    }


    /**
     * @test
     */
    public function testlayer1ClassOneWithMock() {

        $sClassName='layer1\ClassOne';
        $sInterfaceName='layer1\IClassOne';

        $aMapFactoryNameSpace= array();
        $aMapFactoryNameSpace["layer0"]= new reflection\mapperFactoryNameSpace\FactoryNameSpaceLayer0($this->createFactoryMock());
        $oResolver= new reflection\ResolverByNameSpace(new reflection\resolveInterfaceByName\ResolveInterfaceByNameFirstLetter(),$aMapFactoryNameSpace);
        $oGotten=$oResolver->getInstanceOf($sClassName);

        $this->assertInstanceOf($sClassName,$oGotten,"The instance  gotten is not an instances of ".$sClassName);
        $this->assertInstanceOf($sInterfaceName,$oGotten,"The instance  gotten is not  an implementation of  ".$sInterfaceName);
       $this->assertEquals($oGotten->returnTextDependencyLayer0(),$this->sDefaultTxt,"The text expected is ".$this->sDefaultTxt);

    }



    private function createFactoryMock(){

        $oMockClassOne=$this->getMockBuilder('layer0\ClassOne')->getMock();
        $oMockClassOne->method("returnText")->will($this->returnValue($this->sDefaultTxt));
        $oMockClassFactoryLayer0=$this->getMockBuilder('layer0\Layer0Factory')->getMock();
        $oMockClassFactoryLayer0->method("getInstanceOfClass")->will($this->returnValue($oMockClassOne));
        return $oMockClassFactoryLayer0;

    }


}