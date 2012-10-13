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

namespace ZendServerAPI\Method;

use ZendServerAPI\Adapter\CodetracingDownloadTraceFile as CodetracingDownloadTraceFileAdapter;

class CodetracingDownloadTraceFile extends \ZendServerAPI\Method
{
    protected $traceFile = null;
    protected $fileName = null;
    protected $exportDirectory = null;

    /**
     *
     * @param string $traceFile
     */
    public function __construct($traceFile, $fileName = null, $exportDirectory = null)
    {
        parent::__construct();

        $this->traceFile = $traceFile;
        $this->setExportDirectory($exportDirectory);
        $this->setFileName($fileName);
    }

    public function configure()
    {
        $this->setFunctionPath('/ZendServerManager/Api/codetracingDownloadTraceFile');
        $this->setMethod('GET');
        $this->setParser(new CodetracingDownloadTraceFileAdapter());
    }

    public function getLink()
    {
        $link = parent::getLink();
        $link .= '?traceFile='.$this->traceFile;

        return $link;
    }

    public function getAcceptHeader()
    {
        return "application/vnd.zend.serverapi+xml;version=1.2";
    }

    public function getExportDirectory()
    {
        return $this->getParser()->getExportDirectory();
    }

    public function setExportDirectory($exportDirectory)
    {
        $this->getParser()->setExportDirectory($exportDirectory);
    }

    public function setFileName($fileName)
    {
        $this->getParser()->setFileName($fileName);
    }

    public function getFileName()
    {
        return $this->getParser()->getFileName();
    }
}
