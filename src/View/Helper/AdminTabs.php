<?php

namespace Midnight\AdminModule\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

class AdminTabs extends AbstractHelper
{
    /**
     * @var array
     */
    private $spec;

    /**
     * @param array $spec
     *
     * @return string
     */
    public function __invoke(array $spec)
    {
        $this->spec = $spec;
        $this->prepareSpec();
        $vm = new ViewModel(array('spec' => $this->spec));
        $vm->setTemplate('midnight/admin-module/tabs/index.phtml');
        return $this->getView()->render($vm);
    }

    /**
     * @return void
     */
    private function prepareSpec()
    {
        $this->ensureTabsKey();
    }

    /**
     * @return void
     */
    private function ensureTabsKey()
    {
        if (!isset($this->spec['tabs']) || !is_array($this->spec['tabs'])) {
            $this->spec['tabs'] = array();
        }
    }
} 
