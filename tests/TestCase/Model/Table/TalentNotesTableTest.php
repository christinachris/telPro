<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TalentNotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TalentNotesTable Test Case
 */
class TalentNotesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TalentNotesTable
     */
    public $TalentNotes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TalentNotes',
        'app.Talents'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TalentNotes') ? [] : ['className' => TalentNotesTable::class];
        $this->TalentNotes = TableRegistry::getTableLocator()->get('TalentNotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TalentNotes);

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
