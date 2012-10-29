<?php
/*
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

namespace ZendServerAPI;

class Deployment extends BaseAPI
{

    /**
     * Implementation of 'applicationGetStatus' method
     *
     * @access public
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
     *            boolean $createVhost[optional]=false <p>create VHost</p>
     * @param
     *            boolean $defaultServer[optional]=false <p>Deploy the application on the default server</p>
     * @param
     *            string $userAppName[optional]=null <p>Free text for user defined application identifier</p>
     * @param
     *            boolean $ignoreFailures[optional]=false <p>ignore errors during staging on some servers</p>
     * @param
     *            array $userParams[optional]=array() <p>Set values for user parameters defined in package</p>
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function applicationDeploy ($file, $baseUrl, $createVhost = false,
            $defaultServer = false, $userAppName = null, $igonreFailures = false,
            $userParams = array())
    {
        $this->request->setAction($this->apiFactory->factory('applicationDeploy', $file, $baseUrl,
                        $createVhost, $defaultServer, $userAppName,
                        $igonreFailures, $userParams));

        return $this->request->send();
    }

    /**
     * Implementation of 'applicationUpdate' method
     *
     * @access public
     * @param
     *            Integer The application's ID
     * @param
     *            string The application's package
     * @param
     *            s boolean Ignore failures during staging on some servers
     * @param
     *            s array Set values for user parameters defined in package
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function applicationUpdate ($appId, $package,
            $ignoreFailures = false, array $userParams = array())
    {
        $this->request->setAction($this->apiFactory->factory('applicationUpdate', $appId, $package, $ignoreFailures, $userParams));

        return $this->request->send();
    }

    /**
     * Implementation of 'applicationRemove' method
     *
     * @access public
     * @param  id                                       $appId
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function applicationRemove ($appId)
    {
        $this->request->setAction($this->apiFactory->factory('applicationRemove', $appId));

        return $this->request->send();
    }

    /**
     * Implementation of 'applicationRollback' method
     *
     * @access public
     * @param  id                                       $appId
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function applicationRollback ($appId)
    {
        $this->request->setAction($this->apiFactory->factory('applicationRollback', $appId));

        return $this->request->send();
    }

    /**
     * Implementation of 'applicationSynchronize' method
     *
     * @access public
     * @param
     *            integer The application's id
     * @param
     *            array Array of server IDs to perform action on
     * @param
     *            boolean Ignore failures during staging on some servers
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
     *            The application's ID
     * @param int $interval
     *            Seconds to repeat test
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

            if($i++ == 5)
                break;
        } while ($applicationInfo->getStatus() !== "deployed");

        return $applicationInfo;
    }

    /**
     * Wait for application not beeing in the list
     *
     * @param int $applicationId
     *            The application's ID
     * @param int $interval
     *            Seconds to repeat test
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

            if ($i++ == 5) {
                $retVal = false;
                break;
            }
        } while ($applicationInfos !== array());

        return $retVal;
    }
}
