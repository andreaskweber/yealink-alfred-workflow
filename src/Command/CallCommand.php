<?php

namespace AndreasWeber\YealinkWorkflow\Command;

use AndreasWeber\YealinkWorkflow\Item\Item;
use AndreasWeber\YealinkWorkflow\Query\Query;

class CallCommand extends AbstractCommand
{
    /**
     * @inheritDoc
     */
    public function getCommand()
    {
        return COMMAND_PREFIX . ':call';
    }

    /**
     * @inheritDoc
     */
    public function supports(Query $query)
    {
        return $this->getCommand() === $query->getCommand();
    }

    /**
     * @inheritDoc
     */
    public function invoke(Query $query)
    {
        $number = $this->getNumberFromQuery($query);
        $line = $this->getLineFromQuery($query);

        $this->app->getPhoneGateway()->call($number, $line);

        echo sprintf('Calling "%s" with line "%s"', $number, $line);
    }

    /**
     * @inheritDoc
     */
    public function getItems(Query $query)
    {
        $config = $this->app->getConfig();

        // remove spaces from number
        $number = str_replace(' ', '', $query->getArgument());

        // item is only valid if a number is given
        $valid = $number ? true : false;

        // auto completion is only needed when no number is given
        $autoComplete = !$number ? $query->getCommandWithoutPrefix() : null;

        // only a valid number is callable ;-)
        if ($number && !preg_match('/^\+?\d+$/', $number)) {
            return array();
        }

        $items = array();
        foreach ($config['lines'] as $line) {
            // change subtitle whether a number is given or not
            if ($number) {
                $subtitle = sprintf('Calling "%s" with line "%s"', $number, $line['title']);
            } else {
                $subtitle = sprintf('Enter number to call with line "%s"', $line['title']);
            }

            // add new line item
            $items[] = new Item(
                $line['title'],
                $subtitle,
                $line['icon'],
                sprintf('%s %s %s', $query->getCommand(), $number, $line['uri']),
                $autoComplete,
                $line['uri'],
                $valid
            );
        }

        return $items;
    }

    /**
     * Extracts and returns the number from the query.
     *
     * @param Query $query Query
     *
     * @return string Number
     */
    public function getNumberFromQuery(Query $query)
    {
        $argument = $query->getArgument();
        $arguments = explode(' ', $query->getArgument());

        if (false !== strpos($argument, '@')) {
            array_pop($arguments);
        }

        return implode('', $arguments);
    }

    /**
     * Extracts and returns the line from the query.
     *
     * @param Query $query Query
     *
     * @return string Line
     */
    public function getLineFromQuery(Query $query)
    {
        $argument = $query->getArgument();

        if (false === strpos($argument, '@')) {
            return null;
        }

        $arguments = explode(' ', $argument);
        $line = array_pop($arguments);

        // hack due to a possible bug in Yealink firmware
        // we must strip the @ char and the host from uri
        // otherwise the line would not be recognised by the phone
        $line = explode('@', $line);
        $line = $line[0];

        return $line;
    }
}
