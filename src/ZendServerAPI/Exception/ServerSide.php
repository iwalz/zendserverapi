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

namespace ZendServerAPI\Exception;

/**
 * Exception to handle errors, that are flagged by the
 * Zend Server as "Server Side"
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class ServerSide extends \Exception
{
    /**
     * Constructor for serverside exception
     *
     * @param string error message
     * @param int error code
     */
    public function __construct($error, $code = null)
    {
        $xml = simplexml_load_string($error);

        if($code === null)
            $code = 500;

        if (!$xml || !isset($xml->errorData->errorCode) || !isset($xml->errorData->errorMessage)) {
            parent::__construct($error, $code);
        } else {
            $errorCode = (string) $xml->errorData->errorCode;
            $errorMessage = (string) $xml->errorData->errorMessage;

            parent::__construct($errorCode . ': ' . $errorMessage, $code);
        }
    }
}
