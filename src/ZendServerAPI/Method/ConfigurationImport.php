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

use ZendServerAPI\Adapter\ServersList;

class ConfigurationImport extends \ZendServerAPI\Method
{
    private $file = null;

    public function __construct($file = null)
    {
        parent::__construct();

        $this->file = $file;
    }

    public function configure()
    {
        $this->setFunctionPath('/ZendServerManager/Api/configurationImport');
        $this->setMethod('POST');
        $this->setParser(new ServersList());
    }

    public function getContentType()
    {
        return 'application/x-www-form-urlencoded';
    }

    public function getPostFiles()
    {
        return array('configFile' => array('fileName' => $this->file, 'contentType' => 'application/vnd.zend.serverconfig'));
    }

    public function getContent()
    {
        return "";
    }

    public function getImportFile()
    {
        return $this->file;
    }

    public function setImportFile($importFile)
    {
        $this->file = $importFile;
    }
}
