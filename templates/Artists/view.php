<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Artist $artist
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Artist'), ['action' => 'edit', $artist->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Artist'), ['action' => 'delete', $artist->id], ['confirm' => __('Are you sure you want to delete # {0}?', $artist->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Artists'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Artist'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="artists view content">
            <h3><?= h($artist->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($artist->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Url') ?></th>
                    <td><?= h($artist->url) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($artist->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($artist->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($artist->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Albums') ?></h4>
                <?php if (!empty($artist->albums)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Release Year') ?></th>
                            <th><?= __('Artist Id') ?></th>
                            <th><?= __('Url') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($artist->albums as $album) : ?>
                        <tr>
                            <td><?= h($album->id) ?></td>
                            <td><?= h($album->created) ?></td>
                            <td><?= h($album->modified) ?></td>
                            <td><?= h($album->name) ?></td>
                            <td><?= h($album->release_year) ?></td>
                            <td><?= h($album->artist_id) ?></td>
                            <td><?= h($album->url) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Albums', 'action' => 'view', $album->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Albums', 'action' => 'edit', $album->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Albums', 'action' => 'delete', $album->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $album->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Favorites') ?></h4>
                <?php if (!empty($artist->favorites)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Artist Id') ?></th>
                            <th><?= __('Album Id') ?></th>
                            <th><?= __('Type') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($artist->favorites as $favorite) : ?>
                        <tr>
                            <td><?= h($favorite->id) ?></td>
                            <td><?= h($favorite->created) ?></td>
                            <td><?= h($favorite->modified) ?></td>
                            <td><?= h($favorite->user_id) ?></td>
                            <td><?= h($favorite->artist_id) ?></td>
                            <td><?= h($favorite->album_id) ?></td>
                            <td><?= h($favorite->type) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Favorites', 'action' => 'view', $favorite->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Favorites', 'action' => 'edit', $favorite->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Favorites', 'action' => 'delete', $favorite->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $favorite->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Requests') ?></h4>
                <?php if (!empty($artist->requests)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Release Year') ?></th>
                            <th><?= __('Artist Id') ?></th>
                            <th><?= __('Url') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($artist->requests as $request) : ?>
                        <tr>
                            <td><?= h($request->id) ?></td>
                            <td><?= h($request->user_id) ?></td>
                            <td><?= h($request->type) ?></td>
                            <td><?= h($request->name) ?></td>
                            <td><?= h($request->release_year) ?></td>
                            <td><?= h($request->artist_id) ?></td>
                            <td><?= h($request->url) ?></td>
                            <td><?= h($request->status) ?></td>
                            <td><?= h($request->created) ?></td>
                            <td><?= h($request->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Requests', 'action' => 'view', $request->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Requests', 'action' => 'edit', $request->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Requests', 'action' => 'delete', $request->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $request->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>