<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientNote[]|\Cake\Collection\CollectionInterface $clientNotes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Client Note'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clientNotes index large-9 medium-8 columns content">
    <h3><?= __('Client Notes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('create_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('content') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edit_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('client_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientNotes as $clientNote): ?>
            <tr>
                <td><?= $this->Number->format($clientNote->id) ?></td>
                <td><?= h($clientNote->create_date) ?></td>
                <td><?= h($clientNote->content) ?></td>
                <td><?= h($clientNote->edit_date) ?></td>
                <td><?= h($clientNote->id_flag) ?></td>
                <td><?= $clientNote->has('client') ? $this->Html->link($clientNote->client->id, ['controller' => 'Clients', 'action' => 'view', $clientNote->client->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $clientNote->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $clientNote->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clientNote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientNote->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
