<?php

namespace GameOfLife;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LifeCommand
 *
 * @package GameOfLife
 */
class LifeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('play')
            ->setDescription('launches the game of life')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
            ->addOption(
               'maxNumberOfGenerations',
               null,
               InputOption::VALUE_REQUIRED,
               'Maximum number of generations'
            )
            ->addOption(
               'maxRowLimit',
               null,
               InputOption::VALUE_REQUIRED,
               'Maximum number of grid rows',
               40
            )
            ->addOption(
               'maxColumnLimit',
               null,
               InputOption::VALUE_REQUIRED,
               'Maximum number of grid columns',
               40
            )
            ->addOption(
               'generator',
               null,
               InputOption::VALUE_REQUIRED,
               'The grid generator, see the list-generators command',
               'Random'
            )                
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $life = new Life(
            $this->getGridGenerator($input->getOption('generator')),
            new SimpleReplicator(new ConwayRuleSet(), new SimpleNeighboursCounter()),
            new CliGridPrinter($output)
        );

        $life->play(
            $input->getOption('maxNumberOfGenerations'),
            $input->getOption('maxRowLimit'),   
            $input->getOption('maxColumnLimit')
        );
    }
    
    /**
     * 
     * @param string $generator
     * @return GridGenerator
     */
    private function getGridGenerator($generator)
    {
        if (empty($generator)) {
            return new GridGenerator\RandomGenerator();
        }
        
        return GridGeneratorFactory::getGridGeneratorInstance($generator);
    }
}