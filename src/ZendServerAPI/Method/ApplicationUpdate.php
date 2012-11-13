<?php
/**
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * <http://www.rubber-duckling.net>
 */

namespace ZendServerAPI\Method;

class ApplicationUpdate extends \ZendServerAPI\Method
{
    /**
     * The application's ID to update
     * @var int
     */
    protected $appId = null;
    /**
     * The application package file
     * @var string
     */
    protected $appPackage = null;
    /**
     * Ignore failures
     * @var boolean
     */
    protected $ignoreFailures = null;
    /**
     * Values for user params
     * @var array
     */
    protected $userParams = null;

    /**
     * Method implementation of 'ApplicationDeploy' call
     *
     * @param string  $appPackage
     * @param string  $baseUrl
     * @param boolean $createVhost
     * @param boolean $defaultServer
     * @param string  $userAppName
     * @param boolean $ignoreFailure
     * @param array   $userParams
     */
    public function __construct ($appId, $appPackage, $ignoreFailure = false, array $userParams = array())
    {
        $this->appId = $appId;
        $this->appPackage = $appPackage;
        $this->ignoreFailures = $ignoreFailure;
        $this->userParams = $userParams;

        parent::__construct();
    }

    /**
     * @see \ZendServerAPI\Method::configure()
     */
    public function configure ()
    {
        $this->setMethod('POST');
        $this->setFunctionPath('/ZendServerManager/Api/applicationUpdate');
        $this->setParser(new \ZendServerAPI\Adapter\ApplicationInfo());
//         $this->setParser(new \ZendServerAPI\Adapter\DumpParser());
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return "";
    }

    public function getContentValues()
    {
        $contentArray = array(
            'appId' => $this->appId,
            'userParams' => $this->getUserParams(),
            'ignoreFailures' => ($this->ignoreFailures === true ? 'TRUE' : 'FALSE')
        );

        return $contentArray;
    }

    /**
     * @see \ZendServerAPI\Method::getContentType()
     */
    public function getContentType()
    {
        return 'multipart/form-data';
    }

    /**
     * @see \ZendServerAPI\Method::getPostFiles()
     */
    public function getPostFiles()
    {
        return array('appPackage' => array('fileName' => $this->appPackage, 'contentType' => 'application/vnd.zend.applicationpackage'));
    }

    /**
     * Get the application's package name
     *
     * @return $appPackage
     */
    public function getAppPackage ()
    {
        return $this->appPackage;
    }

    /**
     * Get the application ID
     *
     * @return int
     */
    public function getApplicationId()
    {
        return $this->appId;
    }

    /**
     * Ignore failures
     *
     * @return $ignoreFailures
     */
    public function getIgnoreFailures ()
    {
        return $this->ignoreFailures;
    }

    /**
     * Get the user params
     *
     * @return $userParams
     */
    public function getUserParams ()
    {
        return $this->userParams;
    }

    /**
     * Set the application package
     *
     * @param string $appPackage
     */
    public function setAppPackage ($appPackage)
    {
        $this->appPackage = $appPackage;
    }

    /**
     * Set the application ID to update
     *
     * @param int $appId
     */
    public function setApplicationId($appId)
    {
        $this->appId = $appId;
    }

    /**
     * Ignore failures
     *
     * @param boolean $ignoreFailures
     */
    public function setIgnoreFailures ($ignoreFailures)
    {
        $this->ignoreFailures = $ignoreFailures;
    }

    /**
     * Set the user params for the application
     *
     * @param array $userParams
     */
    public function setUserParams ($userParams)
    {
        $this->userParams = $userParams;
    }
}
