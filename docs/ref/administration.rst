.. highlight:: php
.. _zendservice.administration:

**********************
Administration methods
**********************

The following is a list of methods available for the Administration feature:

    * userAuthenticateSettings
    * userSetPassword
    * setPassword
    * apiKeysGetList
    * apiKeysAddKey
    * apiKeyRemove
    * serverValidateLicense
    * aclSetGroups
    * bootstrapSingleServer


.. _zendservice.administration.methods.userAuthenticateSettings:

The userAuthenticateSettings Method
===================================

Modify current authentication settings, allowing the user to switch between simple and extended authentication and authorization schemes.

.. _zendservice.administration.methods.userAuthenticateSettings.definition:

Method userAuthenticateSettings definition
------------------------------------------

.. code-block:: php

    <?php
    public function userAuthenticateSettings($type, $password, $confirmNewPassword, $ldap = array()) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $type
     - string
     -
     - yes
     - One of : simple, extended
   * - $password
     - string
     -
     - yes
     - Current user’s password for authentication
   * - $confirmNewPassword
     - string
     -
     - yes
     - Confirmation of new password
   * - $ldap
     - array
     -
     - no
     - Array of ldap properties:
       host: host, ip or location of the active directory

       port: port part of the URL above

       encryption:

       ssl: use SSL to secure communications

       tls: start TLS to secure communications

       none: no encryption is used

       username: directory username, broken to CN and DC parts for use in querying the active directory

       password: matching password for the above username

       baseDn: DN broken down to CN and DC parts for using during user authentication


.. _zendservice.administration.methods.userAuthenticateSettings.information:

userAuthenticateSettings information
------------------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\AuthenticationType (`AuthenticationType api doc`_)
   * - Online reference
     - `userAuthenticateSettings online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.administration.methods.userAuthenticateSettings.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Administration;

    $administration = new Administration();
    $administration->userAuthenticateSettings("extended", "currentPassword", "newPassword",
        array(
            "host" => "internalldap",
            "port" => 636,
            "encryption" => "ssl",
            "username" => "admin",
            "password" => "currentPassword",
            "baseDn" => "internal"
        )
    );

.. _zendservice.administration.methods.userSetPassword:

The userSetPassword Method
==========================

 Modify a specific user password. This action changes any user password and is an administrative action.
 Note that a separate action exists for the user to modify his own password and has a lower permission level.

.. _zendservice.administration.methods.userSetPassword.definition:

Method userSetPassword definition
---------------------------------

.. code-block:: php

    <?php
    public function userSetPassword($username, $password, $newPassword, $confirmNewPassword) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $username
     - string
     -
     - yes
     - admin (for Administrator)

       testuser (for Developer)
   * - $password
     - string
     -
     - yes
     - Current password
   * - $newPassword
     - string
     -
     - yes
     - New password
   * - $confirmNewPassword
     - string
     -
     - yes
     - Confirmation of new password


.. _zendservice.administration.methods.userSetPassword.information:

userSetPassword information
---------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\UserInfo (`UserInfo api doc`_)
   * - Online reference
     - `userSetPassword online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.administration.methods.userSetPassword.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Administration;

    $administration = new Administration();
    $administration->userSetPassword("admin", "oldpassword", "newpassword", "newpassword");

.. _zendservice.administration.methods.setPassword:

The setPassword Method
======================

Modify a current user password.

.. _zendservice.administration.methods.setPassword.definition:

Method setPassword definition
-----------------------------

.. code-block:: php

    <?php
    public function setPassword($password, $newPassword, $confirmNewPassword) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $password
     - string
     -
     - yes
     - Current password
   * - $newPassword
     - string
     -
     - yes
     - New password
   * - $confirmNewPassword
     - string
     -
     - yes
     - Confirmation of new password


.. _zendservice.administration.methods.setPassword.information:

setPassword information
-----------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\UserInfo (`UserInfo api doc`_)
   * - Online reference
     - `setPassword online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.administration.methods.setPassword.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Administration;

    $administration = new Administration();
    $administration->setPassword("oldpassword", "newpassword", "newpassword");

.. _zendservice.administration.methods.apiKeysGetList:

The ApiKeysGetList Method
=========================

Get a list of api keys.

.. _zendservice.administration.methods.apiKeysGetList.definition:

Method apiKeysGetList definition
--------------------------------

.. code-block:: php

    <?php
    public function apiKeysGetList() { }

.. _zendservice.administration.methods.apiKeysGetList.information:

apiKeysGetList information
--------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\UserInfo (`ApiKeys api doc`_)
   * - Online reference
     - `apiKeysGetList online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.administration.methods.apiKeysGetList.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Administration;

    $administration = new Administration();
    $apiKeys = $administration->apiKeysGetList();

.. _zendservice.administration.methods.apiKeysAddKey:

The apiKeysAddKey Method
========================

Add a WebAPI Key.

.. _zendservice.administration.methods.apiKeysAddKey.definition:

Method apiKeysAddKey definition
-------------------------------

.. code-block:: php

    <?php
    public function apiKeysAddKey($name, $username) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $name
     - string
     -
     - yes
     - The name of the key
   * - $username
     - string
     -
     - yes
     - Any username supplied for retrieving ACL information

.. _zendservice.administration.methods.apiKeysAddKey.information:

apiKeysAddKey information
-------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\ApiKeys (`ApiKeys api doc`_)
   * - Online reference
     - `apiKeysAddKey online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.administration.methods.apiKeysAddKey.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Administration;

    $administration = new Administration();
    $apiKeys = $administration->apiKeysAddKey("foo", "admin");

.. _zendservice.administration.methods.apiKeysRemoveKey:

The apiKeysRemoveKey Method
===========================

Remove a WebAPI Key.

.. _zendservice.administration.methods.apiKeysRemoveKey.definition:

Method apiKeysRemoveKey definition
----------------------------------

.. code-block:: php

    <?php
    public function apiKeysRemoveKey($ids) { }

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
     - array of api key ids to remove

.. _zendservice.administration.methods.apiKeysRemoveKey.information:

apiKeysRemoveKey information
----------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\ApiKeys (`ApiKeys api doc`_)
   * - Online reference
     - `apiKeysRemoveKey online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.administration.methods.apiKeysRemoveKey.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Administration;

    $administration = new Administration();
    $apiKeys = $administration->apiKeysRemoveKey(array(5, 6, 7));

.. _zendservice.administration.methods.serverValidateLicense:

The serverValidateLicense Method
================================

Validate a Zend Server license.

.. _zendservice.administration.methods.serverValidateLicense.definition:

Method serverValidateLicense definition
---------------------------------------

.. code-block:: php

    <?php
    public function serverValidateLicense($licenseName, $licenseValue) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $licenseName
     - string
     -
     - yes
     - The name of the license
   * - $licenseValue
     - string
     -
     - yes
     - The value of the license

.. _zendservice.administration.methods.serverValidateLicense.information:

serverValidateLicense information
---------------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\LicenseValidated (`LicenseValidated api doc`_)
   * - Online reference
     - `serverValidateLicense online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.administration.methods.serverValidateLicense.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Administration;

    $administration = new Administration();
    $licenseValidated = $administration->serverValidateLicense("TRIAL-1795-69", "V1Q26G1VUK185031C5ACF7165686C91B");

.. _zendservice.administration.methods.serverStoreLicense:

The serverStoreLicense Method
=============================

Stores a Zend Server license.

.. _zendservice.administration.methods.serverStoreLicense.definition:

Method serverStoreLicense definition
------------------------------------

.. code-block:: php

    <?php
    public function serverStoreLicense($licenseName, $licenseValue) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $licenseName
     - string
     -
     - yes
     - The name of the license
   * - $licenseValue
     - string
     -
     - yes
     - The value of the license

.. _zendservice.administration.methods.serverStoreLicense.information:

serverStoreLicense information
------------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\LicenseValidated (`LicenseValidated api doc`_)
   * - Online reference
     - `serverValidateLicense online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.administration.methods.serverStoreLicense.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Administration;

    $administration = new Administration();
    $licenseValidated = $administration->serverStoreLicense("TRIAL-1795-69", "V1Q26G1VUK185031C5ACF7165686C91B");

.. _zendservice.administration.methods.aclSetGroups:

The aclSetGroups Method
=======================

Store a set of group mappings for resolving user roles during authentication.
These groups correspond to roles within the system or to applications that implicitly grant the developerLimited
role to the user.

.. _zendservice.administration.methods.aclSetGroups.definition:

Method aclSetGroups definition
------------------------------

.. code-block:: php

    <?php
    public function aclSetGroups($roleGroups, $appGroups = null) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $roleGroups
     - array
     -
     - yes
     - An associative list of role names and their corresponding group.
   * - $appGroups
     - array
     -
     - no
     - An associative list of application IDs (numbers) and their corresponding group.

.. _zendservice.administration.methods.aclSetGroups.information:

aclSetGroups information
------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\LicenseValidated (`LicenseValidated api doc`_)
   * - Online reference
     - `aclSetGroups online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.administration.methods.aclSetGroups.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Administration;

    $administration = new Administration();
    $roleGroups = $administration->->aclSetGroups(array("developer" => "bar"));

.. _zendservice.administration.methods.bootstrapSingleServer:

The bootstrapSingleServer Method
================================

Bootstrap a server for standalone usage in production or development environment. This action is designed to give an
automated process the option to bootstrap a server with particular settings.
Note that once a server has been bootstrapped, it may not be added passively into a cluster using clusterAddServer.
It may still join a cluster using a direct WebAPI -serverAddToCluster, or a UI call. This WebAPI action is explicitly
accessible without a WebAPI Key, but only during the bootstrap stage.
Unlike the UI bootstrap/launching process, this bootstrap action does not restart Zend Server nor perform any
authentication. A WebAPI key with administrative permissions is created as part of the bootstrap process so that you
may immediately continue working. It is up to the user to decide what to do with this key once the bootstrap is
completed.
Read a certain number of log lines from the end of the file log. If serverId is passed, then the request will be
performed against that cluster member, otherwise it is performed locally.

.. _zendservice.administration.methods.bootstrapSingleServer.definition:

Method bootstrapSingleServer definition
---------------------------------------

.. code-block:: php

    <?php
    public function bootstrapSingleServer(
            $adminPassword,
            $orderNumber,
            $licenseKey,
            $acceptEula,
            $production = null,
            $applicationUrl = null,
            $adminEmail = null,
            $developerPassword = null
        ) { }

.. list-table:: **Parameter**
   :header-rows: 1

   * - Parameter
     - Data Type
     - Default value
     - Required
     - Description
   * - $adminPassword
     - string
     -
     - yes
     - The new administrator password to store for authentication
   * - $orderNumber
     - string
     -
     - yes
     - License order number to store in the server’s configuration. This license can be obtained from zend.com
   * - $licenseKey
     - string
     -
     - yes
     - License key to store in the server’s configuration. This license can be obtained from zend.com
   * - $acceptEula
     - bool
     -
     - yes
     - Must be set to true to accept ZS6’s EULA
   * - $production
     - bool
     -
     - no
     - Bootstrap this server using the factory “production” usage profile. Default value: true
   * - $applicationUrl
     - string
     -
     - no
     - The default application URL to use when displaying and handling deployed application URLs in the UI.
       Default: empty
   * - $adminEmail
     - string
     -
     - no
     - The default Email to use when sending notifications about events, audit entries and other features
   * - $developerPassword
     - string
     -
     - no
     - The new developer user password to be stored for authentication. If no password is supplied, the developer
       user will not be created


.. _zendservice.administration.methods.bootstrapSingleServer.information:

bootstrapSingleServer information
---------------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\Bootstrap (`Bootstrap api doc`_)
   * - Online reference
     - `bootstrapSingleServer online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.administration.methods.bootstrapSingleServer.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Administration;

    $administration = new Administration();
    $bootstrap = $administration->bootstrapSingleServer("test", "ON", "LC", true);

.. _userAuthenticateSettings online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_userauthenticatesettings_method.htm
.. _AuthenticationType api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.AuthenticationType.html
.. _userSetPassword online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_usersetpassword_method.htm
.. _UserInfo api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.UserInfo.html
.. _setPassword online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_setpassword_method.htm
.. _ApiKeys api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.ApiKeys.html
.. _apiKeysGetList online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_apikeysgetlist_method.htm
.. _apiKeysAddKey online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_apikeysaddkey_method.htm
.. _apiKeysRemoveKey online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_apikeyremove_method.htm
.. _serverValidateLicense online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_servervalidatelicense_method.htm
.. _aclSetGroups online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_aclsetgroups_method.htm
.. _LicenseValidated api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.LicenseValidated.html
.. _bootstrap api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.Bootstrap.html
.. _bootstrapSingleServer online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_bootstrapsingleserver_method.htm
