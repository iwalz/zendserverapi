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


Method definition
^^^^^^^^^^^^^^^^^

.. code-block:: php

    <?php
    public function getSystemInfo() { }


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


.. _zendservice.server.methods.clusterGetServerStatus:

The clusterGetServerStatus Method
---------------------------------

Use this method to get the list of servers in the cluster and the status of each one. On a Zend Server Cluster Manager
with no valid license, this operation fails. This operation causes Zend Server Cluster Manager to check the status of
servers and return fresh, non-cached information. This is different from the Servers List tab in the GUI, which may
present cached information. Users interested in reducing load by caching this information should do it in their own code.

Method definition
^^^^^^^^^^^^^^^^^

.. code-block:: php

    <?php
    public function clusterGetServerStatus(array $parameters = array()) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $parameter
     - array
     - array()
     - no
     - A list of server IDs. If specified, the status is returned for these servers only. If not specified,
       the status of all the servers is returned.

clusterGetServerStatus information
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\ServersList (`ServersList api doc`_)
   * - Online reference
     - `clusterGetServerStatus online reference`_
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
    $serversList = $server->clusterGetServerStatus(array($serverId1, $serverId2));

    foreach ($serversList as $server) {
        /** @var $server \ZendService\ZendServerAPI\DataTypes\ServersList */
        echo "Id: " . $server->getId() . PHP_EOL;
        echo "Name: " . $server->getName() . PHP_EOL;
     }


.. _zendservice.server.methods.clusterAddServer:

The clusterAddServer Method
---------------------------

Add a new server to the cluster. On a Zend Server Cluster Manager with no valid license, this operation fails.

Method definition
^^^^^^^^^^^^^^^^^

.. code-block:: php

    <?php
    public function clusterAddServer($serverName, $serverUrl, $guiPassword, $propagateSettings = false) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $serverName
     - string
     -
     - yes
     - The server name.
   * - $serverUrl
     - string
     -
     - yes
     - The server address as a full HTTP/HTTPS URL.
   * - $guiPassword
     - string
     -
     - yes
     - The server GUI password.
   * - $propagateSettings
     - boolean
     - false
     - no
     - Propagate this server’s current settings to the rest of the cluster.

clusterAddServer information
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - **Return value**:
     - \\ZendService\\ZendServerAPI\\DataTypes\\ServerInfo (`ServerInfo api doc`_)
   * - **Online reference**:
     - `clusterAddServer online reference`_
   * - **Available in Version**:
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
    $serverName = "server10";
    $serverUrl = "https://10.0.0.10:10082/ZendServer";
    $guiPassword = "test";
    $propagateSettings = false;
    $serverInfo = $server->clusterAddServer($serverName, $serverUrl, $guiPassword, $propagateSettings);

.. _zendservice.server.methods.clusterRemoveServer:

The clusterRemoveServer Method
------------------------------

This method removes a server from the cluster. The removal process may be asynchronous if Session Clustering is used.
If this is the case, the initial operation will return an HTTP 202 response. As long as the server is not fully removed,
further calls to remove the same server should be idempotent. On a Zend Server Cluster Manager with no valid license,
this operation fails.

Method definition
^^^^^^^^^^^^^^^^^

.. code-block:: php

    <?php
    public function clusterRemoveServer($serverId, $force = false) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $serverId
     - int
     -
     - yes
     - The id of the server to remove
   * - $force
     - boolean
     - false
     - no
     - Force-remove the server, skipping graceful shutdown process.

clusterRemoveServer information
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - **Return value**:
     - \\ZendService\\ZendServerAPI\\DataTypes\\ServerInfo (`ServerInfo api doc`_)
   * - **Online reference**:
     - `clusterRemoveServer online reference`_
   * - **Available in Version**:
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
    $serversList = $server->clusterGetServerStatus();

    // removes all server from the 'general' cluster
    foreach ($serversList as $server) {
        $server->clusterRemoveServer($server->getId());
    }

.. _zendservice.server.methods.clusterEnableServer:

The clusterEnableServer Method
------------------------------

This method is used to re-enable a cluster member. This process may be asynchronous if Session Clustering is used.
If this is the case, the initial operation will return an HTTP 202 response. This action is idempotent, and running
it on an enabled server will result in a 200 OK response with no consequences. On a Zend Server Cluster Manager with
no valid license this operation fails.

Method definition
^^^^^^^^^^^^^^^^^

.. code-block:: php

    <?php
    public function clusterEnableServer($serverId)

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $serverId
     - int
     -
     - yes
     - The server id

clusterEnableServer information
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - **Return value**:
     - \\ZendService\\ZendServerAPI\\DataTypes\\ServerInfo (`ServerInfo api doc`_)
   * - **Online reference**:
     - `clusterEnableServer online reference`_
   * - **Available in Version**:
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
    $serversList = $server->clusterGetServerStatus();

    // enables all server from the 'general' cluster
    foreach ($serversList as $server) {
        $server->clusterEnableServer($server->getId());
    }

.. _zendservice.server.methods.clusterDisableServer:

The clusterDisableServer Method
-------------------------------

This method disables a cluster member. This process may be asynchronous if Session Clustering is used. If this is
the case, the initial operation returns an HTTP 202 response. As long as the server is not fully disabled, further
calls to this method are idempotent. On a Zend Server Cluster Manager with no valid license, this operation fails.

Method definition
^^^^^^^^^^^^^^^^^

.. code-block:: php

    <?php
    public function clusterDisableServer($serverId)

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $serverId
     - int
     -
     - yes
     - The server id

clusterDisableServer information
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - **Return value**:
     - \\ZendService\\ZendServerAPI\\DataTypes\\ServerInfo (`ServerInfo api doc`_)
   * - **Online reference**:
     - `clusterDisableServer online reference`_
   * - **Available in Version**:
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
    $serversList = $server->clusterGetServerStatus();

    // disables all server from the 'general' cluster
    foreach ($serversList as $server) {
        $server->clusterDisableServer($server->getId());
    }

.. _zendservice.server.methods.clusterReconfigureServer:

The clusterReconfigureServer Method
-----------------------------------

Re-configure a cluster member to match the cluster's profile. This operation will fail on a Zend Server Cluster Manager with no valid license.

Method definition
^^^^^^^^^^^^^^^^^

.. code-block:: php

    <?php
    public function clusterReconfigureServer($serverId, $doRestart = false)

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $serverId
     - int
     -
     - yes
     - Specify if the re-configured server should be restarted after the re-configure action.
   * - $doRestart
     - boolean
     - false
     - no
     - Sends the restart command to all servers at the same time

*Note*: Because of the Zend Deployment Deamon (zdd), since Zend Server 5.5, there is an implicit restart on this method anyways.

clusterReconfigureServer information
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - **Return value**:
     - \\ZendService\\ZendServerAPI\\DataTypes\\ServerInfo (`ServerInfo api doc`_)
   * - **Online reference**:
     - `clusterReconfigureServer online reference`_
   * - **Available in Version**:
     - * 1.1
       * 1.2
       * 1.3

Example
^^^^^^^

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Server;

    $server = new Server();
    $serverInfo = $server->clusterGetServerStatus();

    // reconfigure all server from the 'general' cluster
    foreach ($serversList as $server) {
        $server->clusterReconfigureServer($server->getId());
    }

.. _zendservice.server.methods.restartPhp:

The restartPhp Method
---------------------

This method restarts PHP on all servers or on specified servers in the cluster. A 202 response in this case does not
always indicate a successful restart of all servers. Use the clusterGetServerStatus command to check the server(s) status again after a few seconds.

Method definition
^^^^^^^^^^^^^^^^^

.. code-block:: php

    <?php
    public function restartPhp($serverIds = array(), $parallelRestart = false) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $serverIds
     - array
     - array()
     - no
     - A list of server IDs to restart. If not specified, all servers in the cluster will be restarted. In a single
       Zend Server context this parameter is ignored.
   * - $parallelRestart
     - boolean
     - false
     - no
     - Sends the restart command to all servers at the same time.


restartPhp information
^^^^^^^^^^^^^^^^^^^^^^

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - **Return value**:
     - \\ZendService\\ZendServerAPI\\DataTypes\\ServersList (`ServersList api doc`_)
   * - **Online reference**:
     - `restartPhp online reference`_
   * - **Available in Version**:
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
    $server->restartPhp();


.. _getSystemInfo online reference: http://files.zend.com/help/Zend-Server/zend-server.htm#getsysteminfo.htm
.. _SystemInfo api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.SystemInfo.html
.. _clusterGetServerStatus online reference: http://files.zend.com/help/Zend-Server/zend-server.htm#clustergetserverstatus.htm
.. _ServersList api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.ServersList.html
.. _clusterAddServer online reference: http://files.zend.com/help/Zend-Server/zend-server.htm#clusteraddserver.htm
.. _ServerInfo api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.ServerInfo.html
.. _clusterRemoveServer online reference: http://files.zend.com/help/Zend-Server/zend-server.htm#clusterremoveserver.htm
.. _clusterEnableServer online reference: http://files.zend.com/help/Zend-Server/zend-server.htm#clusterenableserver.htm
.. _clusterDisableServer online reference: http://files.zend.com/help/Zend-Server/zend-server.htm#clusterdisableserver.htm
.. _clusterReconfigureServer online reference: http://files.zend.com/help/Zend-Server/zend-server.htm#clusterreconfigureserver.htm
.. _restartPhp online reference: http://files.zend.com/help/Zend-Server/zend-server.htm#restartphp.htm
