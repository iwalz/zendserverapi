.. highlight:: php
.. _zendservice.filter:

**************
Filter methods
**************

Filter API actions provide external actors with ways to query and manipulate filters and their definitions.

    * filterGetByType
    * filterSave
    * filtersDelete

.. _zendservice.filter.methods.filterGetByType:

The filterGetByType Method
==========================

Retrieve and display a list of filters.

.. _zendservice.filter.methods.filterGetByType.definition:

Method filterGetByType definition
---------------------------------

.. code-block:: php

    <?php
    public function filterGetByType($type) { }

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
     - Type of a filter (issue,job)

.. _zendservice.filter.methods.filterGetByType.information:

filterGetByType information
---------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\Filters (`Filters api doc`_)
   * - Online reference
     - `filterGetByType online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.filter.methods.filterGetByType.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Filter;

    $server = new Filter();
    $filters = $server->filterGetByType("issue");

    foreach($filters as $filter) {
        echo $filter->getName() . PHP_EOL;
    }


.. _zendservice.filter.methods.filterSave:

The filterSave Method
=====================

Save a filter.

.. _zendservice.filter.methods.filterSave.definition:

Method filterSave definition
----------------------------

.. code-block:: php

    <?php
    public function filterSave($type, $name, $id = null, $data = array()) { }

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
     - Type of a filter (issue,job)
   * - $name
     - string
     -
     - yes
     - Name of filter.
   * - $id
     - int
     -
     - no
     - ID of a filter.
   * - $data
     - array
     - array()
     - no
     - Array of parameters to be saved.

.. _zendservice.filter.methods.filterSave.information:

filterSave information
----------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\Filter (`Filter api doc`_)
   * - Online reference
     - `filterSave online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.filter.methods.filterSave.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Filter;

    $server = new Filter();
    $filter = $server->filterSave("issue", "foo", array("eventTypes" => array("function-slow-exec")));

    echo $filter->getName() . " successfully added with id " . $filter->getId() . PHP_EOL;

.. _zendservice.filter.methods.filterDelete:

The filterDelete Method
=======================

Deletes a filter.

.. _zendservice.filter.methods.filterDelete.definition:

Method filterDelete definition
------------------------------

.. code-block:: php

    <?php
    public function filterDelete($name) { }

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
     - Name of filter.

.. _zendservice.filter.methods.filterDelete.information:

filterDelete information
------------------------

.. list-table::
   :widths: 5 10
   :header-rows: 0

   * - Return value
     - \\ZendService\\ZendServerAPI\\DataTypes\\Filter (`Filter api doc`_)
   * - Online reference
     - `filterDelete online reference`_
   * - Available in Version
     - * 1.3

.. _zendservice.filter.methods.filterDelete.example:

Example
-------

.. code-block:: php

    <?php
    use ZendService\ZendServerAPI\Filter;

    $server = new Filter();
    $filter = $server->filterDelete("foo");

    echo $filter->getName() . " successfully removed" . PHP_EOL;

.. _filterGetByType online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_filtergetbytype_method.htm
.. _Filters api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.Filters.html
.. _filterSave online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_filtersave_method.htm
.. _Filter api doc: http://zs-apidoc.rubber-duckling.net/classes/ZendService.ZendServerAPI.DataTypes.Filter.html
.. _filterDelete online reference: http://files.zend.com/help/Beta/Zend-Server-6/zend-server.htm#the_filterdelete_method.htm
