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
 * IssueList model implementation.
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class IssueList extends DataType implements \Countable, \IteratorAggregate
{
    /**
     * Internal issue storage
     * @var array
     */
    protected $issues = array();

    /**
     * Add Issue to container
     *
     * @param  \ZendServerAPI\DataTypes\Issue $issue
     * @return void
     */
    public function addIssue(\ZendServerAPI\DataTypes\Issue $issue)
    {
        $this->issues[] = $issue;
    }

    /**
     * Get issue array
     *
     * @return array
     */
    public function getIssues()
    {
        return $this->issues;
    }

    /**
     * Implementation for traversable
     * 
     * @see IteratorAggregate::getIterator()
     * @return \ArrayIterator
     */
    public function getIterator ()
    {
        return new \ArrayIterator($this->issues);
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
