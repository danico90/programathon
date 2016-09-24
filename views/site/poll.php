<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Poll';
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php  
	    foreach($model as $question){
	    	echo '<div class="question-row row">';
	        echo '<label class="col-sm-4">'.$question->question.'</label>';
			echo '<div class="anwers-row col-sm-8">';
		    	foreach($question->anwers as $anwers){
		    		
		    		echo '<input type="radio" name="'.$question->id.'" value="'.$anwers->value.'">'.$anwers->name;
		    		echo '</br>';
		    	}
	    	echo '</div>';
	    	echo '</div></br>';
	    } 
	    
    ?>
</div>
