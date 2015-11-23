<?

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;

class CategoriesForm extends \Phalcon\Forms\Form
{
	public function initialize($entity = null, $options = null)
    {		
    	$title = new Text('title');
		$title->setLabel('Название');
		$title->setFilters(array('striptags', 'string'));
		$this->add($title);
		
		/*$categories = new Select('parentID');
		$categories->setLabel('Родительский раздел');
		
		$data = array();		
		
		foreach(Categories::find() as $category)
		{
			$data[$category->parentID][$category->id] = $category->title;
		}
		
		$categories->setOptions($this->helpers->optionsRecursive(array('Верхний уровень'), $data));				
		$this->add($categories);
		 * 
		 */
	}
}