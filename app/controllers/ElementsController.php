<?

use Phalcon\Db\Column;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ElementsController extends ControllerBase
{
	private function setCategoryTitleSmall($categoryID = 0)
	{
		$category = Categories::findFirst($categoryID);		
		$this->view->h1_small = $category->title;		
		
		$this->view->categoryID = $categoryID;
	}
	
	public function indexAction($categoryID = 0)
	{
		$this->setTitle("Список элементов");
		$this->setCategoryTitleSmall($categoryID);
		
		$this->view->addUrl = $this->di->get('url')->get(array(
			'for' => 'new_element', 
			'categoryID' => $categoryID
		));
		
		$elements = Elements::find([
			"categoryID = :categoryID:",
			"bind" 		=> ["categoryID" => $categoryID],
			"bindTypes" => ["categoryID" => Column::BIND_PARAM_INT],
			"order" 	=> "created desc"
		]);

// ПАГИНАЦИЯ ???
        $paginator = new Paginator(array(
            "data"  => $elements,
            "limit" => 10,
            "page"  => $this->request->getQuery("page", "int") ?: 1
        ));

        $this->view->page = $paginator->getPaginate();
		$this->view->elements = $elements;		
	}
	
	public function newAction($categoryID = 0)
	{
		$this->setTitle('Добавление элемента');
		$this->setCategoryTitleSmall($categoryID);
		
		$this->view->listUrl = $this->di->get('url')->get(array(
			'for' => 'list_element', 
			'categoryID' => $categoryID
		));
		
		$this->view->form = new ElementForm();
		
		if ($this->request->isPost()) 
		{
			$this->saveAction($categoryID);
		}
	}
	
	public function editAction($categoryID = 0, $elementID = 0)
	{
		$this->setTitle('Редактирование элемента');
		$this->setCategoryTitleSmall($categoryID);
		
		$this->view->listUrl = $this->di->get('url')->get(array(
			'for' => 'list_element', 
			'categoryID' => $categoryID
		));		
		
		if ($this->request->isPost()) 
		{
			$this->saveAction($categoryID, $elementID);
		}

		$element = Elements::findFirst($elementID);	
		
		$this->view->elementsHashtags = $element->elementsHashtags;	

		$this->view->form = new ElementForm($element);
	}
	
	protected function saveAction($categoryID = 0, $id = 0)
	{
		$url = '/categories/' . $categoryID . '/elements';
				
		if ($id)
		{
			$action = '/edit/' . $id;
			$element = Elements::findFirst($id);
			
	        if (!$element) 
	        {
	            $this->flash->error("Element not found");
	            return $this->response->redirect($url);
	        }
		}
		else 
		{
			$action = '/new';
			$element = new Elements;
		}
		
		$form = new ElementForm;
		
        $data = $this->request->getPost();

        if (!$form->isValid($data, $element))
        {
            foreach ($form->getMessages() as $message) 
            {
                $this->flash->error($message);
            }
            return $this->response->redirect($url . $action);
        }

		$isSaved = $element->save();

		try 
		{
			if($element->id)
			{
				# Deleting old tags
				$elementsHashtags = ElementsHashtags::find([
			        "elements_id = :id:",
			        "bind"       => ['id' => $element->id . '%'],
			        "bindTypes"	 => ['id' => Column::BIND_PARAM_INT]
				]);
				
				foreach ($elementsHashtags as $elementHashtags)
				{
					$elementHashtags->delete();
				}
				
				# Creating new tags
				if(!empty($data['tags']))
				{									
					foreach ($data['tags'] as $tagID)
					{
						$elementHashtags = new ElementsHashtags;
						$elementHashtags->elements_id = $element->id;
						$elementHashtags->hashtags_id = $tagID;
						$elementHashtags->save();
					}
				}
			}
		}
		catch (Exception $e) 
		{
			$this->flash->error($e->getMessage());
		}

        if ($isSaved == false) 
        {
            foreach ($element->getMessages() as $message) 
            {
                $this->flash->error($message);
            }
            return $this->response->redirect($url . $action);
        }

        $form->clear();		

        $this->flash->success("Элемент успешно сохранен");
        return $this->response->redirect($url);		
	}	
}
	