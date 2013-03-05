<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */
namespace ZendService\ZendServerAPI\Deployment;

/**
 *
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class Descriptor
{
    /**
     * @var string
     */
    protected $name = null;
    /**
     * @var string
     */
    protected $summary = null;
    /**
     * @var string
     */
    protected $description = null;
    /**
     * @var string
     */
    protected $eula = null;
    /**
     * @var Release
     */
    protected $version = null;
    /**
     * @var string
     */
    protected $appdir = null;
    /**
     * @var string
     */
    protected $docroot = null;
    /**
     * @var string
     */
    protected $scriptsdir = null;
    /**
     * @var RequiredList
     */
    protected $dependencies = null;
    /**
     * @var ParameterList
     */
    protected $parameters = null;
    /**
     * @var string
     */
    protected $healthcheck = null;
    /**
     * @var VariableList
     */
    protected $variables = null;
    /**
     * @var ResourceList
     */
    protected $persistentResources = null;

    /**
     * @param string $appdir
     */
    public function setAppdir($appdir)
    {
        $this->appdir = $appdir;
    }

    /**
     * @return string
     */
    public function getAppdir()
    {
        return $this->appdir;
    }

    /**
     * @param \ZendService\ZendServerAPI\Deployment\RequiredList $dependencies
     */
    public function setDependencies(RequiredList $dependencies)
    {
        $this->dependencies = $dependencies;
    }

    /**
     * @return \ZendService\ZendServerAPI\Deployment\RequiredList
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $docroot
     */
    public function setDocroot($docroot)
    {
        $this->docroot = $docroot;
    }

    /**
     * @return string
     */
    public function getDocroot()
    {
        return $this->docroot;
    }

    /**
     * @param string $eula
     */
    public function setEula($eula)
    {
        $this->eula = $eula;
    }

    /**
     * @return string
     */
    public function getEula()
    {
        return $this->eula;
    }

    /**
     * @param string $healthcheck
     */
    public function setHealthcheck($healthcheck)
    {
        $this->healthcheck = $healthcheck;
    }

    /**
     * @return string
     */
    public function getHealthcheck()
    {
        return $this->healthcheck;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \ZendService\ZendServerAPI\Deployment\ParameterList $parameters
     */
    public function setParameters(ParameterList $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return \ZendService\ZendServerAPI\Deployment\ParameterList
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param \ZendService\ZendServerAPI\Deployment\ResourceList $persistentResources
     */
    public function setPersistentResources(ResourceList $persistentResources)
    {
        $this->persistentResources = $persistentResources;
    }

    /**
     * @return \ZendService\ZendServerAPI\Deployment\ResourceList
     */
    public function getPersistentResources()
    {
        return $this->persistentResources;
    }

    /**
     * @param string $scriptsdir
     */
    public function setScriptsdir($scriptsdir)
    {
        $this->scriptsdir = $scriptsdir;
    }

    /**
     * @return string
     */
    public function getScriptsdir()
    {
        return $this->scriptsdir;
    }

    /**
     * @param string $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param \ZendService\ZendServerAPI\Deployment\VariableList $variables
     */
    public function setVariables(VariableList $variables)
    {
        $this->variables = $variables;
    }

    /**
     * @return \ZendService\ZendServerAPI\Deployment\VariableList
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * @param \ZendService\ZendServerAPI\Deployment\Release $version
     */
    public function setVersion(Release $version)
    {
        $this->version = $version;
    }

    /**
     * @return \ZendService\ZendServerAPI\Deployment\Release
     */
    public function getVersion()
    {
        return $this->version;
    }


}
