.. highlight:: php
.. _zendservice.audit:

*************
Audit methods
*************

Save settings of audit history and triggers.

    * auditGetList
    * auditGetDetails
    * auditSetSettings

.. _zendservice.audit.methods.auditGetList:

The auditGetList Method
=======================

Get a list of audit entries.

.. _zendservice.audit.methods.auditGetList.definition:

Method auditGetList definition
------------------------------

.. code-block:: php

    <?php
    public function auditGetList($limit = null, $offset = null, $order = null, $direction = null, $filters = array()) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $limit
     - int
     -
     - no
     - The number of rows to retrieve. Default lists all audit entries up to an arbitrary limit set by the system
   * - $offset
     - int
     - 0
     - no
     - A paging offset to begin the list from. Default: 0
   * - $order
     - string
     - audit_id
     - no
     - Column identifier for sorting the result set (audit_id, node_id, time).
   * - $direction
     - string
     - DESC
     - no
     - Sorting direction: ASC or DESC.
   * - $filters
     - array
     - array()
     - no
     - Add filter parameters in an ad-hoc manner. These filters will be added to the predefined filter that was passed.
       This parameter is an array with a predefined set of parameters that accept strings or arrays to hold multiple
       values:
       from: string, a timestamp to use for retrieving audit rows
       to: string, a timestamp to use for retrieving audit rows
       freeText: string
       auditTypes: array, a list of auditTypes-
       AUDIT_APPLICATION_DEPLOY, AUDIT_APPLICATION_REMOVE, AUDIT_APPLICATION_UPGRADE, AUDIT_APPLICATION_ROLLBACK,
       AUDIT_APPLICATION_REDEPLOY, AUDIT_APPLICATION_REDEPLOY_ALL, AUDIT_APPLICATION_DEFINE, AUDIT_DIRECTIVES_MODIFIED,
       AUDIT_EXTENSION_ENABLED, AUDIT_EXTENSION_DISABLED, AUDIT_RESTART_DAEMON, AUDIT_RESTART_PHP,
       AUDIT_GUI_AUTHENTICATION, AUDIT_GUI_CHANGE_PASSWORD, AUDIT_GUI_AUTHORIZATION, AUDIT_GUI_AUTHENTICATION_LOGOUT,
       AUDIT_GUI_AUDIT_SETTINGS_SAVE, AUDIT_GUI_BOOTSTRAP_CREATEDB, AUDIT_GUI_BOOTSTRAP_SAVELICENSE,
       AUDIT_SERVER_JOIN, AUDIT_SERVER_ADD, AUDIT_SERVER_ENABLE, AUDIT_SERVER_DISABLE, AUDIT_SERVER_REMOVE,
       AUDIT_SERVER_REMOVE_FORCE, AUDIT_SERVER_RENAME, AUDIT_SERVER_SETPASSWORD, AUDIT_CODETRACING_CREATE,
       AUDIT_CODETRACING_DELETE, AUDIT_CODETRACING_DEVELOPER_ENABLE, AUDIT_CODETRACING_DEVELOPER_DISABLE,
       AUDIT_JOBQUEUE_REQUEUE, AUDIT_JOBQUEUE_DELETE, AUDIT_MONITOR_RULES_ENABLE, AUDIT_MONITOR_RULES_DISABLE,
       AUDIT_MONITOR_RULES_SAVE, AUDIT_MONITOR_RULES_REMOVE, AUDIT_STUDIO_DEBUG, AUDIT_STUDIO_PROFILE,
       AUDIT_STUDIO_SOURCE, AUDIT_CLEAR_OPTIMIZER_PLUS_CACHE, AUDIT_CLEAR_DATA_CACHE_CACHE,
       AUDIT_CLEAR_PAGE_CACHE_CACHE, AUDIT_PAGE_CACHE_SAVE_RULE, AUDIT_PAGE_CACHE_DELETE_RULES,
       AUDIT_JOB_QUEUE_SAVE_RULE, AUDIT_JOB_QUEUE_DELETE_RULES, AUDIT_JOB_QUEUE_DELETE_JOBS,
       AUDIT_JOB_QUEUE_REQUEUE_JOBS, AUDIT_JOB_QUEUE_RESUME_RULES,AUDIT_JOB_QUEUE_DISABLE_RULES,
       AUDIT_JOB_QUEUE_RUN_NOW_RULE

.. _zendservice.audit.methods.auditGetList.information:

auditGetList information
------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\AuditMessages (`AuditMessages api doc`_)
   * - Online reference
     - `auditGetList online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.audit.methods.auditGetList.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Audit;

    $audit = new Audit();
    $auditMesssages = $audit->auditGetList();

    foreach($auditMessages as $auditMessage) {
        echo $auditMessage->getAuditTypeTranslated() . " by " . $auditMessage->getUsername() . PHP_EOL;
    }

.. _zendservice.audit.methods.auditGetDetails:

The auditGetDetails Method
==========================

Get all details available on a particular audit item.

.. _zendservice.audit.methods.auditGetDetails.definition:

Method auditGetDetails definition
---------------------------------

.. code-block:: php

    <?php
    public function auditGetDetails($auditId) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $auditId
     - int
     -
     - yes
     - Audit ID to get all details for

.. _zendservice.audit.methods.auditGetDetails.information:

auditGetDetails information
---------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\AuditMessageDetails (`AuditMessageDetails api doc`_)
   * - Online reference
     - `auditGetDetails online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.audit.methods.auditGetDetails.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Audit;

    $audit = new Audit();
    $auditMesssages = $audit->auditGetList();

    foreach($auditMessages as $auditMessage) {
        $details = $audit->auditGetDetails($auditMessage->getId());
        echo $details->getAuditProgress()->getServerName() . PHP_EOL
    }

.. _zendservice.audit.methods.auditSetSettings:

The auditSetSettings Method
===========================

Get all details available on a particular audit item.

.. _zendservice.audit.methods.auditSetSettings.definition:

Method auditSetSettings definition
----------------------------------

.. code-block:: php

    <?php
    public function auditSetSettings($history, $email = null, $callbackUrl = null) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $history
     - int
     -
     - yes
     - Number of saved days in history
   * - $email
     - string
     -
     - no
     - Email to send notifications to
   * - $callbackUrl
     - string
     -
     - no
     - URL to send notification to

.. _zendservice.audit.methods.auditSetSettings.information:

auditSetSettings information
----------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\AuditSettings (`AuditSettings api doc`_)
   * - Online reference
     - `auditSetSettings online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.audit.methods.auditSetSettings.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Audit;

    $audit = new Audit();
    $audit->auditSetSettings(20, "a@b.com", "http://www.test.com");


.. _auditGetList online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_auditgetlist_method.htm
.. _auditSetSettings online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_auditsetsettings_method.htm
.. _auditGetDetails online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_auditgetdetails_method.htm
.. _AuditMessageDetails api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.AuditMessageDetails.html
.. _AuditMessages api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.AuditMessages.html
.. _AuditSettings api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.AuditSettings.html
