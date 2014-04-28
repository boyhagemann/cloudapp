<?php

class NodeTableSeeder extends Seeder {

	public function run()
	{		
        $layout = Node::create(array(
            'id' => 1,
            'page_id' => 1,
			'variable' => '',
            'resource' => '12345layout',
			'cache' => 1,
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
			'cache' => 1,
			'params' => array(
				'title' => 'Test title 2',
			),
		))->makeChildOf($layout);

		$newsdata = Node::create(array(
			'id' => 3,
			'variable' => 'news',
			'page_id' => 1,
			'resource' => '9IAH54IX',
			'cache' => 1,
			'params' => array(),
		))->makeChildOf($newsview);

		$form = Node::create(array(
			'id' => 4,
			'variable' => 'sidebar',
			'page_id' => 1,
			'resource' => '12345form',
			'cache' => 1,
			'params' => array(
				'title' => 'Create news',
				'action' => 'http://localhost/cloudapp/public/news/create',
				'method' => 'post',
			)
		))->makeChildOf($layout);

		$newscreate = Node::create(array(
			'id' => 5,
			'variable' => 'config',
			'page_id' => 1,
			'resource' => '12345newscreatecontract',
			'cache' => 1,
			'params' => array(),
		))->makeChildOf($form);


		$text = Node::create(array(
			'id' => 6,
			'variable' => 'sidebar',
			'page_id' => 1,
			'resource' => '12345text',
			'cache' => 1,
			'params' => array(
				'text' => 'Hellllooo',
			)
		))->makeChildOf($layout);


		$store = Node::create(array(
			'id' => 7,
			'page_id' => 2,
			'variable' => '',
			'resource' => '12345newsstore',
			'cache' => 1,
			'params' => array(),
		));

	}

}