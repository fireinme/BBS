<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'PUT':
            case 'PATCH':
            case 'POST': {
                return [
                    // CREATE ROLES
                    'title' => 'required|max:50',
                    'body' => 'required|min:5',
                    'category_id' => 'required|numeric',
                ];
            }

            // UPDATE


            case 'GET':

            case 'DELETE':

            default: {
                return [
                    'title' => 'required|max:20',
                    'body' => 'required|min:5',
                    'category_id' => 'required|integer',
                ];
            };
        }
    }

    public function messages()
    {
        return [
            // Validation messages
            'body.min'=>'文章内容最少为五个字符'
        ];
    }
}
