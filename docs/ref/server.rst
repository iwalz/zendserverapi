.. highlight:: php
.. _zendservice.server:

*************************************
Server and Cluster Management methods
*************************************

The following is a list and documentation of the available methods used to manage your server and/or cluster.

.. _zendservice.server.methods:

Methods
=======

    * getSystemInfo
    * clusterGetServerStatus
    * clusterAddServer
    * clusterRemoveServer
    * clusterDisableServer
    * clusterEnableServer
    * clusterReconfigureServer
    * restartPHP

.. _zendservice.server.methods.getsysteminfo:

The getSystemInfo Method
------------------------

Use this method to get information about the system, including the Zend Server edition and version, PHP version, licensing information, etc. This method produces similar output on all Zend Server systems, and is future compatible.


getSystemInfo information
^^^^^^^^^^^^^^^^^^^^^^^^^

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\SystemInfo (`SystemInfo api doc`_)
   * - Online reference
     - `getSystemInfo online reference`_
   * - Available in Version
     - * 1.0
       * 1.1
       * 1.2
       * 1.3

Example
^^^^^^^

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Server;

    $server = new Server();
    $systemInfo = $server->getSystemInfo();


.. _getSystemInfo online reference: http://files.zend.com/help/Zend-Server/zend-server.htm#getsysteminfo.htm
.. _SystemInfo api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.SystemInfo.html
