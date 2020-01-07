<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // for ($i = 1; $i <= 4; $i++) {
        //     $category = new Category();
        //     $category->setName('category'.$i);

        //     $manager->persist($category);

        // $manager->flush();
        // }
    }
}
