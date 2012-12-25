.. highlight:: php
.. _zendservice.installation:

************
Installation
************

Via Composer
-------------

.. _zendservice.installation.composer:

You can install the API with composer by adding the following lines to your ``composer.json`` file:

.. code-block:: javascript

    {
        "repositories": [
            {
                "type": "composer",
                "url": "http://packages.zendframework.com/"
            }
        ],
        "require": {
            "zendserverapi/zendserverapi": "dev-master"
        },
        "minimum-stability": "dev"
    }


.. program:: composer

.. cmdoption:: composer install

    Run the installation and you're ready to go.




**Note:** There are a few dependencies to the Zend Framework 2 from inside the library.
The ``repositories`` section will allow you to install only the required components and not the whole framework.
If you don't register the Zend packagist repository, the whole Zend Framework 2 will be installed by composer.
I recommend to register that repository to reduce the overhead during installation.
