<?

use Phalcon\Paginator\Adapter\Model as Paginator;

class CategoriesController extends ControllerBase
{
	public function indexAction()
	{
		$this->tag->prependTitle('Разделы');
		$this->view->setVar('h1', 'Разделы');
		
		$categories = Categories::find();

        $paginator = new Paginator(array(
            "data"  => $categories,
            "limit" => 10,
            "page"  => $this->request->getQuery("page", "int") ?: 1
        ));

        $this->view->page = $paginator->getPaginate();
		$this->view->elements = $categories;
	}
	
	public function newAction()
	{
		$this->tag->prependTitle('Добавление раздела');
		$this->view->setVar('h1', 'Добавление раздела');
		
		$this->view->form = new CategoriesForm;
		
		if ($this->request->isPost()) 
		{
			$this->saveAction();
		}
	}
	
	public function editAction($id)
	{
		$this->tag->prependTitle('Редактирование раздела');
		$this->view->setVar('h1', 'Редактирование раздела');
		
		if ($this->request->isPost()) 
		{
			$this->saveAction($id);
		}
		
		$category = Categories::findFirst($id);
		
        if (!$category) 
        {
            return $this->forward("categories/index");
        }
		
		$this->view->setVar('id', $id);
		$this->view->form = new CategoriesForm($category);
	}
	
	protected function saveAction($id = 0)
	{
		if ($id)
		{
			$action = 'edit';
			$category = Categories::findFirst($id);
			
	        if (!$category) 
	        {
	            $this->flash->error("Element not found");
	            return $this->forward("categories/index");
	        }
		}
		else 
		{
			$action = 'new';
			$category = new Categories;
		}
		
		$form = new CategoriesForm;
		
        $data = $this->request->getPost();
		
        if (!$form->isValid($data, $category)) 
        {
            foreach ($form->getMessages() as $message) 
            {
                $this->flash->error($message);
            }
            return $this->forward('categories/' . $action);
        }

        if ($category->save() == false) 
        {
            foreach ($category->getMessages() as $message) 
            {
                $this->flash->error($message);
            }
            return $this->forward('categories/' . $action);
        }

        $form->clear();

        $this->flash->success("Элемент успешно сохранен");
        return $this->forward("categories/index");		
	}
}