<?php

namespace App\Command;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[AsCommand(name: 'app:create-user')]
class UserCommand extends Command
{

    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $entityManager

    ) {
        parent::__construct();
 ;
    }
    protected function configure()
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'User email to create')
            ->addArgument('password', InputArgument::REQUIRED, 'User password to create')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);

        $userEmail = trim($input->getArgument('email'));
        $userPassword = trim($input->getArgument('password'));


        $user = new User();
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $userPassword
        );


        $user
            ->setEmail($userEmail)
            ->setRoles(['ROLE_USER'])
            ->setPassword($hashedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();


        $io->success('user creation complete');

        return Command::SUCCESS;
    }
}