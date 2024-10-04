<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Author;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
    ) {

    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user,'toto11');
        $user
            ->setEmail('fabien@test.com')
            ->setRoles(['ROLE_USER'])
            ->setPassword($hashedPassword);
        $manager->persist($user);

        $author1 = new Author();
        $author1->setName('Stephen King');
        $manager->persist($author1);

        $author2 = new Author();
        $author2->setName('Terry Goodkind');
        $manager->persist($author2);

        $book1 = new Book();
        $book1->setTitle('The Sword of Truth');
        $book1->setReleaseDate(new \DateTime('1994-01-01'));
        $book1->setAuthor($author2);
        $manager->persist($book1);

        $book2 = new Book();
        $book2->setTitle('Stone of Tears');
        $book2->setReleaseDate(new \DateTime('1995-01-01'));
        $book2->setAuthor($author2);
        $manager->persist($book2);

        $book3 = new Book();
        $book3->setTitle('The Gunslinger');
        $book3->setReleaseDate(new \DateTime('1984-01-01'));
        $book3->setAuthor($author1);
        $manager->persist($book3);

        $book4 = new Book();
        $book4->setTitle('The Drawing of the Three');
        $book4->setReleaseDate(new \DateTime('1987-01-01'));
        $book4->setAuthor($author1);
        $manager->persist($book4);



        $manager->flush();
    }
}
