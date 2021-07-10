<?php

declare(strict_types=1);

namespace App\CarInsurance\Reader;

use ErrorException;
use InvalidArgumentException;
use UnexpectedValueException;


class InputJsonReader implements InputReaderInterface
{

    const FULL_PATH = __DIR__ . '/../../../public/inputs/';

    protected $pathFile;
    protected $content;

    function __construct(string $file)
    {
        try {
            $this->pathFile = self::FULL_PATH . $file;
            $rawContent = file_get_contents($this->pathFile);
            $this->load($rawContent);
        } catch (ErrorException $ex) {
            throw new InvalidArgumentException("file does not exist");
        }
    }

    public function load(string $rawContent): void
    {
        try {
            $this->content = json_decode($rawContent, true);
        } catch (ErrorException $ex) {
            throw new UnexpectedValueException("Errors in json file");
        }
    }

    public function getObject(): array
    {
        return $this->content;
    }
}
