<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Albums Controller
 *
 * @property \App\Model\Table\AlbumsTable $Albums
 */
class AlbumsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index(): void
    {
        $query = $this->Albums->find()
            ->contain(['Artists']);
        $albums = $this->paginate($query);

        $userId = $this->request->getAttribute('identity')->id ?? 1;

        $favoritesTable = $this->fetchTable('Favorites');

        $favoriteAlbumIds = $favoritesTable->find()
            ->select(['album_id'])
            ->where(['user_id' => $userId, 'type' => 'album'])
            ->all()                     // 把查询结果转成集合 Collection
            ->extract('album_id')       // 提取字段
            ->toList();                 // 转为普通 array（或者用 toArray() 也行）


        $this->set(compact('albums', 'favoriteAlbumIds'));
    }


    /**
     * View method
     *
     * @param string|null $id Album id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $album = $this->Albums->get($id, contain: ['Artists', 'Favorites']);
        $this->set(compact('album'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $album = $this->Albums->newEmptyEntity();
        if ($this->request->is('post')) {
            $album = $this->Albums->patchEntity($album, $this->request->getData());
            if ($this->Albums->save($album)) {
                $this->Flash->success(__('The album has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The album could not be saved. Please, try again.'));
        }
        $artists = $this->Albums->Artists->find('list', limit: 200)->all();
        $this->set(compact('album', 'artists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Album id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $album = $this->Albums->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $album = $this->Albums->patchEntity($album, $this->request->getData());
            if ($this->Albums->save($album)) {
                $this->Flash->success(__('The album has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The album could not be saved. Please, try again.'));
        }
        $artists = $this->Albums->Artists->find('list', limit: 200)->all();
        $this->set(compact('album', 'artists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Album id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $album = $this->Albums->get($id);
        if ($this->Albums->delete($album)) {
            $this->Flash->success(__('The album has been deleted.'));
        } else {
            $this->Flash->error(__('The album could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function favorites(): void
    {
        $userId = $this->request->getAttribute('identity')->id ?? 1;
        $favoritesTable = $this->fetchTable('Favorites');

        $favoriteAlbumIds = $favoritesTable->find()
            ->select(['album_id'])
            ->where(['user_id' => $userId, 'type' => 'album'])
            ->all()                     // 把查询结果转成集合 Collection
            ->extract('album_id')       // 提取字段
            ->toList();                 // 转为普通 array（或者用 toArray() 也行）


        $albums = empty($albumIds) ? [] : $this->Albums->find()
            ->contain(['Artists'])
            ->where(['Albums.id IN' => $albumIds])
            ->all();

        $this->set(compact('albums', 'albumIds'));
    }

    public function toggleFavorite($albumId = null)
    {
        $this->request->allowMethod(['post']);
        $userId = $this->request->getAttribute('identity')->id ?? 1;

        $favoritesTable = $this->fetchTable('Favorites');

        $favorite = $favoritesTable->find()
            ->where(['user_id' => $userId, 'album_id' => $albumId, 'type' => 'album'])
            ->first();

        if ($favorite) {
            $favoritesTable->delete($favorite);
            $this->Flash->success(__('Album removed from favorites.'));
        } else {
            $favorite = $favoritesTable->newEntity([
                'user_id' => $userId,
                'album_id' => $albumId,
                'type' => 'album',
            ]);
            if ($favoritesTable->save($favorite)) {
                $this->Flash->success(__('Album added to favorites.'));
            } else {
                $this->Flash->error(__('Failed to add favorite.'));
            }
        }

        return $this->redirect($this->referer());
    }


}
