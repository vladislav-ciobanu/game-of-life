<?php

namespace GameOfLife;

use GameOfLife\GridGenerator\RandomGenerator;
use Symfony\Component\Console\Command\Command;
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
    const COMMAND_NAME = 'play';
    const LIST_SEP = ', ';

    const OPTION_MAX_COLUMN_LIMIT = 'maxColumnLimit';
    const OPTION_MAX_ROW_LIMIT = 'maxRowLimit';
    const OPTION_GENERATOR = 'generator';
    const OPTION_MAX_NUMBER_OF_GENERATIONS = 'maxNumberOfGenerations';

    const DEFAULT_MAX_COLUMN_LIMIT = 40;
    const DEFAULT_MAX_ROW_LIMIT = 40;
    const DEFAULT_GENERATOR = 'Random';

    /**
     * @var Replicator
     */
    private $replicator;

    /**
     * @var GridGeneratorFactory
     */
    private $gridGeneratorFactory;


    /**
     * @param Replicator           $replicator
     * @param GridGeneratorFactory $gridGeneratorFactory
     */
    public function __construct(Replicator $replicator, GridGeneratorFactory $gridGeneratorFactory)
    {
        parent::__construct();
        $this->replicator = $replicator;
        $this->gridGeneratorFactory = $gridGeneratorFactory;
    }

    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription('launches the game of life')
            ->addOption(
                self::OPTION_MAX_NUMBER_OF_GENERATIONS,
                null,
                InputOption::VALUE_REQUIRED,
                'Maximum number of generations'
            )
            ->addOption(
                self::OPTION_MAX_ROW_LIMIT,
                null,
                InputOption::VALUE_REQUIRED,
                'Maximum number of grid rows',
                self::DEFAULT_MAX_ROW_LIMIT
            )
            ->addOption(
                self::OPTION_MAX_COLUMN_LIMIT,
                null,
                InputOption::VALUE_REQUIRED,
                'Maximum number of grid columns',
                self::DEFAULT_MAX_COLUMN_LIMIT
            )
            ->addOption(
                self::OPTION_GENERATOR,
                null,
                InputOption::VALUE_REQUIRED,
                'The grid generator: ' . $this->getGridGeneratorNames(),
                self::DEFAULT_GENERATOR
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $life = new Life(
            $this->getGridGenerator($input->getOption(self::OPTION_GENERATOR)),
            $this->replicator,
            new ConsoleGridPrinter($output)
        );

        $life->play(
            $input->getOption(self::OPTION_MAX_NUMBER_OF_GENERATIONS),
            $input->getOption(self::OPTION_MAX_ROW_LIMIT),
            $input->getOption(self::OPTION_MAX_COLUMN_LIMIT)
        );
    }
    
    /**
     * @param string $generator
     * @return GridGenerator
     */
    private function getGridGenerator($generator)
    {
        if (empty($generator)) {
            $generator = self::DEFAULT_GENERATOR;
        }

        return $this->gridGeneratorFactory->getGridGeneratorInstance($generator);
    }

    /**
     * @return string
     */
    private function getGridGeneratorNames()
    {
        return implode(self::LIST_SEP, GridGeneratorName::getGridGeneratorNameList());
    }
}
