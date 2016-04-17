<?php



class ResolveInterfaceByNameTest extends PHPUnit_Framework_TestCase {


    private $oResolverByName;
    private $sClassName="NameInterface";
    private $sInterfaceName='INameInterface';

    /**
     *called before the test functions will be executed
     *this function is defined in PHPUnit_TestCase and overwritten
     *here
     */
    function setUp() {

        $this->oResolverByName =new reflection\resolveInterfaceByName\ResolveInterfaceByNameFirstLetter();

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
    public function testType() {

        $sInterface='reflection\resolveInterfaceByName\IResolveInterfaceByName';
        $this->assertInstanceOf($sInterface,$this->oResolverByName,"The onject is not an instance of ".$sInterface);

    }


    /**
     * @test
     */
    public function testInterfaceName() {

        $sInterfaceName="INameInterface";

        $sReturn=$this->oResolverByName->getClassName($sInterfaceName);
        $this->assertEquals($this->sClassName,$sReturn,"The string returned wasn't ".$this->sClassName);

    }


    /**
     * @test
     */
    public function testInterfaceWithNameSpace() {


        $sInterfaceName='namespacesPart1\namespacesPart2\\';
        $sReturn=$this->oResolverByName->getClassName($sInterfaceName.$this->sInterfaceName);
        $this->assertEquals($sInterfaceName.$this->sClassName,$sReturn,"The string returned wasn't ".$sInterfaceName.$this->sClassName);

    }



    /**
     * @test
     */
    public function testClassName() {


        $sClass="layer0\\ClassOne";
        $sReturn=$this->oResolverByName->getClassName("layer0\\ClassOne");
        $this->assertEquals($sReturn,$sClass,"The name of the class returned is not ".$sClass);

    }


}