<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 */
class RequestsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event){
        parent::beforeFilter($event);

        //configure the login action to not require authentication, preventing
        //the 
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Requests->find()
            ->contain(['Users', 'Artists']);
        $requests = $this->paginate($query);

        $this->set(compact('requests'));
    }

    /**
     * View method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $request = $this->Requests->get($id, contain: ['Users', 'Artists']);
        $this->set(compact('request'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $request = $this->Requests->newEmptyEntity();
        $user = $this->request->getAttribute('identity');

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // 验证 album 时必须填 artist
            if ($data['type'] === 'album' && empty($data['artist_id'])) {
                $this->Flash->error(__('You must select an artist when requesting an album.'));
            } else {
                $request = $this->Requests->patchEntity($request, $data);

                if ($user) {
                    $request->user_id = $user->id;
                }

                $request->status = 'pending';

                if ($this->Requests->save($request)) {
                    $this->Flash->success(__('The request has been saved.'));
                    return $this->redirect(['controller' => 'Albums', 'action' => 'index']);
                }

                debug($request->getErrors());
                $this->Flash->error(__('The request could not be saved. Please, try again.'));
            }
        }

        $users = $this->Requests->Users->find('list', ['limit' => 200])->all();
        $artists = $this->Requests->Artists->find('list', ['limit' => 200])->all();

        $type = $this->request->getData('type') ?? $this->request->getQuery('type') ?? 'artist';
        $this->set(compact('request', 'users', 'artists', 'type'));

    }


    /**
     * Edit method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $request = $this->Requests->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $request = $this->Requests->patchEntity($request, $this->request->getData());
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request could not be saved. Please, try again.'));
        }
        $users = $this->Requests->Users->find('list', limit: 200)->all();
        $artists = $this->Requests->Artists->find('list', limit: 200)->all();
        $this->set(compact('request', 'users', 'artists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $request = $this->Requests->get($id);
        if ($this->Requests->delete($request)) {
            $this->Flash->success(__('The request has been deleted.'));
        } else {
            $this->Flash->error(__('The request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function post($id = null)
    {
        $this->request->allowMethod(['post']); // 只允许 POST 请求

        $request = $this->Requests->get($id, [
            'contain' => ['Users', 'Artists']
        ]);

        if ($request->status !== 'pending') {
            $this->Flash->error(__('This request has already been processed.'));
            return $this->redirect(['action' => 'index']);
        }

        // 根据类型处理添加逻辑
        if ($request->type === 'artist') {
            // 添加到 artists 表
            $artist = $this->Requests->Artists->newEmptyEntity();
            $artist->name = $request->name;
            $artist->url = $request->url;

            if ($this->Requests->Artists->save($artist)) {
                $this->Requests->delete($request);
                $this->Flash->success(__('Artist added and request approved.'));

            } else {
                $this->Flash->error(__('Failed to save artist.'));
            }

        } elseif ($request->type === 'album') {
            // 添加到 albums 表
            if (empty($request->artist_id)) {
                $this->Flash->error(__('Missing artist_id for album.'));
            } else {
                $album = $this->Requests->Artists->Albums->newEmptyEntity();
                $album->name = $request->name;
                $album->url = $request->url;
                $album->release_year = $request->release_year;
                $album->artist_id = $request->artist_id;

                if ($this->Requests->Artists->Albums->save($album)) {
                    $this->Requests->delete($request);
                    $this->Flash->success(__('Album added and request approved.'));

                } else {
                    $this->Flash->error(__('Failed to save album.'));
                }
            }
        }

        return $this->redirect(['action' => 'index']);
    }

}
