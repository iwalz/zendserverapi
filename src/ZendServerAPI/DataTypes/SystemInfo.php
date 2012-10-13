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

namespace ZendServerAPI\DataTypes;

class SystemInfo
{
    private $status = null;
    private $edition = null;
    private $zendServerVersion = null;
    private $supportedApiVersions = null;
    private $phpVersion = null;
    private $operatingSystem = null;
    private $deploymentVersion = null;
    private $serverLincenseInfo = null;
    private $managerLicenseInfo = null;
    private $messageList = null;

    /**
     * @return the $xml
     */
    public function getXml ()
    {
        return $this->xml;
    }

    /**
     * @return the $status
     */
    public function getStatus ()
    {
        return $this->status;
    }

    /**
     * @return the $edition
     */
    public function getEdition ()
    {
        return $this->edition;
    }

    /**
     * @return the $zendServerVersion
     */
    public function getZendServerVersion ()
    {
        return $this->zendServerVersion;
    }

    /**
     * @return the $supportedApiVersions
     */
    public function getSupportedApiVersions ()
    {
        return $this->supportedApiVersions;
    }

    /**
     * @return the $phpVersion
     */
    public function getPhpVersion ()
    {
        return $this->phpVersion;
    }

    /**
     * @return the $operatingSystem
     */
    public function getOperatingSystem ()
    {
        return $this->operatingSystem;
    }

    /**
     * @return the $deploymentVersion
     */
    public function getDeploymentVersion ()
    {
        return $this->deploymentVersion;
    }

    /**
     * @return the $serverLincenseInfo
     */
    public function getServerLincenseInfo ()
    {
        return $this->serverLincenseInfo;
    }

    /**
     * @return the $managerLicenseInfo
     */
    public function getManagerLicenseInfo ()
    {
        return $this->managerLicenseInfo;
    }

    /**
     * @return the $messageList
     */
    public function getMessageList ()
    {
        return $this->messageList;
    }

    /**
     * @param NULL $xml
     */
    public function setXml ($xml)
    {
        $this->xml = $xml;
    }

    /**
     * @param NULL $status
     */
    public function setStatus ($status)
    {
        $this->status = $status;
    }

    /**
     * @param NULL $edition
     */
    public function setEdition ($edition)
    {
        $this->edition = trim($edition);
    }

    /**
     * @param NULL $zendServerVersion
     */
    public function setZendServerVersion ($zendServerVersion)
    {
        $this->zendServerVersion = $zendServerVersion;
    }

    /**
     * @param NULL $supportedApiVersions
     */
    public function setSupportedApiVersions ($supportedApiVersions)
    {
        $this->supportedApiVersions = $supportedApiVersions;
    }

    /**
     * @param NULL $phpVersion
     */
    public function setPhpVersion ($phpVersion)
    {
        $this->phpVersion = $phpVersion;
    }

    /**
     * @param NULL $operatingSystem
     */
    public function setOperatingSystem ($operatingSystem)
    {
        $this->operatingSystem = $operatingSystem;
    }

    /**
     * @param NULL $deploymentVersion
     */
    public function setDeploymentVersion ($deploymentVersion)
    {
        $this->deploymentVersion = $deploymentVersion;
    }

    /**
     * @param NULL $serverLincenseInfo
     */
    public function setServerLincenseInfo ($serverLincenseInfo)
    {
        $this->serverLincenseInfo = $serverLincenseInfo;
    }

    /**
     * @param NULL $managerLicenseInfo
     */
    public function setManagerLicenseInfo ($managerLicenseInfo)
    {
        $this->managerLicenseInfo = $managerLicenseInfo;
    }

    /**
     * @param NULL $messageList
     */
    public function setMessageList ($messageList)
    {
        $this->messageList = $messageList;
    }

}
