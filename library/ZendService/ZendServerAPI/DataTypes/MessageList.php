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
 * @package     ZendServerAPI\DataTypes
 */

namespace ZendService\ZendServerAPI\DataTypes;

/**
 * MessageList model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\DataTypes
 */
class MessageList extends DataType
{
    /**
     * Info severity message
     * @var string
     */
    protected $info = null;
    /**
     * Warning severity message
     * @var string
     */
    protected $warning = null;
    /**
     * Error severity message
     * @var string
     */
    protected $error = null;

    /**
     * Constructor for MessageList DataType.
     * XML data can be provided here for parsing
     *
     * @param  string                               $xmlData
     * @return \ZendServerAPI\DataTypes\MessageList
     */
    public function __construct($xmlData = null)
    {
        if ($xmlData !== null) {
            $xml = simplexml_load_string($xmlData);

            $this->info = (string) $xml->info;
            $this->warning = (string) $xml->warning;
            $this->error = (string) $xml->error;
        }
    }

    /**
     * Get the info severity message
     *
     * @return string
     */
    public function getInfo ()
    {
        return $this->info;
    }

    /**
     * Get the warning severity message
     *
     * @return string
     */
    public function getWarning ()
    {
        return $this->warning;
    }

    /**
     * Get the error severity message
     *
     * @return string
     */
    public function getError ()
    {
        return $this->error;
    }

    /**
     * Set the severity info message
     *
     * @param  string $info
     * @return void
     */
    public function setInfo ($info)
    {
        $this->info = $info;
    }

    /**
     * Set the warning severity message
     *
     * @param  string $warning
     * @return void
     */
    public function setWarning ($warning)
    {
        $this->warning = $warning;
    }

    /**
     * Set the error severity message
     *
     * @param  string $error
     * @return void
     */
    public function setError ($error)
    {
        $this->error = $error;
    }

}
