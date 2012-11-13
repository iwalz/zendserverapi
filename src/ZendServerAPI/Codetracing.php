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

namespace ZendServerAPI;

/**
 * <b>Codetracing Methods</b>
 *
 * The following is a list of methods available for the Codetracing feature:
 *
 * <ul>
 * <li>codetracingDisable</li>
 * <li>codetracingEnable</li>
 * <li>codetracingIsEnabled</li>
 * <li>codetracingCreate</li>
 * <li>codetracingDelete</li>
 * <li>codetracingList</li>
 * <li>codetracingDownloadTraceFile</li>
 * </ul>
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 */
class Codetracing extends BaseAPI
{
    /**
     * The directory where to store the codetrace files
     * @var string
     */
    protected $exportDirectory = null;

    /**
     * <b>The codetracingEnable Method</b>
     *
     * <pre>Enable code-tracing component and two directives necessary
     * for creating tracing dumps
     *
     * This method will force the Zend Server to enable the
     * developerMode. This mode causes the Zend Server to create a
     * dump on every request. <b>Do not use it in production!</b></pre>
     *
     * @param  boolean                                    $restartNow <p>Restart after method call</p>
     * @return \ZendServerAPI\DataTypes\CodeTracingStatus
     */
    public function codetracingEnable($restartNow = true)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingEnable', $restartNow));

        return $this->request->send();
    }

    /**
     * <b>The codetracingDisable Method</b>
     *
     * <pre>Disable the code-tracing directive two directives necessary
     * for creating tracing dumps, this action does not disable the code-tracing component.
     *
     * This method will force the Zend Server to disable the
     * developerMode. This mode causes the Zend Server to create a
     * dump on every request. <b>Do not use it in production!</b></pre>
     *
     * @param  boolean                                    $restartNow <p>Restart after method call</p>
     * @return \ZendServerAPI\DataTypes\CodeTracingStatus
     */
    public function codetracingDisable($restartNow = true)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingDisable', $restartNow));

        return $this->request->send();
    }

    /**
     * <b>The codetracingIsEnabled Method</b>
     *
     * <pre>Check if the directives zend_codetracing.always_dump and
     * zend_codetracing.trace_enabled are set, and if the code-tracing
     * component is active.
     *
     * This method returns true if developerMode is enabled.
     * The developerMode will cause the Zend Server to create a trace
     * on every request. Do not use it in production</pre>
     *
     * @return \ZendServerAPI\DataTypes\CodeTracingStatus
     */
    public function codetracingIsEnabled()
    {
        $this->request->setAction($this->apiFactory->factory('codetracingIsEnabled'));

        return $this->request->send();
    }

    /**
     * <b>The codetracingCreate Method</b>
     *
     * <pre>Create a new code-tracing entry.
     *
     * This method will generate a codetrace of the given URL.
     * The URL needs to be a fully encoded and has to start with
     * the protocoll.</pre>
     *
     * @param  string                               $url <p>the url to trace</p>
     * @return \ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingCreate($url)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingCreate', $url));

        return $this->request->send();
    }

    /**
     * <b>The codetracingDelete Method</b>
     *
     * <pre>Delete a code-tracing file entry.</pre>
     *
     * @param  integer                              $id <p>Trace file ID</p>
     * @return \ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingDelete($id)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingDelete', $id));

        return $this->request->send();
    }

    /**
     * <b>The codetracingList Method</b>
     *
     * <pre>Retrieve a list of code-tracing files available for download using codetracingDownloadTraceFile.</pre>
     *
     * @param  array                                $applicationIds <p>List of application IDs</p>
     * @param  int                                  $limit          <p>Row limit to retrieve</p>
     * @param  int                                  $offset         <p>Page offset to be displayed</p>
     * @param  string                               $orderBy        <p>Column to sort the result by (Id,Date,Url,CreatedBy,FileSize)</p>
     * @param  string                               $direction      <p>Direction to sort, default to Desc</p>
     * @return \ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingList($applicationIds = array(), $limit = null, $offset = null, $orderBy = null, $direction = null)
    {
        $this->request->setAction($this->apiFactory->factory('codetracingList', $applicationIds, $limit, $offset, $orderBy, $direction));

        return $this->request->send();
    }

    /**
     * <b>The codetracingDownloadTraceFile Method</b>
     *
     * <pre>Download the amf file specified by the codetracing identifier.</pre>
     *
     * @param  string                               $traceFile <p>Trace file identifier</p>
     * @param  string                               $fileName  <p>Filename to save tracefile to</p>
     * @return \ZendServerAPI\DataTypes\CodeTracing
     */
    public function codetracingDownloadTraceFile($traceFile, $fileName = null, $exportDirectory = null)
    {
        if($exportDirectory !== null)
            $this->exportDirectory = $exportDirectory;
        else
            $this->exportDirectory = getcwd();

        $this->request->setAction($this->apiFactory->factory('codetracingDownloadTraceFile', $traceFile, $fileName, $this->exportDirectory));

        return $this->request->send();
    }
}
