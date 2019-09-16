<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MentionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MentionsTable Test Case
 */
class MentionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MentionsTable
     */
    public $Mentions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Mentions',
        'app.Talents',
        'app.Projects',
        'app.Tasks',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Mentions') ? [] : ['className' => MentionsTable::class];
        $this->Mentions = TableRegistry::getTableLocator()->get('Mentions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Mentions);

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
