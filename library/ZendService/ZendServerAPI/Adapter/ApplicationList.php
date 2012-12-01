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
 * @package     ZendServerAPI\Adapter
 */

namespace ZendServerAPI\Adapter;

/**
 * ApplicationList datatype adapter implementation
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\Adapter
 */
class ApplicationList extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param  string                                   $xml
     * @return \ZendServerAPI\DataTypes\ApplicationList
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $applicationList = new \ZendServerAPI\DataTypes\ApplicationList();
        foreach ($xml->responseData->applicationsList->applicationInfo as $xmlAppInfo) {
            $applicationInfo = new \ZendServerAPI\DataTypes\ApplicationInfo();
            $applicationInfo->setAppName((string) $xmlAppInfo->appName);
            $applicationInfo->setId((string) $xmlAppInfo->id);
            $applicationInfo->setBaseUrl((string) $xmlAppInfo->baseUrl);
            $applicationInfo->setUserAppName((string) $xmlAppInfo->userAppName);
            $applicationInfo->setInstalledlocation((string) trim($xmlAppInfo->installedLocation));
            $applicationInfo->setStatus((string) $xmlAppInfo->status);

            foreach ($xmlAppInfo->servers->applicationServer as $xmlServer) {
                $server = new \ZendServerAPI\DataTypes\ApplicationServer();
                $server->setId((string) $xmlServer->id);
                $server->setDeployedVersion((string) trim($xmlServer->deployedVersion));
                $server->setStatus((string) $xmlServer->status);
                $applicationInfo->addServer($server);
            }
            foreach ($xmlAppInfo->deployedVersions->deployedVersion as $xmlDeployedVersions) {
                $deployedVersions = new \ZendServerAPI\DataTypes\DeployedVersions();
                $deployedVersions->setVersion((string) trim($xmlDeployedVersions));
                $applicationInfo->addDeployedVersions($deployedVersions);
            }

            $messageListAdapter = new \ZendServerAPI\Adapter\MessageList();
            $xmlMessageList = (string) $xmlAppInfo->messageList;

            if(!empty($xmlMessageList))
                $applicationInfo->setMessageList($messageListAdapter->parse($xmlMessageList));

            $applicationList->addApplicationInfo($applicationInfo);
        }

        return $applicationList;
    }
}
