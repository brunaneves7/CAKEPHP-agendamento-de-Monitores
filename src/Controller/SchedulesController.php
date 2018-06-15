<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * Schedules Controller
 *
 * @property \App\Model\Table\SchedulesTable $Schedules
 *
 * @method \App\Model\Entity\Schedule[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SchedulesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Students', 'Monitors']
        ];
        $schedules = $this->paginate($this->Schedules);

        $this->set(compact('schedules'));
    }

    /**
     * View method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => ['Students', 'Monitors']
        ]);

        $this->set('schedule', $schedule);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //if ($this->Auth->user('role')=== "student") {
            echo "dsfdsf";
        //}
        $schedule = $this->Schedules->newEntity();
        if ($this->request->is('post')) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->getData());
            $schedule->user_id=$this->Auth->user('id');
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('The schedule has been saved.'));
                $estudante = $this->Schedules->Students->get($schedule->id);
                $email = new Email('default');
        $email->from(['remetente@example.com' => 'Meu Site'])
            ->to("brunarafaellaneves@gmail.com")
            ->subject('Bem Vindo')
            ->send('Sua monitoria foi agendada com sucesso!');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schedule could not be saved. Please, try again.'));
        }
        $students = $this->Schedules->Students->find('list', ['limit' => 200]);
        $monitors = $this->Schedules->Monitors->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'students', 'monitors'));
        
        }
    /**
     * Edit method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->getData());
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('The schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schedule could not be saved. Please, try again.'));
        }
        $students = $this->Schedules->Students->find('list', ['limit' => 200]);
        $monitors = $this->Schedules->Monitors->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'students', 'monitors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schedule = $this->Schedules->get($id);
        if ($this->Schedules->delete($schedule)) {
            $this->Flash->success(__('The schedule has been deleted.'));
        } else {
            $this->Flash->error(__('The schedule could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
