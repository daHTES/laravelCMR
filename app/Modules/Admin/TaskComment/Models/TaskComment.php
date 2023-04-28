<?php

namespace App\Modules\Admin\TaskComment\Models;

use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model{
    use HasFactory;

    protected $fillable = [
        'text',
        'comment_value',
    ];
    public function task(){
        return $this->belongsTo(Task::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(){
        return $this->belongsTo(Status::class);
    }
}
