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

class CodeTrace
{
    /**
     * The trace id
     * @var string
     */
    protected $id = null;
    /**
     * The create date time
     * @var \DateTime
     */
    protected $date = null;
    /**
     * The traced URL
     * @var string
     */
    protected $url = null;
    /**
     * The createdBy Event
     * @var string
     */
    protected $createdBy = null;
    /**
     * File size in bytes
     * @var int
     */
    protected $fileSize = null;
    /**
     * The application id
     * @var integer
     */
    protected $applicationId = null;

    public function __construct()
    {

    }

    /**
     * @return the $id
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @return the $date
     */
    public function getDate ()
    {
        return $this->date;
    }

    /**
     * @return the $url
     */
    public function getUrl ()
    {
        return $this->url;
    }

    /**
     * @return the $createdBy
     */
    public function getCreatedBy ()
    {
        return $this->createdBy;
    }

    /**
     * @return the $fileSize
     */
    public function getFileSize ()
    {
        return $this->fileSize;
    }

    /**
     * @return the $applicationId
     */
    public function getApplicationId ()
    {
        return $this->applicationId;
    }

    /**
     * @param string $id
     */
    public function setId ($id)
    {
        $this->id = $id;
    }

    /**
     * @param DateTime $date
     */
    public function setDate ($date)
    {
        $this->date = $date;
    }

    /**
     * @param string $url
     */
    public function setUrl ($url)
    {
        $this->url = $url;
    }

    /**
     * @param string $createdBy
     */
    public function setCreatedBy ($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @param number $fileSize
     */
    public function setFileSize ($fileSize)
    {
        $this->fileSize = $fileSize;
    }

    /**
     * @param number $applicationId
     */
    public function setApplicationId ($applicationId)
    {
        $this->applicationId = $applicationId;
    }

}
