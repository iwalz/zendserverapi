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
 * SuperGlobals model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\DataTypes
 */
class SuperGlobals extends DataType
{
    /**
     * Internal get array
     * @var array
     */
    protected $get = array();
    /**
     * Internal post array
     * @var array
     */
    protected $post = array();
    /**
     * Internal cookie array
     * @var array
     */
    protected $cookie = array();
    /**
     * Internal server array
     * @var array
     */
    protected $server = array();
    /**
     * Internal session array
     * @var array
     */
    protected $session = array();

    /**
     * Add a get parameter key/value pair
     *
     * @param  string $key
     * @param  string $value
     * @return void
     */
    public function addGetParameter($key, $value)
    {
        $this->get[$key] = $value;
    }

    /**
     * Get the get parameter array or value by key
     * if parameter is given
     *
     * @param  string|null  $key
     * @return string|array
     */
    public function getGetParameter($key = null)
    {
        if ($key === null) {
            return $this->get;
        } elseif (array_key_exists($key, $this->get)) {
            return $this->get[$key];
        } else {
            return null;
        }
    }

    /**
     * Add a post parameter key/value pair
     *
     * @param  string $key
     * @param  string $value
     * @return void
     */
    public function addPostParameter($key, $value)
    {
        $this->post[$key] = $value;
    }

    /**
     * Get the post parameter array or value by key
     * if parameter is given
     *
     * @param  string|null  $key
     * @return string|array
     */
    public function getPostParameter($key = null)
    {
        if ($key === null) {
            return $this->post;
        } elseif (array_key_exists($key, $this->post)) {
            return $this->post[$key];
        } else {
            return null;
        }
    }

    /**
     * Add a cookie parameter key/value pair
     *
     * @param  string $key
     * @param  string $value
     * @return void
     */
    public function addCookieParameter($key, $value)
    {
        $this->cookie[$key] = $value;
    }

    /**
     * Get the cookie parameter array or value by key
     * if parameter is given
     *
     * @param  string|null  $key
     * @return string|array
     */
    public function getCookieParameter($key = null)
    {
        if ($key === null) {
            return $this->cookie;
        } elseif (array_key_exists($key, $this->cookie)) {
            return $this->cookie[$key];
        } else {
            return null;
        }
    }

    /**
     * Add a session parameter key/value pair
     *
     * @param  string $key
     * @param  string $value
     * @return void
     */
    public function addSessionParameter($key, $value)
    {
        $this->session[$key] = $value;
    }

    /**
     * Get the session parameter array or value by key
     * if parameter is given
     *
     * @param  string|null  $key
     * @return string|array
     */
    public function getSessionParameter($key = null)
    {
        if ($key === null) {
            return $this->session;
        } elseif (array_key_exists($key, $this->session)) {
            return $this->session[$key];
        } else {
            return null;
        }
    }

    /**
     * Add a server parameter key/value pair
     *
     * @param  string $key
     * @param  string $value
     * @return void
     */
    public function addServerParameter($key, $value)
    {
        $this->server[$key] = $value;
    }

    /**
     * Get the server parameter array or value by key
     * if parameter is given
     *
     * @param  string|null  $key
     * @return string|array
     */
    public function getServerParameter($key = null)
    {
        if ($key === null) {
            return $this->server;
        } elseif (array_key_exists($key, $this->server)) {
            return $this->server[$key];
        } else {
            return null;
        }
    }
}
