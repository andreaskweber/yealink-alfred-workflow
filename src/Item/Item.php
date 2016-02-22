<?php

namespace AndreasWeber\YealinkWorkflow\Item;

class Item implements ItemInterface
{
    /**
     * @var string Title
     */
    private $title;

    /**
     * @var string Subtitle
     */
    private $subtitle;

    /**
     * @var string Icon
     */
    private $icon;

    /**
     * @var string Argument
     */
    private $argument;

    /**
     * @var string Auto complete
     */
    private $autoComplete;

    /**
     * @var string Uid
     */
    private $uid;

    /**
     * @var bool Is valid
     */
    private $valid;

    /**
     * __construct()
     *
     * @param string $title        Title
     * @param string $subtitle     Subtitle
     * @param string $icon         Icon
     * @param string $argument     Argument
     * @param string $autoComplete Auto complete
     * @param string $uid          Uid
     * @param bool   $valid        Is valid
     */
    public function __construct($title, $subtitle, $icon, $argument, $autoComplete, $uid, $valid)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->icon = $icon;
        $this->argument = $argument;
        $this->autoComplete = $autoComplete;
        $this->uid = $uid;
        $this->valid = (bool)$valid;
    }

    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @inheritDoc
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @inheritDoc
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @inheritDoc
     */
    public function getArgument()
    {
        return $this->argument;
    }

    /**
     * @inheritDoc
     */
    public function getAutoComplete()
    {
        return $this->autoComplete;
    }

    /**
     * @inheritDoc
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @inheritDoc
     */
    public function isValid()
    {
        return $this->valid;
    }
}
