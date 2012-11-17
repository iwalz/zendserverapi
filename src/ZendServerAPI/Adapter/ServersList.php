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

use ZendServerAPI\DataTypes\ServerInfo as ServerInfoData,
    ZendServerAPI\DataTypes\MessageList,
    ZendServerAPI\DataTypes\ServersList as ServersListData;

/**
 * ServersList datatype adapter implementation
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\Adapter
 */
class ServersList extends Adapter
{
    /**
     * Parse the xml response in object mappings
     *
     * @param string $xml
     * @return \ZendServerAPI\DataTypes\ServersList
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $serversList = new ServersListData();

        foreach ($xml->responseData->serversList->serverInfo as $serverInfo) {
            $server = new ServerInfoData();
            $server->setId((int) $serverInfo->id);
            $server->setName((string) $serverInfo->name);
            $server->setAddress((string) $serverInfo->address);
            $server->setStatus((string) $serverInfo->status);

            $messageList = new MessageList();
            $messageList->setError((string) $serverInfo->messageList->error);
            $messageList->setInfo((string) $serverInfo->messageList->info);
            $messageList->setWarning((string) $serverInfo->messageList->warning);
            $server->setMessageList($messageList);

            $serversList->addServerInfo($server);
        }

        return $serversList;
    }
}
