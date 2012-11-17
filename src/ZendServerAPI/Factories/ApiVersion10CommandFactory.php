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
 * @package     ZendServerAPI\Factories
 */

namespace ZendServerAPI\Factories;

/**
 * A factory, that retrieves commands from the webapi version 1.0.
 * Used for the intruduced Zend Server version 5.1
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\Factories
 */
class ApiVersion10CommandFactory implements CommandFactory
{
    /**
     * Retrieves the command object and throws an error if
     * the command is not supported via this factory (and the Zend Server/webapi version).
     *
     * @throws \RuntimeException
     * @param  string                $name
     * @return \ZendServerAPI\Method
     */
    public function factory($name)
    {
        $args = func_get_args();
        array_shift($args);

        switch ($name) {
            case 'clusterGetServerStatus':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ClusterGetServerStatus');

                return $reflect->newInstanceArgs($args);
                break;
            case 'clusterAddServer':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ClusterAddServer');

                return $reflect->newInstanceArgs($args);
                break;
            case 'clusterRemoveServer':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ClusterRemoveServer');

                return $reflect->newInstanceArgs($args);
                break;
            case 'clusterEnableServer':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ClusterEnableServer');

                return $reflect->newInstanceArgs($args);
                break;
            case 'clusterDisableServer':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ClusterDisableServer');

                return $reflect->newInstanceArgs($args);
                break;
            case 'restartPHP':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\RestartPHP');

                return $reflect->newInstanceArgs($args);
                break;
            case 'getSystemInfo':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\GetSystemInfo');

                return $reflect->newInstanceArgs($args);
                break;
            case 'configurationImport':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ConfigurationImport');

                return $reflect->newInstanceArgs($args);
                break;
            case 'configurationExport':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\ConfigurationExport');

                return $reflect->newInstanceArgs($args);
                break;
            default:
                throw new \RuntimeException('The method ' . $name . ' is not available');
        }
    }
}
