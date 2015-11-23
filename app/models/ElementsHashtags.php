<?

class ElementsHashtags extends \Phalcon\Mvc\Model
{
	public $id;
	public $elements_id;
	public $hashtags_id;
	
    public function initialize()
    {
        $this->belongsTo("elements_id", "Elements", "id");
        $this->belongsTo("hashtags_id", "Hashtags", "id");
    }
}