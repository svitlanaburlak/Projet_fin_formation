<?php

namespace App\Command;

use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:post:event-passed',
)]
class EventDateCommand extends Command
{
    // protected static $defaultName = 'app:post:event-passed';
    protected static $defaultDescription = 'A command to pass status to 0 if the date of event is passed';

    private $postRepo;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
        $this->entityManager = $entityManager;

        parent::__construct();
    }
    
    protected function configure(): void
    {
        // $this
        //     ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
        //     ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        // ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $postList = $this->postRepo->findByDate();
        // dd($postList);

        foreach ($postList as $post) {
            
            if($post->getStatus() == 1) {
                $post->setStatus(0);
                $io->note('Le statut du post ' . $post->getId() . ' a été changé'); 
            }
            
        }

        $this->entityManager->flush();
        $io->success('Ça marche');

        return Command::SUCCESS;
    }
}
