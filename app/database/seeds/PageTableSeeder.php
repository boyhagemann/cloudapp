<?php

class PageTableSeeder extends Seeder {

	public function run()
	{		
        Page::create(array(
            'id' => 1,
            'title' => 'Test page',
            'route' => 'test',
            'method' => 'GET',
            'alias' => 'test',
        ));
	}

}