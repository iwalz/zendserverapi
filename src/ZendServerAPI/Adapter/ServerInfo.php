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

namespace ZendServerAPI\Adapter;

use \ZendServerAPI\DataTypes\MessageList,
    \ZendServerAPI\DataTypes\ServerInfo as ServerInfoData;

class ServerInfo extends \ZendServerAPI\Adapter\Adapter
{
    /**
     * @see \ZendServerAPI\Adapter\Adapter::parse()
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);

        $server = new ServerInfoData();
        $server->setId((int) $xml->responseData->serverInfo->id);
        $server->setName((string) $xml->responseData->serverInfo->name);
        $server->setAddress((string) $xml->responseData->serverInfo->address);
        $server->setStatus((string) $xml->responseData->serverInfo->status);

        $messageList = new MessageList();
        if (isset($xml->responseData->serverInfo->messageList->error)) {
            $messageList->setError((string) $xml->responseData->serverInfo->messageList->error);
        }
        if (isset($xml->responseData->serverInfo->messageList->info)) {
            $messageList->setInfo((string) $xml->responseData->serverInfo->messageList->info);
        }
        if (isset($xml->responseData->serverInfo->messageList->warning)) {
            $messageList->setWarning((string) $xml->responseData->serverInfo->messageList->warning);
        }
        $server->setMessageList($messageList);

        return $server;
    }
}
