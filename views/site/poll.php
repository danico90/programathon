<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Poll';
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php  
	    foreach($model as $question){
	    	echo '<div class="question-row">';
	        echo '<label>'.$question->question.'</label>';

	    	foreach($question->anwers as $anwers){
	    		echo '<div class="anwers-row">';
	    		echo '<input type="radio" name="'.$question->id.'" value="'.$anwers->value.'">'.$anwers->name;
	    		echo '</div>';
	    	}
	    	echo '</div></br>';
	    } 
	    
    ?>
</div>
