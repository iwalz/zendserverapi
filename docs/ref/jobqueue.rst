.. highlight:: php
.. _zendservice.jobqueue:

****************
Jobqueue methods
****************

Job Queue API actions provide external actors with ways to query and manipulate jobs and their recurring definitions.
The following is a list of methods available for the Job Queue feature:

<ul>
<li>The jobqueueListJobs Method</li>
<li>The jobqueueJobInfo Method</li>
<li>The jobqueueDeleteJob Method</li>
<li>The jobqueueRequeueJob Method</li>
<li>The jobqueueListRules Method</li>
<li>The jobqueueRuleInfo Method</li>
<li>The jobqueueSaveRule Method</li>
<li>The jobqueueDisableRules Method </li>
<li>The jobqueueResumeRules Method </li>
<li>The jobqueueDeleteRules Method</li>
<li>The jobqueueRunNowRule Method</li>
</ul>

.. _zendservice.jobqueue.methods.jobqueueJobsList:

The jobqueueJobsList Method
===========================

Job Queue API actions provide external actors with ways to query and manipulate jobs and their recurring definitions.

.. _zendservice.jobqueue.methods.jobqueueJobsList.definition:

Method jobqueueJobsList definition
----------------------------------

.. code-block:: php

    <?php
    public function jobqueueJobsList($limit = null, $offset = null, $orderBy = null, $direction = null, $filter = null) { }

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
     - Row limit to retrieve, defaults to value defined in zend-user-user.ini
   * - $offset
     - int
     - 0
     - no
     - The page offset to be displayed, defaults to 0
   * - $orderBy
     - string
     - Date
     - no
     - Column to sort the result by (), defaults to Date
   * - $direction
     - string
     - DESC
     - no
     - Sorting direction: ASC or DESC.
   * - $filters
     - array
     - array()
     - no
     - Associative array, accteps any of the following keys: app_id, name, script, priority, status, rule_id, scheduled_before, scheduled_after, executed_before, executed_after, freeText
       The priority key, accepts the following values: low, normal, high, urgent.
       The status key, accepts the following values: Active, Waiting, Running, Completed, Failed, Timeout, Removed, Scheduled, Suspende

.. _zendservice.jobqueue.methods.jobqueueJobsList.information:

jobqueueJobsList information
----------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\Jobs (`Jobs api doc`_)
   * - Online reference
     - `jobqueueJobsList online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.jobqueue.methods.jobqueueJobsList.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Jobqueue;

    $jobqueue = new Jobqueue();
    $jobs = $jobqueue->jobqueueJobsList();

.. _zendservice.jobqueue.methods.jobqueueJobInfo:

The jobqueueJobInfo Method
===========================

Retrieve and display details of a job.

.. _zendservice.jobqueue.methods.jobqueueJobInfo.definition:

Method jobqueueJobInfo definition
---------------------------------

.. code-block:: php

    <?php
    public function jobqueueJobInfo($id) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $id
     - int
     -
     - yes
     - job id

.. _zendservice.jobqueue.methods.jobqueueJobInfo.information:

jobqueueJobInfo information
---------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\JobInfo (`JobInfo api doc`_)
   * - Online reference
     - `jobqueueJobInfo online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.jobqueue.methods.jobqueueJobInfo.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Jobqueue;

    $jobqueue = new Jobqueue();
    $jobInfo = $jobqueue->jobqueueJobInfo(1);

.. _zendservice.jobqueue.methods.jobqueueDeleteJobs:

The jobqueueDeleteJobs Method
=============================

Delete job queue.

.. _zendservice.jobqueue.methods.jobqueueDeleteJobs.definition:

Method jobqueueDeleteJobs definition
------------------------------------

.. code-block:: php

    <?php
    public function jobqueueDeleteJobs(array $ids) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $ids
     - array
     -
     - yes
     - job ids

.. _zendservice.jobqueue.methods.jobqueueDeleteJobs.information:

jobqueueDeleteJobs information
------------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\Jobs (`Jobs api doc`_)
   * - Online reference
     - `jobqueueDeleteJobs online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.jobqueue.methods.jobqueueDeleteJobs.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Jobqueue;

    $jobqueue = new Jobqueue();
    $jobs = $jobqueue->jobqueueDeleteJobs(array(1));

.. _zendservice.jobqueue.methods.jobqueueRequeueJobs:

The jobqueueRequeueJobs Method
==============================

Requeue a job.

.. _zendservice.jobqueue.methods.jobqueueRequeueJobs.definition:

Method jobqueueRequeueJobs definition
-------------------------------------

.. code-block:: php

    <?php
    public function jobqueueRequeueJobs(array $ids) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $ids
     - array
     -
     - yes
     - job ids

.. _zendservice.jobqueue.methods.jobqueueRequeueJobs.information:

jobqueueRequeueJobs information
-------------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\Jobs (`Jobs api doc`_)
   * - Online reference
     - `jobqueueRequeueJobs online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.jobqueue.methods.jobqueueRequeueJobs.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Jobqueue;

    $jobqueue = new Jobqueue();
    $jobs = $jobqueue->jobqueueRequeueJobs(array(1));

.. _zendservice.jobqueue.methods.jobqueueListRules:

The jobqueueListRules Method
============================

Retrieve and display a list of jobs rules.

.. _zendservice.jobqueue.methods.jobqueueListRules.definition:

Method jobqueueListRules definition
-----------------------------------

.. code-block:: php

    <?php
    public function jobqueueListRules($limit = null, $offset = null, $orderBy = null, $direction = null) { }

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
     - Row limit to retrieve, defaults to value defined in zend-user-user.ini
   * - $offset
     - int
     - 0
     - no
     - The page offset to be displayed, defaults to 0
   * - $orderBy
     - string
     - Date
     - no
     - Column to sort the result by (), defaults to Date
   * - $direction
     - string
     - DESC
     - no
     - Sorting direction: ASC or DESC.

.. _zendservice.jobqueue.methods.jobqueueListRules.information:

jobqueueListRules information
-----------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\Jobs (`Rules api doc`_)
   * - Online reference
     - `jobqueueListRules online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.jobqueue.methods.jobqueueListRules.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Jobqueue;

    $jobqueue = new Jobqueue();
    $rules = $jobqueue->jobqueueListRules();

.. _zendservice.jobqueue.methods.jobqueueRuleInfo:

The jobqueueRuleInfo Method
===========================

Retrieve and display a job rule information.

.. _zendservice.jobqueue.methods.jobqueueRuleInfo.definition:

Method jobqueueRuleInfo definition
----------------------------------

.. code-block:: php

    <?php
    public function jobqueueRuleInfo($id) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $id
     - int
     -
     - yes
     - job id

.. _zendservice.jobqueue.methods.jobqueueRuleInfo.information:

jobqueueRuleInfo information
----------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\RuleInfo (`RuleInfo api doc`_)
   * - Online reference
     - `jobqueueRuleInfo online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.jobqueue.methods.jobqueueRuleInfo.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Jobqueue;

    $jobqueue = new Jobqueue();
    $ruleInfo = $jobqueue->jobqueueRuleInfo(1);

.. _zendservice.jobqueue.methods.jobqueueSaveRule:

The jobqueueSaveRule Method
===========================

Create a job queue rule.

.. _zendservice.jobqueue.methods.jobqueueSaveRule.definition:

Method jobqueueSaveRule definition
----------------------------------

.. code-block:: php

    <?php
    public function jobqueueSaveRule($url, $options, $vars = array()) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $url
     - string
     -
     - yes
     - A URL for the job.
   * - $options
     - string
     -
     - yes
     - Rule options. (schedule pattern)
   * - $vars
     - array
     -
     - no
     - Variables for the rule.

.. _zendservice.jobqueue.methods.jobqueueSaveRule.information:

jobqueueSaveRule information
----------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\RuleInfo (`RuleInfo api doc`_)
   * - Online reference
     - `jobqueueSaveRule online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.jobqueue.methods.jobqueueSaveRule.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Jobqueue;

    $jobqueue = new Jobqueue();
    $ruleInfo = $jobqueue->jobqueueSaveRule("http://www.example.com/foo", "1 */10");

.. _zendservice.jobqueue.methods.jobqueueDisableRules:

The jobqueueDisableRules Method
===============================

Suspend a job queue rule.

.. _zendservice.jobqueue.methods.jobqueueDisableRules.definition:

Method jobqueueDisableRules definition
--------------------------------------

.. code-block:: php

    <?php
    public function jobqueueDisableRules(array $ruleIds) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $ruleIds
     - array
     -
     - yes
     - Array of rule ids

.. _zendservice.jobqueue.methods.jobqueueDisableRules.information:

jobqueueDisableRules information
--------------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\Rules (`Rules api doc`_)
   * - Online reference
     - `jobqueueDisableRules online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.jobqueue.methods.jobqueueDisableRules.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Jobqueue;

    $jobqueue = new Jobqueue();
    $rules = $jobqueue->jobqueueDisableRules(array(1));

.. _zendservice.jobqueue.methods.jobqueueResumeRules:

The jobqueueResumeRules Method
==============================

Resume a suspended job queue rule.

.. _zendservice.jobqueue.methods.jobqueueResumeRules.definition:

Method jobqueueResumeRules definition
-------------------------------------

.. code-block:: php

    <?php
    public function jobqueueResumeRules(array $ruleIds) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $ruleIds
     - array
     -
     - yes
     - Array of rule ids

.. _zendservice.jobqueue.methods.jobqueueResumeRules.information:

jobqueueResumeRules information
-------------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\Rules (`Rules api doc`_)
   * - Online reference
     - `jobqueueResumeRules online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.jobqueue.methods.jobqueueResumeRules.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Jobqueue;

    $jobqueue = new Jobqueue();
    $rules = $jobqueue->jobqueueResumeRules(array(1));

.. _zendservice.jobqueue.methods.jobqueueDeleteRules:

The jobqueueDeleteRules Method
==============================

Delete a job queue rule.

.. _zendservice.jobqueue.methods.jobqueueDeleteRules.definition:

Method jobqueueDeleteRules definition
-------------------------------------

.. code-block:: php

    <?php
    public function jobqueueDeleteRules(array $ruleIds) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $ruleIds
     - array
     -
     - yes
     - Array of rule ids

.. _zendservice.jobqueue.methods.jobqueueDeleteRules.information:

jobqueueDeleteRules information
-------------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\Rules (`Rules api doc`_)
   * - Online reference
     - `jobqueueDeleteRules online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.jobqueue.methods.jobqueueDeleteRules.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Jobqueue;

    $jobqueue = new Jobqueue();
    $rules = $jobqueue->jobqueueDeleteRules(array(1));

.. _zendservice.jobqueue.methods.jobqueueRunNowRule:

The jobqueueRunNowRule Method
=============================

Run a scheduled job that was scheduled for a later time.

.. _zendservice.jobqueue.methods.jobqueueRunNowRule.definition:

Method jobqueueRunNowRule definition
------------------------------------

.. code-block:: php

    <?php
    public function jobqueueRunNowRule($ruleId) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $ruleId
     - int
     -
     - yes
     - Rule id

.. _zendservice.jobqueue.methods.jobqueueRunNowRule.information:

jobqueueRunNowRule information
------------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\RuleInfo (`RuleInfo api doc`_)
   * - Online reference
     - `jobqueueRunNowRule online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.jobqueue.methods.jobqueueRunNowRule.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Jobqueue;

    $jobqueue = new Jobqueue();
    $ruleInfo = $jobqueue->jobqueueRunNowRule(1);

.. _jobqueueJobsList online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#jobqueuelistjobs.htm
.. _jobqueueJobInfo online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_jobqueuejobinfo_method.htm
.. _jobqueueDeleteJobs online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_jobqueuedeletejob_method.htm
.. _jobqueueRequeueJobs online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_jobqueuerequeuejob_method.htm
.. _jobqueueListRules online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_jobqueuelistrules_method.htm
.. _jobqueueRuleInfo online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_jobqueueruleinfo_method.htm
.. _jobqueueSaveRule online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_jobqueuesaverule_method.htm
.. _jobqueueDisableRules online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_jobqueuesuspendrules_method.htm
.. _jobqueueResumeRules online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_jobqueueresumerules_method.htm
.. _jobqueueDeleteRules online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_jobqueuedeleterules_method.htm
.. _jobqueueRunNowRule online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_jobqueuerunnowrule_method.htm
.. _Jobs api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.Jobs.html
.. _Rules api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.Rules.html
.. _RuleInfo api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.RuleInfo.html
.. _JobInfo api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.JobInfo.html
