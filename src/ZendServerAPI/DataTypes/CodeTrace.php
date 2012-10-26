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

namespace ZendServerAPI\DataTypes;

/**
 * CodeTrace model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
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
     * @var integer
     */
    protected $fileSize = null;
    /**
     * The application id
     * @var integer
     */
    protected $applicationId = null;

    /**
     * Get the codeTrace id
     *
     * @return int
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Get the creation timestamp
     *
     * @return \DateTime
     */
    public function getDate ()
    {
        return $this->date;
    }

    /**
     * Get the URL string that created the trace
     *
     * @return string
     */
    public function getUrl ()
    {
        return $this->url;
    }

    /**
     * Get the method of creation
     * (Code Request, Manual Request, Monitor Request)
     *
     * @return string
     */
    public function getCreatedBy ()
    {
        return $this->createdBy;
    }

    /**
     * Get the file size in bytes
     *
     * @return int
     */
    public function getFileSize ()
    {
        return $this->fileSize;
    }

    /**
     * Get the application id
     *
     * @return int
     */
    public function getApplicationId ()
    {
        return $this->applicationId;
    }

    /**
     * Set the codeTrace id
     *
     * @param  int  $id
     * @return void
     */
    public function setId ($id)
    {
        $this->id = (int) $id;
    }

    /**
     * Creation timestamp, will end up as a \DateTime
     *
     * @param  \DateTime|int|string $date
     * @throws \RuntimeException
     * @return void
     */
    public function setDate ($date)
    {
        if (is_int($date)) {
            $this->date = new \DateTime();
            $this->date->setTimestamp($date);
        } elseif (is_string($date)) {
            $this->date = new \DateTime();
            $this->date->setTimestamp((int) $date);
        } elseif ($date instanceof \DateTime) {
            $this->date = $date;
        } else {
            throw new \RuntimeException("Invalid data type");
        }
    }

    /**
     * URL string that created the trace
     *
     * @param  string $url
     * @return void
     */
    public function setUrl ($url)
    {
        $this->url = $url;
    }

    /**
     * Set the method of creation (Code Request,
     * Manual Request, Monitor Event)
     *
     * @param  string $createdBy
     * @return void
     */
    public function setCreatedBy ($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * Set the file size in bytes
     *
     * @param  float $fileSize
     * @return void
     */
    public function setFileSize ($fileSize)
    {
        $this->fileSize = (float) $fileSize;
    }

    /**
     * Set the application id
     *
     * @param  int  $applicationId
     * @return void
     */
    public function setApplicationId ($applicationId)
    {
        $this->applicationId = (int) $applicationId;
    }

}
