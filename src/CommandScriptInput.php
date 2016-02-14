<?php

namespace AndreasWeber;

class CommandScriptInput extends AbstractScript
{
    /**
     * @inheritDoc
     */
    public function invoke($query)
    {
        return $query;
    }
}
