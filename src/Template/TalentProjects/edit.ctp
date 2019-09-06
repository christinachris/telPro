<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TalentProject $talentProject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $talentProject->talent_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $talentProject->talent_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Talent Projects'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Talents'), ['controller' => 'Talents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent'), ['controller' => 'Talents', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="talentProjects form large-9 medium-8 columns content">
    <?= $this->Form->create($talentProject) ?>
    <fieldset>
        <legend><?= __('Edit Talent Project') ?></legend>
        <?php
            echo $this->Form->control('start_date');
            echo $this->Form->control('end_date', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
