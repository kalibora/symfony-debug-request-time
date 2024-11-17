<?php

namespace App\DataFixtures;

use App\Entity\Campaign;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CampaignFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $campaign = new Campaign('PHP Conference Japan 2024', new DateTimeImmutable('2024-12-22'), new DateTimeImmutable('2024-12-23'));
        $manager->persist($campaign);

        $campaign = new Campaign('Toshiyuki Fujita\'s birthday festival', new DateTimeImmutable('1979-07-31'), new DateTimeImmutable('1979-08-01'));
        $manager->persist($campaign);

        $manager->flush();
    }
}
