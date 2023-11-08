<?php
namespace MageINIC\DynamicRowsWidget\Block\System\Config\Field;

use Magento\Framework\View\Element\Html\Select;

/**
 * System Config DynamicColumn
 */
class DynamicColumn extends Select
{
    /**
     * Set "name" for <select> element
     *
     * @param string $value
     * @return $this
     */
    public function setInputName(string $value): DynamicColumn
    {
        return $this->setName($value);
    }

    /**
     * Set "id" for <select> element
     *
     * @param string $value
     * @return $this
     */
    public function setInputId(string $value): DynamicColumn
    {
        return $this->setId($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml(): string
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->getSourceOptions());
        }
        return parent::_toHtml();
    }

    /**
     * Get Source Options.
     *
     * @return array
     */
    private function getSourceOptions(): array
    {
        return [
            ['label' => 'Yes', 'value' => 1],
            ['label' => 'No', 'value' => 0],
        ];
    }
}
