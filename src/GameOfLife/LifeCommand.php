<?php

namespace GameOfLife;

use GameOfLife\Grid\Generator\PatternGridGenerator;
use GameOfLife\Grid\Generator\RandomGridGenerator;
use GameOfLife\Util\GamePatternsLoader;
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
    const OPTION_PATTERN = 'pattern';
    const OPTION_MAX_NUMBER_OF_GENERATIONS = 'maxNumberOfGenerations';

    const DEFAULT_MAX_COLUMN_LIMIT = 40;
    const DEFAULT_MAX_ROW_LIMIT = 40;
    const DEFAULT_PATTERN = 'random';

    /**
     * @var Life
     */
    private $life;

    /**
     * @var PatternGridGenerator
     */
    private $patternGridGenerator;

    /**
     * @var RandomGridGenerator
     */
    private $randomGridGenerator;

    /**
     * @var GamePatternsLoader
     */
    private $gamePatternsLoader;


    /**
     * @param life                 $life
     * @param PatternGridGenerator $patternGridGenerator
     * @param RandomGridGenerator  $randomGridGenerator
     * @param GamePatternsLoader   $gamePatternsLoader
     */
    public function __construct(
        Life $life,
        PatternGridGenerator $patternGridGenerator,
        RandomGridGenerator $randomGridGenerator,
        GamePatternsLoader $gamePatternsLoader
    ) {
        $this->life = $life;
        $this->patternGridGenerator = $patternGridGenerator;
        $this->randomGridGenerator= $randomGridGenerator;
        $this->gamePatternsLoader = $gamePatternsLoader;
        parent::__construct();
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
                self::OPTION_PATTERN,
                null,
                InputOption::VALUE_REQUIRED,
                'The game pattern: ' . $this->getGamePatterns(),
                self::DEFAULT_PATTERN
            );
    }

    /**
     * @param InputInterface $input
     * @return void
     */
    protected function execute(InputInterface $input)
    {
        $grid = $this->generateGrid(
            $input->getOption(self::OPTION_PATTERN),
            $input->getOption(self::OPTION_MAX_ROW_LIMIT),
            $input->getOption(self::OPTION_MAX_COLUMN_LIMIT)
        );

        $this->life->play($grid, $input->getOption(self::OPTION_MAX_NUMBER_OF_GENERATIONS));
    }

    /**
     * @param $pattern
     * @param $maxRowLimit
     * @param $maxColumnLimit
     * @return Grid\Grid
     */
    private function generateGrid($pattern, $maxRowLimit, $maxColumnLimit)
    {
        return empty($pattern) || strtolower($pattern) === self::DEFAULT_PATTERN
                ? $this->randomGridGenerator->generate(null, $maxRowLimit, $maxColumnLimit)
                : $this->patternGridGenerator->generate($pattern, $maxRowLimit, $maxColumnLimit);
    }

    /**
     * @return string
     */
    private function getGamePatterns()
    {
        return implode(self::LIST_SEP, $this->gamePatternsLoader->getPatternNames());
    }
}
