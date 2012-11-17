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
 * @package     ZendServerAPI\Method
 */

namespace ZendServerAPI\Method;

/**
 * <b>The monitorExportIssueByEventsGroup Method</b>
 *
 * <pre>Export an archive containing all of the issue's information,
 * event groups and code tracing if available, ready for consumption by Zend Studio.
 * The response is a binary payload.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package ZendServerAPI\Method
 */
class MonitorExportIssueByEventsGroup extends \ZendServerAPI\Method
{
    /**
     * The events group identifier
     * @var int
     */
    protected $eventsGroupId = null;

    /**
     * Constructor for MonitorExportIssueByEventsGroup
     *
     * @param int    $eventsGroupId   the events group identifier
     * @param string $exportDirectory the directory where to export files to
     * @param string $fileName        the file where to export the data to
     */
    public function __construct($eventsGroupId, $exportDirectory = null, $fileName = null)
    {
        parent::__construct();

        if($exportDirectory !== null)
            $this->setExportDirectory($exportDirectory);

        if($fileName !== null)
            $this->setFileName($fileName);

        $this->eventsGroupId = $eventsGroupId;
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure()
    {
        $this->setFunctionPath('/ZendServerManager/Api/monitorExportIssueByEventsGroup');
        $this->setMethod('GET');
        $this->setParser(new \ZendServerAPI\Adapter\MonitorExportIssueByEventsGroup());
    }

    /**
     * Returns the accept header
     *
     * @return string
     */
    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    /**
     * Get link for the method
     *
     * @return string
     */
    public function getLink()
    {
        $link = parent::getLink();
        $link .= '?eventGroupId='.$this->eventsGroupId;

        return $link;
    }

    /**
     * Get the directory where to export the files to
     * Proxy for the export directory in the adapter
     *
     * @return string
     */
    public function getExportDirectory()
    {
        return $this->getParser()->getExportDirectory();
    }

    /**
     * Set the directory where to export the files to.
     * Proxy for the adapter
     *
     * @param  string $exportDirectory
     * @return void
     */
    public function setExportDirectory($exportDirectory)
    {
        $this->getParser()->setExportDirectory($exportDirectory);
    }

    /**
     * Set the fileName where to export the file to
     * Proxy to the adapter
     *
     * @param  string $fileName
     * @return void
     */
    public function setFileName($fileName)
    {
        $this->getParser()->setFileName($fileName);
    }

    /**
     * Get the filename where to export the file to
     * Proxy to the adapter
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->getParser()->getFileName();
    }
}
