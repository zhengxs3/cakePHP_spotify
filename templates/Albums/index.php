<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Album> $albums
 */
?>
<div class="albums index content">
    <?= $this->Html->link(__('New Album'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Albums') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('release_year') ?></th>
                    <th><?= $this->Paginator->sort('artist_id') ?></th>
                    <th><?= $this->Paginator->sort('url') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($albums as $album): ?>
                <tr>
                    <td><?= $this->Number->format($album->id) ?></td>
                    <td><?= h($album->created) ?></td>
                    <td><?= h($album->modified) ?></td>
                    <td><?= h($album->name) ?></td>
                    <td><?= h($album->release_year) ?></td>
                    <td><?= $album->hasValue('artist') ? $this->Html->link($album->artist->name, ['controller' => 'Artists', 'action' => 'view', $album->artist->id]) : '' ?></td>
                    <td><?= h($album->url) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $album->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $album->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $album->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $album->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>