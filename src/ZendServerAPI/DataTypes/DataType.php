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
 * Base DataType implementation.
 *
 * @license MIT
 * @link http://github.com/iwalz/zendserverapi
 * @author Ingo Walz <ingo.walz@googlemail.com>
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

        $classVars = get_class_vars(get_called_class());
        foreach ($classVars as $key => $value) {
            $value = $this->$key;
            if (is_array($value)) {
                foreach ($value as $single) {
                    if ($single instanceof DataType) {
                        $subKey = lcfirst(
                                str_replace("ZendServerAPI\\DataTypes\\", "",
                                        get_class($single)));
                        $subValue = $single->getArray();
                        if (count($subValue) > 1) {
                            $returnArray[$subKey][] = $subValue;
                        } else {
                            $returnArray[$subKey] = $subValue;
                        }
                    }
                }
            } else {
                $returnArray[$key] = $value;
            }
        }

        return $returnArray;
    }
}
