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
 * @package     ZendService\ZendServerAPI\DataTypes
 */

namespace ZendService\ZendServerAPI\DataTypes;

/**
 * ServerInfo model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendService\ZendServerAPI\DataTypes
 */
class ServerInfo extends DataType
{
    /**
     * The server ID
     * @var int
     */
    private $id = null;
    /**
     * The server name
     * @var string
     */
    private $name = null;
    /**
     * The server address as an HTTP URL
     * @var string
     */
    private $address = null;
    /**
     * The server status, which may be one of the following values:
     * - pendingRestart
     * - restarting
     * - misconfigured
     * - extensionMismatch
     * - daemonMismatch
     * - notResponding
     * - disabled
     * - removed
     * - startingUp
     * - shuttingDown
     * - OK
     * - unknown
     * @var string
     */
    private $status = null;
    /**
     * A list of messages reported by this server, which can be
     * empty if there are no messages to show.
     * @var \ZendService\ZendServerAPI\DataTypes\MessageList
     */
    private $messageList = null;

    /**
     * Get the server ID
     *
     * @return int
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Get the server name
     *
     * @return string
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * Get the server address as an HTTP URL
     *
     * @return string
     */
    public function getAddress ()
    {
        return $this->address;
    }

    /**
     * The server status, which may be one of the following values:
     * - pendingRestart
     * - restarting
     * - misconfigured
     * - extensionMismatch
     * - daemonMismatch
     * - notResponding
     * - disabled
     * - removed
     * - startingUp
     * - shuttingDown
     * - OK
     * - unknown
     *
     * @return string
     */
    public function getStatus ()
    {
        return $this->status;
    }

    /**
     * Get the messsage list
     *
     * @return \ZendService\ZendServerAPI\DataTypes\MessageList
     */
    public function getMessageList ()
    {
        return $this->messageList;
    }

    /**
     * Set the ID
     *
     * @param  int  $id
     * @return void
     */
    public function setId ($id)
    {
        $this->id = (int) $id;
    }

    /**
     * Set the server name
     *
     * @param  string $name
     * @return void
     */
    public function setName ($name)
    {
        $this->name = $name;
    }

    /**
     * Set the server address as an HTTP URL
     *
     * @param  string $address
     * @return void
     */
    public function setAddress ($address)
    {
        $this->address = $address;
    }

    /**
     * The server status, which may be one of the following values:
     * - pendingRestart
     * - restarting
     * - misconfigured
     * - extensionMismatch
     * - daemonMismatch
     * - notResponding
     * - disabled
     * - removed
     * - startingUp
     * - shuttingDown
     * - OK
     * - unknown
     *
     * @param  string $status
     * @return void
     */
    public function setStatus ($status)
    {
        $this->status = $status;
    }

    /**
     * Set the message list
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\MessageList $messageList
     * @return void
     */
    public function setMessageList (\ZendService\ZendServerAPI\DataTypes\MessageList $messageList)
    {
        $this->messageList = $messageList;
    }

}
