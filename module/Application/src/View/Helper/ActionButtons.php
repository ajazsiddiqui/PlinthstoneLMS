<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * This view helper class displays action buttons.
 */
class ActionButtons extends AbstractHelper
{
    /**
     * Array of items.
     * @var array
     */
    private $items = [];
    
    /**
     * Constructor.
     * @param array $items Array of items (optional).
     */
    public function __construct($items=[])
    {
        $this->items = $items;
    }
    
    /**
     * Sets the items.
     * @param array $items Items.
     */
    public function setItems($items)
    {
        $this->items = $items;
    }
    
    /**
     * Renders the buttons.
     * @return string HTML code of the buttons.
     */
    public function render()
    {
        if (count($this->items)==0) {
            return '';
        } // Do nothing if there are no items.
        
        // Resulting HTML code will be stored in this var
        $result = '<ol class="actionbuttons">';
        
        // Get item count
        $itemCount = count($this->items);
        
        $itemNum = 1; // item counter
        
        // Walk through items
        foreach ($this->items as $label=>$link) {
                        
            // Render current item
            $result .= $this->renderItem($label, $link);
                        
            // Increment item counter
            $itemNum++;
        }
        
        $result .= '</ol>';
        
        return $result;
    }
    
    protected function renderItem($label, $link)
    {
        $escapeHtml = $this->getView()->plugin('escapeHtml');
        
        $result = '<a href="'.$escapeHtml($link).'"><li class="action-item">'.$escapeHtml($label).'</li></a>';
    
        return $result;
    }
}
