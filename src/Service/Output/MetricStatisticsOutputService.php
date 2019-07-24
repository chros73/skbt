<?php declare(strict_types=1);

namespace App\Service\Output;

use App\Service\Output\Interfaces\MetricStatisticsOutputServiceInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \InvalidArgumentException;

/**
 * Prints metric statistics to console
 *
 * @package App\Service\Output
 */
class MetricStatisticsOutputService implements MetricStatisticsOutputServiceInterface
{
    /**
     * Output Interface
     *
     * @var OutputInterface
     */
    private $output;

    /**
     * Constructor
     *
     * @param   OutputInterface  $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * Display and format statistics
     *
     * @param   array   $input  Statistics data
     * @return void
     */
    public function print(array $input): void
    {
        if (empty($input)) {
            throw new InvalidArgumentException('Invalid argument was supplied to ' . get_class($this));
        }

        // Compose initial output
        $outputData = [
            'SamKnows Metric Analyser v1.0.0',
            '===============================',
            '',
            'Period checked:',
            '',
            '    From: ' . $input['from'],
            '    To:   ' . $input['to'],
            '',
            'Statistics:',
            '',
            '    Unit: Megabits per second',
            '',
            '    Average: ' . $input['avg'],
            '    Min: ' . $input['min'],
            '    Max: ' . $input['max'],
            '    Median: ' . $input['med'],
        ];

        // Deal with potential under-performing intervals
        if (isset($input['intervals']) && is_array($input['intervals']) && !empty($input['intervals'])) {
            $outputData[] = "\nInvestigate:\n";
            
            $postWarning = ' was under-performing.';

            foreach ($input['intervals'] as $interval) {
                $warning = '    * The ';

                if (is_array($interval) && isset($interval['from'])) {
                    // Deal with only one day
                    if (!isset($interval['to'])) {
                        $warning .= 'date ' . $interval['from'] . $postWarning;
                    } else {
                        $warning .= 'period between ' . $interval['from'] . ' and '
                            . $interval['to'] . "\n     " . $postWarning;
                    }

                    $outputData[] = $warning;
                }
            }

            $outputData[] = '';
        }

        $this->output->writeln($outputData);
    }
}
