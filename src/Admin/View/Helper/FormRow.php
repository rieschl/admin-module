<?php

namespace Admin\View\Helper;

use Zend\Form\ElementInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

class FormRow extends AbstractHelper
{
    function __invoke(ElementInterface $element)
    {
        $vm = new ViewModel(array(
            'element' => $element,
        ));
        $vm->setTemplate('admin/form/form-row.phtml');
        return $this->getView()->render($vm);
    }
}