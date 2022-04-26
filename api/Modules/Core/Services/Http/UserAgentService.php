<?php

namespace Modules\Core\Services\Http;

use Jenssegers\Agent\Agent;
use Modules\Core\Contracts\Http\UserAgentContract;

class UserAgentService implements UserAgentContract {
    /**
     * @var \Jenssegers\Agent\Agent
     */
    private Agent $objAgent;

    /**
     * @param \Jenssegers\Agent\Agent $objAgent
     */
    public function __construct(Agent $objAgent) {
        $this->objAgent = $objAgent;
    }

    public function getDevice(): string {
        return $this->objAgent->device();
    }

    public function getBrowser(): string {
        return $this->objAgent->browser();
    }

    public function getSessionPlatform(): string {
        $strBrowser = $this->getBrowser();

        return $strBrowser . " " . $this->getBrowserVersion($strBrowser) .  " " . $this->getDevice();
    }

    public function getBrowserVersion(string $browser): string {
        return $this->objAgent->version($browser);
    }
}