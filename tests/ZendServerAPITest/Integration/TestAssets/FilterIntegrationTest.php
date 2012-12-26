<?php

namespace ZendServerAPITest\Integration;

use ZendService\ZendServerAPI\DataTypes\ServerInfo;

class FilterIntegrationTest extends \ZendServerAPITest\Integration\BaseAPIIntegration
{
    public function setUp()
    {
        $this->mockObject = new \ZendService\ZendServerAPI\Filter(self::ZS6LOCAL);
        $this->object = new \ZendService\ZendServerAPI\Filter(self::ZS6LOCAL);
        parent::setUp();
    }

    public function getFilterGetByType()
    {
        $filters = new \ZendService\ZendServerAPI\DataTypes\Filters();

        $filter1 = new \ZendService\ZendServerAPI\DataTypes\Filter();
        $filter1->setData(array());
        $filter1->setId((int)1);
        $filter1->setName('All Issues');
        $filter1->setCustom(false);

        $filter2 = new \ZendService\ZendServerAPI\DataTypes\Filter();
        $filter2->setData(
            array(
                "eventTypes" => array(
                    "function-error",
                    "zend-error",
                    "java-exception",
                    "jq-job-exec-error",
                    "tracer-write-file-fail",
                    "jq-job-logical-failure",
                    "custom"))
        );
        $filter2->setId((int)3);
        $filter2->setName('Errors Issues');
        $filter2->setCustom(false);

        $filter3 = new \ZendService\ZendServerAPI\DataTypes\Filter();
        $filter3->setData(array("eventTypes" => array("function-slow-exec","request-slow-exec")));
        $filter3->setId((int)2);
        $filter3->setName('Performance Issues');
        $filter3->setCustom(false);

        $filter4 = new \ZendService\ZendServerAPI\DataTypes\Filter();
        $filter4->setData(
            array("eventTypes" => array(
                "request-large-mem-usage","request-relative-large-out-size","jq-job-exec-delay")
            )
        );
        $filter4->setId((int)4);
        $filter4->setName('Resources Issues');
        $filter4->setCustom(false);

        $filters->addFilter($filter1);
        $filters->addFilter($filter2);
        $filters->addFilter($filter3);
        $filters->addFilter($filter4);

        return $filters;
    }

    public function getFilterSave()
    {
        $filter = new \ZendService\ZendServerAPI\DataTypes\Filter();
        $filter->setId(10);
        $filter->setName("test2");
        $filter->setCustom(true);

        return $filter;
    }

    public function getFilterDelete()
    {
        $filter = new \ZendService\ZendServerAPI\DataTypes\Filter();
        $filter->setId(10);
        $filter->setName("test2");
        $filter->setCustom(true);

        return $filter;
    }

    public function mockProvider()
    {
        static::$mockDataProvider = array(
            array("filterGetByType", $this->getFilterGetByType(), array("issue")),
            array("filterSave", $this->getFilterSave(), array("issue", "foo")),
            array("filterDelete", $this->getFilterDelete(), array("foo"))
        );

        return static::$mockDataProvider;
    }

    public function productionProvider()
    {
        static::$localDataProvider = array(
            array("filterGetByType", array("issue"), self::LOCAL)
        );

        return static::$localDataProvider;
    }

    public function getSection()
    {
        return "filter";
    }
}

