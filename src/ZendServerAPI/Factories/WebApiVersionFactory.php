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
 * @package     ZendServerAPI\Factories
 */

namespace ZendServerAPI\Factories;

/**
 * Factory for the WebApiVersionFactories.
 * Gets a config object injected to identify the version
 * and returns the correct factory for this version
 *
 * @license     MIT
 * @link        http://github.com/iwalz/zendserverapi
 * @author      Ingo Walz <ingo.walz@googlemail.com>
 * @package     ZendServerAPI\Factories
 */
class WebApiVersionFactory
{
    /**
     * Config object for that request
     * @var \ZendServerAPI\Config
     */
    protected $config = null;

    /**
     * Get the Command factory for the corrent webapi version.
     * If config object is null, it will return the first version 1.0
     *
     * @return \ZendServerAPI\Factories\CommandFactory
     */
    public function getCommandFactory()
    {
        if($this->config === null ||
           $this->config->getApiVersion() == "1.0") {
            return new \ZendServerAPI\Factories\ApiVersion10CommandFactory();
        } elseif ($this->config->getApiVersion() == "1.1") {
            return new \ZendServerAPI\Factories\ApiVersion11CommandFactory();
        } elseif ($this->config->getApiVersion() == "1.2") {
            return new \ZendServerAPI\Factories\ApiVersion12CommandFactory();
        }
    }

    /**
     * Set the config
     *
     * @param  \ZendServerAPI\Config $config
     * @return void
     */
    public function setConfig(\ZendServerAPI\Config $config)
    {
        $this->config = $config;
    }

    /**
     * Get the config
     *
     * @return \ZendServerAPI\Config
     */
    public function getConfig()
    {
        return $this->config;
    }
}
