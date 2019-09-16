<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project[]|\Cake\Collection\CollectionInterface $projects
 */

use Cake\Core\Configure;
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
                    <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a
                            href=" <?php echo $this->Url->build(["controller" => "dashboard", "action" => "index"]); ?>"
                            class="kt-menu__link "><span class="kt-menu__link-text">Dashboard </span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a
                            href="<?php echo $this->Url->build(['controller' => 'Projects', 'action' => 'index']) ?>"
                            class="kt-menu__link "><span class="kt-menu__link-text">Project</span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a
                            href="<?php echo $this->Url->build(['controller' => 'Talents', 'action' => 'index']) ?>"
                            class="kt-menu__link "><span class="kt-menu__link-text">Talent</span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a
                            href="<?php echo $this->Url->build(['controller' => 'Clients', 'action' => 'index']) ?>"
                            class="kt-menu__link "><span class="kt-menu__link-text">Client</span></a></li>
                </ul>

            </div>

        </div>
        <!-- end: Header Menu -->
    </div>
</div>
<style>
    @media (min-width: 1025px)
        .kt-portlet.kt-portlet--height-fluid-half {
            height: calc(50% - 100px) !important;
        }
</style>
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
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <div class="btn kt-subheader__btn-daterange" title="Select dashboard daterange">
                            <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                            <span class="kt-subheader__btn-daterange-date"
                                  id="kt_dashboard_daterangepicker_date"><?php echo date("M d") ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px"
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
                    <!-- begin dashboard content-->
                    <div class="row">
                        <div class="col-xl-4">
                            <!--begin:: Widgets/Activity-->
                            <div
                                class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--height-fluid">
                                <div class="kt-portlet__head kt-portlet__space-x">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Project Trends
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div class="kt-widget12" style="padding-top: 80px ;padding-left: 25px;padding-right: 25px;height:auto">
                                        <div class="kt-widget12__content">
                                            <div class="kt-widget12__item">
                                                <div class="kt-widget12__info">
                                                    <span class="kt-widget12__desc">Average Project Receiving </span>
                                                    <span class="kt-widget12__value"><?php echo round($aveProjectsMonth,2)?> Projects</span>
                                                </div>

                                                <div class="kt-widget12__info">
                                                    <span class="kt-widget12__desc">Today </span>
                                                    <span class="kt-widget12__value"><?php echo date("d M Y") ?></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="kt-widget17">
                                        <div
                                            class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides">
                                            <div class="chartjs-render-monitor"
                                                 style="background-image: url('<?= $this->Url->image('bg-3.jpg') ?>') ;    background-size: cover;
                                                     background-position: center; ">
                                                <div id="app2"></div>

                                            </div>

                                        </div>
                                        <div class="kt-widget17__stats" style="    margin: -6.3rem auto 0 auto;">
                                            <div class="kt-widget17__items ">
                                                <div
                                                    class="kt-widget17__item kt-portlet kt-iconbox kt-iconbox--animate">
            								<span class="kt-widget17__icon">
            									<svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1"
                                                     class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                                        <path
                                                            d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                            id="Mask" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                        <path
                                                            d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                            id="Mask-Copy" fill="#000000" fill-rule="nonzero"/>
                                                    </g>
                                                </svg>
            								</span>
                                                    <span class="kt-widget17__subtitle" style="color: black">
            									<?php echo $totalTalents ?> Talents
            								</span>
                                                </div>
                                                <div class="kt-widget17__item">
            								<span class="kt-widget17__icon">
            									<svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1"
                                                     class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <path
                                                            d="M14.1124454,7.00625159 C14.0755336,7.00212117 14.0380145,7 14,7 L10,7 C9.96198549,7 9.92446641,7.00212117 9.88755465,7.00625159 L7.34761705,4.55799196 C6.95060373,4.17530866 6.9382927,3.54346816 7.32009765,3.14561006 L8.41948359,2 L15.5805164,2 L16.6799023,3.14561006 C17.0617073,3.54346816 17.0493963,4.17530866 16.6523829,4.55799196 L14.1124454,7.00625159 Z"
                                                            id="Combined-Shape" fill="#000000"/>
                                                        <path
                                                            d="M13.7640285,9 L15.4853424,18.1494183 C15.5450675,18.4668794 15.4477627,18.7936387 15.2240963,19.0267093 L12.7215131,21.6345146 C12.7120098,21.6444174 12.7023037,21.6541236 12.6924008,21.6636269 C12.2939201,22.0460293 11.6608893,22.0329953 11.2784869,21.6345146 L8.77590372,19.0267093 C8.55223728,18.7936387 8.45493249,18.4668794 8.5146576,18.1494183 L10.2359715,9 L13.7640285,9 Z"
                                                            id="Path" fill="#000000" opacity="0.3"/>
                                                    </g>
                                                </svg>
            								</span>
                                                    <span class="kt-widget17__subtitle" style="color: black">
            								<?php echo $totalClients ?> Clients
            								</span>
                                                </div>
                                            </div>
                                            <div class="kt-widget17__items">
                                                <div class="kt-widget17__item">
            								<span class="kt-widget17__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1"
                                                     class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <path
                                                            d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z"
                                                            id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                                    </g>
                                                </svg>
            								</span>
                                                    <span class="kt-widget17__subtitle" style="color: black">
            									<?php echo $totalProjects ?> Projects
            								</span>
                                                    <span class="kt-widget17__desc">
            									<?php echo $notCompletedProgress ?> Projects In Progress;<br>
                                                        <?php echo $completedProgress ?>
                                                        Projects Have Been Finished;<br>
                                                        <?php echo $totalArchives ?> archived projects;
            								</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end:: Widgets/Activity-->
                        </div>
                        <div class="col-xl-4">
                            <div class="kt-portlet kt-portlet--height-fluid-half">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Quick Notes:
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body" style="padding:0px">
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="topbar_notifications_notifications"
                                             role="tabpanel">
                                            <?php $note = null;
                                            $note_desc = NULL;
                                            $results = $conn->execute('select * from notes where user_id = :id ', ['id' => $this->Session->read('Auth.User.id')]);
                                            foreach ($results as $task) {
                                                $note_desc = $task['note_desc'];
                                            } ?>
                                            <?= $this->Form->create($note, ['url' => ['controller' => 'Notes', 'action' => 'edit', $this->Session->read('Auth.User.id')]]) ?>
                                            <?php echo $this->Form->hidden('modify_date', ['value' => date("Y-m-d H:i:s")]); ?>
                                            <?php echo $this->Form->hidden('user_id', ['value' => $this->Session->read('Auth.User.id')]); ?>

                                            <?php
                                            echo $this->Form->control('note_desc', [
                                                'value' => $note_desc,
                                                'templates' => ['inputContainer' => '{{content}}'],
                                                'type' => 'textarea',
                                                'data-desc-text' => $note_desc,
                                                'class' => 'form-control mytextarea col-lg-10 col-md-10 col-sm-12',
                                                //'id'=>'deslen',
                                                'label' =>false
                                            ]); ?>

                                            <?php $this->Form->setTemplates(['button' => '<button{{attrs}}>{{text}}</button>']) ?>
                                            <?= $this->Form->postButton('Submit ',
                                                ['controller' => 'Notes', 'action' => 'edit', $this->Session->read('Auth.User.id')],
                                                [
                                                    'class' => 'btn btn-brand btn-sm',
                                                    'style' => 'margin : 15px',
                                                    'escape' => false
                                                ]);
                                            ?>
                                            <?= $this->Form->end() ?>
                                            <script
                                                src="https://cdn.tiny.cloud/1/skxxriyhfnae4ssf886wrpuv496ctdpkp14xxnp6zhxzs4yy/tinymce/5/tinymce.min.js"
                                                referrerpolicy="origin"></script>
                                            <script>

                                                tinymce.init({
                                                    selector: '.mytextarea',
                                                    height : "280px",
                                                    toolbar: "false",
                                                    statusbar: true,
                                                    plugins: "wordcount",
                                                    resize: false,
                                                });
                                            </script>

                                            <style>
                                                .tox-statusbar__branding {
                                                    display: none;
                                                }
                                                .tox-statusbar{
                                                    display: none;
                                                }

                                                .tox-tinymce {
                                                    border: 1px solid #cccccc63 !important;
                                                    /*border-radius: 10px !important;*/
                                                    max-height ; 300px;

                                                }

                                                .tox .tox-toolbar, .tox .tox-toolbar__overflow, .tox .tox-toolbar__primary {
                                                    border: 1px solid #cccccc63 !important;
                                                    background: none;
                                                .tox .tox-tbtn {
                                                    height: 25px;
                                                    OPACITY: 0.6;
                                                }
                                                .tox .tox-edit-area {
                                                    border-top: none;
                                                }
                                            </style>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet kt-portlet--height-fluid-half">
                                <div class="kt-widget14">
                                    <div class="kt-widget14__header">
                                        <h3 class="kt-widget14__title">
                                            Talent Skill Category
                                        </h3>
                                        <span class="kt-widget14__desc">
								Percentage of talents in each category
							</span>
                                    </div>
                                    <!-- <canvas id="app" style="height: 140px; width: 140px; display: block;" width="140" height="140" class="chartjs-render-monitor"></canvas> -->
                                    <div id="app"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="kt-portlet kt-portlet--height-fluid-half">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Task Information
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body" style="padding-top: 0px">
                                    <div class="tab-content">
                                        <div class="tab-content">
                                            <div class="tab-pane active show" id="topbar_notifications_notifications"
                                                 role="tabpanel">
                                                <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll"
                                                     data-scroll="true" data-height="280" data-mobile-height="200">
                                                    <?php
                                                    $results = $conn->execute('select * from tasks');
                                                    $count = 0;
                                                    foreach ($results as $task) {
                                                        $due_date = date_create_from_format('Y-m-d H:i:s', $task['due_date']);
                                                        $sys_date = date_create_from_format('Y-m-d', date('Y-m-d'));
                                                        $datediff = date_diff($sys_date, $due_date);
                                                        if ($task['status_id'] == 2) {
                                                            ?>
                                                            <a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $task['project_id']]); ?>"
                                                               class="kt-notification__item">
                                                                <div class="kt-notification__item-icon">
                                                                    <i class="flaticon2-line-chart kt-font-success"></i>
                                                                </div>
                                                                <div class="kt-notification__item-details">
                                                                    <div class="kt-notification__item-title">
                                                                        Task: <b> <?php echo $task["task_name"] ?> </b>
                                                                        is under the Doing section !
                                                                    </div>
                                                                    <div class="kt-notification__item-time">
                                                                        <?php echo $datediff->days ?> Days left
                                                                    </div>
                                                                </div>
                                                            </a>

                                                            <?php
                                                            $count = $count + 1;
                                                        }
                                                    }

                                                    //if there is no task in to doing section
                                                    if ($count == 0) {
                                                        foreach ($results as $task) {
                                                            $due_date = date_create_from_format('Y-m-d H:i:s', $task['due_date']);
                                                            $sys_date = date_create_from_format('Y-m-d', date('Y-m-d'));
                                                            $datediff = date_diff($sys_date, $due_date);
                                                            if ($task['status_id'] == 1) {
                                                                ?>
                                                                <a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $task['project_id']]); ?>"
                                                                   class="kt-notification__item">
                                                                    <div class="kt-notification__item-icon">
                                                                        <i class="flaticon2-line-chart kt-font-info"></i>
                                                                    </div>
                                                                    <div class="kt-notification__item-details">
                                                                        <div class="kt-notification__item-title">
                                                                            Task:
                                                                            <b> <?php echo $task["task_name"] ?> </b> is
                                                                            under the ToDo section !
                                                                        </div>
                                                                        <div class="kt-notification__item-time">
                                                                            <?php echo $datediff->days ?> Days left
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet kt-portlet--height-fluid-half">
                                <div class="kt-portlet__head kt-portlet__space-x">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Activities To Be Done
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body kt-portlet__body--fluid" style="padding-top: 0px ">
                                    <div class="tab-pane active show" id="topbar_notifications_notifications"
                                         role="tabpanel" style="width: 100%">
                                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll"
                                             data-scroll="true"  data-height="280" data-mobile-height="200">
                                            <?php
                                            $results = $conn->execute('select * from tasks');
                                            foreach ($results as $task) {
                                                $due_date = date_create_from_format('Y-m-d H:i:s', $task['due_date']);
                                                $sys_date = date_create_from_format('Y-m-d', date('Y-m-d'));
                                                $datediff = date_diff($sys_date, $due_date);
                                                if (($datediff->days < 10) && !($task['status_id'] == 4)) {
                                                    ?>
                                                    <a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $task['project_id']]); ?>"
                                                       class="kt-notification__item">
                                                        <div class="kt-notification__item-icon">
                                                            <i class="flaticon2-time kt-font-danger"></i>
                                                        </div>
                                                        <div class="kt-notification__item-details">
                                                            <div class="kt-notification__item-title">
                                                                Task: <b> <?php echo $task["task_name"] ?> </b> is coming to its due day.
                                                            </div>
                                                            <div class="kt-notification__item-time">
                                                                <?php echo $datediff->days ?> Days left
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dashboard Content End -->

            </div>
        </div>
    </div>

    <style>
        .alinkcolor {
            color: #fff;
        }

        .alinkcolor:hover {
            color: #fff;
        }
    </style>

    <script crossorigin src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/prop-types@15.6.2/prop-types.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.34/browser.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
    <script src="https://unpkg.com/react-apexcharts@1.1.0/dist/react-apexcharts.iife.min.js"></script>


    <script type="text/babel">
        var skillCateNames = JSON.parse('<?php echo json_encode($skillCateName); ?>');
        var skillCateNumber = JSON.parse('<?php echo json_encode($numberOfSkillCate); ?>');

        class DonutChart extends React.Component {
            constructor(props) {
                super(props);

                this.state = {
                    options: {

                        dataLabels: {
                            enabled: false
                        },
                        labels: skillCateNames,
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }]
                    },
                    series: skillCateNumber
                }
            }

            render() {
                return (
                    <div>
                        <div id="chart">
                            <ReactApexChart options={this.state.options} series={this.state.series} type="donut"
                                            width="430"/>
                        </div>
                        <div id="html-dist">
                        </div>
                    </div>
                );
            }
        }

        const domContainer = document.querySelector('#app');
        ReactDOM.render(React.createElement(DonutChart), domContainer);

    </script>


    <script crossorigin src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/prop-types@15.6.2/prop-types.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.34/browser.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
    <script src="https://unpkg.com/react-apexcharts@1.1.0/dist/react-apexcharts.iife.min.js"></script>
    <?= $this->Html->script('app/custom/general/dashboard.js') ?>
    <script type="text/babel">

        var latestMonth = JSON.parse('<?php echo json_encode($latestMonth); ?>');
        var newProjects = JSON.parse('<?php echo json_encode($newProjects); ?>');


        class AreaChart extends React.Component {

            constructor(props) {
                super(props);

                this.state = {
                    options: {
                        chart: {
                            height: 450,
                            type: 'area',
                            zoom: {
                                enabled: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            curve: 'smooth',
                            colors: ['#1dc9b7'],
                            // lineCap: 'butt',
                            width: 4,
                            dashArray: 0,
                        },
                        fill: {
                            colors: ['#1dc9b7'],
                            opacity: 0.2,
                            type: 'solid',
                        },
                        chart: {
                            toolbar: {
                                show: false
                            }
                        },

                        xaxis: {
                            labels: {
                                show: false
                            },
                            axisBorder: {
                                show: false
                            },
                            categories: latestMonth,

                        },
                        yaxis: {
                            labels: {
                                show: false
                            },
                            gridLines: {
                                enabled: false,
                            },
                            axisBorder: {
                                enabled: false,
                            },

                        },
                        grid: {
                            show: false,
                        },

                    },
                    series: [{
                        name: 'New Pojects',
                        data: newProjects
                    }],
                }
            }

            render() {
                return (
                    <div id="chart">
                        <ReactApexChart options={this.state.options} series={this.state.series} type="area"
                                        height="300"/>
                    </div>

                );
            }
        }


        const domContainer = document.querySelector('#app2');
        ReactDOM.render(React.createElement(AreaChart), domContainer);

    </script>
