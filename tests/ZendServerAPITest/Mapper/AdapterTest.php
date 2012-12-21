<?php
namespace ZendServerAPITest;

use ZendService\ZendServerAPI\Adapter\ApplicationList;

class AdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testSetContentTransformation()
    {
        $adapter = $this->getMockForAbstractClass('\ZendService\ZendServerAPI\Adapter\Adapter');
        $content = file_get_contents(__DIR__.'/../DataTypes/TestAsset/applicationlist.xml');
        
        $adapter->setContent($content);
        $this->assertTrue($adapter->getContent() instanceof \SimpleXMLElement);
        $adapter->setContent(new \SimpleXMLElement($content));
        $this->assertTrue($adapter->getContent() instanceof \SimpleXMLElement);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The content needs to be a string or a SimpleXMLElement
     */
    public function testSetContentWithWrongType()
    {
        $adapter = $this->getMockForAbstractClass('\ZendService\ZendServerAPI\Adapter\Adapter');
        
        $adapter->setContent(null);
    }
    
    public function testGetElement()
    {
        $adapter = $this->getMockForAbstractClass('\ZendService\ZendServerAPI\Adapter\Adapter');
        $content = file_get_contents(__DIR__.'/../DataTypes/TestAsset/applicationlist.xml');
        $adapter->setContent($content);
        
        $this->assertCount(8, $adapter->getElements("//id"));
        $this->assertCount(1, $adapter->getElements("/applicationsList/applicationInfo/id[text()=1]"));
        $this->assertCount(2, $adapter->getElements("/applicationsList/applicationInfo"));
        
        $this->assertInstanceOf('SimpleXMLElement', $adapter->getElement("//id"));
        $this->assertInstanceOf('SimpleXMLElement', $adapter->getElement("/applicationsList/applicationInfo/id[text()=1]"));
        $this->assertInstanceOf('SimpleXMLElement', $adapter->getElement("/applicationsList/applicationInfo"));
    }
    
    public function testGeneralXPathWithoutPrepend()
    {
        $adapter = $this->getMockForAbstractClass('\ZendService\ZendServerAPI\Adapter\Adapter');
        $content =<<<XML
            <root>
                <foo>
                    <bar>blubb</bar>
                </foo>
            </root>        
XML;
        $adapter->setContent($content);
        $this->assertInstanceOf('SimpleXMLElement', $adapter->getElement("//foo"));
    }
}

