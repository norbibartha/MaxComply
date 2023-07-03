<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        // Create simple user
        $user = new User();
        $user->setEmail('user@example.com');
        $user->setRoles(['ROLE_USER']);

        $password = $this->hasher->hashPassword($user, 'Password1.');
        $user->setPassword($password);

        $manager->persist($user);

        // Create user with admin role
        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_USER', 'ROLE_ADMIN']);

        $password = $this->hasher->hashPassword($admin, 'Password1.Admin');
        $admin->setPassword($password);

        $manager->persist($admin);

        $manager->flush();
    }
}