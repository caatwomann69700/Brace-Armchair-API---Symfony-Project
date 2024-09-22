<?php
// src/DataFixtures/UserFixtures.php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Tools\Pagination\Paginator;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $usersData = [
            [
                'email' => 'admin@example.com',
                'password' => 'password', // N'oublie pas de le hacher
                'roles' => ['ROLE_ADMIN'],
                'firstname' => 'John',
                'lastname' => 'Doe',
                'birthdate' => new \DateTime('1990-01-01'),
                'adress' => '123 Admin St',
                'city' => 'Admin City',
                'country' => 'Adminland',
                'gender' => 'Male'
            ],
            [
                'email' => 'user1@example.com',
                'password' => 'password', // N'oublie pas de le hacher
                'roles' => ['ROLE_USER'],
                'firstname' => 'Alice',
                'lastname' => 'Smith',
                'birthdate' => new \DateTime('1992-05-15'),
                'adress' => '456 User St',
                'city' => 'User City',
                'country' => 'Userland',
                'gender' => 'Female'
            ],
            [
                'email' => 'user2@example.com',
                'password' => 'password', // N'oublie pas de le hacher
                'roles' => ['ROLE_USER'],
                'firstname' => 'Bob',
                'lastname' => 'Johnson',
                'birthdate' => new \DateTime('1988-11-30'),
                'adress' => '789 User St',
                'city' => 'User City',
                'country' => 'Userland',
                'gender' => 'Male'
            ]
        ];

        foreach ($usersData as $data) {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setPassword(password_hash($data['password'], PASSWORD_BCRYPT)); // Hachage du mot de passe
            $user->setRoles($data['roles']);
            $user->setFirstname($data['firstname']);
            $user->setLastname($data['lastname']);
            $user->setBirthdate($data['birthdate']);
            $user->setAdress($data['adress']);
            $user->setCity($data['city']);
            $user->setCountry($data['country']);
            $user->setGender($data['gender']);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
