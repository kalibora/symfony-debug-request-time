<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Service\RequestTime\ExtractorInterface;
use App\ValueObject\RequestTime;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment as TwigEnvironment;

final readonly class RequestTimeSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private ExtractorInterface $extractor,
        private TwigEnvironment $twig,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            // Security Firewall よりは優先させる
            KernelEvents::REQUEST => ['onKernelRequest', 10],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        $requestTime = $this->extractor->extract($request);

        // リクエストの attributes に設定
        $request->attributes->set(RequestTime::REQUEST_ATTR_NAME, $requestTime);

        // Twig にグローバル変数として設定
        $this->twig->addGlobal('request_time', $requestTime);
    }
}
