<?php

declare(strict_types=1);

namespace App\ValueResolver;

use App\ValueObject\RequestTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final readonly class RequestTimeResolver implements ValueResolverInterface
{
    /**
     * @return iterable<mixed>
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $argumentType = $argument->getType();
        if (!$argumentType || !is_a($argumentType, RequestTime::class, true)) {
            return [];
        }

        yield $request->attributes->get(RequestTime::REQUEST_ATTR_NAME);
    }
}
