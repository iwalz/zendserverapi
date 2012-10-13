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

class GeneralDetails
{
    protected $url = null;
    protected $sourceFile = null;
    protected $sourceLine = null;
    protected $function = null;
    protected $aggregationHint = null;
    protected $errorString = null;
    protected $errorType = null;

    /**
     * @return the $url
     */
    public function getUrl ()
    {
        return $this->url;
    }

    /**
     * @return the $sourceFile
     */
    public function getSourceFile ()
    {
        return $this->sourceFile;
    }

    /**
     * @return the $sourceLine
     */
    public function getSourceLine ()
    {
        return $this->sourceLine;
    }

    /**
     * @return the $function
     */
    public function getFunction ()
    {
        return $this->function;
    }

    /**
     * @return the $aggregationHint
     */
    public function getAggregationHint ()
    {
        return $this->aggregationHint;
    }

    /**
     * @return the $errorString
     */
    public function getErrorString ()
    {
        return $this->errorString;
    }

    /**
     * @return the $errorType
     */
    public function getErrorType ()
    {
        return $this->errorType;
    }

    /**
     * @param NULL $url
     */
    public function setUrl ($url)
    {
        $this->url = $url;
    }

    /**
     * @param NULL $sourceFile
     */
    public function setSourceFile ($sourceFile)
    {
        $this->sourceFile = $sourceFile;
    }

    /**
     * @param NULL $sourceLine
     */
    public function setSourceLine ($sourceLine)
    {
        $this->sourceLine = $sourceLine;
    }

    /**
     * @param NULL $function
     */
    public function setFunction ($function)
    {
        $this->function = $function;
    }

    /**
     * @param NULL $aggregationHint
     */
    public function setAggregationHint ($aggregationHint)
    {
        $this->aggregationHint = $aggregationHint;
    }

    /**
     * @param NULL $errorString
     */
    public function setErrorString ($errorString)
    {
        $this->errorString = $errorString;
    }

    /**
     * @param NULL $errorType
     */
    public function setErrorType ($errorType)
    {
        $this->errorType = $errorType;
    }

}
