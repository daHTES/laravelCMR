<?php


namespace App\Services\Response;


class ResponseServices  {

    private static function responseParams($status, $errors = [], $data = []){

        return [
          'status' => $status,
          'errors' => (object)$errors,
          'data' => (object)$data,
        ];
    }


    public static function sendJSONResponse($status,$code = 200, $errors = [], $data = []){
        return response()->json(
            self::responseParams($status, $errors, $data),
            $code
        );

    }

    public static function success($data = []){
        return self::sendJSONResponse(true, 200, [], $data);

    }

    public static function notFound($data = []){
        return self::sendJSONResponse(false, 404, [], []);

    }

}
