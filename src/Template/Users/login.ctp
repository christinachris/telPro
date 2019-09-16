<!-- File: src/Template/Users/login.ctp -->

<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v2 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(<?= $this->Url->image('bg-11.jpg') ?>);">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                <div class="kt-login__container">
                    <div class="kt-login__logo">
                        <a href="#">
                            <img src="<?= $this->Url->image('SMBU_IMS.png') ?>">
                        </a>
                    </div>
                    <div class="kt-login__signin">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Sign In To System</h3>
                        </div>
                        <?= $this->Flash->render() ?>

                        <div class="kt-form" action="">;
                            <?= $this->Form->create() ?>
                            <div class="col-lg-12">
                                <!--<input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off"> -->
                                <?= $this->Form->control('username',['class' => 'form-control', 'type'=>'text','placeholder'=>'Username','autocomplete'=>"off",'label' =>'','style'=>'color: white;']) ?>

                            </div>
                            <div class="col-lg-12">
                                <?= $this->Form->control('password',['class' => 'form-control', 'type'=>'password','placeholder'=>'Password','name'=>'password','label' =>'','style'=>'color: white;']) ?>
                            </div>
                            <div class="row kt-login__extra">
                                <div class="col">
                                    <!--<label class="kt-checkbox">
                                        <input type="checkbox" name="remember"> Remember me
                                        <span></span>
                                    </label>-->
                                </div>
                                <div class="col kt-align-right">
                                <!--    <a href="javascript:;" id="kt_login_forgot" class="kt-link kt-login__link">Forget Password ?</a> -->
                                </div>
                            </div>
                            <div class="kt-login__actions">

                                <?= $this->Form->button('Login',['class'=>'btn btn-pill kt-login__btn-primary']); ?>

                                <?= $this->Form->end() ?>
                                <?= $this->Html->link('<span class="btn btn-pill kt-login__btn-primary"> Forget password?</span>', ['controller' => 'Users', 'action' => 'forgetPassword'], ['escape' => false]) ?>

                </div>
            </div>
        </div>
    </div>
</div>
