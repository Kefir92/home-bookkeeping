<?

use Phalcon\Db\Column;
use Phalcon\Paginator\Adapter\Model as Paginator;

class HashtagsController extends ControllerBase
{
	public function indexAction()
	{
		$this->tag->prependTitle('Хештеги');
		$this->view->setVar('h1', 'Хештеги');
		
		$hashtags = Hashtags::find();

        $paginator = new Paginator(array(
            "data"  => $hashtags,
            "limit" => 10,
            "page"  => $this->request->getQuery("page", "int") ?: 1
        ));

        $this->view->page = $paginator->getPaginate();
		$this->view->elements = $hashtags;
	}
	
	public function newAction()
	{
		$this->tag->prependTitle('Добавление хештега');
		$this->view->setVar('h1', 'Добавление хештега');
		
		$this->view->form = new HashtagsForm;
		
		if ($this->request->isPost()) 
		{
			$this->saveAction();
		}
	}
	
	public function editAction($id)
	{
		$this->tag->prependTitle('Редактирование хештега');
		$this->view->setVar('h1', 'Редактирование хештега');
		
		if ($this->request->isPost()) 
		{
			$this->saveAction($id);
		}
		
		$hashtags = Hashtags::findFirst($id);
		
        if (!$hashtags) 
        {
            return $this->forward("hashtags/index");
        }
		
		$this->view->setVar('id', $id);
		$this->view->form = new HashtagsForm($hashtags);
	}
	
	protected function saveAction($id = 0)
	{
		if ($id)
		{
			$action = 'edit';
			$hashtags = Hashtags::findFirst($id);
			
	        if (!$hashtags) 
	        {
	            $this->flash->error("Element not found");
	            return $this->forward("categories/index");
	        }
		}
		else 
		{
			$action = 'new';
			$hashtags = new Hashtags;
		}
		
		$form = new HashtagsForm;
		
        $data = $this->request->getPost();
		
        if (!$form->isValid($data, $hashtags)) 
        {
            foreach ($form->getMessages() as $message) 
            {
                $this->flash->error($message);
            }
            return $this->forward('hashtags/' . $action);
        }

        if ($hashtags->save() == false) 
        {
            foreach ($hashtags->getMessages() as $message) 
            {
                $this->flash->error($message);
            }
            return $this->forward('hashtags/' . $action);
        }

        $form->clear();

        $this->flash->success("Элемент успешно сохранен");
        return $this->forward("hashtags/index");		
	}

	public function searchAction($letter)
	{
		if(!strlen($letter))
		{
			return false;	
		}		
		
		$hashtags = Hashtags::find([
	        "title LIKE :title:",
	        "bind"       => ['title' => $letter . '%'],
	        "bindTypes"	 => ['title' => Column::BIND_PARAM_STR]
		])->toArray();
		
		return $hashtags;
	}

	public function searchAjaxAction()
	{
		$output = array('action' => false, 'message' => '');
		
		$tag = $this->request->getPost('tag', 'string');	
		$choosen = $this->request->getPost('choosen');
		
		if(strlen($tag))
		{
			$find = [
		        "title LIKE :title:",
		        "bind"       => ['title' => $tag . '%'],
		        "bindTypes"	 => ['title' => Column::BIND_PARAM_STR]
			];	
			
			if(!empty($choosen))
			{
				$find[0] .= " and id not in (". implode(', ', $choosen) .")";
			}
			
			$hashtags = Hashtags::find($find)->toArray();
			
			if(count($hashtags) === 0)
			{
				$output = array('action' => false, 'tag' => $tag, 'message' => 'Ничего не найдено.');
			}
			else
			{
				$arHashtags = array();
				
				foreach ($hashtags as $hashtag)
				{
					$arHashtags[$hashtag['id']] = $hashtag;
				}
				
				$output = array('action' => true, 'tag' => $tag, 'hashtags' => $arHashtags);
			}
		}

		$this->view->disable();
		$this->response->setStatusCode(200, 'OK');
		$this->response->setContentType('application/json', 'UTF-8');
		$this->response->setContent(json_encode($output));
		
		return $this->response;
	}
	
	public function createAjaxAction()
	{
		$output = array('action' => false, 'message' => '');
		
		$tag = $this->request->getPost('tag', 'string');	
		
		if(strlen($tag))
		{
			$hashtags = new Hashtags;
			$hashtags->title = $tag;
			
	        if ($hashtags->save() == true)
	        {
	        	$info = $hashtags->toArray();
	        	$output = array('action' => true, 'ID' => $hashtags->id, 'info' => array($info['id'] => $info));
			}
			else
			{
				$output['message'] = implode(', ', $hashtags->getMessages());
			}
		}
		
		$this->view->disable();
		$this->response->setStatusCode(200, 'OK');
		$this->response->setContentType('application/json', 'UTF-8');
		$this->response->setContent(json_encode($output));
		
		return $this->response;		
	}
}