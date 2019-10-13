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
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Personal Notes:
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body" style="padding:0px">
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="topbar_notifications_notifications"
                                             role="tabpanel">

                                            <?php if(isset($errors))
                                            { ?>
                                                <p style="color: red"><?php echo $errors; ?></p>
                                            <?php } ?>
                                            <?= $this->Form->create($notes) ?>
                                            <?php
                                            echo $this->Form->control('note_desc', [
                                                'templates' => ['inputContainer' => '{{content}}'],
                                                'type' => 'textarea',
                                                'class' => 'form-control mytextarea max col-lg-10 col-md-10 col-sm-12',
                                                //'id'=>'character_count',
                                                //'maxlength' => 10,
                                                'label' =>false
                                            ]); ?>


                                            <?php $this->Form->setTemplates(['button' => '<button{{attrs}}>{{text}}</button>']) ?>
                                            <?= $this->Form->Button('Submit ',
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
                                                /*tinymce.PluginManager.add('maxchars', function(editor) {

                                                  //set a default value for the maxChars peroperty
                                                  editor.maxChars = editor.maxChars || 500;

                                                  var label = null;

                                                  function init() {
                                                    //add a custom style which will be injected into the iframe
                                                    editor.contentStyles.push(".maxchars {color: red !important;}");

                                                    //try and add label to to the status bar
                                                    var statusbar = editor.theme.panel && editor.theme.panel.find('#statusbar')[0];

                                                    if (statusbar) {
                                                      statusbar.insert({
                                                        type: 'label',
                                                        name: 'maxcharslabel',
                                                        style: "color:red;",
                                                        classes: 'wordcount' //this puts it on the right
                                                      }, 0);

                                                      //cache the newly created element
                                                      label = statusbar.find('#maxcharslabel')
                                                    }

                                                    console.log("Max chars inititilaized: limit = %d", editor.maxChars);
                                                    updateStyle(); //check if the initial content is valid
                                                  };

                                                  function updateMsg(show) {
                                                    if (!label) {
                                                      return;
                                                    }
                                                    var msg = show ? editor.maxChars + " chars max" : "";
                                                    //console.log(panel);
                                                    label.text(msg);
                                                  }

                                                  function updateStyle() {
                                                    var content = editor.getContent({
                                                      format: 'text'
                                                    });
                                                    var $body = editor.$('.mce-content-body');

                                                    //add class to content body based on content length
                                                    if (content.length > editor.maxChars) {
                                                      $body.addClass("maxchars");
                                                      updateMsg(true);

                                                    } else {
                                                      $body.removeClass("maxchars");
                                                      updateMsg(false);
                                                    }

                                                  };
                                                  editor.on('init', init);
                                                  editor.on("change keyUp", updateStyle);
                                                });


                                                //make sure custom plugin is loaded before this call
                                                tinymce.init({
                                                  selector: '.mytextarea',
                                                  plugins: ['maxchars','wordcount'],
                                                  //toolbar: "false",
                                                  //statusbar: true,
                                                  resize: false,
                                                  setup: function(editor) {
                                                    //console.log(editor);
                                                    editor.maxChars = 10;
                                                  }
                                                });						*/

                                                tinymce.init({
                                                    selector: '.mytextarea',
                                                    height : "580px",
                                                    toolbar: "false",
                                                    statusbar: true,
                                                    plugins: "wordcount",
                                                    resize: false,
                                                    max_chars: 10,
                                                });

                                                /*function CountCharacters() {
                                                   var body = tinymce.get("mytextarea").getBody();
                                                   var content = tinymce.trim(body.innerText || body.textContent);
                                                   return content.length;
                                               };										*/




                                                /*var max = 4,
                                                setup: function(ed){
                                                    ed.keypress(function(e){
                                                                if (e.which < 0x20) {
                                                                // e.which < 0x20, then it's not a printable character
                                                                // e.which === 0 - Not a character
                                                                    return;     // Do nothing
                                                                }
                                                                if (this.value.length == max) {
                                                                    e.preventDefault();
                                                                } else if (this.value.length > max) {
                                                                    // Maximum exceeded
                                                                    this.value = this.value.substring(0, max);
                                                                }
                                                });
                                                },*/


                                                //max_chars: 5000, // max. allowed chars
                                                /*setup: function (ed) {
                                                    var allowedKeys = [8, 37, 38, 39, 40, 46]; // backspace, delete and cursor keys
                                                    ed.on('keydown', function (e) {
                                                        if (allowedKeys.indexOf(e.keyCode) != -1) return true;
                                                        if (tinymce_getContentLength() + 1 > this.settings.max_chars) {
                                                            e.preventDefault();
                                                            e.stopPropagation();
                                                            return false;
                                                        }
                                                        return true;
                                                    });
                                                    ed.on('keyup', function (e) {
                                                        tinymce_updateCharCounter(this, tinymce_getContentLength());
                                                    });
                                                },
                                                    init_instance_callback: function () { // initialize counter div
    $('#' + this.id).prev().append('<div class="char_count" style="text-align:right"></div>');
    tinymce_updateCharCounter(this, tinymce_getContentLength());
},
paste_preprocess: function (plugin, args) {
    var editor = tinymce.get(tinymce.activeEditor.id);
    var len = editor.contentDocument.body.innerHTML.length;
    var text = $(args.content).text();
    if (len + text.length > editor.settings.max_chars) {
        alert('Pasting this exceeds the maximum allowed number of ' + editor.settings.max_chars + ' characters.');
        args.content = '';
    } else {
        tinymce_updateCharCounter(editor, len + text.length);
    }
}

                                                /*setup:function (ed) {
                                                    ed.onKeyUp.add(
                                                        function (ed, evt) {
                                                            document.form1.deslen.value = tinyMCE.activeEditor.getContent().replace(/]+>/g, ”).length;
                                                        }
                                                    );
                                                },*/

                                                // });

                                                /*$(document).ready(function() {
                                                    // validate form on keyup and submit
                                                    $("#form1").validate({
                                                        rules: {
                                                            deslen: {
                                                                min: 2,
                                                                max: 5000
                                                            }
                                                        },
                                                        messages: {
                                                            deslen: {
                                                                min: " Please enter a description",
                                                                max: " Description must not be longer than 5000 characters"
                                                            },
                                                        }
                                                    });
                                                });*/
                                                /*	function tinymce_updateCharCounter(el, len) {
                                        $('#' + el.id).prev().find('.char_count').text(len + '/' + el.settings.max_chars);
                                    };

                                    function tinymce_getContentLength() {
                                        return tinymce.get(tinymce.activeEditor.id).contentDocument.body.innerHTML.length;
                                    };		*/

                                            </script>
                                            <script>

                                                /*jQuery(document).ready(function($) {
                                                    var max = 4;
                                                    $('textarea#note-desc').keypress(function(e) {
                                                        if (e.which < 0x20) {
                                                            // e.which < 0x20, then it's not a printable character
                                                            // e.which === 0 - Not a character
                                                            return;     // Do nothing
                                                        }
                                                        if (this.value.length == max) {
                                                            e.preventDefault();
                                                        } else if (this.value.length > max) {
                                                            // Maximum exceeded
                                                            this.value = this.value.substring(0, max);
                                                        }
                                                    });
                                                }); //end if ready(fn)*/


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

                        </div>
                        <div class="col-xl-4">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            To Do List
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body" style="padding-top: 0px">
                                    <div class="tab-content">
                                        <div class="tab-content">
                                            <div class="tab-pane active show" id="topbar_notifications_notifications"
                                                 role="tabpanel">
                                                <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll"
                                                     data-scroll="true" data-height="580" data-mobile-height="200">
                                                    <?php if(sizeOf($unFinishedTsk1)==0 && sizeOf($unFinishedTsk2)==0){ ?>
                                                        <br><br><br>
                                                        <p style="text-align: center"><b> You don't have any tasks in doing or to do list! </b></p>
                                                    <?php }else{ ?>
                                                        <?php foreach($unFinishedTsk2 as $unFinishedTsk2){ ?>
                                                            <?php $due_date =$unFinishedTsk2['due_date'];

                                                            $now = Time::now();
                                                            $datediff = date_diff($now, $due_date); ?>
                                                            <a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $unFinishedTsk2['project_id'],'task' => $unFinishedTsk2['id']]); ?>"
                                                               class="kt-notification__item">
                                                                <div class="kt-notification__item-icon">
                                                                    <i class="flaticon2-line-chart kt-font-success"></i>
                                                                </div>
                                                                <div class="kt-notification__item-details">
                                                                    <div class="kt-notification__item-title">
                                                                        Task: <b> <?php echo $unFinishedTsk2["task_name"] ?> </b>
                                                                        is under the Doing section !
                                                                    </div>
                                                                    <div class="kt-notification__item-time">
                                                                        <?php echo $datediff->days ?> Days left
                                                                    </div>
                                                                </div>
                                                            </a>

                                                            <?php
                                                        } ?>

                                                        <?php foreach($unFinishedTsk1 as $unFinishedTsk1){ ?>
                                                            <?php $due_date =$unFinishedTsk1['due_date'];

                                                            $now = Time::now();
                                                            $datediff = date_diff($now, $due_date); ?>
                                                            <a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $unFinishedTsk1['project_id'],'task' => $unFinishedTsk1['id']]); ?>"
                                                               class="kt-notification__item">
                                                                <div class="kt-notification__item-icon">
                                                                    <i class="flaticon2-line-chart kt-font-success"></i>
                                                                </div>
                                                                <div class="kt-notification__item-details">
                                                                    <div class="kt-notification__item-title">
                                                                        Task: <b> <?php echo $unFinishedTsk1["task_name"] ?> </b>
                                                                        is under the To do section !
                                                                    </div>
                                                                    <div class="kt-notification__item-time">
                                                                        <?php echo $datediff->days ?> Days left
                                                                    </div>
                                                                </div>
                                                            </a>

                                                            <?php
                                                        } } ?>


                                                    <!--//if there is no task in to doing section-->
                                                    <!--if ($count == 0) {-->
                                                    <!--foreach ($results as $task) {-->
                                                    <!--$due_date = date_create_from_format('Y-m-d H:i:s', $task['due_date']);-->
                                                    <!--$sys_date = date_create_from_format('Y-m-d', date('Y-m-d'));-->
                                                    <!--$datediff = date_diff($sys_date, $due_date);-->
                                                    <!--if ($task['status_id'] == 1) {-->
                                                    <!--?>-->
                                                    <!--<a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $task['project_id']]); ?>"-->
                                                    <!--class="kt-notification__item">-->
                                                    <!--<div class="kt-notification__item-icon">-->
                                                    <!--<i class="flaticon2-line-chart kt-font-info"></i>-->
                                                    <!--</div>-->
                                                    <!--<div class="kt-notification__item-details">-->
                                                    <!--<div class="kt-notification__item-title">-->
                                                    <!--Task:-->
                                                    <!--<b> <?php echo $task["task_name"] ?> </b> is-->
                                                    <!--</div>-->
                                                    <!--<div class="kt-notification__item-time">-->
                                                    <!--<?php echo $datediff->days ?> Days left-->
                                                    <!--</div>-->
                                                    <!--</div>-->
                                                    <!--</a>-->


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head kt-portlet__space-x">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Mention
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body kt-portlet__body--fluid" style="padding-top: 0px ">
                                    <div class="tab-pane active show" id="topbar_notifications_notifications"
                                         role="tabpanel" style="width: 100%">
                                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll"
                                             data-scroll="true"  data-height="580" data-mobile-height="200">

                                            <?php if(sizeOf($mentions)==0 ){ ?>
                                                <br><br><br>
                                                <p style="text-align: center"><b> You don't have any mentions ! </b></p>
                                            <?php }else{

                                                foreach($mentions as $mention){ ?>
                                                    <?php $mention_date =$mention['mention_date'];

                                                    $now = Time::now();
                                                    $datediff = date_diff($now, $mention_date); ?>

                                                    <a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $mention['project_id'], 'task' => $mention['task_id']]); ?>"
                                                       class="kt-notification__item metion-noti">
                                                        <div class="kt-notification__item-icon">
                                                            <i class="flaticon2-hangouts-logo kt-font-success"></i>
                                                        </div>
                                                        <div class="kt-notification__item-details">
                                                            <div class="kt-notification__item-title">
                                                                You has been Mentioned @ in task:
                                                                <b> <?php echo $mention["task_name"]; ?> </b> !
                                                            </div>
                                                            <div class="kt-notification__item-time">
                                                                <?php echo $datediff->days ?> Days ago
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <?php
                                                }
                                            }?>

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
