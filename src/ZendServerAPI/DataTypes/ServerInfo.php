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

class ServerInfo
{
    /**
     * @var Integer
     */
    private $id = null;
    /**
     * @var string
     */
    private $name = null;
    /**
     * @var string
     */
    private $address = null;
    /**
     * @var string
     */
    private $status = null;
    /**
     * @var \ZendServerAPI\DataTypes\MessageList
     */
    private $messageList = null;

    /**
     * @return the $id
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @return the $name
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * @return the $address
     */
    public function getAddress ()
    {
        return $this->address;
    }

    /**
     * @return the $status
     */
    public function getStatus ()
    {
        return $this->status;
    }

    /**
     * @return the $messageList
     */
    public function getMessageList ()
    {
        return $this->messageList;
    }

    /**
     * @param Integer $id
     */
    public function setId ($id)
    {
        $this->id = (int) $id;
    }

    /**
     * @param string $name
     */
    public function setName ($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $address
     */
    public function setAddress ($address)
    {
        $this->address = $address;
    }

    /**
     * @param string $status
     */
    public function setStatus ($status)
    {
        $this->status = $status;
    }

    /**
     * @param \ZendServerAPI\MessageList $messageList
     */
    public function setMessageList ($messageList)
    {
        $this->messageList = $messageList;
    }

}
