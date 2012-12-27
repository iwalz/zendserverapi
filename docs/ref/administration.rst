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

.. _userAuthenticateSettings online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_userauthenticatesettings_method.htm
.. _AuthenticationType api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.AuthenticationType.html

