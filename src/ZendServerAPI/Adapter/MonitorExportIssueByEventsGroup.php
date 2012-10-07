<?php
namespace ZendServerAPI\Adapter;

class MonitorExportIssueByEventsGroup extends Adapter
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

