<?php

namespace Zantolov\MediaBundle\DataFixtures\ORM;

use Zantolov\AppBundle\DataFixtures\ORM\AbstractDbFixture;
use Zantolov\BlogBundle\Entity\Post;
use Zantolov\MediaBundle\Entity\Image;

class LoadPostsData extends AbstractDbFixture
{

    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {

            $p = new Post();
            $p->setActive(true);
            $p->setTitle($faker->sentence());
            $p->setAuthor($faker->name);
            $p->setBody($faker->realText(500));
            $p->setIntro($faker->realText(200));
            $p->setKeywords(implode(', ', $faker->words()));

            $manager->persist($p);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }

}
