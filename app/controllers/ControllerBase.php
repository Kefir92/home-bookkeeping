<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected function initialize()
    {
        $this->tag->setTitle('Домашняя бухгалтерия');
        $this->view->setTemplateAfter('personal');
    }

    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0],
    			'action' => $uriParts[1],
                'params' => $params
    		)
    	);
    }
	
	protected function setTitle($title)
	{
		if(strlen($title)) 
		{		
			$this->tag->prependTitle($title);
			$this->view->setVar('h1', $title);
		}
	}	
}
