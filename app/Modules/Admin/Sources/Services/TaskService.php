<?php


namespace App\Modules\Admin\Sources\Services;


use App\Modules\Admin\Sources\Models\Source;
use App\Modules\Admin\Sources\Requests\TaskCommentRequest;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\Task\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService{

    public function getTasks(){

        $tasks = new Task();
        $tasks = $tasks->getTasks(Auth::user());


        $statuses = Status::all();


        $resultTasks = [];
        $statuses->each(function($item, $key) use (&$resultTasks, $tasks){
            $collection = $tasks->where('status_id', $item->id);
            $resultTasks[$item->title] = $collection->map(function($elem){
                return $elem;
            });
        });
        return $resultTasks;

    }

    public function store($request, $user){

        $task = new Task();

        $status = Status::where('title', 'new')->firstOrFail();

        $user
            ->tasks()
            ->save($task->fill($request->except('comment'))->status()->associate($status));

        $task->statuses()->attach($status->id);

        $this->addTasksComments($task, $user, $status, $request);

        return $task;
    }

    public function archive()
    {
        /** @var Collection $tasks */
        $tasks = (new Task())->getArchives(Auth::user());
        return $tasks;
    }

    private function addTasksComments($task, $user, $status, $request)
    {
        $is_event = true;
        $tmpText = "Автор ".$user->fullname.' создал задачу со статусом '.$status->title_ru;
        TaskCommentService::saveComment($tmpText, $task, $user, $status, null, $is_event);

        if (isset($request->text) && $request->text != "") {
            $tmpText = "Пользователь <strong>" . $user->fullname . '</strong> оставил <strong>комментарий</strong> ' . $request->text;
            TaskCommentService::saveComment($tmpText, $task, $user, $status, $request->text);
        }
    }

}