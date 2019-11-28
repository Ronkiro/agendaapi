<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContatoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContatoTable Test Case
 */
class ContatoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ContatoTable
     */
    public $Contato;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Contato'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Contato') ? [] : ['className' => ContatoTable::class];
        $this->Contato = TableRegistry::getTableLocator()->get('Contato', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Contato);

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
