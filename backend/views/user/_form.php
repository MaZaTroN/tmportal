<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\helpers\ArrayHelper;
use common\helpers\UtilsHelper;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'id' => 'up',
        'enableAjaxValidation' => true
    ]); ?>
    <?php if(!$userData->isNewRecord): ?>
            <?= $form->field($user, 'status')->checkbox([
                'class' => 'switch',
                'data-on-color' => "success",
                'data-off-color' => "danger",
                'data-on-text' => Yii::t('status', "Active"),
                'data-off-text' => Yii::t('status', "Disabled"),
            ], false)->label(false)?>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($user, 'username')->textInput() ?>
            
            <?php if($userData->isNewRecord):?>
                <?= $form->field($user, 'password')->textInput() ?>
                <?= $form->field($user, 'role')->dropDownList(User::getRoles(), ['options' =>[ User::ROLE_USER => ['Selected' => true]]]) ?>
            <?php else: ?>
                <?= $form->field($user, 'role')->dropDownList(User::getRoles()) ?>
            <?php endif; ?>
            
            <?= $form->field($user, 'email')->textInput() ?>
            
            <?= $form->field($userData, 'office_id')->dropDownList(
                ArrayHelper::map(\common\models\Office::find()->all(), 'id', 'name')
            )->label('Office') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($userData, 'first_name')->textInput() ?>
            <?= $form->field($userData, 'last_name')->textInput() ?>
            <?= $form->field($userData, 'gender')->dropDownList(common\models\UserData::getGenders()) ?>
            <?= $form->field($userData, 'phone')->textInput() ?>
            <?= $form->field($userData, 'skype')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($userData, 'hire_date')->input('date') ?>
            <?= $form->field($userData, 'birthday')->input('date') ?>
            <?= $form->field($userData, 'address')->textInput() ?>
            <?= $form->field($userData, 'position_id')->dropDownList(
                ArrayHelper::map(common\models\JobPosition::find()->all(), 'id', 'name')
            ) ?>
            <?= $form->field($userData, 'map_place')->textInput() ?>
        </div>
    </div>
    

    <div class="form-group text-center">
        <?= Html::submitButton($userData->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $userData->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?= common\widgets\map\MapWidget::widget(['params' => [
    'showList' => false
]]); ?>
<script>
function initAutocomplete(){
    console.log($('#userdata-address').val());
    new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('userdata-address')),
    {types: ['geocode']});
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFEbpuIHsQQeWN0UhmO568TQaVH-oaDps&signed_in=true&libraries=places&callback=initAutocomplete"
async defer></script>
