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
 * ApplicationInfo datatype adapter implementation
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\Adapter
 */
class ApplicationInfo extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param string $xml
     * @return \ZendServerAPI\DataTypes\ApplicationInfo
     */
    public function parse ($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $applicationInfo = new \ZendServerAPI\DataTypes\ApplicationInfo();
        $applicationInfo->setAppName((string) $xml->responseData->applicationInfo->appName);
        $applicationInfo->setId((string) $xml->responseData->applicationInfo->id);
        $applicationInfo->setBaseUrl((string) $xml->responseData->applicationInfo->baseUrl);
        $applicationInfo->setUserAppName((string) $xml->responseData->applicationInfo->userAppName);
        $applicationInfo->setInstalledlocation((string) trim($xml->responseData->applicationInfo->installedLocation));
        $applicationInfo->setStatus((string) $xml->responseData->applicationInfo->status);

        if (isset($xml->responseData->applicationInfo->servers->applicationServer)) {
            foreach ($xml->responseData->applicationInfo->servers->applicationServer as $xmlServer) {
                $server = new \ZendServerAPI\DataTypes\ApplicationServer();
                $server->setId((string) $xmlServer->id);
                $server->setDeployedVersion((string) trim($xmlServer->deployedVersion));
                $server->setStatus((string) $xmlServer->status);
                $applicationInfo->addServer($server);
            }
        }
        if (isset($xml->responseData->applicationInfo->deployedVersions->deployedVersion)) {
            foreach ($xml->responseData->applicationInfo->deployedVersions->deployedVersion as $xmlDeployedVersions) {
                $deployedVersions = new \ZendServerAPI\DataTypes\DeployedVersions();
                $deployedVersions->setVersion((string) trim($xmlDeployedVersions));
                $applicationInfo->addDeployedVersions($deployedVersions);
            }
        }

        $messageListAdapter = new \ZendServerAPI\Adapter\MessageList();
        $xmlMessageList = (string) $xml->responseData->applicationInfo->messageList;

        if(!empty($xmlMessageList))
            $applicationInfo->setMessageList($messageListAdapter->parse($xmlMessageList));

        return $applicationInfo;
    }
}
