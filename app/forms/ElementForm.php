<?

use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Textarea;

class ElementForm extends \Phalcon\Forms\Form
{
	public function initialize($entity = null, $options = null)
    {
       	$created = new Date('created');
		$created->setLabel('Дата');
		$this->add($created); 	
		
    	$sum = new Numeric('sum');
		$sum->setLabel('Сумма');
		$this->add($sum);
		
    	$categoryID = new Hidden('categoryID');
		$this->add($categoryID);
		
    	$text = new Textarea('text');
		$text->setLabel('Описание');
		$this->add($text);				
	}
}