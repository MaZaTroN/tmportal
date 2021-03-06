<?php

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\UserHelper;

/* @var $this View */

$this->title = Yii::t('page-title', 'User Profile');
$this->params['breadcrumbs'][] = $this->title;
$bundle = AppAsset::register($this);
?>
<div class="user-data-index">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card card-user">
                    <div class="image">
                        <img src="<?= $bundle->baseUrl ?>/images/background.jpg" alt="..."/>
                    </div>
                    <div class="content">
                        <div class="author">
                            <div class="avatar border-white">
                                <img src="<?= UserHelper::getAvatarUrl($userData->photo) ?>" />
                                <div class="icon-info text-center upload-icon"><i class="ti-upload"></i></div>
                                <input type="file" id="photo" name="photo" accept=".jpg,.jpeg" style="display: none;">
                            </div>
                            <h4 class="title"><?= $userData->first_name ?> <?= $userData->last_name ?><br />
                                <!--<a href="#"><small>@chetfaker</small></a>-->
                            </h4>
                        </div>
                        <h4 class="text-center"><?= Yii::t('user', 'About me')?></h4>
                        <blockquote class="description text-center">
                            <em><?= $userData->comment ? $userData->comment : '...' ?></em>
                        </blockquote>
                    </div>
                    <hr>
<!--                    <div class="text-center">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <h5>12<br /><small>Files</small></h5>
                            </div>
                            <div class="col-md-4">
                                <h5>2GB<br /><small>Used</small></h5>
                            </div>
                            <div class="col-md-3">
                                <h5>24,6$<br /><small>Spent</small></h5>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="title text-center"><?= Yii::t('user', 'Edit Profile')?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($userData, 'first_name')->textInput(['maxlength' => true, 'class' => 'form-control border-input']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($userData, 'last_name')->textInput(['maxlength' => true, 'class' => 'form-control border-input']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($userData, 'phone')->textInput(['maxlength' => true, 'class' => 'form-control border-input']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($userData, 'skype')->textInput(['maxlength' => true, 'class' => 'form-control border-input']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?= $form->field($userData, 'comment')->textarea(['rows' => 6, 'class' => 'form-control border-input'])->label(Yii::t('user', 'About me')) ?>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            
        </div>
    </div>
</div>
<script>
    $('.upload-icon').on('click', function () {
        $('#photo').click();
    })
    $('#photo').on('change', function () {
        var data = new FormData();
        data.append('photo', this.files[0]);
        $.ajax({
            url: "upload-photo",
            type: "POST",
            data: data,
            processData: false, // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            success : function (data) {
                if(data){
                    window.location.reload();
                }
            }
        });
    });
</script>
