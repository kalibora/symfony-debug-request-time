<?php

declare(strict_types=1);

namespace App\Service\RequestTime;

use App\ValueObject\RequestTime;
use Symfony\Component\HttpFoundation\Request;

interface ExtractorInterface
{
    public function extract(Request $request): RequestTime;
}
