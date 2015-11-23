<?

class Elements extends \Phalcon\Mvc\Model
{
	public $id;
	public $sum;
	public $created;
	public $categoryID;
	
    public function initialize()
    {
    	$this->hasMany("id", "ElementsHashtags", "elements_id");
    	$this->useDynamicUpdate(true);
    }
}