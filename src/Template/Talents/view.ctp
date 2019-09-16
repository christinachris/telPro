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
<?= $this->Html->css('wizard-v3.demo8.css') ?>
<div class="kt-header__bottom">
    <div class="kt-container">

        <!-- begin: Header Menu -->
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu">
                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"><a href=" <?php echo $this->Url->build(["controller" => "dashboard", "action" => "index"]); ?>" class="kt-menu__link ">
                            <span class="kt-menu__link-text">Dashboard </span></a></li>
                    <li class="kt-menu__item   " aria-haspopup="true"><a href=" <?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Projects </span></a></li>
                    <li class="kt-menu__item kt-menu__item--active kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="<?php echo $this->Url->build(['controller'=>'Talents', 'action'=>'index'])?>" class="kt-menu__link "><span class="kt-menu__link-text">Talent</span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="<?php echo $this->Url->build(['controller'=>'Clients', 'action'=>'index'])?>" class="kt-menu__link "><span class="kt-menu__link-text">Client</span></a></li>
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
                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="<?php echo $this->Url->build(['controller' => 'Talents', 'action' => 'index']) ?>"
                           class="kt-subheader__breadcrumbs-link">
                            Talents List
                        </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>

                        <span
                            class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active"><?= h($talent->first_name) . " " . h($talent->last_name) ?>
                            's Details</span>
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
                <!-- begin:: Content -->
                <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
                    <div class="kt-portlet">
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="first">

                                <div class="kt-grid__item kt-wizard-v2__aside">
                                    <!--begin: Form Wizard Nav -->
                                    <div class="kt-wizard-v3__nav">
                                        <div class="kt-wizard-v3__nav-items">
                                            <a data-ktwizard-type="step" data-ktwizard-state="current">
                                                <a href="<?php echo $this->Url->build(['controller' => 'Talents',
                                                    'action' => 'index']) ?>" class="btn btn-secondary  kt-font-transform-u">
                                                    <i class="la la-long-arrow-left"></i>
                                                    Back
                                                </a>
                                                <div style="margin-right:-15% ;float:right;">
                                                    <a >
                                                        <?= $this->Html->link('<span class="btn btn-secondary" ><i class="flaticon2-note"></i>Edit</span>', ['action' => 'edit', $talent->id], ['escape' => false, 'data-toggle' => "kt-popover", 'data-content' => "Edit Talent", 'data-placement' => 'bottom']) ?>
                                                    </a>
                                                </div>
                                                <div class="kt-wizard-v3__content kt-wizard-v3__review kt-wizard-v2__review-content kt-wizard-v3__review-item kt-form__section kt-form__section--first" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                                    <div class="kt-heading kt-heading--md">
                                                        <?= h($talent->first_name).' '.h($talent->last_name)  ?><br><h6><p><?= h($talent->email) ?></p></h6>
                                                    </div>
                                                                    First Name:<br><h5> <?= h($talent->first_name) ?></h5><br>
                                                                    Last Name:<br><h5> <?= h($talent->last_name) ?></h5><br>
                                                                    Preferred Name:<br><h5> <?= h($talent->preferred_name) ?></h5><br>
                                                                    Phone Number: <br><h5><?= h($talent->phone_no) ?></h5><br>
                                                                    Email address:<br><h5><?= h($talent->email) ?></h5><br>

                                                                    Address:<br><h5><?= h($talent->address) ?></h5><br>
                                                                    Url:<br><h5> <?= h($talent->url) ?></h5><br>
                                                                    Username:<br><h5><?= h($talent->username) ?></h5><br>
                                                                    Password:<br><h5> <?= h($talent->password) ?> </h5><br>
                                                                    Cost:<br><h5> <?= h($talent->cost) ?></h5><br>
                                                                    Response Time:<br><h5> <?= h($talent->response_time) ?></h5><br>
                                                                    Position:<br><h5> <?= h($talent->position) ?></h5><br>
                                                                    Quality of Work:<br><h5> <?= h($talent->quality_of_work) ?>
                                                                    </h5><br>
                                                                    Speciality:<br><h5> <?= $talent->has('speciality') ? $this->Html->link($talent->speciality->name, ['controller' => 'Specialities', 'action' => 'index']) : '' ?>
                                                                    </h5><br>
                                                                    Skill Category:<br><h5> <?= $talent->has('skill_category') ? $this->Html->link($talent->skill_category->name, ['controller' => 'SkillCategories', 'action' => 'view', $talent->skill_category->id]) : '' ?>
                                                                    </h5><br>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Nav -->
                                </div>
                                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">
                                    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                                        <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3"
                                             data-ktwizard-state="step-first">
                                            <div class="kt-grid__item">
                                                <!--begin: Form Wizard Nav -->
                                                <div class="kt-wizard-v3__nav">
                                                    <div class="kt-wizard-v3__nav-items">
                                                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step"
                                                           data-ktwizard-state="current">
                                                            <div class="kt-wizard-v3__nav-body">
                                                                <div class="kt-wizard-v3__nav-label">
                                                                    Notes
                                                                </div>
                                                                <div class="kt-wizard-v3__nav-bar"></div>
                                                            </div>
                                                        </a>
                                                        <a class="kt-wizard-v3__nav-item" href="##"
                                                           data-ktwizard-type="step">
                                                            <div class="kt-wizard-v3__nav-body">
                                                                <div class="kt-wizard-v3__nav-label">
                                                                    Activities
                                                                </div>
                                                                <div class="kt-wizard-v3__nav-bar"></div>
                                                            </div>
                                                        </a>
                                                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step">
                                                            <div class="kt-wizard-v3__nav-body">
                                                                <div class="kt-wizard-v3__nav-label">
                                                                    Projects
                                                                </div>
                                                                <div class="kt-wizard-v3__nav-bar"></div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!--end: Form Wizard Nav -->
                                            </div>
                                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">
                                                <!--begin: Form Wizard Form-->
                                                <form id="kt_form">
                                                    <!--begin: Form Wizard Step 1-->
                                                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content"
                                                         data-ktwizard-state="current">
                                                        <div class="col-xl-12 kt-scroll ps ps--active-y">
                                                            <div class="kt-portlet__body">

                                                                <div class="row" >
                                                                    <div class="col-xl-4"
                                                                         style="margin-left: 60%; float:right;">
                                                                        <?php echo $this->Html->link('<span class="btn btn-primary" style="float:right"><i class="flaticon2-plus"></i>Add Note</span>',
                                                                            array('type' => 'button'), ['escape' => false, 'data-target' => '#kt_modal_6note', 'data-toggle' => 'modal'])
                                                                        ?>

                                                                    </div>


                                                                    <div class="col-lg-12" data-scroll="true" data-height="700"
                                                                         style="height: 700px; overflow: hidden; ">

                                                                        <div
                                                                            class="kt-timeline-v1 kt-timeline-v1--justified"
                                                                            style="margin-left:5%;">
                                                                            <?php if (!empty($talent->talent_notes)): ?>
                                                                                <?php foreach (array_reverse($talent->talent_notes) as $talentNotes): ?>

                                                                                    <div class="kt-timeline-v1__items"
                                                                                         style="margin-bottom: -5%;">
                                                                                        <div class="kt-timeline-v1__marker"></div>
                                                                                        <div class="kt-timeline-v1__item kt-timeline-v1__item--first">
                                                                                            <div class="kt-timeline-v1__item-circle">
                                                                                                <div class="kt-bg-danger"></div>
                                                                                            </div>
                                                                                            <span class=" kt-font-brand">
															                                 <b><?php echo date_format($talentNotes->created_date,'d/m/Y H:m') ?></b></span>

                                                                                            <div
                                                                                                class="kt-timeline-v1__item-content"
                                                                                                style="max-width: 90%;">
                                                                                                <div class="kt-timeline-v1__item-title ">
                                                                                                    <div style="float: right; ">
                                                                                                        <button
                                                                                                            class="editNoteButton btn btn-sm btn-clean btn-icon btn-icon-sm"
                                                                                                            data-note-id="<?php echo $talentNotes->id ?>"
                                                                                                            data-note-content="<?php echo $talentNotes->content ?>">
                                                                                                            <i class="flaticon2-note"
                                                                                                               data-toggle="kt-popover"
                                                                                                               data-content="Edit Note"
                                                                                                               data-placement='bottom'></i>
                                                                                                        </button>
                                                                                                        <?= $this->Html->link('<span class="btn btn-sm btn-clean btn-icon btn-icon-sm"><i class="flaticon2-delete"></i></span>', ['controller' => 'TalentNotes', 'action' => 'delete', $talentNotes->id], ['escape' => false, 'data-toggle' => "kt-popover", 'data-content' => "delete note", 'data-placement' => 'bottom', 'confirm' => 'Are you sure you wish to delete this note?']) ?>

                                                                                                    </div>

                                                                                                </div>

                                                                                                <div
                                                                                                    class="kt-timeline-v1__item-body "
                                                                                                    style="word-wrap:break-word;">
                                                                                                    <p>
                                                                                                        <?= h($talentNotes->content) ?>
                                                                                                    </p>
                                                                                                </div>
                                                                                                <div style="float: right">
                                                                                                    <div class="checkbox">
                                                                                                        <label>
                                                                                                            <style>
                                                                                                                .switch {
                                                                                                                    position: relative;
                                                                                                                    display: inline-block;
                                                                                                                    width: 30px;
                                                                                                                    height: 17px;
                                                                                                                }

                                                                                                                .switch input {
                                                                                                                    opacity: 0;
                                                                                                                    width: 0;
                                                                                                                    height: 0;
                                                                                                                }

                                                                                                                .slider {
                                                                                                                    position: absolute;
                                                                                                                    cursor: pointer;
                                                                                                                    top: 0;
                                                                                                                    left: 0;
                                                                                                                    right: 0;
                                                                                                                    bottom: 0;
                                                                                                                    background-color: #ccc;
                                                                                                                    -webkit-transition: .4s;
                                                                                                                    transition: .4s;
                                                                                                                }

                                                                                                                .slider:before {
                                                                                                                    position: absolute;
                                                                                                                    content: "";
                                                                                                                    height: 13px;
                                                                                                                    width: 13px;
                                                                                                                    left: 2px;
                                                                                                                    bottom: 2px;
                                                                                                                    background-color: white;
                                                                                                                    -webkit-transition: .4s;
                                                                                                                    transition: .4s;
                                                                                                                }

                                                                                                                input:checked + .slider {
                                                                                                                    background-color: #5c00e6;
                                                                                                                }

                                                                                                                input:focus + .slider {
                                                                                                                    box-shadow: 0 0 1px #5c00e6;
                                                                                                                }

                                                                                                                input:checked + .slider:before {
                                                                                                                    -webkit-transform: translateX(13px);
                                                                                                                    -ms-transform: translateX(13px);
                                                                                                                    transform: translateX(13px);
                                                                                                                }

                                                                                                                /* Rounded sliders */
                                                                                                                .slider.round {
                                                                                                                    border-radius: 17px;
                                                                                                                }

                                                                                                                .slider.round:before {
                                                                                                                    border-radius: 50%;
                                                                                                                }
                                                                                                            </style>

                                                                                                            <label class="switch">
                                                                                                                <?php if ( $talentNotes->if_flag==1):?>
                                                                                                                    <input type="checkbox" onclick="notePass(<?php echo $talentNotes->id?>,<?php echo $talentNotes->if_flag?>)"  checked >
                                                                                                                    <span class="slider round" data-toggle = "kt-popover" data-content = "Unflag Note" data-placement = 'bottom'></span>
                                                                                                                <?php else:?>
                                                                                                                    <input type="checkbox"  onclick="notePass(<?php echo $talentNotes->id?>,<?php echo $talentNotes->if_flag?>)" >
                                                                                                                    <span class="slider round" data-toggle = "kt-popover" data-content = "Flag Note" data-placement = 'bottom'></span>
                                                                                                                <?php endif?>
                                                                                                            </label>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>

                                                                                    </div>

                                                                                <?php endforeach; ?>

                                                                            <?php endif; ?>

                                                                        </div>


                                                                    </div>

                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!--end: Form Wizard Step 1-->

                                                <!--start: Form Wizard Step 2-->
                                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content"
                                                     >
                                                    <div class="col-xl-12 kt-scroll ps ps--active-y">
                                                        <div class="kt-portlet__body">

                                                            <div class="row" >
                                                                <div class="col-xl-4"
                                                                     style="margin-left: 60%; float:right;">


                                                                </div>


                                                                <div class="col-lg-12" data-scroll="true" data-height="700"
                                                                     style="height: 700px; overflow: hidden; ">

                                                                    <div
                                                                        class="kt-timeline-v1 kt-timeline-v1--justified"
                                                                        style="margin-left:5%;">
                                                                        <?php if (!empty($allActivity)): ?>
                                                                            <?php foreach ($allActivity as $activity): ?>

                                                                                <div class="kt-timeline-v1__items"
                                                                                     style="margin-bottom: -5%;">
                                                                                    <div class="kt-timeline-v1__marker"></div>
                                                                                    <div class="kt-timeline-v1__item kt-timeline-v1__item--first">
                                                                                        <div class="kt-timeline-v1__item-circle">
                                                                                            <div class="kt-bg-danger"></div>
                                                                                        </div>
                                                                                        <span class=" kt-font-brand">
															                                                                  <b><?php echo $activity['create_date']->format('d/m/Y H:i'); ?></b></span>

                                                                                        <div
                                                                                            class="kt-timeline-v1__item-content"
                                                                                            style="max-width: 90%;">


                                                                                            <div
                                                                                                class="kt-timeline-v1__item-body"
                                                                                                style=" word-wrap:break-word;">

                                                                                                <?php foreach($client as $clients){
                                                                                                    if($clients['id']==$activity['client_id']){
                                                                                                        $clientfn=$clients['first_name'];
                                                                                                        $clientln=$clients['last_name'];
                                                                                                    }
                                                                                                } ?>

                                                                                                <?php if($activity['content']=='Email'){ ?>
                                                                                                    <p><?php echo $talentfn.' '.$talentln.' added a Email activity for '.$clientfn.' '.$clientln; ?></p>
                                                                                                    <p><?php echo 'Summary: '.$activity['summary'];?></p>
                                                                                                    <i class="flaticon-event-calendar-symbol" style="font-size:20px;width: 3%;color:#00e6b8" ></i>
                                                                                                    <?= h($activity->date->i18nFormat('dd/MM/yyyy').' ') ?><?php echo $this->Time->format($activity->time, 'HH:mm a') ?>
                                                                                                <?php }else if($activity['content']=='Phone Call'){?>
                                                                                                    <p><?php echo $talentfn.' '.$talentln.' added a Phone Call activity for '.$clientfn.' '.$clientln; ?></p>
                                                                                                    <p><?php echo 'Summary: '.$activity['summary'];?></p>
                                                                                                    <i class="flaticon-event-calendar-symbol" style="font-size:20px;width: 3%;color:#00e6b8" ></i>
                                                                                                    <?= h($activity->date->i18nFormat('dd/MM/yyyy').' ') ?><?php echo $this->Time->format($activity->time, 'HH:mm a') ?>
                                                                                                <?php }else if($activity['content']=='Virtual Meeting'){?>
                                                                                                    <p><?php echo $talentfn.' '.$talentln.' added a Virtual Meeting Call activity for '.$clientfn.' '.$clientln; ?></p>
                                                                                                    <p><?php echo 'Summary: '.$activity['summary'];?></p>
                                                                                                    <i class="flaticon-event-calendar-symbol" style="font-size:20px;width: 3%;color:#00e6b8" ></i>
                                                                                                    <?= h($activity->date->i18nFormat('dd/MM/yyyy').' ') ?><?php echo $this->Time->format($activity->time, 'HH:mm a') ?>
                                                                                                <?php }else if($activity['content']=='Meeting'){?>
                                                                                                    <p><?php echo $talentfn.' '.$talentln.' added a Meeting activity for '.$clientfn.' '.$clientln; ?></p>
                                                                                                    <p><?php echo 'Summary: '.$activity['summary'];?></p>
                                                                                                    <i class="flaticon-event-calendar-symbol" style="font-size:20px;width: 3%;color:#00e6b8" ></i>
                                                                                                    <?= h($activity->date->i18nFormat('dd/MM/yyyy').' ') ?><?php echo $this->Time->format($activity->time, 'HH:mm a') ?>
                                                                                                <?php }else if($activity['content']=='Text Message'){?>
                                                                                                    <p><?php echo $talentfn.' '.$talentln.' added a Text Message activity for '.$clientfn.' '.$clientln; ?></p>
                                                                                                    <p><?php echo 'Summary: '.$activity['summary'];?></p>
                                                                                                    <i class="flaticon-event-calendar-symbol" style="font-size:20px;width: 3%;color:#00e6b8" ></i>
                                                                                                    <?= h($activity->date->i18nFormat('dd/MM/yyyy').' ') ?><?php echo $this->Time->format($activity->time, 'HH:mm a') ?>
                                                                                                <?php } else{ ?>
                                                                                                    <p><?php echo $talentfn.' '.$talentln.' added a note for '.$clientfn.' '.$clientln; ?></p>
                                                                                                    <p><?php echo 'Notes: '.$activity['content'];?></p>
                                                                                                <?php } ?>
                                                                                            </div>


                                                                                            <div
                                                                                                class="kt-timeline-v1__item-body">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>

                                                                            <?php endforeach; ?>

                                                                        <?php endif; ?>


                                                                        </div>

                                                                    </div>


                                                                </div>




                                                        </div>
                                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                            <div class="ps__thumb-x" tabindex="0"
                                                                 style="left: 0px; width: 0px;"></div>
                                                        </div>
                                                        <div class="ps__rail-y"
                                                             style="top: 0px; height: 380px; right: 0px;">
                                                            <div class="ps__thumb-y" tabindex="0"
                                                                 style="top: 0px; height: 300px;"></div>
                                                        </div>

                                                    </div>
                                                </div>


                                                <!--end: Form Wizard Step 2-->

                                                <!--begin: Form Wizard Step 3-->
                                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                                    <div class="kt-form__section kt-form__section--first">
                                                        <div class="col-xl-12 kt-scroll ps ps--active-y">
                                                            <div class="kt-portlet__body">

                                                                <div class="row">
                                                                    <div class="col-xl-10"></div>
                                                                    <div class="col-xl-6"
                                                                         style="margin-left: 50%; float:right;">

                                                                        <!--<span class="btn btn-primary" style="float:right"><i class="flaticon2-plus"></i>Add Project</span>-->
                                                                        <!--<?php echo $this->Html->link('<span class="btn btn-primary" style="float:right"><i class="flaticon2-plus"></i>Add Project</span>',
                                                                            array('type' => 'button'), ['escape' => false])
                                                                        ?> -->


                                                                    </div>


                                                                    <div data-scroll="true" data-height="500"
                                                                         style="height: 500px; overflow: hidden; width:600px;">

                                                                        <div class="kt-timeline-v1 kt-timeline-v1--justified" style="margin-left:5%;">
                                                                            <?php foreach($talent_project as $talent_projects){ ?>

                                                                                <div class="kt-timeline-v1__items"
                                                                                     style="margin-bottom: -5%;">
                                                                                    <div
                                                                                        class="kt-timeline-v1__marker"></div>
                                                                                    <div
                                                                                        class="kt-timeline-v1__item kt-timeline-v1__item--first">
                                                                                        <div
                                                                                            class="kt-timeline-v1__item-circle">
                                                                                            <div
                                                                                                class="kt-bg-danger"></div>
                                                                                        </div>

                                                                                        <span class=" kt-font-brand">
                                                                                        <div
                                                                                            class="kt-timeline-v1__item-content"
                                                                                            style="max-width: 90%;">


                                                                                            <div class="kt-timeline-v1__item-title ">

                                                                                                <?php echo $talent_projects['project_name']?>
                                                                                            </div>
                                                                                            <div
                                                                                                class="kt-timeline-v1__item-body"
                                                                                                style=" word-wrap:break-word;">
                                                                                                 <h6>Project Progress</h6>

                                                                                                <div class="progress" style="font-size: 15px ;height: 20px ; font-weight: 500">
                                                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                                                                         role="progressbar"
                                                                                                         aria-valuenow="<?= $this->Number->format($talent_projects['progress_num']) ?>"
                                                                                                         aria-valuemin="0" aria-valuemax="100"
                                                                                                         style="width: <?= $this->Number->format($talent_projects['progress_num']) ?>% "><?= $this->Number->format($talent_projects['progress_num']) ?>
                                                                                                        %
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <h6>Project Description</h6>

                                                                                                <p>
                                                                                                    <?php echo $talent_projects['project_desc']?>
                                                                                                </p>

                                                                                                <p>Start
                                                                                                    Date: <?php echo date_format($talent_projects['start_date'], "d/m/Y "); ?>
                                                                                                    <br>End
                                                                                                    Date: <?php echo date_format($talent_projects['end_date'], "d/m/Y "); ?>
                                                                                                </p>








                                                                                            </div>

                                                                                        </div>
                                                                                    </div>

                                                                                </div>

                                                                            <?php } ?>
                                                                        </div>

                                                                    </div>

                                                        </div>
                                                    </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end: Form Actions -->
                                                <!--end: Form Wizard Form-->
                                                <!-- add note modal-->
                                                <div class="modal fade" id="kt_modal_6note" tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content" style="width:500%">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Add New Note</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                        <span>
                                                                            <?= $this->Form->create(null, ['type' => 'post']) ?>
                                                                            <fieldset>

                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-12">
                                                                                                <?php echo $this->Form->control('content', ['class' => 'form-control', 'id' => 'exampleSelect1', 'type' => 'textarea', 'placeholder' => 'Please enter a note','label'=>false]); ?>
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
                                                <!-- edit note modal-->
                                                <div class="modal fade" id="editNoteModal" tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content" style="width:500%">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Note</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                        <span>
                                                                            <?php ?>
                                                                            <?= $this->Form->create(null, ['type' => 'post', 'patch', 'put', 'id' => 'editNoteForm', 'url' => [
                                                                                'controller' => 'TalentNotes',
                                                                                'action' => 'edit'
                                                                            ]]) ?>
                                                                            <fieldset>
                                                                                            <div class="form-group row">
                                                                                            <div class="col-lg-4">
                                                                                                <?php echo $this->Form->hidden('id', ['value' => $talentNotes->id, 'class' => 'form-control']); ?>
                                                                                            </div>
                                                                                            </div>


                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-12">
                                                                                                <?php echo $this->Form->control('content', ['class' => 'form-control', 'type' => 'textarea', 'placeholder' => 'Please enter a note', 'label'=>false]); ?>
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
                                                <!-- end edit note modal-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Form Actions -->
                            <!--end: Form Wizard Form-->
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->Html->script('general/jquery/dist/jquery.js') ?>
            <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
            <script src="js/bootstrap-datepicker.js"></script>
            <?= $this->Html->script('app/custom/wizard/wizard-v3.js') ?>
            <script>
                $(document).on("click", ".editNoteButton", function () {
                    var noteId = $(this).attr("data-note-id");
                    var noteContent = $(this).attr("data-note-content");
                    var action = "/team34/iteration2/TalentNotes/edit";
                    var signal = "/";
                    var returnAddress = window.location.href;
                    $('#content').val(noteContent);
                    $('#editNoteForm').attr('action', action + signal + noteId);
                    $('#editNoteModal').modal('show');
                    $('#editNoteForm').submit(function(e){
                        e.preventDefault();
                        var form = $(this);
                        $.ajax({
                            url: '<?php echo $this->Url->build([
                                'controller' => 'TalentNotes',
                                'action' => 'edit'
                            ])?>' + '/' + noteId,
                            type:'POST',
                            data:form.serialize(),
                            success: function(){
                                window.location.reload();
                            }
                        });
                    })
                })
            </script>
            <script>
                function notePass($hello,$flag1){
                    var string1 =$hello.toString();
                    var test1;
                    if($flag1==1){
                        test1=0;
                    }
                    else{
                        test1=1;
                    }



                    $.ajax({
                        url: '<?php echo $this->Url->build([
                            'controller' => 'TalentNotes',
                            'action' => 'edit'
                        ])?>' + '/' + string1,
                        type:'POST',
                        headers: {
                            'X-CSRF-Token': '<?= h($this->request->getParam('_csrfToken')); ?>'
                        },
                        data:{'if_flag':test1},
                        success: function(){
                        }


                    });
                }
            </script>
