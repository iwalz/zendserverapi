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

use \ZendServerAPI\DataTypes\LicenseInfo,
    \ZendServerAPI\DataTypes\MessageList as MessageListData,
    \ZendServerAPI\DataTypes\SystemInfo as SystemInfoData;

/**
 * MessageList datatype adapter implementation
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class MessageList extends Adapter
{
    /**
     * @see \ZendServerAPI\Adapter\Adapter::parse()
     * @return \ZendServerAPI\DataTypes\MessageList
     */
    public function parse($xml = null)
    {
        if($xml === null)
            $xml = $this->getResponse()->getBody();

        $xml = simplexml_load_string($xml);
        $messageList = new MessageListData();
        if(isset($xml->error))
            $messageList->setError((string) $xml->error);
        if(isset($xml->info))
            $messageList->setInfo((string) $xml->info);
        if(isset($xml->warning))
            $messageList->setWarning((string) $xml->warning);

        return $messageList;
    }
}
