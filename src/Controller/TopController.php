<?php

declare(strict_types=1);

namespace App\Controller;

use App\ValueObject\RequestTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TopController extends AbstractController
{
    #[Route('/')]
    public function index(Request $request, RequestTime $request_time): Response
    {
        dump([
            'from_attributes' => $request->attributes->get(RequestTime::REQUEST_ATTR_NAME),
            'from_arguments' => $request_time,
        ]);

        return $this->render('top/index.html.twig');
    }
}
