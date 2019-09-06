<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TalentProject $talentProject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Talent Project'), ['action' => 'edit', $talentProject->talent_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Talent Project'), ['action' => 'delete', $talentProject->talent_id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentProject->talent_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Talent Projects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Project'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talents'), ['controller' => 'Talents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent'), ['controller' => 'Talents', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="talentProjects view large-9 medium-8 columns content">
    <h3><?= h($talentProject->talent_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Talent') ?></th>
            <td><?= $talentProject->has('talent') ? $this->Html->link($talentProject->talent->id, ['controller' => 'Talents', 'action' => 'view', $talentProject->talent->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $talentProject->has('project') ? $this->Html->link($talentProject->project->id, ['controller' => 'Projects', 'action' => 'view', $talentProject->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($talentProject->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($talentProject->end_date) ?></td>
        </tr>
    </table>
</div>
