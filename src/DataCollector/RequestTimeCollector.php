<?php

declare(strict_types=1);

namespace App\DataCollector;

use App\ValueObject\RequestTime;
use Symfony\Bundle\FrameworkBundle\DataCollector\AbstractDataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class RequestTimeCollector extends AbstractDataCollector
{
    public function collect(Request $request, Response $response, ?Throwable $exception = null): void
    {
        $this->data = [
            'request_time' => $request->attributes->get(RequestTime::REQUEST_ATTR_NAME),
        ];
    }

    public function getRequestTime(): ?RequestTime
    {
        return $this->data['request_time'] ?? null;
    }

    public static function getTemplate(): ?string
    {
        return 'data_collector/template.html.twig';
    }
}
