<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Agendamento Entity
 *
 * @property int $student_id
 * @property int $monitor_id
 * @property \Cake\I18n\FrozenTime $date_hour_init
 * @property \Cake\I18n\FrozenTime $date_hour_end
 * @property string $status
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Monitor $monitor
 */
class Agendamento extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'student_id' => true,
        'monitor_id' => true,
        'date_hour_init' => true,
        'date_hour_end' => true,
        'status' => true,
        'student' => true,
        'monitor' => true
    ];
}
