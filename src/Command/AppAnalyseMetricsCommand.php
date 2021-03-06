<?php declare(strict_types=1);

namespace App\Command;

use App\Service\Converter\MetricJsonToArrayService;
use App\Service\Hydrator\MetricHydratorService;
use App\Service\Output\MetricStatisticsOutputService;
use App\Service\Reader\FileReaderService;
use App\Service\Statistic\CalculateMetricStatisticService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AppAnalyseMetricsCommand
 *
 * @package App\Command
 */
class AppAnalyseMetricsCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:analyse-metrics';

    /**
     * Configure the command.
     */
    protected function configure(): void
    {
        $this->setDescription('Analyses the metrics to generate a report.');
        $this->addOption('input', null, InputOption::VALUE_REQUIRED, 'The location of the test input');
    }

    /**
     * Detect slow-downs in the data and output them to stdout.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        // Read input file, convert JSON to array, then get all the metric data
        $readerService = new FileReaderService($input);
        $metricJsonToArrayService = new MetricJsonToArrayService();
        $metricHydratorService = new MetricHydratorService();

        $metricCollection = $metricHydratorService->getMetrics(
            $metricJsonToArrayService->getMetrics($readerService->read())
        );

        // Calculate statistics for reporting
        $calculateMetricStatisticService = new CalculateMetricStatisticService();
        $statistics = $calculateMetricStatisticService->calculate($metricCollection);

        // Display and format result
        $metricStatisticsOutputService = new MetricStatisticsOutputService($output);
        $metricStatisticsOutputService->print($statistics);
    }
}
