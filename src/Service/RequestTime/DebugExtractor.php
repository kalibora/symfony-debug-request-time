<?php

declare(strict_types=1);

namespace App\Service\RequestTime;

use App\ValueObject\RequestTime;
use DateMalformedStringException;
use DateTimeZone;
use Symfony\Component\HttpFoundation\Request;

final readonly class DebugExtractor extends Extractor
{
    public function extract(Request $request): RequestTime
    {
        $value = $request->headers->get('X-Debug-Request-Time');
        $requestTime = null !== $value ? $this->extractFromDebugHeader($value) : null;

        return $requestTime ?? parent::extract($request);
    }

    private function extractFromDebugHeader(string $value): ?RequestTime
    {
        try {
            $requestTime = ctype_digit($value) ? new RequestTime("@{$value}") : new RequestTime($value);
        } catch (DateMalformedStringException $e) {
            // 入力が不正でもエラーにせず無視する
            return null;
        }

        // 独自のHTTPヘッダーから取得した場合は debug を true にしておく
        return $requestTime->setDebug(true)->setTimezone(new DateTimeZone(date_default_timezone_get()));
    }
}
