<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductApiFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("Gitane Verso Sport 30");
        $product->setCategory("sport");
        $product->setColor("grey");
        $product->setWeight(8);
        $product->setPriceExclTax(500);
        $product->setPriceInclTax(650);
        $product->setStock(2);
        $product->setDimensions("L 165,5 x l 58,5 x h 133,5 cm");
        $manager->persist($product);

        $product2 = new Product();
        $product2->setName("Apple AirPods2");
        $product2->setCategory("music");
        $product2->setColor("white");
        $product2->setPriceExclTax(100);
        $product2->setPriceInclTax(150);
        $product2->setStock(8);
        $product2->setDimensions("L 12,5 x l 12,5 x h 6,8 cm");
        $manager->persist($product2);

        $product3 = new Product();
        $product3->setName("Da Vinci Code");
        $product3->setCategory("book");
        $product3->setPriceExclTax(10);
        $product3->setPriceInclTax(15);
        $product3->setStock(6);
        $product3->setDimensions("L 20,5 x l 14,5 x h 2,0 cm");
        $manager->persist($product3);


        // 20 Items for population
        for ($i = 1 ;$i <=20 ;$i++)
        {
            $productI = new Product();
            $productI->setName("Item".$i);
            $productI->setWeight($i);
            $productI->setStock($i+2);
            $manager->persist($productI);
        }

        $manager->flush();
    }
}
