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

/**
 * IssueList model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class LicenseInfo
{
    /**
     * The licensing status, which can be one of the following:
     * notRequired - This edition does not require this license type.
     * OK - The server/cluster is licensed and working.
     * invalid - The license is invalid.
     * expired - The license has expired.
     * serverLimitExceeded - The Zend Server Cluster Manager server limit has been exceeded.
     * @var string
     */
    private $status = null;
    /**
     * The license order number, which is empty if there is no license.
     * @var string
     */
    private $orderNumber = null;
    /**
     * The license expiration date, which is empty if there is no license (timestamp)
     * @var int
     */
    private $validUntil = null;
    /**
     * For a Zend Server Cluster Manager license, this is the
     * number of servers allowed by the license. For a license
     * other than Zend Server Cluster Manager, the value is always 0.
     * @var int
     */
    private $serverLimit = null;

    /**
     * Get the licensing status, which can be one of the following:
     * notRequired - This edition does not require this license type.
     * OK - The server/cluster is licensed and working.
     * invalid - The license is invalid.
     * expired - The license has expired.
     * serverLimitExceeded - The Zend Server Cluster Manager server limit has been exceeded.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the license order number, which is empty if there is no license.
     *
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Get the license expiration date, which is empty if there is no license (timestamp)
     *
     * @return int
     */
    public function getValidUntil()
    {
        return $this->validUntil;
    }

    /**
     * Get the server limit - for a Zend Server Cluster Manager license, this is the
     * number of servers allowed by the license. For a license other than
     * Zend Server Cluster Manager, the value is always 0.
     *
     * @return int
     */
    public function getServerLimit()
    {
        return $this->serverLimit;
    }

    /**
     * Set the licensing status, which can be one of the following:
     * notRequired - This edition does not require this license type.
     * OK - The server/cluster is licensed and working.
     * invalid - The license is invalid.
     * expired - The license has expired.
     * serverLimitExceeded - The Zend Server Cluster Manager server limit has been exceeded.
     *
     * @param  string $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Set the license order number, which is empty if there is no license.
     *
     * @param  string $orderNumber
     * @return void
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * Set the license expiration date, which is empty if there is no license (timestamp)
     *
     * @param  int  $validUntil
     * @return void
     */
    public function setValidUntil($validUntil)
    {
        $this->validUntil = (int) $validUntil;
    }

    /**
     * Set the server limit - For a Zend Server Cluster Manager license, this is the
     * number of servers allowed by the license. For a license
     * other than Zend Server Cluster Manager, the value is always 0.
     *
     * @param  int  $serverLimit
     * @return void
     */
    public function setServerLimit($serverLimit)
    {
        $this->serverLimit = (int) $serverLimit;
    }
}
