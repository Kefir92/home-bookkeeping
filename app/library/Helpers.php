<?

class Helpers
{
	public function _d($data)
	{
		echo '<pre>', print_r($data), '</pre>';
	}
	
	public function optionsRecursive($options = array(), $data = array(), $parentID = 0, $level = 0) 
	{
        if(!empty($data[$parentID])) 
        {
            foreach ($data[$parentID] as $key => $value) 
            {
                $options[$key] = str_repeat(' . ', $level) . $value;

		        if(!empty($data[$key])) 
		        {
		            $options += $this->optionsRecursive($options, $data, $key, $level + 1);
				}
            }
        }
        
        return $options;
    }
	
	public function titleRecursive($data = array(), $titles = array(), $parentID = 0)
	{
		foreach ($data[$parentID] as $childID => $title)
		{
			if(isset($titles[$parentID]))
			{
				$titles[$childID] = $titles[$parentID] . ' > ' . $title;
			}
			else
			{
				$titles[$childID] = $title;
			}
			
			if(isset($data[$childID]))
			{
				$titles += $this->titleRecursive($data, $titles, $childID);
			}
		}
		
		return $titles;
	}	
}