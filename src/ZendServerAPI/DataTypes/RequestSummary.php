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
 * RequestSummary model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class RequestSummary implements \IteratorAggregate, \Countable
{
    /**
     * Number of event occurance
     * @var int
     */
    protected $eventsCount = null;
    /**
     * CodeTrace identifier
     * @var string
     */
    protected $codeTracing = null;
    /**
     * Internal event storage
     * @var array
     */
    protected $events = array();

    /**
     * Get the number of event occurance
     *
     * @return int
     */
    public function getEventsCount ()
    {
        return $this->eventsCount;
    }

    /**
     * Get the CodeTrace identifier
     *
     * @return string
     */
    public function getCodeTracing ()
    {
        return $this->codeTracing;
    }

    /**
     * Get the internal events
     *
     * @return array
     */
    public function getEvents ()
    {
        return $this->events;
    }

    /**
     * Set the number of event occurance
     *
     * @param  int  $eventsCount
     * @return void
     */
    public function setEventsCount ($eventsCount)
    {
        $this->eventsCount = (int) $eventsCount;
    }

    /**
     * Set the CodeTrace identifier
     *
     * @param  string $codeTracing
     * @return void
     */
    public function setCodeTracing ($codeTracing)
    {
        $this->codeTracing = $codeTracing;
    }

    /**
     * Add event to the internal list storage
     *
     * @param  \ZendServerAPI\DataTypes\Event $events
     * @return void
     */
    public function addEvents (\ZendServerAPI\DataTypes\Event $event)
    {
        $this->events[] = $event;
    }

    /**
     * @see IteratorAggregate::getIterator()
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        return new \ArrayIterator($this->events);
    }

    /**
     * @see Countable::count()
     * @return int
     */
    public function count ()
    {
        return count($this->getIterator());
    }

}
