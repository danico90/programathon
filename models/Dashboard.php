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
            ['startDate', 'validateStartDate'],
            ['endDate', 'validateEndDate'],
        ];
    }

    public function validateStartDate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            
            if(strtotime($this->startDate) > strtotime($this->endDate)) {
                $this->addError($attribute, 'La fecha final debe ser mayor o igual que la fecha inicial.');
            }
            else {
                if (strtotime($this->startDate) > strtotime(date('Y-m-d'))) {
                    $this->addError($attribute, 'La fecha inicial debe ser menor o igual que le fecha actual.');
                }
            }
        }
    }

    public function validateEndDate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if(strtotime($this->endDate) > strtotime($this->endDate)) {
                $this->addError($attribute, 'La fecha inicial no puede ser mayor que la fecha final.');
            }
            else {
                if (strtotime($this->startDate) > strtotime(date('Y-m-d'))) {
                    $this->addError($attribute, 'La fecha inicial no puede ser mayor que la fecha actual.');
                }
            }
        }
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
