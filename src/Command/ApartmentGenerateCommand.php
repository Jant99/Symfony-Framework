<?php

namespace App\Command;

use App\Entity\Apartment;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:apartment:generate',
    description: 'Generates random apartment',
)]
class ApartmentGenerateCommand extends Command
{
    public function __construct(private EntityManagerInterface $em, private CategoryRepository $category_repository)
    {
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $category = $this->category_repository->findOneBy([]);

        if (!$category){
            $output->writeln('<error>No category found. Run fixtures first.</error>');
            return Command::FAILURE;
        }

        $apartment = new Apartment();
        $apartment->setTitle('Apartment #' . random_int(100, 999));
        $apartment->setPrice(random_int(1500, 6000));
        $apartment->setRooms(random_int(1, 4));
        $apartment->setArea(random_int(25, 90));
        $apartment->setAddress('Random street ' . random_int(1, 50));
        $apartment->setDescription('Generated automatically');
        $apartment->setCreatedAt(new \DateTimeImmutable());

        $apartment->setCategory($category);
        $this->em->persist($apartment);
        $this->em->flush();

        $output->writeln('<info>Random apartment generated</info>');

        return Command::SUCCESS;
    }
}
