<?php
App::uses('AppModel', 'Model');
/**
 * Employee Model
 *
 */
class Employee extends AppModel {
    var $validate = array(
    'nazwisko' => array('rule' => 'notBlank'),
    'etat' => array('rule' => 'notBlank'),
    'placa_pod' => array(
        'rulemin' => array(
            'rule' => 'comparison', '>=', 0,
            'message' => 'Placa podstawowa musi zawierać się w przedziale <0,2000>'),
        'rulemax' => array(
            'rule' => 'comparison', '<=', 2000,
            'message' => 'Placa podstawowa musi zawierać się w przedziale <0,2000>')
        )
    );
}
