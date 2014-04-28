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

		Page::create(array(
			'id' => 2,
			'title' => 'Create news',
			'route' => 'news/create',
			'method' => 'POST',
			'alias' => 'news.create',
		));
	}

}