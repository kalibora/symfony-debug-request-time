<?php

declare(strict_types=1);

namespace App\ValueObject;

use DateTimeImmutable;

final class RequestTime extends DateTimeImmutable
{
    public const string REQUEST_ATTR_NAME = '_app_request_time';

    private bool $debug = false;

    public function isDebug(): bool
    {
        return $this->debug;
    }

    public function setDebug(bool $debug): self
    {
        $clone = clone $this;

        $clone->debug = $debug;

        return $clone;
    }
}
