<?php

declare(strict_types=1);

namespace App\Service\RequestTime;

use App\ValueObject\RequestTime;
use DateTimeZone;
use Symfony\Component\HttpFoundation\Request;

readonly class Extractor implements ExtractorInterface
{
    public function extract(Request $request): RequestTime
    {
        $timestamp = $request->server->getInt('REQUEST_TIME');
        $timezone = new DateTimeZone(date_default_timezone_get());

        return (new RequestTime("@{$timestamp}"))->setTimezone($timezone);
    }
}
