<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TalentProjectsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TalentProjectsTable Test Case
 */
class TalentProjectsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TalentProjectsTable
     */
    public $TalentProjects;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TalentProjects',
        'app.Talents',
        'app.Projects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TalentProjects') ? [] : ['className' => TalentProjectsTable::class];
        $this->TalentProjects = TableRegistry::getTableLocator()->get('TalentProjects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TalentProjects);

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
