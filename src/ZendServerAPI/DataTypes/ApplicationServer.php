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
 * ApplicationServer model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\DataTypes
 */
class ApplicationServer extends DataType
{
    /**
     * The server ID
     * @var int
     */
    protected $id = null;
    /**
     * The latest version of the application that was identified
     * on the server
     * @var string
     */
    protected $deployedVersion = null;
    /**
     * The deployedVersion's status
     * @var string
     */
    protected $status = null;

    /**
     * Get the server's ID
     *
     * @return int
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Get the latest deployed Version
     *
     * @return string
     */
    public function getDeployedVersion ()
    {
        return $this->deployedVersion;
    }

    /**
     * Get the application's status
     *
     * @see \ZendServerAPI\DataTypes\ApplicationInfo::getStatus
     * @return string
     */
    public function getStatus ()
    {
        return $this->status;
    }

    /**
     * Set the server's ID
     *
     * @param  int  $id
     * @return void
     */
    public function setId ($id)
    {
        $this->id = (int) $id;
    }

    /**
     * Set the latest deployed Version
     *
     * @param  string $deployedVersion
     * @return void
     */
    public function setDeployedVersion ($deployedVersion)
    {
        $this->deployedVersion = $deployedVersion;
    }

    /**
     * Set the application's status
     *
     * @param  string $status
     * @return void
     */
    public function setStatus ($status)
    {
        $this->status = $status;
    }

}
