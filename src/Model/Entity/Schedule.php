<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schedule Entity
 *
 * @property int $id
 * @property string $student_id
 * @property string $monitor_id
 * @property \Cake\I18n\FrozenTime $date_start_time
 * @property \Cake\I18n\FrozenTime $date_end_time
 * @property string $status
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Monitor $monitor
 */
class Schedule extends Entity
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
        'date_start_time' => true,
        'date_end_time' => true,
        'status' => true,
        'student' => true,
        'monitor' => true
    ];
}
