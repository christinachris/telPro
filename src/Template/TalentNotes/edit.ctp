<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TalentNote $talentNote
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $talentNote->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $talentNote->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Talent Notes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Talents'), ['controller' => 'Talents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent'), ['controller' => 'Talents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="talentNotes form large-9 medium-8 columns content">
    <?= $this->Form->create($talentNote) ?>
    <fieldset>
        <legend><?= __('Edit Talent Note') ?></legend>
        <?php
            echo $this->Form->control('created_date');
            echo $this->Form->control('content');
            echo $this->Form->control('edited_date', ['empty' => true]);
            echo $this->Form->control('if_flag');
            echo $this->Form->control('talent_id', ['options' => $talents, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
