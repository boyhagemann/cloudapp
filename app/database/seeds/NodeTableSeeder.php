<?php

class NodeTableSeeder extends Seeder {

	public function run()
	{		
        $root = Node::create(array(
            'id' => 1,
            'page_id' => 1,
			'variable' => '',
            'resource' => '12345layout',
            'params' => array(
                'title' => 'Test title',
                'sidebar' => 'taaa',
            ),
        ));

		$newsview = Node::create(array(
			'id' => 2,
			'page_id' => 1,
			'variable' => 'content',
			'resource' => '9IAH54IY',
			'params' => array(
				'title' => 'Test title 2',
			),
		))->makeChildOf($root);


		$newsdata = Node::create(array(
			'id' => 3,
			'variable' => 'news',
			'page_id' => 1,
			'resource' => '9IAH54IX',
			'params' => array(),
		))->makeChildOf($newsview);
	}

}