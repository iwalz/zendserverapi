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

namespace ZendServerAPI\DataTypes;

class ServersList
{
    /**
     * Internal container for ServerInfo storage
     * @var array
     */
    private $serverInfos = array();

    /**
     * Get the internal ServerInfo container
     *
     * @return array
     */
    public function getServerInfos()
    {
        return $this->serverInfos;
    }

    /**
     * Set ServerInfo container
     *
     * @param array $serverInfos
     */
    public function setServerInfos(array $serverInfos)
    {
        $this->serverInfos = $serverInfos;
    }

    /**
     * Add ServerInfo to container
     *
     * @param ServerInfo $serverInfo
     */
    public function addServerInfo(ServerInfo $serverInfo)
    {
        $this->serverInfos[] = $serverInfo;
    }

    /**
     * Returns the ServerInfo by a given Zend Server ID
     *
     * @param  int                                       $serverId
     * @return \ZendServerAPI\DataTypes\ServerInfo|false
     */
    public function getServerStatusById($serverId)
    {
        foreach ($this->serverInfos as $serverInfo) {
            if($serverInfo->getId() === $serverId)

                return $serverInfo;
        }

        return false;
    }

    /**
     * Returns the ServerInfo by a given Zend Server Name
     *
     * @param  string                                    $serverName
     * @return \ZendServerAPI\DataTypes\ServerInfo|false
     */
    public function getServerStatusByName($serverName)
    {
        foreach ($this->serverInfos as $serverInfo) {
            if($serverInfo->getName() === $serverName)

                return $serverInfo;
        }

        return false;
    }

    /**
     * Returns the first ServerInfo object
     *
     * @return \ZendServerAPI\DataTypes\ServerInfo
     */
    public function getFirst()
    {
       if(count($this->serverInfos) === 0)
           throw new \Exception("No server in list");

       return $this->serverInfos[0];
    }
}
