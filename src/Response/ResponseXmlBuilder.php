<?php

namespace AndreasWeber\YealinkWorkflow\Response;

use AndreasWeber\YealinkWorkflow\Command\CommandInterface;

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
     * @param CommandInterface[] $commands The commands
     *
     * @return string Response xml
     */
    public function render(array $commands)
    {
        $filterXml = $this->getFilterXmlTemplate();

        foreach ($commands as $command) {
            foreach($command->getItems() as $item) {
                $itemXml = $filterXml->addChild('item');

                $itemXml->addAttribute('uid', $item->getUid());
                $itemXml->addAttribute('valid', $item->isValid() ? 'yes' : 'no');
                $itemXml->addAttribute('autocomplete', $item->getAutoComplete());
                $itemXml->addChild('title', $item->getTitle());
                $itemXml->addChild('subtitle', $item->getSubtitle());
                $itemXml->addChild('icon', $item->getIcon());

                if($item->isValid()) {
                    $itemXml->addAttribute('arg', $item->getArgument());
                }
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
