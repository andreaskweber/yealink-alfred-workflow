<?php

namespace AndreasWeber\YealinkWorkflow\Phone;

class PhoneGateway
{
    /**
     * @var string Username
     */
    private $username;

    /**
     * @var string Password
     */
    private $password;

    /**
     * @var string IP
     */
    private $ip;

    /**
     * __construct()
     *
     * @param string $ip       IP
     * @param string $username Username
     * @param string $password Password
     */
    public function __construct($ip, $username, $password)
    {
        $this->ip = $ip;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Dials the given number with the given line.
     *
     * @param string $number Number
     * @param string $line   Line
     *
     * @return null
     */
    public function call($number, $line = null)
    {
        if ($line) {
            $command = sprintf(
                'curl \'http://%s:%s@%s/cgi-bin/ConfigManApp.com?number=%s&outgoing_uri=%s\'',
                $this->username,
                $this->password,
                $this->ip,
                $number,
                $line
            );
        } else {
            $command = sprintf(
                'curl \'http://%s:%s@%s/cgi-bin/ConfigManApp.com?number=%s\'',
                $this->username,
                $this->password,
                $this->ip,
                $number
            );
        }

        exec($command);
    }

    /**
     * Ends an active call.
     *
     * @return null
     */
    public function hangup()
    {
        $command = sprintf(
            'curl \'http://%s:%s@%s/cgi-bin/ConfigManApp.com?key=X\'',
            $this->username,
            $this->password,
            $this->ip
        );

        exec($command);
    }
}
