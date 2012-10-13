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

class MessageList
{
    private $info = null;
    private $warning = null;
    private $error = null;

    public function __construct($xmlData = null)
    {
        if ($xmlData !== null) {
            $xml = simplexml_load_string($xmlData);

            $this->info = (string) $xml->info;
            $this->warning = (string) $xml->warning;
            $this->error = (string) $xml->error;
        }
    }

    /**
     * @return the $info
     */
    public function getInfo ()
    {
        return $this->info;
    }

    /**
     * @return the $warning
     */
    public function getWarning ()
    {
        return $this->warning;
    }

    /**
     * @return the $error
     */
    public function getError ()
    {
        return $this->error;
    }

    /**
     * @param NULL $info
     */
    public function setInfo ($info)
    {
        $this->info = $info;
    }

    /**
     * @param NULL $warning
     */
    public function setWarning ($warning)
    {
        $this->warning = $warning;
    }

    /**
     * @param NULL $error
     */
    public function setError ($error)
    {
        $this->error = $error;
    }

}
