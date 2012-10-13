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

class Step
{
    protected $number = null;
    protected $object = null;
    protected $class = null;
    protected $function = null;
    protected $file = null;
    protected $line = null;

    public function __construct()
    {

    }
    /**
     * @return the $number
     */
    public function getNumber ()
    {
        return $this->number;
    }

    /**
     * @return the $object
     */
    public function getObject ()
    {
        return $this->object;
    }

    /**
     * @return the $class
     */
    public function getClass ()
    {
        return $this->class;
    }

    /**
     * @return the $function
     */
    public function getFunction ()
    {
        return $this->function;
    }

    /**
     * @return the $file
     */
    public function getFile ()
    {
        return $this->file;
    }

    /**
     * @return the $line
     */
    public function getLine ()
    {
        return $this->line;
    }

    /**
     * @param NULL $number
     */
    public function setNumber ($number)
    {
        $this->number = $number;
    }

    /**
     * @param NULL $object
     */
    public function setObject ($object)
    {
        $this->object = $object;
    }

    /**
     * @param NULL $class
     */
    public function setClass ($class)
    {
        $this->class = $class;
    }

    /**
     * @param NULL $function
     */
    public function setFunction ($function)
    {
        $this->function = $function;
    }

    /**
     * @param NULL $file
     */
    public function setFile ($file)
    {
        $this->file = $file;
    }

    /**
     * @param NULL $line
     */
    public function setLine ($line)
    {
        $this->line = $line;
    }

}
