.. highlight:: php
.. _zendservice.versioning:

**************
API Versioning
**************

.. _zendservice.versioning.configuration:

Configure the version
=====================

Reference: `Zend Server 5.6 Webapi Versioning`_

The version needs to be specified in the :ref:`zendservice.configuration.file` under the ``version`` key.
The Web API was introduced in Zend Server 5.1 with the Web API Version 1.0. With Zend Server 5.5 the API Version 1.1 has been released. 1.2 came with Zend Server 5.6 and 1.3 with Zend Server 6.
For now, the API is fully functional up to Zend Server 5.6 - Zend Server 6 implementation is in progress.

The following class constants are available:

.. code-block:: php

    <?php
    namespace ZendService\ZendServerAPI;

    class Version
    {
        /**
         * Zend Server Cluster Manager 5.1
         * API Version 1.0
         * @var string
         */
        const ZSCM51 = "1.0";
        /**
         * Zend Server Cluster Manager 5.5
         * API Version 1.1
         * @var string
         */
        const ZSCM55 = "1.1";
        /**
         * Zend Server Cluster Manager 5.6
         * API Version 1.2
         * @var string
         */
        const ZSCM56 = "1.2";
        /**
         * Zend Server 5.1
         * API Version 1.0
         * @var string
         */
        const ZS51 = "1.0";
        /**
         * Zend Server 5.5
         * API Version 1.1
         * @var string
         */
        const ZS55 = "1.1";
        /**
         * Zend Server 5.6
         * API Version 1.2
         * @var string
         */
        const ZS56 = "1.2";
    }

This is configured on the Server level and is the basis for the web api factories.
Every API method is fetched from specific version factories. If you specifiy e.g. ZS55 on a Zend Server 5.6, you're not able to perform Web API 1.2 actions!
So take care, that you configure the correct API Version for your servers.

.. _zendservice.versioning.methods:

Web API Version methods
=======================

**Web API 1.0**

    * clusterGetServerStatus
    * clusterAddServer
    * clusterRemoveServer
    * clusterEnableServer
    * clusterDisableServer
    * restartPHP
    * :ref:`zendservice.server.methods.getsysteminfo`
    * configurationImport
    * configurationExport

**Web API 1.1**

    * clusterReconfigureServer
    * applicationGetStatus
    * applicationDeploy
    * applicationRemove
    * applicationRollback
    * applicationSynchronize
    * applicationUpdate

**Web API 1.2**

    * codetracingDisable
    * codetracingEnable
    * codetracingIsEnabled
    * codetracingCreate
    * codetracingDelete
    * codetracingList
    * codetracingDownloadTraceFile
    * monitorGetRequestSummary
    * monitorGetIssuesListByPredefinedFilter
    * monitorGetIssuesDetails
    * monitorGetEventGroupDetails
    * monitorChangeIssueStatus
    * monitorExportIssueByEventsGroup
    * studioStartDebug
    * studioStartProfile

.. _Zend Server 5.6 Webapi Versioning: http://files.zend.com/help/Zend-Server/zend-server.htm#api_versioning_negotation.htm
