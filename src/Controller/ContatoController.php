<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\MethodNotAllowedException;

/**
 * Contato Controller
 *
 * @property \App\Model\Table\ContatoTable $Contato
 *
 * @method \App\Model\Entity\Contato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContatoController extends AppController
{
    public $paginate = [
        'limit' => 5,
        'order' => [
            'Contato.id' => 'asc'
        ]
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $contato = $this->paginate($this->Contato);

        // $this->set(compact('contato'));

        $this->set([
            'contato' => $contato,
            '_serialize' => ['contato']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Contato id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contato = $this->Contato->get($id, [
            'contain' => []
        ]);

        $this->set([
            'contato' => $contato,
            '_serialize' => ['contato']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contato = $this->Contato->newEntity();
        $message = "";
        if ($this->request->is('post')) {
            $contato = $this->Contato->patchEntity($contato, $this->request->getData());
            if ($this->Contato->save($contato)) {
                $message = "O contato foi salvo";
            }
            else {
                debug($contato->getErrors());
                $message = "Erro ao salvar o contato.";
            }
        }
        $this->set([
            'message' => $message,
            'contato' => $contato,
            '_serialize' => ['message', 'contato']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contato id.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contato = $this->Contato->get($id, [
            'contain' => []
        ]);
        
        if (json_encode($this->request->getData()) == "[]"){
            throw new BadRequestException(__("Dados inválidos."));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $contato = $this->Contato->patchEntity($contato, $this->request->getData());
            if ($this->Contato->save($contato)) {
                $message = "Alterações realizadas com sucesso.";
            }
            else {
                throw new BadRequestException(__("Ocorreu um erro ao salvar o contato."));
            }
        }
        else {
            throw new MethodNotAllowedException(__("Método não permitido."));
        }
        $this->set([
            'message' => $message,
            'contato' => $contato,
            '_serialize' => ['message', 'contato']
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contato id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contato = $this->Contato->get($id);
        if ($this->Contato->delete($contato)) {
            $message = "Contato {$id} deletado com sucesso!";
        } else {
            throw new BadRequestException("Ocorreu um erro ao deletar o contato.");
        }

        $this->set([
            'message' => $message,
            'contato' => $contato,
            '_serialize' => ['message', 'contato']
        ]);
    }
}
