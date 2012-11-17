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
 * @package     ZendServerAPI\DataTypes
 */

namespace ZendServerAPI\DataTypes;

/**
 * Base DataType implementation.
 *
 * @license MIT
 * @link http://github.com/iwalz/zendserverapi
 * @author Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\DataTypes
 */
abstract class DataType
{

    /**
     * Get an associative array based on the model information
     *
     * @return array
     */
    public function getArray ()
    {
        $returnArray = array();

        // Get members from parent class
        $classVars = get_class_vars(get_called_class());

        // Iterate through members to generate key => value pairs
        foreach ($classVars as $key => $value) {
            $value = $this->$key;

            // If value is an array
            if (is_array($value)) {
                // Iterate through them and call that function recursivly if DataType
                foreach ($value as $subKey => $single) {
                    if ($single instanceof DataType) {
                        $subKey = lcfirst(
                                str_replace("ZendServerAPI\\DataTypes\\", "",
                                        get_class($single)));
                        $subValue = $single->getArray();
                        $returnArray[$subKey][] = $subValue;
                    // If regular value, add to the array
                    } else {
                        $returnArray[$subKey][] = $single;
                    }
                }
            // Value is not array
            } else {
                // and value is DataType
                if ($value instanceof DataType) {
                    $subKey = lcfirst(
                            str_replace("ZendServerAPI\\DataTypes\\", "",
                                    get_class($value)));
                    // Call recursion again
                    $subValue = $value->getArray();
                    $returnArray[$key] = $subValue;
                // Otherwise simply add
                } else {
                    $returnArray[$key] = $value;
                }
            }
        }

        return $returnArray;
    }

}
