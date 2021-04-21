<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * This view helper class displays a menu bar.
 */
class Menu extends AbstractHelper
{
    /**
     * Menu items array.
     * @var array
     */
    protected $items = [];
    
    /**
     * Active item's ID.
     * @var string
     */
    protected $activeItemId = '';
    
    /**
     * Constructor.
     * @param array $items Menu items.
     */
    public function __construct($items=[])
    {
        $this->items = $items;
    }
    
    /**
     * Sets menu items.
     * @param array $items Menu items.
     */
    public function setItems($items)
    {
        $this->items = $items;
    }
    
    /**
     * Sets ID of the active items.
     * @param string $activeItemId
     */
    public function setActiveItemId($activeItemId)
    {
        $this->activeItemId = $activeItemId;
    }
    
    public function renderMenu()
    {
        if (count($this->items)==0) {
            return '';
        } // Do nothing if there are no items.
        $escapeHtml = $this->getView()->plugin('escapeHtml');
        $result = '<ul class="nav side-menu">';
        
        // Render items
        foreach ($this->items as $item) {
            $link = isset($item['link']) ? $item['link'] : '#';
            $label = isset($item['label']) ? $item['label'] : '';
            if (!isset($item['float']) || $item['float']=='left') {
                $result .= $this->rendermenuItem($item);
            }
        }
        
        $result .= '</ul>';
        return $result;
    }

    protected function renderMenuItem($item)
    {
        $id = isset($item['id']) ? $item['id'] : '';
        $isActive = ($id==$this->activeItemId);
        $label = isset($item['label']) ? $item['label'] : '';
             
        $result = '';
     
        $escapeHtml = $this->getView()->plugin('escapeHtml');
        
        if (isset($item['dropdown'])) {
            $dropdownItems = $item['dropdown'];
            
            $result .= $isActive?'<li class="active">':'<li>';
            $result .= '<a href="#">';
            $result .= $escapeHtml($label) . '<span class="menu_arrow fas fa-chevron-down"></span>';
            $result .= '</a>';
           
            $result .= '<ul class="nav child_menu">';
            foreach ($dropdownItems as $item) {
                $link = isset($item['link']) ? $item['link'] : '#';
                $label = isset($item['label']) ? $item['label'] : '';
                
                $result .= '<li>';
                $result .= '<a href="'.$escapeHtml($link).'">'.$escapeHtml($label).'</a>';
                $result .= '</li>';
            }
            $result .= '</ul>';
            $result .= '</li>';
        } else {
            $link = isset($item['link']) ? $item['link'] : '#';
            
            $result .= $isActive?'<li class="active">':'<li>';
            $result .= '<a href="'.$escapeHtml($link).'">'.$escapeHtml($label).'</a>';
            $result .= '</li>';
        }
    
        return $result;
    }
}
