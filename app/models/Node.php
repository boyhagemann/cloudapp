<?php
use Baum\Node as BaseNode;

/**
* Node
*/
class Node extends BaseNode {

  /**
   * Table name.
   *
   * @var string
   */
  protected $table = 'nodes';

    /**
     * 
     * @param string $value
     * @return array
     */
    public function getParamsAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * 
     * @param array $value
     */
    public function setParamsAttribute(Array $value)
    {
        $this->attributes['params']  = json_encode($value);
    }

	/**
	 * @return string
	 */
	public function createCacheKey()
	{
		return md5(json_encode(array(
			$this->id,
			$this->config,
		)));
	}
}
