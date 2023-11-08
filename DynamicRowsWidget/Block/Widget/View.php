<?php

namespace MageINIC\DynamicRowsWidget\Block\Widget;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Widget\Block\BlockInterface;
use Magento\Widget\Helper\Conditions;

/**
 * Class View
 */
class View extends Template implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = "MageINIC_DynamicRowsWidget::widget/view.phtml";

    /**
     * @var Json
     */
    private Json $serializer;
    /**
     * @var Conditions
     */
    private Conditions $conditions;

    /**
     * @param Template\Context $context
     * @param Json $serializer
     * @param Conditions $conditions
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Json $serializer,
        Conditions $conditions,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->serializer = $serializer;
        $this->conditions = $conditions;
    }

    /**
     * Fetches `conditions` containing serialized items then turns them into DataObjects
     *
     * @return bool|string
     */
    public function getConditionsSerialize(): bool|string
    {
        $condition = $this->conditions->decode($this->getData('conditions_encoded'));
        $data = [];
        foreach ($condition as $content) {
            $data[] = $content;
        }
        return $this->serializer->serialize($data);
    }
}
