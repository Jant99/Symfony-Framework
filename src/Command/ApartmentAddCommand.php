<?php

namespace App\Command;

use App\Entity\Apartment;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:apartment:add',
    description: 'Add a short description for your command',
    hidden: false,
    aliases: ['app:apartment:add']
)]
class ApartmentAddCommand extends Command
{
    public function __construct(private EntityManagerInterface $em, private CategoryRepository $category_repository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
        ->addArgument('title', InputArgument::REQUIRED)
        ->addArgument('price', InputArgument::REQUIRED)
        ->addArgument('rooms', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $category = $this->category_repository->findOneBy([]);

        if (!$category){
            $output->writeln('<error>No category found. Run fixtures first.</error>');
            return Command::FAILURE;
        }
        $apartment = new Apartment();
        $apartment->setTitle($input->getArgument('title'));
        $apartment->setPrice((float)$input->getArgument('price'));
        $apartment->setRooms((int)$input->getArgument('rooms'));
        $apartment->setArea(40);
        $apartment->setAddress('Generated address');
        $apartment->setDescription('Added via command');
        $apartment->setCreatedAt(new \DateTimeImmutable());

        $apartment->setCategory($category);
        $this->em->persist($apartment);
        $this->em->flush();

        $output->writeln('<info>Apartment added!</info>');

        return Command::SUCCESS;
    }
}
