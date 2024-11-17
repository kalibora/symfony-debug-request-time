<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Campaign;
use App\ValueObject\RequestTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/campaigns')]
class CampaignController extends AbstractController
{
    #[Route('/{id}', requirements: ['id' => '\d+'])]
    public function detail(Campaign $campaign, RequestTime $requestTime): Response
    {
        // if (!$campaign->isActive($requestTime)) {
        //     throw $this->createNotFoundException();
        // }

        return $this->render('campaign/detail.html.twig', [
            'campaign' => $campaign,
        ]);
    }
}
