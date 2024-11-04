<?php

declare(strict_types=1);

namespace App\Service\RequestTime;

use App\ValueObject\RequestTime;
use DateTimeZone;
use Exception;
use Symfony\Component\HttpFoundation\Request;

final readonly class DebugExtractor extends Extractor
{
    public const string HEADER = 'X-Debug-Request-Time';

    public function extract(Request $request): RequestTime
    {
        if (($value = $request->headers->get(self::HEADER)) !== null) {
            $requestTime = $this->extractFromDebugHeader($value);

            if (null !== $requestTime) {
                return $requestTime;
            }
        }

        return parent::extract($request);
    }

    private function extractFromDebugHeader(string $value): ?RequestTime
    {
        try {
            if (ctype_digit($value)) {
                $requestTime = new RequestTime("@{$value}");
            } else {
                $requestTime = new RequestTime($value);
            }

            // 独自のHTTPヘッダーから取得した場合は debug を true にしておく
            return $requestTime->setDebug(true)->setTimezone(new DateTimeZone(date_default_timezone_get()));
        } catch (Exception $e) {
            // 入力が不正でもエラーにせず無視する
        }

        return null;
    }
}
