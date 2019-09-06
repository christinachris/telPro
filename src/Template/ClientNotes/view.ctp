<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClientNote $clientNote
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Client Note'), ['action' => 'edit', $clientNote->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Client Note'), ['action' => 'delete', $clientNote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientNote->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Client Notes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client Note'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clientNotes view large-9 medium-8 columns content">
    <h3><?= h($clientNote->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Content') ?></th>
            <td><?= h($clientNote->content) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Client') ?></th>
            <td><?= $clientNote->has('client') ? $this->Html->link($clientNote->client->id, ['controller' => 'Clients', 'action' => 'view', $clientNote->client->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($clientNote->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Create Date') ?></th>
            <td><?= h($clientNote->create_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edit Date') ?></th>
            <td><?= h($clientNote->edit_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Flag') ?></th>
            <td><?= $clientNote->id_flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
