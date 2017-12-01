<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $topics = Topic::WithOrder(request('order'))->paginate(30);
        return view('topics.index', compact('topics'));
    }

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    public function create(Topic $topic)
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request)
    {
        $topic = new Topic();
        $topic->fill(\request()->all());
        $topic->user_id = Auth::user()->id;
        // $topic->excerpt = '';
        $topic->save();
        /* $data = $request->all();
         $data['user_id'] = Auth::user()->id;
         $topic = new Topic();
         $topic->fill($data);

         $topic->save();*/

        /*create为批量赋值，需要在模型中设置运行用户插入（$fillable属性 ）
         * $topic = Topic::create($data);
         * */
        return redirect()->route('topics.show', $topic->id)->with('success', '文章成功创建');
    }

    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update($request->all());

        return redirect()->route('topics.show', $topic->id)->with('success', '更新成功.');
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->delete();

        return redirect()->route('topics.index')->with('success', '删除成功.');
    }
}