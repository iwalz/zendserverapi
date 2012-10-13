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

class ConfigurationExport extends Adapter
{
    private $fileName = null;
    private $exportDirectory = null;

    /*
     * @see \ZendServerAPI\Adapter\Adapter::parse()
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

    public function getExportDirectory()
    {
        return $this->exportDirectory;
    }

    public function setExportDirectory($exportDirectory)
    {
        $this->exportDirectory = $this->checkPermission($exportDirectory);
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

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
