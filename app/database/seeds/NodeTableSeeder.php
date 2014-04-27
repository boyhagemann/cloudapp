<?php

class NodeTableSeeder extends Seeder {

	public function run()
	{		
        Node::create(array(
            'id' => 1,
            'variable' => 'content',
            'page_id' => 1,
            'resource' => '12345layout',
            'params' => array(
                'title' => 'Test title',
                'content' => 'teee',
                'sidebar' => 'taaa',
            ),
        ));
	}

}