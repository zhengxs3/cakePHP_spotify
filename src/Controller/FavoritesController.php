<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Favorites Controller
 *
 * @property \App\Model\Table\FavoritesTable $Favorites
 */
class FavoritesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
{
    $userId = $this->request->getAttribute('identity')->id ?? 1;

    $query = $this->Favorites->find()
        ->where(['Favorites.user_id' => $userId])
        ->contain(['Users', 'Artists', 'Albums']);

    $favorites = $this->paginate($query);
    $this->set(compact('favorites'));
}

    /**
     * View method
     *
     * @param string|null $id Favorite id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $favorite = $this->Favorites->get($id, contain: ['Users', 'Artists', 'Albums']);
        $this->set(compact('favorite'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $favorite = $this->Favorites->newEmptyEntity();
        if ($this->request->is('post')) {
            $favorite = $this->Favorites->patchEntity($favorite, $this->request->getData());
            if ($this->Favorites->save($favorite)) {
                $this->Flash->success(__('The favorite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The favorite could not be saved. Please, try again.'));
        }
        $users = $this->Favorites->Users->find('list', limit: 200)->all();
        $artists = $this->Favorites->Artists->find('list', limit: 200)->all();
        $albums = $this->Favorites->Albums->find('list', limit: 200)->all();
        $this->set(compact('favorite', 'users', 'artists', 'albums'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Favorite id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $favorite = $this->Favorites->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $favorite = $this->Favorites->patchEntity($favorite, $this->request->getData());
            if ($this->Favorites->save($favorite)) {
                $this->Flash->success(__('The favorite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The favorite could not be saved. Please, try again.'));
        }
        $users = $this->Favorites->Users->find('list', limit: 200)->all();
        $artists = $this->Favorites->Artists->find('list', limit: 200)->all();
        $albums = $this->Favorites->Albums->find('list', limit: 200)->all();
        $this->set(compact('favorite', 'users', 'artists', 'albums'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Favorite id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $favorite = $this->Favorites->get($id);
        if ($this->Favorites->delete($favorite)) {
            $this->Flash->success(__('The favorite has been deleted.'));
        } else {
            $this->Flash->error(__('The favorite could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function statistiques()
    {
        // Top 5 albums les plus favoris
        $topAlbums = $this->Favorites->find()
            ->select(['album_id', 'count' => 'COUNT(*)'])
            ->where(['type' => 'album'])
            ->group('album_id')
            ->order(['count' => 'DESC'])
            ->limit(5)
            ->contain(['Albums']);
    
        // Bottom 5 albums les moins favoris
        $flopAlbums = $this->Favorites->find()
            ->select(['album_id', 'count' => 'COUNT(*)'])
            ->where(['type' => 'album'])
            ->group('album_id')
            ->order(['count' => 'ASC'])
            ->limit(5)
            ->contain(['Albums']);
    
        // Top 5 utilisateurs avec le plus de favoris
        $topUsers = $this->Favorites->find()
            ->select(['user_id', 'count' => 'COUNT(*)'])
            ->where(['type' => 'album'])
            ->group('user_id')
            ->order(['count' => 'DESC'])
            ->limit(5)
            ->contain(['Users']);


            // debug($topAlbums);
            // debug($flopAlbums);
            // debug($topUsers);
            
        $this->set(compact('topAlbums', 'flopAlbums', 'topUsers'));
    }
    


}
