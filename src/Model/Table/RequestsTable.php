<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Requests Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ArtistsTable&\Cake\ORM\Association\BelongsTo $Artists
 *
 * @method \App\Model\Entity\Request newEmptyEntity()
 * @method \App\Model\Entity\Request newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Request> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Request get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Request findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Request patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Request> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Request|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Request saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Request>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Request>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Request>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Request> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Request>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Request>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Request>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Request> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RequestsTable extends Table
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

        $this->setTable('requests');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
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
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->date('release_year')
            ->allowEmptyDate('release_year');

        $validator
            ->integer('artist_id')
            ->allowEmptyString('artist_id');

        $validator
            ->scalar('url')
            ->maxLength('url', 250)
            ->requirePresence('url', 'create')
            ->notEmptyString('url');

        $validator
            ->scalar('status')
            ->allowEmptyString('status');

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

        return $rules;
    }
}
