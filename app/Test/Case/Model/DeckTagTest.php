<?php
App::uses('DeckTag', 'Model');

/**
 * DeckTag Test Case
 *
 */
class DeckTagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.deck_tag',
		'app.deck',
		'app.tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DeckTag = ClassRegistry::init('DeckTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DeckTag);

		parent::tearDown();
	}

}
