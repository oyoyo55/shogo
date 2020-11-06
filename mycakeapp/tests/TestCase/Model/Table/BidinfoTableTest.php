<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BidinfoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BidinfoTable Test Case
 */
class BidinfoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BidinfoTable
     */
    public $Bidinfo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bidinfo',
        'app.biditems',
        'app.users',
        'app.bidmessages',
        'app.bidrequests'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Bidinfo') ? [] : ['className' => BidinfoTable::class];
        $this->Bidinfo = TableRegistry::get('Bidinfo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bidinfo);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
