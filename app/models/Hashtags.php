<?

class Hashtags extends \Phalcon\Mvc\Model
{
	public $id;
	public $title;
	
    public function initialize()
    {
    	$this->hasMany("id", "ElementsHashtags", "hashtags_id");
    	$this->useDynamicUpdate(true);
    }
	
	public static function getFirstLetters()
	{
		$pdo = \Phalcon\Di::getDefault()->getShared('db');
		
		$result = $pdo->query('SELECT DISTINCT LEFT(title, 1) as letter FROM `hashtags` ORDER BY letter');
		
		$letters = $result->fetchAll();
		
		return $letters;
	}
}