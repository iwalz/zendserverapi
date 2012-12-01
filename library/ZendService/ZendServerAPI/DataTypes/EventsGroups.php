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
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendService\ZendServerAPI\DataTypes
 */

namespace ZendService\ZendServerAPI\DataTypes;

/**
 * EventsGroupDetails model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendService\ZendServerAPI\DataTypes
 */
class EventsGroups extends DataType implements \Countable, \IteratorAggregate
{
    /**
     * Internal event group array
     * @var array
     */
    protected $eventGroups = array();

    /**
     * Add an event group to the list
     *
     * @param  \ZendService\ZendServerAPI\DataTypes\EventsGroup $eventGroup
     * @return void
     */
    public function addEventGroup(\ZendService\ZendServerAPI\DataTypes\EventsGroup $eventGroup)
    {
        $this->eventGroups[] = $eventGroup;
    }

    /**
     * Get the internal event group array
     *
     * @return array
     */
    public function getEventGroups()
    {
        return $this->eventGroups;
    }

    /**
     * Implementation for traversable
     *
     * @see IteratorAggregate::getIterator()
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        return new \ArrayIterator($this->eventGroups);
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
