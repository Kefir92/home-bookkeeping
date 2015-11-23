<?

/*
 * Adjacency List
 */

class Categories extends \Phalcon\Mvc\Model
{
	public $id;
	public $title;
	public $titleFull;
	//public $parentID;
	
	public function getTitleFull()
	{
		return $this->titleFull ?: $this->title;
	}
	
	public function beforeValidation()
	{
		$this->titleFull = $this->titleFull ?: new Phalcon\Db\RawValue('default');
	}
	
    public function initialize()
    {
    	$this->useDynamicUpdate(true);
    }
	
	public function fillFullTitle()
	{
		$categories = array();
		
		foreach(Categories::find() as $category)
		{
			$categories[$category->parentID][$category->id] = $category->title;
		}
		
		$helpers = new Helpers;
		
		$titles = $helpers->titleRecursive($categories);

		foreach ($titles as $id => $title)
		{
			$category = Categories::findFirst($id);
			$category->titleFull = $title;
			$category->save();		
		}
	}
}