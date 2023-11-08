<?php

namespace MageINIC\DynamicRowsWidget\Block\Adminhtml;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Exception\LocalizedException;
use MageINIC\DynamicRowsWidget\Block\Adminhtml\Widget\DynamicRows as CoreDynamicRows;
/**
 * Class DynamicRows
 */
class DynamicRows extends Widget
{
    /**
     * @var string
     */
    protected string $_blockClassName = CoreDynamicRows::class;

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Prepare chooser element HTML
     *
     * @param AbstractElement $element
     * @return AbstractElement
     * @throws LocalizedException
     */
    public function prepareElementHtml(AbstractElement $element): AbstractElement
    {
        $uniqId = $this->mathRandom->getUniqueHash($element->getId());

        $dynamicRows = $this->getLayout()->createBlock(
            $this->_blockClassName
        )->setElement(
            $element
        )->setConfig(
            $this->getConfig()
        )->setFieldsetId(
            $this->getFieldsetId()
        )->setUniqId(
            $uniqId
        );

        if ($element->getValue()) {
            $values = $element->getValue();
            $values = array_filter($values);
            $element->setValue($values);
        }

        $element->setData('after_element_html', $dynamicRows->toHtml());
        return $element;
    }
}
