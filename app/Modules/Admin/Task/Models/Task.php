<?php


namespace App\Modules\Admin\Task\Models;


use App\Modules\Admin\Sources\Models\Source;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\TaskComment\Models\TaskComment;
use App\Modules\Admin\Unit\Models\Unit;
use App\Modules\Admin\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    protected $fillable = [
        'link',
        'phone',
        'source_id',
        'init_id',
        'user_id',
        'resposible_id',
    ];

    public function getTasks(User $user){

        $builder = $this
            ->with([
                'source',
                'init',
                'status'
            ])->where(function($query){
                $query->whereBetween('status_id', [1, 2])
                    ->orWhere([
                        ['status_id', 3],
                        ['updated_at', '>', \DB::raw('DATE_SUB(NOW(), INTERVAL 24 HOUR)')],
                    ]);
            });
        if($user->hasRole('manager')){
            $builder->where(function($query) use ($user){
                $query
                    ->where('user_id', $user->id)
                    ->orWhere('responsible_id', $user->id);
            });
        }

        return $builder
            ->orderBy('created_at')
            ->get();
    }

    public function getArchives(User $user){

        $builder = $this
            ->with([
                'status',
                'source',
                'unit'
            ]
            )->where(function($query){
                $query
                    ->where('updated_at', '<', \DB::raw('DATE_SUB(NOW(), INTERVAL 24 HOUR)'))
                    ->where('status_id', 3);
            });

        if($user->hasRole('manager')) {
            $builder->where(function($query) use ($user) {
                $query
                    ->where('user_id', $user->id)
                    ->orWhere('responsible_id', $user->id);
            });
        }
        return $builder
            ->orderBy('updated_at', 'DESC')
            ->paginate(config('settings.pagination'));
    }

    public function statuses(){
        return $this->belongsToMany(Status::class,'task_status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(){
        return $this->belongsTo(Status::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source(){
        return $this->belongsTo(Source::class);
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
    public function responsibleUser(){
        return $this->belongsTo(User::class,'responsible_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit(){
        return $this->belongsTo(Unit::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(){
        return $this->hasMany(TaskComment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lastComment(){
        return $this->comments()->where('comment_value', '!=', NULL)->orderBy('id','desc')->first();
    }

}
