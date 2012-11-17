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

use \ZendServerAPI\DataTypes\LicenseInfo,
    \ZendServerAPI\DataTypes\MessageList as MessageListData,
    \ZendServerAPI\DataTypes\SystemInfo as SystemInfoData;

/**
 * SystemInfo datatype adapter implementation
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\Adapter
 */
class SystemInfo extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param string $xml
     * @return \ZendServerAPI\DataTypes\SystemInfo
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $systemInfo = new SystemInfoData();
        $systemInfo->setStatus((string) $xml->responseData->systemInfo->status);
        $systemInfo->setEdition((string) $xml->responseData->systemInfo->edition);
        $systemInfo->setZendServerVersion((string) $xml->responseData->systemInfo->zendServerVersion);
        $systemInfo->setSupportedApiVersions((string) trim($xml->responseData->systemInfo->supportedApiVersions));
        $systemInfo->setPhpVersion((string) $xml->responseData->systemInfo->phpVersion);
        $systemInfo->setOperatingSystem((string) $xml->responseData->systemInfo->operatingSystem);
        $systemInfo->setDeploymentVersion((string) $xml->responseData->systemInfo->deploymentVersion);

        $serverLicenseInfo = new LicenseInfo();
        $serverLicenseInfo->setStatus((string) $xml->responseData->systemInfo->serverLicenseInfo->status);
        $serverLicenseInfo->setOrderNumber((string) $xml->responseData->systemInfo->serverLicenseInfo->orderNumber);
        $serverLicenseInfo->setValidUntil((string) $xml->responseData->systemInfo->serverLicenseInfo->validUntil);
        $serverLicenseInfo->setServerLimit((string) $xml->responseData->systemInfo->serverLicenseInfo->serverLimit);
        $systemInfo->setServerLincenseInfo($serverLicenseInfo);

        $managerLicenseInfo = new LicenseInfo();
        $managerLicenseInfo->setStatus((string) $xml->responseData->systemInfo->managerLicenseInfo->status);
        $managerLicenseInfo->setOrderNumber((string) $xml->responseData->systemInfo->managerLicenseInfo->orderNumber);
        $managerLicenseInfo->setValidUntil((string) $xml->responseData->systemInfo->managerLicenseInfo->validUntil);
        $managerLicenseInfo->setServerLimit((string) $xml->responseData->systemInfo->managerLicenseInfo->serverLimit);
        $systemInfo->setManagerLicenseInfo($managerLicenseInfo);

        $messageListAdapter = new \ZendServerAPI\Adapter\MessageList();
        $messageList = $messageListAdapter->parse((string) $xml->responseData->messageList);
        $systemInfo->setMessageList($messageList);

        return $systemInfo;
    }
}
