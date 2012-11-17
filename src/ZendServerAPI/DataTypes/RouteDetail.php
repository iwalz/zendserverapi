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

namespace ZendServerAPI\DataTypes;

/**
 * RouteDetail model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\DataTypes
 */
class RouteDetail extends DataType
{
    /**
     * Route detail piece's key name
     * @var string
     */
    protected $key = null;
    /**
     * Route detail piece's value
     * @var string
     */
    protected $value = null;

    /**
     * Get the route detail piece's key name
     *
     * @return string
     */
    public function getKey ()
    {
        return $this->key;
    }

    /**
     * Get the route detail piece's value
     *
     * @return string
     */
    public function getValue ()
    {
        return $this->value;
    }

    /**
     * Set the route detail piece's key name
     *
     * @param  string $key
     * @return void
     */
    public function setKey ($key)
    {
        $this->key = $key;
    }

    /**
     * Set the route detail piece's value
     *
     * @param  string $value
     * @return void
     */
    public function setValue ($value)
    {
        $this->value = $value;
    }

}
