<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request $request
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Request'), ['action' => 'edit', $request->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Request'), ['action' => 'delete', $request->id], ['confirm' => __('Are you sure you want to delete # {0}?', $request->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Requests'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Request'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="requests view content">
            <h3><?= h($request->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $request->hasValue('user') ? $this->Html->link($request->user->username, ['controller' => 'Users', 'action' => 'view', $request->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($request->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($request->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Artist') ?></th>
                    <td><?= $request->hasValue('artist') ? $this->Html->link($request->artist->name, ['controller' => 'Artists', 'action' => 'view', $request->artist->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Url') ?></th>
                    <td><?= h($request->url) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($request->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($request->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Release Year') ?></th>
                    <td><?= h($request->release_year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($request->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($request->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>