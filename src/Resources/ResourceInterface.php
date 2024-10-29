<?php

declare(strict_types=1);

namespace Carloshaam\D4signApi\Resources;

use Carloshaam\D4signApi\Config;

interface ResourceInterface
{
    public function setConfig(Config $config): void;
}
