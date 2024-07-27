<?php

namespace App\DataFixtures;

use App\Factory\UsuarioFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UsuarioFactory::createMany(5);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
