<?php declare(strict_types=1);

namespace App\Service\Reader\Interfaces;

/**
 * File Reader Service interface
 *
 * @package App\Service\Reader\Interfaces
 */
interface FileReaderServiceInterface
{
    /**
     * Reads content of a file
     *
     * @return string
     */
    public function read(): string;
}
