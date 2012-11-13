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
 */

namespace ZendServerAPI;

class Configuration extends BaseAPI
{
    /**
     * The config file to import
     * @var string
     */
    protected $importFile = null;
    /**
     * Directory where to save exported configs
     * @var string
     */
    protected $exportDirectory = null;

    /**
     * Export the configuration and store locally
     *
     * @param  string       $exportDirectory Directory where to save the exported configs
     * @return \SplFileInfo
     */
    public function configurationExport($exportDirectory = null, $fileName = null)
    {
        if($exportDirectory !== null)
            $this->exportDirectory = $exportDirectory;
        else
            $this->exportDirectory = getcwd();

        $this->request->setAction($this->apiFactory->factory('configurationExport', $this->exportDirectory, $fileName));

        return $this->request->send();
    }

    /**
     * Import a local config file
     *
     * @param  string                               $importFile File to import
     * @return \ZendServerAPI\DataTypes\ServersList
     */
    public function configurationImport($importFile = null)
    {
        if($importFile !== null)
            $this->importFile = $importFile;

        $this->request->setAction($this->apiFactory->factory('configurationImport', $this->importFile));

        return $this->request->send();
    }

    /**
     * Get the config file to import
     *
     * @return string
     */
    public function getImportFile()
    {
        return $this->importFile;
    }

    /**
     * Set the import config file
     *
     * @param string $importFile Full path to file
     */
    public function setImportFile($importFile)
    {
        $this->importFile = $importFile;
    }

    /**
     * Get the directory for saving the configs
     *
     * @return string
     */
    public function getExportDirectory()
    {
        return $this->exportDirectory;
    }

    /**
     * Directory for exported config files
     *
     * @param string $exportDirectory
     */
    public function setExportDirectory($exportDirectory)
    {
        $this->exportDirectory = $exportDirectory;
    }
}
