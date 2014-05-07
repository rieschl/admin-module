<?php

namespace Midnight\AdminModule\View\Helper\Form;

use Zend\Form\View\Helper\FormRow as ZendFormRow;

class FormRow extends ZendFormRow
{
    function __construct()
    {
        $this->setPartial('midnight/admin-module/form/form-row.phtml');
    }
}
