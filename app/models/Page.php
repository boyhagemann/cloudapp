<?php

/**
 * 
 * @param Node $node
 */
class Page extends \Eloquent {
	protected $fillable = [];
    
    /**
     * 
     * @return Illuminate\Database\Relations\BelongsTo
     */
    public function node()
    {
        return belongsTo('Node');
    }

}