<?php declare(strict_types=1);

namespace App\Service\Reader;

use App\Service\Reader\Interfaces\FileReaderServiceInterface;
use Symfony\Component\Console\Input\InputInterface;
use \InvalidArgumentException;

/**
 * Reads content of a file
 *
 * @package App\Service\Reader
 */
class FileReaderService implements FileReaderServiceInterface
{
    /**
     * Input Interface
     *
     * @var InputInterface
     */
    private $input;

    /**
     * Constructor
     *
     * @param   InputInterface  $input
     */
    public function __construct(InputInterface $input)
    {
        $this->input = $input;
    }

    /**
     * Reads content of a file
     *
     * @return string
     */
    public function read(): string
    {
        $content = file_get_contents($this->input->getOption('input'));

        if ($content === false) {
            throw new InvalidArgumentException('Invalid argument was supplied to ' . get_class($this));
        }

        return $content;
    }
}
