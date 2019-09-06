<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');
    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
       <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?= $this->element('auto_table_warning') ?>
<?php
if (extension_loaded('xdebug')) :
    xdebug_print_function_stack();
endif;

$this->end();
endif;
?>
<!--<h2>--><?//= h($message) ?><!--</h2>-->
<!--<p class="error" >-->
<!--    <strong>--><?//= __d('cake', 'Error') ?><!--: </strong>-->
<!--   <?//= __d('cake', 'The requested address {0} was not found on this server.', "<strong>'{$url}'</strong>") ?> -->
<!--</p>-->
<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v3" style="background-image: url(<?= $this->Url->image('error-3.jpg') ?>); ">
        <div class="kt-error_container">
		<span class="kt-error_number">
			<h1>404</h1>
		</span>
            <p class="kt-error_title kt-font-light">
                How did you get here
            </p>
            <p class="kt-error_subtitle">
                Sorry we can't seem to find the page you're looking for.
            </p>
            <p class="kt-error_description">
                There may be amisspelling in the URL entered,<br>
                or the page you are looking for may no longer exist.
            </p>
        </div>
    </div>	</div>

<!-- end:: Page -->
