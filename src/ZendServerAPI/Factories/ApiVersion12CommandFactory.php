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

/**
 * A factory, that retrieves commands from the webapi version 1.2.
 * Used for the Zend Server version 5.6. Can also handle the commands from
 * 1.1 and 1.0
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class ApiVersion12CommandFactory extends ApiVersion11CommandFactory
{
    /**
     * Retrieves the command object and throws an error if
     * the command is not supported via this factory (and the Zend Server/webapi version).
     * Will take care of the commands from the previous factories
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
            case 'codetracingDisable':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\CodetracingDisable');

                return $reflect->newInstanceArgs($args);
                break;
            case 'codetracingEnable':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\CodetracingEnable');

                return $reflect->newInstanceArgs($args);
                break;
            case 'codetracingIsEnabled':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\CodetracingIsEnabled');

                return $reflect->newInstanceArgs($args);
                break;
            case 'codetracingCreate':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\CodetracingCreate');

                return $reflect->newInstanceArgs($args);
                break;
            case 'codetracingDelete':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\CodetracingDelete');

                return $reflect->newInstanceArgs($args);
                break;
            case 'codetracingList':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\CodetracingList');

                return $reflect->newInstanceArgs($args);
                break;
            case 'codetracingDownloadTraceFile':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\CodetracingDownloadTraceFile');

                return $reflect->newInstanceArgs($args);
                break;
            case 'monitorGetRequestSummary':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\MonitorGetRequestSummary');

                return $reflect->newInstanceArgs($args);
                break;
            case 'monitorGetIssuesListByPredefinedFilter':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\MonitorGetIssuesListByPredefinedFilter');

                return $reflect->newInstanceArgs($args);
                break;
            case 'monitorGetIssuesDetails':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\MonitorGetIssuesDetails');

                return $reflect->newInstanceArgs($args);
                break;
            case 'monitorGetEventGroupDetails':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\MonitorGetEventGroupDetails');

                return $reflect->newInstanceArgs($args);
                break;
            case 'monitorChangeIssueStatus':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\MonitorChangeIssueStatus');

                return $reflect->newInstanceArgs($args);
                break;
            case 'monitorExportIssueByEventsGroup':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\MonitorExportIssueByEventsGroup');

                return $reflect->newInstanceArgs($args);
                break;
            case 'studioStartDebug':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\StudioStartDebug');

                return $reflect->newInstanceArgs($args);
                break;
            case 'studioStartProfile':
                $reflect  = new \ReflectionClass('\ZendServerAPI\Method\StudioStartProfile');

                return $reflect->newInstanceArgs($args);
                break;

            default:
                return call_user_func_array('parent::factory', array_merge(array($name), $args));
        }
    }
}
