<?php

namespace ZendServerAPITest\Integration;

use ZendService\ZendServerAPI\DataTypes\ServerInfo;

class AuditIntegrationTest extends \ZendServerAPITest\Integration\BaseAPIIntegration
{
    public function setUp()
    {
        $this->mockObject = new \ZendService\ZendServerAPI\Audit(self::ZS6LOCAL);
        $this->object = new \ZendService\ZendServerAPI\Audit(self::ZS6LOCAL);
        parent::setUp();
    }

    public function getAuditSetSettings()
    {
        $auditSettings = new \ZendService\ZendServerAPI\DataTypes\AuditSettings();
        $auditSettings->setHistory(20);
        $auditSettings->setSendToMail("a@b.com");
        $auditSettings->setSendToUrl("http://www.test.com");

        return $auditSettings;
    }

    public function getAuditGetList()
    {
        $auditMessages = new \ZendService\ZendServerAPI\DataTypes\AuditMessages();

        $auditMessage = new \ZendService\ZendServerAPI\DataTypes\AuditMessage();
        $auditMessage->setId(7);
        $auditMessage->setUsername("admin");
        $auditMessage->setRequestInterface("INTERFACE_UI");
        $auditMessage->setRemoteAddr("127.0.0.1");
        $auditMessage->setAuditType("AUDIT_GUI_AUTHENTICATION");
        $auditMessage->setAuditTypeTranslated("GUI Authentication");
        $auditMessage->setBaseUrl("");
        $auditMessage->setCreationTime("2012-12-25T22:47:28+01:00");
        $auditMessage->setCreationTimeTimestramp("1356472048");
        $auditMessage->setOutcome("OK");
        $auditMessages->addAuditMessage($auditMessage);

        $auditMessage2 = new \ZendService\ZendServerAPI\DataTypes\AuditMessage();
        $auditMessage2->setId(6);
        $auditMessage2->setUsername("admin");
        $auditMessage2->setRequestInterface("INTERFACE_UI");
        $auditMessage2->setRemoteAddr("127.0.0.1");
        $auditMessage2->setAuditType("AUDIT_GUI_AUTHENTICATION");
        $auditMessage2->setAuditTypeTranslated("GUI Authentication");
        $auditMessage2->setBaseUrl("");
        $auditMessage2->setCreationTime("2012-12-24T15:59:18+01:00");
        $auditMessage2->setCreationTimeTimestramp("1356361158");
        $auditMessage2->setOutcome("OK");
        $auditMessages->addAuditMessage($auditMessage2);

        $auditMessage3 = new \ZendService\ZendServerAPI\DataTypes\AuditMessage();
        $auditMessage3->setId(5);
        $auditMessage3->setUsername("admin");
        $auditMessage3->setRequestInterface("INTERFACE_UI");
        $auditMessage3->setRemoteAddr("127.0.0.1");
        $auditMessage3->setAuditType("AUDIT_RESTART_PHP");
        $auditMessage3->setAuditTypeTranslated("PHP Restart");
        $auditMessage3->setBaseUrl("");
        $auditMessage3->setCreationTime("2012-12-24T15:29:18+01:00");
        $auditMessage3->setCreationTimeTimestramp("1356359358");
        $auditMessage3->setOutcome("OK");
        $auditMessages->addAuditMessage($auditMessage3);

        $auditMessage4 = new \ZendService\ZendServerAPI\DataTypes\AuditMessage();
        $auditMessage4->setId(4);
        $auditMessage4->setUsername("admin");
        $auditMessage4->setRequestInterface("INTERFACE_UI");
        $auditMessage4->setRemoteAddr("127.0.0.1");
        $auditMessage4->setAuditType("AUDIT_DIRECTIVES_MODIFIED");
        $auditMessage4->setAuditTypeTranslated("Directives Modified");
        $auditMessage4->setBaseUrl("");
        $auditMessage4->setCreationTime("2012-12-24T15:29:13+01:00");
        $auditMessage4->setCreationTimeTimestramp("1356359353");
        $auditMessage4->setExtraData(
            array("Extension name: date, Directive: date.timezone, Old value: , New value: Europe/Berlin")
        );
        $auditMessage4->setOutcome("In Progress");
        $auditMessages->addAuditMessage($auditMessage4);


        $auditMessage5 = new \ZendService\ZendServerAPI\DataTypes\AuditMessage();
        $auditMessage5->setId(3);
        $auditMessage5->setUsername("admin");
        $auditMessage5->setRequestInterface("INTERFACE_UI");
        $auditMessage5->setRemoteAddr("127.0.0.1");
        $auditMessage5->setAuditType("AUDIT_RESTART_PHP");
        $auditMessage5->setAuditTypeTranslated("PHP Restart");
        $auditMessage5->setBaseUrl("");
        $auditMessage5->setCreationTime("2012-12-24T15:25:40+01:00");
        $auditMessage5->setCreationTimeTimestramp("1356359140");
        $auditMessage5->setOutcome("OK");
        $auditMessages->addAuditMessage($auditMessage5);

        $auditMessage6 = new \ZendService\ZendServerAPI\DataTypes\AuditMessage();
        $auditMessage6->setId(2);
        $auditMessage6->setUsername("admin");
        $auditMessage6->setRequestInterface("INTERFACE_UI");
        $auditMessage6->setRemoteAddr("127.0.0.1");
        $auditMessage6->setAuditType("AUDIT_EXTENSION_DISABLED");
        $auditMessage6->setAuditTypeTranslated("Extension Disabled");
        $auditMessage6->setBaseUrl("");
        $auditMessage6->setCreationTime("2012-12-24T15:25:33+01:00");
        $auditMessage6->setCreationTimeTimestramp("1356359133");
        $auditMessage6->setExtraData(array("oci8"));
        $auditMessage6->setOutcome("OK");
        $auditMessages->addAuditMessage($auditMessage6);

        $auditMessage7 = new \ZendService\ZendServerAPI\DataTypes\AuditMessage();
        $auditMessage7->setId(1);
        $auditMessage7->setUsername("Unknown");
        $auditMessage7->setRequestInterface("INTERFACE_UI");
        $auditMessage7->setRemoteAddr("127.0.0.1");
        $auditMessage7->setAuditType("AUDIT_GUI_BOOTSTRAP_SAVELICENSE");
        $auditMessage7->setAuditTypeTranslated("Bootstrap Save License");
        $auditMessage7->setBaseUrl("");
        $auditMessage7->setCreationTime("2012-12-24T15:18:55+01:00");
        $auditMessage7->setCreationTimeTimestramp("1356358735");
        $auditMessage7->setOutcome("OK");
        $auditMessages->addAuditMessage($auditMessage7);

        return $auditMessages;
    }

    public function getAuditGetDetails()
    {
        $auditMessageDetails = new \ZendService\ZendServerAPI\DataTypes\AuditMessageDetails();

        $auditMessage = new \ZendService\ZendServerAPI\DataTypes\AuditMessage();
        $auditMessage->setId(4);
        $auditMessage->setUsername("admin");
        $auditMessage->setRequestInterface("INTERFACE_UI");
        $auditMessage->setRemoteAddr("127.0.0.1");
        $auditMessage->setAuditType("AUDIT_DIRECTIVES_MODIFIED");
        $auditMessage->setAuditTypeTranslated("Directives Modified");
        $auditMessage->setBaseUrl("");
        $auditMessage->setCreationTime("2012-12-24T15:29:13+01:00");
        $auditMessage->setCreationTimeTimestramp("1356359353");
        $auditMessage->setExtraData(
            array("Extension name: date, Directive: date.timezone, Old value: , New value: Europe/Berlin")
        );

        $auditMessageDetails->setAuditMessage($auditMessage);

        return $auditMessageDetails;
    }

    public function mockProvider()
    {
        static::$mockDataProvider = array(
            array("auditSetSettings", $this->getAuditSetSettings(), array(20, "a@b.com", "http://www.test.com")),
            array("auditGetList", $this->getAuditGetList(), array()),
            array("auditGetDetails", $this->getAuditGetDetails(), array(2))
        );

        return static::$mockDataProvider;
    }

    public function productionProvider()
    {
        static::$localDataProvider = array(
            array("auditSetSettings", array(20, "a@b.com", "http://www.test.com"), self::ZS6LOCAL)
        );

        return static::$localDataProvider;
    }

    public function getSection()
    {
        return "audit";
    }
}

