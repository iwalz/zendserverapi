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

namespace ZendServerAPI\Factories;

class ApiVersion10CommandFactory implements CommandFactory
{
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
