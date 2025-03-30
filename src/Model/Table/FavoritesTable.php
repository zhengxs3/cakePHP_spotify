<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Favorites Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ArtistsTable&\Cake\ORM\Association\BelongsTo $Artists
 * @property \App\Model\Table\AlbumsTable&\Cake\ORM\Association\BelongsTo $Albums
 *
 * @method \App\Model\Entity\Favorite newEmptyEntity()
 * @method \App\Model\Entity\Favorite newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Favorite> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Favorite get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Favorite findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Favorite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Favorite> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Favorite|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Favorite saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Favorite>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Favorite>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Favorite>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Favorite> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Favorite>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Favorite>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Favorite>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Favorite> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FavoritesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('favorites');
        $this->setDisplayField('type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('Albums', [
            'foreignKey' => 'album_id',
            'joinType' => 'LEFT',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('artist_id')
            ->allowEmptyString('artist_id'); // ✅
        
        $validator
            ->integer('album_id')
            ->allowEmptyString('album_id'); // ✅
        

        $validator
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['artist_id'], 'Artists'), ['errorField' => 'artist_id']);
        $rules->add($rules->existsIn(['album_id'], 'Albums'), ['errorField' => 'album_id']);

        return $rules;
    }
}
