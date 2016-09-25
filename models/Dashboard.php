<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Dashboard is the model behind the dashboard.
 */
class Dashboard extends Model
{
    public $startDate;
    public $endDate;
    public $genero;
    public $edad;
    public $pregunta1;
    public $pregunta2;
    public $pregunta3;
    public $pregunta4;
    public $pregunta5;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['startDate', 'endDate'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'startDate' => 'Fecha inicio',
            'endDate' => 'Fecha final',
        ];
    }
   
}
