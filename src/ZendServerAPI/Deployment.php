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
 * 
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI
 */

namespace ZendServerAPI;

/**
 * <b>Deployment Methods</b>
 *
 * The following is a list of methods available for the deployment feature:
 * <ul>
 * <li>The applicationGetStatus Method</li>
 * <li>The applicationDeploy Method</li>
 * <li>The applicationUpdate Method</li>
 * <li>The applicationRemove Method</li>
 * <li>The applicationSynchronize Method</li>
 * <li>The applicationRollback Method</li>
 * </ul>
 *
 * <b>Possible Deployment Action Specific Error Codes:</b>
 * <table><tr>
 * <td><b>HTTP Code</b></td>
 * <td><b>Error Code</b></td>
 * <td><b>Description</b></td>
 * </tr><tr>
 * <td><b>500</b></td>
 * <td><b>serverVersionMismatch</b></td>
 * <td><b>One or more servers in the cluster
 * is a Zend Server that does not support the deployment
 * feature.</b></td>
 * </tr></table>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI
 */
class Deployment extends BaseAPI
{
    /**
     * Break loops for wait methods after this number of tries
     * @var int
     */
    const DEFAULT_WAITINTERVAL = 5;
    
    /**
     * <b>The applicationGetStatus Method</b>
     *
     * <pre>Get the list of applications currently deployed (or staged) on the server or the cluster and information
     * about each application. If application IDs are specified, this method will return information about the
     * specified applications. If no IDs are specified, this method will return information about all applications on
     * the server or cluster.</pre>
     *
     * @param
     *            array Ids of application's
     * @return \ZendServerAPI\DataTypes\ApplicationList
     */
    public function applicationGetStatus (array $applicationIds = array())
    {
        $this->request->setAction($this->apiFactory->factory('applicationGetStatus', $applicationIds));

        return $this->request->send();
    }

    /**
     * <b>The applicationDeploy Method</b>
     *
     * <pre>Deploy a new application to the server or cluster.
     * This process is asynchronous, meaning the initial request will wait until the application is uploaded and verified,
     * and the initial response will show information about the application being deployed.
     * However, the staging and activation process will proceed after the response is returned.
     * You must continue checking the application status using the applicationGetStatus method until the deployment process is complete.</pre>
     *
     *
     * @param
     *            string $file <p>File object of ZPK file</p>
     * @param
     *            string $baseUrl <p>The baseurl to which the application will be deployed</p>
     * @param
     *            boolean $createVhost <p>create VHost</p>
     * @param
     *            boolean $defaultServer <p>Deploy the application on the default server</p>
     * @param
     *            string $userAppName <p>Free text for user defined application identifier</p>
     * @param
     *            bool $ignoreFailures <p>ignore errors during staging on some servers</p>
     * @param
     *            array $userParams <p>Set values for user parameters defined in package</p>
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function applicationDeploy ($file, $baseUrl, $createVhost = false,
            $defaultServer = false, $userAppName = null, $ignoreFailures = false,
            $userParams = array())
    {
        $this->request->setAction($this->apiFactory->factory('applicationDeploy', $file, $baseUrl,
                        $createVhost, $defaultServer, $userAppName,
                        $ignoreFailures, $userParams));

        return $this->request->send();
    }

    /**
     * <b>The applicationUpdate Method</b>
     *
     * <pre>This method allows you to update an existing application. The package you provide must contain the
     * same application. Additionally, any new parameters or new values for existing parameters must be
     * provided. This process is asynchronous, meaning the initial request will wait until the package is uploaded
     * and verified, and the initial response will show information about the new version being deployed.
     * However, the staging and activation process will proceed after the response is returned. You must
     * continue checking the application status using the applicationGetStatus method until the deployment
     * process is complete.</pre>
     *
     * @param
     *            int $appId <p>The application's ID</p>
     * @param
     *            string $package <p>The application's package</p>
     * @param
     *            bool $ignoreFailures <p>Ignore failures during staging on some servers</p>
     * @param
     *            array $userParams <p>Set values for user parameters defined in package</p>
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function applicationUpdate ($appId, $package,
            $ignoreFailures = false, array $userParams = array())
    {
        $this->request->setAction($this->apiFactory->factory('applicationUpdate', $appId, $package, $ignoreFailures, $userParams));

        return $this->request->send();
    }

    /**
     * <b>The applicationRemove Method</b>
     *
     * <pre>This method allows you to remove an existing application. This process is asynchronous, meaning the
     * initial request will start the removal process and the initial response will show information about the
     * application being removed. However, the removal process will proceed after the response is returned.
     * You must continue checking the application status using the applicationGetStatus method until the
     * removal process is complete. Once applicationGetStatus contains no information about the application, it
     * has been completely removed</pre>
     *
     * @param  int  $appId <p>The application's ID</p>
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function applicationRemove ($appId)
    {
        $this->request->setAction($this->apiFactory->factory('applicationRemove', $appId));

        return $this->request->send();
    }

    /**
     * <b>The applicationRollback Method</b>
     *
     * <pre>Rollback an existing application to its previous version. This process is asynchronous, meaning the initial
     * request will start the rollback process and the initial response will show information about the application
     * being rolled back. You must continue checking the application status using the applicationGetStatus
     * method until the process is complete.</pre>
     *
     * @param  int  $appId <p>The application's ID</p>
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function applicationRollback ($appId)
    {
        $this->request->setAction($this->apiFactory->factory('applicationRollback', $appId));

        return $this->request->send();
    }

    /**
     * <b>The applicationSynchronize Method</b>
     *
     * <pre>Synchronizing an existing application, whether in order to fix a problem or to reset an installation. This
     * process is asynchronous, meaning the initial request will start the synchronize process and the initial
     * response will show information about the application being synchronized. However, the synchronize
     * process will proceed after the response is returned. You must continue checking the application status
     * using the applicationGetStatus method until the process is complete.</pre>
     *
     * @param
     *            int $appId <p>The application's id</p>
     * @param
     *            array $servers <p>Array of server IDs to perform action on</p>
     * @param
     *            bool  $ignoreFailures <p>Ignore failures during staging on some servers</p>
     * @return \ZendServerAPI\DataTypes\ApplicationList
     */
    public function applicationSynchronize ($appId, array $servers = array(),
            $ignoreFailures = false)
    {
        $this->request->setAction($this->apiFactory->factory('applicationSynchronize', $appId, $servers, $ignoreFailures));

        return $this->request->send();
    }

    /**
     * Wait for status = deployed on the application, check every $interval seconds
     *
     * @param int $applicationId
     *            <p>The application's ID</p>
     * @param int $interval
     *            <p>Seconds to repeat test</p>
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function waitForStableState ($applicationId, $interval = 5)
    {
        $applicationInfo = null;
        $i = 0;
        do {
            sleep($interval);

            $applicationList = $this->applicationGetStatus(array($applicationId));
            $applicationInfos = $applicationList->getApplicationInfos();
            $applicationInfo = $applicationInfos[0];

            if($i++ == self::DEFAULT_WAITINTERVAL)
                break;
        } while ($applicationInfo->getStatus() !== "deployed");

        return $applicationInfo;
    }

    /**
     * Wait for application not beeing in the list
     *
     * @param int $applicationId
     *            <p>The application's ID</p>
     * @param int $interval
     *            <p>Seconds to repeat test</p>
     * @return boolean
     */
    public function waitForRemoved ($applicationId, $interval = 5)
    {
        $applicationInfo = null;
        $i = 0;
        $retVal = true;

        do {
            sleep($interval);

            $applicationList = $this->applicationGetStatus(array($applicationId));
            $applicationInfos = $applicationList->getApplicationInfos();

            if ($i++ == self::DEFAULT_WAITINTERVAL) {
                $retVal = false;
                break;
            }
        } while ($applicationInfos !== array());

        return $retVal;
    }
}
