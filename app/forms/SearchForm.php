<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;

class SearchForm extends Form
{
    public function initialize($entity = null, $options = null)
	{
		$search = new Text('search');
		$this->add($search);
    }
}