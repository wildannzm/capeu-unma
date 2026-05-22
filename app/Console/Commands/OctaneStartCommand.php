<?php

namespace App\Console\Commands;

use Laravel\Octane\Commands\StartCommand as BaseStartCommand;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'octane:start')]
class OctaneStartCommand extends BaseStartCommand
{
    /**
     * Returns the list of signals to subscribe.
     */
    public function getSubscribedSignals(): array
    {
        if (PHP_OS_FAMILY === 'Windows') {
            return [];
        }

        return parent::getSubscribedSignals();
    }
}
