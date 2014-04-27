<?php

/**
 * 
 * @param Node[] $nodes
 */
class Page extends \Eloquent {
	protected $fillable = [];
    
    /**
     * 
     * @return Illuminate\Database\Relations\HasMany
     */
    public function nodes()
    {
        return $this->hasMany('Node')->where('depth', 0);
    }

}