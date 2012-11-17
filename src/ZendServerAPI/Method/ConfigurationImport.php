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

use ZendServerAPI\Adapter\ServersList;

/**
 * <b>The configurationImport Method</b>
 *
 * <pre>Import a saved configuration snapshot into the server.</pre>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package ZendServerAPI\Method
 */
class ConfigurationImport extends Method
{
    /**
     * File to import
     * @var string
     */
    private $file = null;

    /**
     * Constructor for ConfigurationImport
     *
     * @param string $file The file to import
     */
    public function __construct($file = null)
    {
        parent::__construct();

        if($file !== null)
            $this->file = $file;
    }

    /**
     * Configures all needed information for the method implementation
     *
     * @return void
     */
    public function configure()
    {
        $this->setFunctionPath('/ZendServerManager/Api/configurationImport');
        $this->setMethod('POST');
        $this->setParser(new ServersList());
    }

    /**
     * Returns the content type
     *
     * @return string
     */
    public function getContentType()
    {
        return 'application/x-www-form-urlencoded';
    }

    /**
     * Get the files to post
     *
     * @return array
     */
    public function getPostFiles()
    {
        return array('configFile' => array('fileName' => $this->file, 'contentType' => 'application/vnd.zend.serverconfig'));
    }

    /**
     * Returns the content
     *
     * @return string
     */
    public function getContent()
    {
        return "";
    }

    /**
     * Get the fileName which file needs to be imported
     *
     * @return string
     */
    public function getImportFile()
    {
        return $this->file;
    }

    /**
     * Set the fileName which file needs to be imported
     *
     * @param  string $importFile
     * @return void
     */
    public function setImportFile($importFile)
    {
        $this->file = $importFile;
    }
}
