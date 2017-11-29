<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 2017/11/29
 * Time: 16:49
 */

namespace App\Handlers;
class ImageUploadHandler
{
    protected $allowed_ext = ['png', 'jpg', 'gif', 'jpeg'];

    /*
     * @param
     * */
    public function save($file, $folder, $file_prefix)
    {
        //目标文件夹
        $folder_name = "uploads/images/$folder/" . date('Ym', time()) . '/' . date('d', time());
        $folder_path = public_path() . '/' . $folder_name;
        //文件名
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }
        $file_name = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;
        //移动
        $file->move($folder_path, $file_name);
        //返回路径
        return [
            'path' => config('app.url') . '/BBS/public'. "/$folder_name/$file_name"
        ];
    }

}