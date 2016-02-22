<?php

namespace AndreasWeber\YealinkWorkflow\Response;

use AndreasWeber\YealinkWorkflow\Item\ItemInterface;

class ResponseXmlBuilder
{
    /**
     * @var string Filter xml template path
     */
    private $filterXmlTemplatePath;

    /**
     * __construct()
     */
    public function __construct()
    {
        $this->filterXmlTemplatePath = BASE_PATH . '/resources/filter_script_template.xml';;
    }

    /**
     * Renders the response.
     *
     * @param ItemInterface[] $items Items
     *
     * @return string Response xml
     */
    public function render(array $items)
    {
        $filterXml = $this->getFilterXmlTemplate();

        foreach ($items as $item) {
            $itemXml = $filterXml->addChild('item');
            $itemXml->addChild('title', $item->getTitle());
            $itemXml->addChild('subtitle', $item->getSubtitle());
            $itemXml->addChild('icon', $item->getIcon());
            $itemXml->addAttribute('valid', $item->isValid() ? 'yes' : 'no');
            // $itemXml->addAttribute('uid', $item->getUid());

            if ($item->getAutoComplete()) {
                $itemXml->addAttribute('autocomplete', $item->getAutoComplete());
            }

            if ($item->isValid()) {
                $itemXml->addAttribute('arg', $item->getArgument());
            }
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
