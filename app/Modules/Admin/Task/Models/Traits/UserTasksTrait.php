<?php


namespace App\Modules\Admin\Task\Models\Traits;


use App\Modules\Admin\Task\Models\Task;

trait UserTasksTrait{

    public function tasks(){

        return $this->hasMany(Task::class);
    }

    public function responsibleTasks(){
        return $this->hasMany(Task::class, 'responsible_id','id');
    }

}
