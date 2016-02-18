<?php

namespace AndreasWeber;

use AndreasWeber\ResponseXml\Command;

class CommandScriptInput extends AbstractScript
{
    /**
     * @inheritDoc
     */
    public function invoke($query)
    {
        switch ($this->getCommandFromQuery($query)) {
            case Command::DIAL:
                $this->dial(
                    $this->getLineFromQuery($query),
                    $this->getNumberFromQuery($query)
                );
                break;
            case Command::HANGUP:
                $this->hangup();
                break;
            default:
                throw new \LogicException(
                    sprintf(
                        'Something wen\'t wrong. Invalid query: %s',
                        $query
                    )
                );
        }
    }

    /**
     * Extracts and returns the command from the query.
     *
     * @param string $query The query
     *
     * @return string The command
     */
    public function getCommandFromQuery($query)
    {
        $queryParts = explode(' ', $query);

        return $queryParts[0];
    }

    /**
     * Extracts and returns the line from the query.
     *
     * @param string $query The query
     *
     * @return string The line
     */
    private function getLineFromQuery($query)
    {
        $queryParts = explode(' ', $query);

        // hack due to a possible bug in Yealink firmware
        // we must strip the @ char and the host from uri
        // otherwise the line would not be recognised by the phone
        $line = explode('@', $queryParts[1]);
        $line = $line[0];

        return $line;
    }

    /**
     * Extracts and returns the number from the query.
     *
     * @param string $query The query
     *
     * @return string The number
     */
    private function getNumberFromQuery($query)
    {
        $queryParts = explode(' ', $query);

        return $queryParts[2];
    }

    /**
     * Dials the given number with the right line.
     *
     * @param string $line   Line
     * @param string $number Number
     *
     * @return null
     */
    private function dial($line, $number)
    {
        $command = sprintf(
            'curl \'http://%s:%s@%s/cgi-bin/ConfigManApp.com?number=%s&outgoing_uri=%s\'',
            $this->config['common']['username'],
            $this->config['common']['password'],
            $this->config['common']['ip'],
            $number,
            $line
        );

        // echo $command . PHP_EOL;
        exec($command);
        echo sprintf('Calling "%s" with line "%s"', $number, $line);
    }

    /**
     * Ends an active call.
     *
     * @return null
     */
    private function hangup()
    {
        $command = sprintf(
            'curl \'http://%s:%s@%s/cgi-bin/ConfigManApp.com?key=X\'',
            $this->config['common']['username'],
            $this->config['common']['password'],
            $this->config['common']['ip']
        );

        // echo $command . PHP_EOL;
        exec($command);
        echo sprintf('Call ended');
    }
}
