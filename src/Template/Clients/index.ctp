<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task[]|\Cake\Collection\CollectionInterface $tasks
 */

use Cake\Datasource\ConnectionManager;
use Cake\I18n\I18n;
use Cake\I18n\Time;

//I18n::Locale('es-au');
// my_connection is defined in your database config
$conn = ConnectionManager::get('default');
?>
<div class="kt-header__bottom">
    <div class="kt-container">

        <!-- begin: Header Menu -->
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu">
                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"><a href=" <?php echo $this->Url->build(["controller" => "dashboard", "action" => "index"]); ?>" class="kt-menu__link ">
                            <span class="kt-menu__link-text">Dashboard </span></a></li>
                    <li class="kt-menu__item   " aria-haspopup="true"><a href=" <?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Projects </span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="<?php echo $this->Url->build(['controller'=>'Talents', 'action'=>'index'])?>" class="kt-menu__link "><span class="kt-menu__link-text">Talent</span></a></li>
                    <li class="kt-menu__item kt-menu__item--active kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="<?php echo $this->Url->build(['controller'=>'Clients', 'action'=>'index'])?>" class="kt-menu__link "><span class="kt-menu__link-text">Client</span></a></li>
                </ul>
            </div>
        </div>
        <!-- end: Header Menu -->
    </div>
</div>




<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
    <div class="kt-container kt-body  kt-grid kt-grid--ver" id="kt_body">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

            <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                <div class="kt-subheader__main">
                    <?= $this->Flash->render() ?>
                    <a href="<?php echo $this->Url->build(["controller" => "dashboard", "action" => "index"]); ?>"
                    <h3 class="kt-subheader__title">
                        Dashboard </h3>
                    </a>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                           <i class="flaticon2-shelter"></i>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                            Client List

                        <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <div class="btn kt-subheader__btn-daterange" title="Select dashboard daterange">
                            <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                            <span class="kt-subheader__btn-daterange-date"
                                  id="kt_dashboard_daterangepicker_date"><?php echo date("M d") ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                 height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24"/>
                                    <path
                                        d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z"
                                        id="check" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path
                                        d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z"
                                        id="Combined-Shape" fill="#000000"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-content kt-grid__item kt-grid__item--fluid">
                <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                    <div class="kt-portlet__body">

                        <!--begin: Selected Rows Group Action Form -->

                        <div class="kt-portlet kt-portlet--mobile">
                            <div class="kt-portlet__head kt-portlet__head--lg">
                                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="flaticon2-list-1"></i>
										</span>
                                    <h3 class="kt-portlet__head-title">
                                        Clients List
                                        <small>:</small>
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-wrapper">

                                        &nbsp;
                                        <div class="dropdown dropdown-inline">

                                            <?= $this->Html->link('<span class="btn btn-primary"><i class="flaticon2-plus"></i> Add Client</span>', ['controller' => 'Clients', 'action' => 'add', 'type' => 'button'], ['escape' => false]) ?>
                                            <?= $this->Html->link('<span class="btn btn-outline-primary"><i class="flaticon-eye"></i> View Archive</span>', ['controller' => 'Clients', 'action' => 'archiveIndex', 'type' => 'button'], ['escape' => false]) ?>


                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="kt-portlet__body">
                                <!--begin: Search Form -->
                                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                    <div class="row align-items-center">
                                        <div class="col-xl-8 order-2 order-xl-1">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                    <div class="kt-input-icon kt-input-icon--left">
                                                        <input type="text" class="form-control" placeholder="Search..."
                                                               id="generalSearch" onkeyup="Search()">
                                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
							<span><i class="la la-search"></i></span>
						</span>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                            <a href="#" class="btn btn-default kt-hidden">
                                                <i class="la la-cart-plus"></i> New Order
                                            </a>
                                            <div
                                                class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                                        </div>
                                    </div>


                                    <!--end: Search Form -->
                                </div>
                                <!--begin: Selected Rows Group Action Form -->


                                <!--end: Selected Rows Group Action Form -->
                            </div>
                            <div class="kt-portlet__body kt-portlet__body--fit">

                                <!--begin: Datatable -->
                                <div
                                    class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--scroll kt-datatable--loaded"
                                    id="server_record_selection" style="">
                                    <table class="table" id="myClientTable">
                                        <thead>
                                        <tr>
                                            <th style="width: 3%"><?= __('') ?></th>
                                            <th style="width: 14%"><?= __('Lifecycle Stage') ?></th>
                                            <th style="width: 10%"><?= $this->Paginator->sort('first_name', 'Full name') ?></th>
                                            <th style="width: 10%"><?= $this->Paginator->sort('preferred_name') ?></th>
                                            <th style="width: 10%"><?= $this->Paginator->sort('phone_no') ?></th>
                                            <th style="width: 18%"><?= $this->Paginator->sort('email') ?></th>
                                            <th style="width: 18%"><?= $this->Paginator->sort('contact_owner') ?></th>
                                            <th style="width: 18%"><?= $this->Paginator->sort('company_name') ?></th>
                                            <th style="width: 10%"><?= $this->Paginator->sort('Last Contacted Date') ?></th>
                                            <th style="width: 10%" class="actions"><?= __('Actions') ?></th>
                                            <th style="width: 10%"><?= __('Shortcuts') ?></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($clients as $client): ?>
                                            <tr>


                                                <td>
                                                    <?php $aaa=3;
                                                        foreach ($client->activities as $activities):
                                                        if ($activities->activity_flag==1):
                                                            $aaa=1;
                                                        endif;
                                                        endforeach;

                                                        foreach ($client->client_notes as $clientNotes):
                                                        if($clientNotes->client_note_flag==1):
                                                            $aaa=1;
                                                        endif;
                                                        endforeach;

                                                    ?>
                                                    <?php if ($aaa == 1): ?>

                                                        <i class="flaticon-bell" style="font-size:30px;width: 3%;color:indianred"></i>
                                                    <?php else: ?>
                                                        <?= h("") ?>
                                                    <?php endif; ?>


                                                </td>
                                                <td>

                                                    <?php if ($client->lifecycle_stage == 'Offer Sent'): ?>

                                                        <i class="flaticon-envelope" style="font-size:30px;width: 3%;color:#00e6b8" data-toggle="kt-popover" data-content="Offer Sent" data-placement='bottom'></i>
                                                    <?php endif; ?>
                                                    <?php if ($client->lifecycle_stage == 'Awaiting Payment'): ?>
                                                        <i class="flaticon2-list" style="font-size:30px;width: 3%;color:#00e6b8" data-toggle="kt-popover" data-content="Awaiting Payment" data-placement='bottom'></i>
                                                    <?php endif; ?>

                                                    <?php if ($client->lifecycle_stage == 'Offer Accepted'): ?>
                                                        <i class="flaticon2-notepad" style="font-size:30px;width: 3%;color:#00e6b8" data-toggle="kt-popover" data-content="Offer Accepted" data-placement='bottom'></i>

                                                    <?php endif; ?>
                                                    <?php if ($client->lifecycle_stage == 'Project In Progress'): ?>
                                                        <i class="flaticon2-chart" style="font-size:25px;width: 3%;color:#00e6b8" data-toggle="kt-popover" data-content="Project In Progress" data-placement='bottom'></i>
                                                    <?php endif; ?>
                                                    <?php if ($client->lifecycle_stage == 'Project Completed'): ?>
                                                    <i class="flaticon2-calendar-5" style="font-size:25px;width: 3%;font-weight: bold;color:#00e6b8" data-toggle="kt-popover" data-content="Project Completed" data-placement='bottom'></i>
                                                    <?php endif; ?>

                                                    <?php if ($client->lifecycle_stage == 'Potential Lead'): ?>
                                                        <i class="flaticon2-percentage" style="font-size:30px;width: 3%;color:#00e6b8" data-toggle="kt-popover" data-content="Potential Lead" data-placement='bottom'></i>

                                                    <?php endif; ?>

                                                    <?php if ($client->lifecycle_stage == 'Business Closed'): ?>
                                                        <i class="flaticon-customer" style="font-size:30px;width: 3%;color:#00e6b8" data-toggle="kt-popover" data-content="Business Closed" data-placement='bottom'></i>
                                                    <?php endif; ?>

                                                </td>
                                                <td><?= $this->Html->link(h($client->first_name) . ' ' . h($client->last_name), ['action' => 'view', $client->id]) ?></td>
                                                <td>
                                                    <?= h($client->preferred_name) ?>
                                                </td>
                                                <td>
                                                    <?= h($client->phone_no) ?>
                                                </td>
                                                <td>
                                                    <?= h($client->email) ?>
                                                </td>
                                                <td>
                                                    <?php if($client->contact_owner_id){ ?>
                                                        <?= h($client->talent->first_name).' '. h($client->talent->last_name) ?>
                                                    <?php } ?>

                                                </td>
                                                <td>
                                                    <?= h($client->company_name) ?>
                                                </td>

                                                <td>
                                                    <?php if($client->last_contactdate){ ?>
                                                    <?= h($client->last_contactdate->i18nFormat('dd/MM/yyyy')) ?>
                                                    <?php }; ?>
                                                </td>


                                                <td class="kt-datatable__cell--left kt-datatable__cell" data-field="Actions" data-autohide-disabled="false">
                                                    <a>
                                                        <!--<?= $this->Html->link('<span class="btn btn-sm btn-clean btn-icon btn-icon-sm" style="margin-left:-5%"><i class="flaticon2-note"></i></span>', ['action' => 'edit', $client->id],['escape' => false,'data-toggle'=>"kt-popover",'data-content'=>"Edit Client",'data-placement'=>'bottom']) ?>-->
                                                    </a>
                                                    <a >
                                                        <?= $this->Html->link('<span class="btn btn-sm btn-clean btn-icon btn-icon-sm" ><i class="flaticon2-note" style="padding : 5px ; font-size: 20px"></i></span>', ['action' => 'edit', $client->id],['escape' => false,'data-toggle'=>"kt-popover",'data-content'=>"Edit Client",'data-placement'=>'bottom']) ?>




                                                        <!-- <?= $this->Form->postLink(' ', [ 'action' => 'archive', $client->id],['confirm' => __('Are you sure you want to archive this client?'),'class'=>"flaticon-symbol", 'data-toggle'=>"kt-popover",'data-content'=>"Archive Client",'data-placement'=>'bottom'], ['confirm' => __('Are you sure you want to ARCHIVE this client', $client->first_name.' '.$client->last_name)]) ?>-->

                                                        <!--<?= $this->Html->link('<span class= "btn btn-sm btn-clean btn-icon btn-icon-sm" ><i class="flaticon-symbol" style="padding : 5px ; font-size: 20px" ></i></span>', [ 'action' => 'archive', $client->id], ['confirm' => __('Are you sure you want to delete {0}?', $client->first_name.' '.$client->last_name), 'action' => 'archive', $client->id]) ?> -->
                                                        <!--<?= $this->Form->Postlink('', ['action' => 'archive', $client->id], ['confirm' => __('Are you sure you want to archive {0}?', $client->first_name.' '.$client->last_name), 'class' => "la la-archive",'style' => 'padding : 5px ; font-size: 20px', 'data-toggle' => "kt-popover", 'data-content' => "Archive Client", 'data-placement' => 'bottom']) ?>-->
                                                        <?= $this->Form->postLink(' ', ['action' => 'archive', $client->id], ['confirm' => __('Are you sure you want to archive this client?'), 'class' => "btn btn-lg btn-clean  la la-archive",'style' => ' color:red; padding : 5px ; font-size: 25px', 'data-toggle' => "kt-popover", 'data-content' => "Archive Client", 'data-placement' => 'bottom'], ['confirm' => __('Are you sure you want to delete {0}?',  $client->first_name.' '.$client->last_name)]) ?>



                                                        <!--<?= $this->Html->link('<span class="btn btn-sm btn-clean btn-icon btn-icon-sm" style="margin-left:-5%"><i class="flaticon2-note"></i></span>', ['action' => 'edit', $client->id],['escape' => false,'data-toggle'=>"kt-popover",'data-content'=>"Edit Client",'data-placement'=>'bottom']) ?>-->
                                                        <!--<?= $this->Html->link('', [ 'action' => 'archive', $client->id],['confirm' => __('Are you sure you want to archive this client?'), 'class'=>"flaticon-symbol", 'data-content'=>"Archive Talent",'data-placement'=>'top']) ?>-->


                                                    </a>

                                                </td>
                                                <td class="actions">
                                                    <button type="button"
                                                            class="get-credential btn btn-sm btn-clean btn-icon btn-icon-sm"
                                                            style="margin-left:-5%" data-toggle="modal" data-target="#kt_modal_6"
                                                            data-id="<?php echo $client->credential ?>"><i class="flaticon-medal" style=" font-size: 19px;"
                                                                                                           data-toggle="kt-popover"
                                                                                                           data-content="View Credential"
                                                                                                           data-placement='bottom'></i>
                                                    </button>
                                                    <button type="button" class="addActivity btn btn-sm btn-clean btn-icon btn-icon-sm"
                                                            data-toggle="modal" data-target="#kt_modal_7"
                                                            data-addA-id="<?php echo $client->id ?>"><i class="flaticon2-calendar-6 " style=" font-size: 18px;"
                                                                                                        data-toggle="kt-popover"
                                                                                                        data-content="Add New Activity"
                                                                                                        data-placement='bottom'></i>
                                                    </button>
                                                    <button type="button" class="addNote btn btn-sm btn-clean btn-icon btn-icon-sm"
                                                            data-toggle="modal" data-target="#addNote"
                                                            data-add-id="<?php echo $client->id ?>"><i class="flaticon-notes" style=" font-size: 20px;"
                                                                                                       data-toggle="kt-popover"
                                                                                                       data-content="Add New Note"
                                                                                                       data-placement='bottom'></i>
                                                    </button>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>


                                        </tbody>
                                    </table>


                                    <!--begin::Modal-->
                                    <div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Credentials</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <span id="idHolder"></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Modal-->
                                    <!-- add note modal-->
                                    <div class="modal fade" id="addNote" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content" style="width:500%">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Note</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                                        <span>
                                                                            <?= $this->Form->create(null, ['type' => 'post']) ?>
                                                                            <fieldset>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-4">
                                                                                                <?php echo $this->Form->hidden('client_id', ['class' => 'form-control', 'type' => 'textarea', 'id' => 'client_id']); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-12">
                                                                                                <?php echo $this->Form->control('content', ['class' => 'form-control', 'id' => 'content', 'maxlength' => "500", 'type' => 'textarea', "onkeyup" => "testWordLimit()", 'placeholder' => 'Please enter a note','label'=>false]); ?>
                                                                                                <span id="wordLimit"
                                                                                                      style="font-size:15px"></span>
                                                                                                <div
                                                                                                    class="kt-input-icon">
                                                                                                    <span
                                                                                                        class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                            </fieldset>
                                                                            <div class="modal-footer">
                                                                                    <?= $this->Form->button('Submit', ['class' => 'btn btn-success']) ?>
                                                                                    <?= $this->Form->end() ?>
                                                                                    <?php echo $this->Html->link('Cancel',
                                                                                        array(
                                                                                            'type' => 'button'),
                                                                                        array('class' => 'btn btn-secondary', 'data-dismiss' => 'modal',))
                                                                                    ?>
                                                                                </div>

                                                                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- end add note modal-->


                                    <!--begin::Modal-->
                                    <div class="modal fade" id="kt_modal_7" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content" style="width:500%">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Activity</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                                        <span>
                                                                            <?= $this->Form->create(null, ['type' => 'post']) ?>
                                                                            <fieldset>


                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-4">
                                                                                                <?php echo $this->Form->control('type', ['class' => 'form-control', 'empty' => '--select--', 'options' => array('' => '', 'Potential Lead' => 'Potential Lead','Offer Sent' => 'Offer Sent', 'Offer Accepted' => 'Offer Accepted','Project In Progress' => 'Project In Progress','Project Completed' => 'Project Completed ','Awaiting Payment' => 'Awaiting Payment', 'Business Closed' => 'Business Closed')]); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-4">
                                                                                                <?php echo $this->Form->hidden('client_id', ['class' => 'form-control', 'type' => 'textarea', 'id' => 'client_note_id']); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-12">
                                                                                                <?php echo $this->Form->control('summary', ['class' => 'form-control', 'type' => 'textarea', 'placeholder' => 'Please enter a summary', 'label'=>false]); ?>
                                                                                                <div
                                                                                                    class="kt-input-icon">
                                                                                                    <span
                                                                                                        class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-6">
                                                                                                <?php echo $this->Form->control('date', ['type' => 'date', 'label' => 'Event Date', 'class' => 'form-control', 'id' => 'exampleSelect1']); ?>
                                                                                                <div
                                                                                                    class="kt-input-icon">
                                                                                                    <span
                                                                                                        class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <?php echo $this->Form->control('time', ['type' => 'time', 'label' => 'Event Time', 'class' => 'form-control', 'id' => 'exampleSelect1']); ?>
                                                                                                <div
                                                                                                    class="kt-input-icon">
                                                                                                    <div
                                                                                                        class="kt-input-icon">
                                                                                                        <span
                                                                                                            class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>

                                                                                        </div>



                                                                            </fieldset>
                                                                            <div class="modal-footer">
                                                                                    <?= $this->Form->button('Submit', ['class' => 'btn btn-success']) ?>
                                                                                    <?= $this->Form->end() ?>
                                                                                    <?php echo $this->Html->link('Cancel',
                                                                                        array(
                                                                                            'type' => 'button'),
                                                                                        array('class' => 'btn btn-secondary', 'data-dismiss' => 'modal',))
                                                                                    ?>
                                                                                </div>

                                                                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <!--end::Modal-->
                                    <div class="paginator kt-datatable__pager kt-datatable--paging-loaded">
                                        <ul class="pagination kt-datatable__pager-nav">
                                            <li>
                                                <?= $this->Paginator->first('<i class="flaticon2-fast-back"></i>', ['escape' => false]) ?></li>
                                            <li>
                                                <?= $this->Paginator->prev('<i class="flaticon2-back"></i>', ['escape' => false, 'class' => 'form-control']) ?></li>
                                            <li style="display: none;"><input type="text" class="kt-pager-input form-control"
                                                                              title="Page number">
                                                <?= $this->Paginator->numbers() ?></li>

                                            <li>
                                                <?= $this->Paginator->next('<i class="flaticon2-next"></i>', ['escape' => false]) ?>
                                            </li>
                                            <?= $this->Paginator->last('<i class="flaticon2-fast-next"></i>', ['escape' => false]) ?>
                                        </ul>
                                        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--this js file is requied for shortcut function-->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


                <script>
                    function flag() {
                        return false;
                    }
                </script>
                <script>
                    $(document).on("click", ".addActivity", function () {
                        var clientIdd = $(this).attr('data-addA-id');
                        if (clientIdd !== "") {
                            $('#client_note_id').val(clientIdd);
                            $('#kt_modal_7').modal('show');
                        }

                    });


                </script>
                <script>
                    function testWordLimit() {
                        var input = document.getElementById("content");
                        var num = input.value.toString().length;
                        var text = "word limited:";
                        $('#wordLimit').val(text);


                    }
                </script>
                <script>
                    $(document).on("click", ".addNote", function () {
                        var clientId = $(this).attr('data-add-id');
                        if (clientId !== "") {
                            $('#client_id').val(clientId);
                            $('#addNote').modal('show');
                            $('#content').keyup(function () {
                                var input = document.getElementById("content");
                                input.value = input.value.replace(/([#0-9]\u20E3)|[\xA9\xAE\u203C\u2047-\u2049\u2122\u2139\u3030\u303D\u3297\u3299][\uFE00-\uFEFF]?|[\u2190-\u21FF][\uFE00-\uFEFF]?|[\u2300-\u23FF][\uFE00-\uFEFF]?|[\u2460-\u24FF][\uFE00-\uFEFF]?|[\u25A0-\u25FF][\uFE00-\uFEFF]?|[\u2600-\u27BF][\uFE00-\uFEFF]?|[\u2900-\u297F][\uFE00-\uFEFF]?|[\u2B00-\u2BF0][\uFE00-\uFEFF]?|(?:\uD83C[\uDC00-\uDFFF]|\uD83D[\uDC00-\uDEFF])[\uFE00-\uFEFF]?|[\u20E3]|[\u26A0-\u3000]|\uD83E[\udd00-\uddff]|[\u00A0-\u269F]/g, '');

                                $('#content').val(input.value);
                                var num = input.value.toString().length;
                                var text = "word limited: " + num + "/500";
                                $('#wordLimit').html(text);


                            })
                        }

                    });


                </script>

                <script>
                    $(document).on("click", ".get-credential", function () {
                        var eventId = $(this).data('id');
                        $('#idHolder').html(eventId);
                    });
                </script>

                <script>
                    function Search() {
                        // Declare variables
                        var input, filter, table, tr, td, i, txtValue, j;
                        input = document.getElementById("generalSearch");
                        filter = input.value.toUpperCase();
                        table = document.getElementById("myClientTable");
                        tr = table.getElementsByTagName("tr");

                        // Loop through all table rows, and hide those who don't match the search query
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[0];

                            if (td) {
                                txtValue = td.textContent || td.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                            }
                            for (j = 1; j < 7; j++) {
                                td = tr[i].getElementsByTagName("td")[j];
                                if (td) {
                                    txtValue += td.textContent || td.innerText;
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        tr[i].style.display = "";
                                    } else {
                                        tr[i].style.display = "none";
                                    }
                                }
                            }
                        }


                    }
                </script>
            </div>
