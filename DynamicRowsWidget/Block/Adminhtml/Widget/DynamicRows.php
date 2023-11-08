<?php

namespace MageINIC\DynamicRowsWidget\Block\Adminhtml\Widget;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use MageINIC\DynamicRowsWidget\Block\System\Config\Field\DynamicColumn;

/**
 * Class DynamicRows
 */
class DynamicRows extends AbstractFieldArray
{
    /**
     * @var DynamicColumn|null
     */
    private ?DynamicColumn $columnRenderer = null;

    /**
     * Prepare rendering the new field by adding all the needed columns
     *
     * @return void
     * @throws LocalizedException
     */
    protected function _prepareToRender()
    {
        $this->addColumn('break_point', [
            'label' => __('BreakPoint'),
            'class' => 'required-entry validate-digits'
        ]);
        $this->addColumn('slide_to_show', [
            'label' => __('Slide To Show'),
            'class' => 'required-entry validate-digits'
        ]);
        $this->addColumn('slide_to_scroll', [
            'label' => __('Slide To Scroll'),
            'class' => 'required-entry validate-digits'
        ]);
        $this->addColumn(
            'dots',
            [
                'label' => __('Dots'),
                'renderer' => $this->getColumnRenderer()
            ]
        );
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }


    /**
     * Prepare existing row data object
     *
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];
        $dynamicColumn = $row->getTemplete();
        if ($dynamicColumn !== null) {
            $options['option_' . $this->getColumnRenderer()->calcOptionHash($dynamicColumn)] = 'selected="selected"';
        }
        $row->setData('option_extra_attrs', $options);
    }

    /**
     * Get Column Renderer.
     *
     * @return DynamicColumn
     * @throws LocalizedException
     */
    private function getColumnRenderer(): DynamicColumn
    {
        if (!$this->columnRenderer) {
            $this->columnRenderer = $this->getLayout()
                ->createBlock(DynamicColumn::class, '', ['data' => ['is_render_to_js_template' => true]]);
        }
        return $this->columnRenderer;
    }
}
