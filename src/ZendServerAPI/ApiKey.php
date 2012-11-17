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
 */

namespace ZendServerAPI;

/**
 * ApiKey model implementation
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class ApiKey
{
    /**
     * Name of the api key
     * @var string
     */
    private $name = null;
    /**
     * Value of the api key
     * @var string
     */
    private $key = null;
    /**
     * State of the api key
     * @var FULL|READONLY
     */
    private $state = null;
    /**
     * Only access to READ methods
     * @var int
     */
    const READONLY = 1;
    /**
     * Access to all methods
     * @var int
     */
    const FULL = 2;

    /**
     * Constructor for ApiKey model class
     *
     * @param string $name Name of the api key
     * @param string $key  The api key value
     * @param int State of the api key
     */
    public function __construct($name = null, $key = null, $state = self::READONLY)
    {
        $this->name = $name;
        $this->key = $key;
        $this->state = $state;
    }

    /**
     * Set the name of the API Key
     *
     * @param string $name Apikey name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set READ or FULL state for API Key
     *
     * @param int 1 | 2
     * @throws InvalidArgumentException
     */
    public function setState($state)
    {
        if($state === self::READONLY || $state === self::FULL)
            $this->state = $state;
        else
            throw new \InvalidArgumentException("State has to be \ZendServerAPI\ApiKey::READONLY or \ZendServerAPI\ApiKey::Full");
    }

    /**
     * Set Key value
     *
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Get name of the API Key
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the state of the current API Key
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get the Key value
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}
