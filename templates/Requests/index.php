<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Request> $requests
 */
?>
<div class="requests index content">
    <?= $this->Html->link(__('New Request'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Requests') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('release_year') ?></th>
                    <th><?= $this->Paginator->sort('artist_id') ?></th>
                    <th><?= $this->Paginator->sort('url') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requests as $request): ?>
                <tr>
                    <td><?= $this->Number->format($request->id) ?></td>
                    <td><?= $request->hasValue('user') ? $this->Html->link($request->user->username, ['controller' => 'Users', 'action' => 'view', $request->user->id]) : '' ?></td>
                    <td><?= h($request->type) ?></td>
                    <td><?= h($request->name) ?></td>
                    <td><?= h($request->release_year) ?></td>
                    <td><?= $request->hasValue('artist') ? $this->Html->link($request->artist->name, ['controller' => 'Artists', 'action' => 'view', $request->artist->id]) : '' ?></td>
                    <td>
                        <iframe src="<?= h($request->url) ?>" width="270" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                    </td>
                    <td><?= $this->Form->postLink(
                            __('Yes'),
                            ['action' => 'post', $request->id],
                            [
                                'method' => 'post',
                                'confirm' => __('Are you sure you want to add # {0}?', $request->id),
                                'class' => 'button'
                            ]
                        ) ?>
                        <?= $this->Form->postLink(
                            __('No'),
                            ['action' => 'delete', $request->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $request->id),
                                'class' => 'button'
                            ]
                        ) ?>
                    </td>

                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $request->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $request->id]) ?>
                        
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