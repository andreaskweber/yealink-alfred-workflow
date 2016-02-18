<?php

namespace AndreasWeber\FilterScript;

use AndreasWeber\ResponseXml\Item;

class ResponseXmlBuilder
{
    /**
     * @var string Filter xml template path
     */
    private $filterXmlTemplatePath;

    /**
     * @var Item[] Items
     */
    private $items = array();

    /**
     * __construct()
     */
    public function __construct()
    {
        $this->filterXmlTemplatePath = BASE_DIR . '/resources/filter_script_template.xml';;
    }

    /**
     * Adds an item.
     *
     * @param Item $item Item
     *
     * @return $this
     */
    public function addItem(Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Renders the items to a valid response xml string.
     *
     * @return string The response xml
     */
    public function render()
    {
        $filterXml = $this->getFilterXmlTemplate();

        foreach ($this->items as $item) {
            $itemXml = $filterXml->addChild('item');

            $itemXml->addAttribute('item', $item->uid);
            $itemXml->addAttribute('arg', $item->arg);
            $itemXml->addAttribute('valid', 'YES');
            $itemXml->addAttribute('autocomplete', $item->autoComplete);

            $itemXml->addChild('title', $item->title);
            $itemXml->addChild('subtitle', $item->subtitle);
            $itemXml->addChild('icon', $item->icon);
        }

        return $filterXml->asXML();
    }

    /**
     * Returns the base filter xml.
     *
     * @return \SimpleXMLElement
     */
    protected function getFilterXmlTemplate()
    {
        $xml = new \SimpleXMLElement(
            file_get_contents($this->filterXmlTemplatePath)
        );

        return $xml;
    }
}
