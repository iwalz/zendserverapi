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
 * RouteDetails model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class RouteDetails extends DataType implements \Countable, \IteratorAggregate
{
    /**
     * Internal route detail array
     * @var array
     */
    protected $routeDetails = array();

    /**
     * Add a route detail to the list
     *
     * @param  \ZendServerAPI\DataTypes\RouteDetail $routeDetail
     * @return void
     */
    public function addRouteDetails(\ZendServerAPI\DataTypes\RouteDetail $routeDetail)
    {
        $this->routeDetails[] = $routeDetail;
    }

    /**
     * Get the internal route detail list array
     *
     * @return array
     */
    public function getRouteDetails()
    {
        return $this->routeDetails;
    }

    /**
     * Implementation for traversable
     *
     * @see IteratorAggregate::getIterator()
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        return new \ArrayIterator($this->routeDetails);
    }

    /**
     * Implementation for countable
     *
     * @see Countable::count()
     * @return int
     */
    public function count ()
    {
        return count($this->getIterator());
    }
}
