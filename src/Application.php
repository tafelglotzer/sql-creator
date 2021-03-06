<?php

namespace Creator;

use InvalidArgumentException;
use Creator\Formatter\FormatterInterface;

class Application
{
    protected $formatters = [];

    public function pushFormatter(FormatterInterface $formatter)
    {
        $this->formatters[$formatter->name] = $formatter;

        return $this;
    }

    public function run($name, array $input)
    {
        if (! isset($this->formatters[$name])) {
            throw new InvalidArgumentException(sprintf(
                'Formatter "%s" does not exists',
                $name
            ));
        }

        echo json_encode(
            array_map('trim', $this->formatters[$name]->format($input))
        );
    }
}
