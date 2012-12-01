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
 * @license MIT
 * @link http://github.com/iwalz/zendserverapi
 * @author Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\DataTypes
 */

namespace ZendServerAPI\DataTypes;

/**
 * DebugRequest model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\DataTypes
 */
class DebugRequest extends DataType
{
    /**
     * 1 if success
     * @var int
     */
    protected $success = null;
    /**
     * Return message
     * @var string
     */
    protected $message = null;

    /**
     * Get if debugrequest was successful
     *
     * @return int
     */
    public function getSuccess ()
    {
        return $this->success;
    }

    /**
     * Get the returned message
     *
     * @return string
     */
    public function getMessage ()
    {
        return $this->message;
    }

    /**
     * Set the success property
     *
     * @param  int  $success
     * @return void
     */
    public function setSuccess ($success)
    {
        $this->success = (int) $success;
    }

    /**
     * Set the message
     *
     * @param  string $message
     * @return void
     */
    public function setMessage ($message)
    {
        $this->message = $message;
    }

}
