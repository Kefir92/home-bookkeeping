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
	}
}