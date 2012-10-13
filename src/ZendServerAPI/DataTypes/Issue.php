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

class Issue
{
    protected $id = null;
    protected $rule = null;
    protected $count = null;
    protected $lastOccurance = null;
    protected $severity = null;
    protected $status = null;
    protected $generalDetails = null;
    protected $routeDetails = array();

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
     * @return the $rule
     */
    public function getRule ()
    {
        return $this->rule;
    }

    /**
     * @return the $count
     */
    public function getCount ()
    {
        return $this->count;
    }

    /**
     * @return the $lastOccurance
     */
    public function getLastOccurance ()
    {
        return $this->lastOccurance;
    }

    /**
     * @return the $severity
     */
    public function getSeverity ()
    {
        return $this->serverity;
    }

    /**
     * @return the $status
     */
    public function getStatus ()
    {
        return $this->status;
    }

    /**
     * @return the $generalDetails
     */
    public function getGeneralDetails ()
    {
        return $this->generalDetails;
    }

    /**
     * @return array
     */
    public function getRouteDetails()
    {
        return $this->routeDetails;
    }

    /**
     * @param NULL $id
     */
    public function setId ($id)
    {
        $this->id = $id;
    }

    /**
     * @param NULL $rule
     */
    public function setRule ($rule)
    {
        $this->rule = $rule;
    }

    /**
     * @param NULL $count
     */
    public function setCount ($count)
    {
        $this->count = $count;
    }

    /**
     * @param NULL $lastOccurance
     */
    public function setLastOccurance ($lastOccurance)
    {
        $this->lastOccurance = $lastOccurance;
    }

    /**
     * @param NULL $severity
     */
    public function setSeverity ($severity)
    {
        $this->severity = $severity;
    }

    /**
     * @param NULL $status
     */
    public function setStatus ($status)
    {
        $this->status = $status;
    }

    /**
     * @param \ZendServerAPI\DataTypes\GeneralDetails $generalDetails
     */
    public function setGeneralDetails (\ZendServerAPI\DataTypes\GeneralDetails $generalDetails)
    {
        $this->generalDetails = $generalDetails;
    }

    /**
     * @param \ZendServerAPI\DataTypes\RouteDetails $generalDetails
     */
    public function addRouteDetails (\ZendServerAPI\DataTypes\RouteDetails $routeDetails)
    {
        $this->routeDetails[] = $routeDetails;
    }
}
