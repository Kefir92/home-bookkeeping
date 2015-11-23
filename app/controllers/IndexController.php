<?php

class IndexController extends ControllerBase
{
    public function initialize()
    {
		$this->view->setTemplateAfter('personal');
        parent::initialize();
		$this->tag->prependTitle('Главная страница');
    }

    public function indexAction()
    {
    	$this->view->categories = Categories::find();
    }
}
