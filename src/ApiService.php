<?php namespace Waqar\Utility;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ApiService
{
    private $validator;


    private function make_validator($rules, $messages = [])
    {
        return $this->validator = Validator::make(request()->all(), $rules, $messages);
    }

    public function response($data = null, $message = '', $status = 200)
    {
        return Response::json([
            'data' => $data,
            'status' => $status,
            'message' => $message,
            'request' => request()->all(),
        ], $status);
    }

    public function not_found($message = 'The response you are looking for not found.')
    {
        return $this->response(null, $message, 404);
    }

    public function validate($rules, $messages = [])
    {
        $this->make_validator($rules, $messages);
        return !$this->validator->fails();
    }

    public function validation_errors()
    {
        $errors = $this->validator->errors()->toArray();
        $errors = array_values($errors);
        $errors = call_user_func_array('array_merge', $errors);

        return $this->response($errors, $this->validator->errors()->first(), 422);
    }

    public function error($message = '', $status = 422)
    {
        return $this->response(null, $message, $status);
    }

    public function server_error(\Throwable $throwable)
    {
        return $this->response(null, $throwable->getMessage(), $throwable->getCode() ?? 500);
    }

    public function forbidden()
    {
        return $this->response(null, 'You don\'t permission to perform this action.', 403);
    }

    public function unauthenticated()
    {
        return $this->response(null, 'User is not authenticated, Authentication Required.', 401);
    }

}