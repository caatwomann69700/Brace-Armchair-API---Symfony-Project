<?php
// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Image; // Assurez-vous d'importer cette entité
use App\Entity\Imagelist; // Assurez-vous d'importer cette entité
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Liste des catégories
        $categories = [
            'Sofa',
            'Chair',
            'Armchair',
            'Bench',
            'Stool'
        ];

        // Création des entités Category
        $categoryEntities = [];
        foreach ($categories as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $categoryEntities[] = $category; // Stocke les catégories pour l'utilisation ultérieure
        }

        // Liste des produits avec prix, description, catégorie, image et imagelist
        $productsData = [
            [
                'name' => 'PLUMP',
                'price' => 899.99,
                'description' => 'Spacious sofa perfect for large living rooms.',
                'category' => $categoryEntities[0], // Sofa
                'image' => 'b0fab4170458263.65104d54cb441.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'SAVOIRDI',
                'price' => 1599.99,
                'description' => 'Inspired by the french Charlotte cake dessert.',
                'category' => $categoryEntities[0], // Sofa
                'image' => 'cf4194165327755.6405e0f1b2f3e.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'QUARTER',
                'price' => 799.50,
                'description' => 'Modular sofa for humans and cats.',
                'category' => $categoryEntities[1], // Chair
                'image' => 'quarter.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'SERENE',
                'price' => 1250.00,
                'description' => 'An elegant armchair designed for comfort.',
                'category' => $categoryEntities[2], // Armchair
                'image' => '84dffc202043091(1).66880a6877165.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'PLOP',
                'price' => 550.75,
                'description' => 'A compact chair for small spaces.',
                'category' => $categoryEntities[1], // Chair
                'image' => 'beb26279429221.5f709d632a82c.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'SINUKUAN',
                'price' => 899.99,
                'description' => 'A stylish bench made from premium materials.',
                'category' => $categoryEntities[3], // Bench
                'image' => 'c30590204368187(1).66a88ad9899b3.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'BAMBU',
                'price' => 2099.99,
                'description' => 'A modern sofa with clean lines.',
                'category' => $categoryEntities[0], // Sofa
                'image' => '1ffebb206451975.66ccea086a537.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'PUTO POUF',
                'price' => 650.49,
                'description' => 'A cozy and versatile pouf for any room.',
                'category' => $categoryEntities[4], // Stool
                'image' => '2a27b2164084495.63f0b2280bf97.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'CLOUDS',
                'price' => 1800.00,
                'description' => 'A high-end, comfortable sofa.',
                'category' => $categoryEntities[0], // Sofa
                'image' => '3c3052203490345.66a8f0308a7a2.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'BALOO',
                'price' => 575.25,
                'description' => 'A trendy chair that complements any decor.',
                'category' => $categoryEntities[1], // Chair
                'image' => '295cd5197126777.662ac9daafe89.png',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'JOJO',
                'price' => 920.75,
                'description' => 'An armchair with a modern design.',
                'category' => $categoryEntities[2], // Armchair
                'image' => 'd7375c202578331.Y3JvcCwxNDAwLDEwOTUsMCwzODg.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'SOLUNA',
                'price' => 900.00,
                'description' => 'A premium sofa offering comfort.',
                'category' => $categoryEntities[0], // Sofa
                'image' => 'f5453b203029889.Y3JvcCwyODAwLDIxOTAsMCw4MDM.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'LUMINARO',
                'price' => 850.99,
                'description' => 'A chair that combines style and functionality.',
                'category' => $categoryEntities[1], // Chair
                'image' => '8e92b5206051895.66c5e41b4c123.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'VELUDO',
                'price' => 1320.50,
                'description' => 'An armchair covered in soft velvet.',
                'category' => $categoryEntities[2], // Armchair
                'image' => '63a596184745293.655747489cf99.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'BREEZE',
                'price' => 700.30,
                'description' => 'A wooden bench perfect for outdoor use.',
                'category' => $categoryEntities[3], // Bench
                'image' => 'a5357b53978519.5948d1486e01d.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'MORPHE',
                'price' => 2500.00,
                'description' => 'A minimalist stool ideal for modern homes.',
                'category' => $categoryEntities[4], // Stool
                'image' => '7eb397206355563.66cb7ed12a1f5.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'MEZZO',
                'price' => 1750.25,
                'description' => 'A sofa that blends contemporary style.',
                'category' => $categoryEntities[0], // Sofa
                'image' => '2c688d205706533.Y3JvcCwxMDgwLDg0NCwwLDExNw.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'ORION',
                'price' => 925.99,
                'description' => 'A sturdy chair that adds character.',
                'category' => $categoryEntities[1], // Chair
                'image' => '8760f4185026033.655cadd664bf1.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ],
            [
                'name' => 'MIRA',
                'price' => 1399.49,
                'description' => 'A plush armchair that invites relaxation.',
                'category' => $categoryEntities[2], // Armchair
                'image' => '2e076d203958721.634bcf1df2d14.jpg',
                'imagelist' => ['image1.jpg', 'image2.jpg', 'image3.jpg']
            ]
        ];

        // Création des entités Product
        foreach ($productsData as $data) {
            $product = new Product();
            $product->setName($data['name']);
            $product->setPrice($data['price']);
            $product->setDescription($data['description']);
            $product->setCategory($data['category']);

            // Ajout de l'image principale
            $image = new Image(); // Créer une instance de l'entité Image
            $image->setName($data['image']); // Assurez-vous que cette méthode existe
            $product->setImage($image); // Assurez-vous que votre méthode setImage() accepte un objet Image

            // Ajout des images à la liste d'images
            foreach ($data['imagelist'] as $imagelistImage) {
                $imagelist = new Imagelist(); // Créer une instance de l'entité Imagelist
                $imagelist->setProduct($product);
                $imagelist->setName($imagelistImage); // Assurez-vous que votre méthode s'appelle setImage()
                $product->addImagelist($imagelist);
            }

            $manager->persist($product);
        }

        $manager->flush();
    }
}
