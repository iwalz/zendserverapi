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

namespace ZendServerAPI\Adapter;

/**
 * MonitorExportIssueByEventsGroup datatype adapter implementation
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class MonitorExportIssueByEventsGroup extends Adapter
{
    /**
     * Filename to save file locally
     * @var string
     */
    private $fileName = null;
    /**
     * Directory where to export the downloaded files
     * @var string
     */
    private $exportDirectory = null;

   /**
    * @see \ZendServerAPI\Adapter\Adapter::parse()
    * @return \SplFileInfo
    */
    public function parse ()
    {
        if ($this->fileName === null) {
            $contentDisposition = $this->getResponse()->getContentDisposition();
            $parts = explode("\"", $contentDisposition);
            $fileName = $this->exportDirectory . DIRECTORY_SEPARATOR . $parts[1];
        } else {
            $fileName = $this->exportDirectory . DIRECTORY_SEPARATOR . $this->fileName;
        }
        file_put_contents( $fileName, $this->getResponse()->getBody());

        return new \SplFileInfo($fileName);
    }

    /**
     * Get the directory, where to save the downloaded files to
     *
     * @return string
     */
    public function getExportDirectory()
    {
        return $this->exportDirectory;
    }

    /**
     * Set the directory, where to save the downloaded files to
     *
     * @param  string $exportDirectory
     * @return void
     */
    public function setExportDirectory($exportDirectory)
    {
        $this->exportDirectory = $this->checkPermission($exportDirectory);
    }

    /**
     * Set the filename where to save the file to (locally)
     *
     * @param  string $fileName
     * @return void
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Get the filename where to save the file to (locally)
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Check the permissions and returns the realpath for the directory
     *
     * @param  string                    $directory
     * @throws \InvalidArgumentException
     * @return string
     */
    private function checkPermission($directory)
    {
        $directoryRealpath = realpath($directory);
        if(!is_dir($directory))
            throw new \InvalidArgumentException("Directory " . $directory . " does not exist");
        if(!is_writable($directory))
            throw new \InvalidArgumentException("Directory " . $directory . " is not writeable");

        return $directoryRealpath;
    }
}
