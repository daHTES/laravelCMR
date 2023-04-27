<?php


namespace App\Modules\Admin\LeadComment\Services;


use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\LeadComment\Models\LeadComment;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\Users\Models\User;

class LeadCommentService{

    public static function saveComment(
        $text,
        Lead $lead,
        User $user,
        Status $status,
        $commentValue = null,
        $is_event = false){

        $comment =  new LeadComment([
            'text' => $text,
            'comment_value' => $commentValue,
        ]);

        $comment->is_event = $is_event;

        $comment->
        lead()->
        associate($lead)->
        user()->
        associate($user)->
        status()->
        associate($status)->
        save();

        return $comment;
    }

    public function store($request, $user){

        $lead = Lead::findOrFail($request->lead_id);
        $status = Status::findOrFail($request->status_id);

        if($status->id != $lead->status_id){
            $lead->status()->associate($status)->update();

            $is_event = true;
            $tmpText = "Пользователь <strong>".$user->firstname."</strong> изменил статус лида ".$status->title_ru;
            LeadCommentService::saveComment($tmpText, $lead, $user, $status, null, $is_event);

            $lead->statuses()->attach($status->id);
        }

        if($request->user_id && $request->user_id != $lead->user_id){
            $newUser = User::findOrFail($request->user_id);
            $lead->status()->associate($newUser)->update();

            $is_event = true;
            $tmpText = "Пользователь <strong>".$user->firstname."</strong> изменил автора лида на ".$newUser->firstname;
            LeadCommentService::saveComment($tmpText, $lead, $user, $status, null, $is_event);
        }

        if($request->text){
            $tmpText = "Пользователь <strong>".$user->firstname."</strong> оставил комментарий ".$request->text;
            LeadCommentService::saveComment($tmpText, $lead, $user, $status, $request->text);
        }

        return $lead;

    }

}
