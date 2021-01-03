<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data = Article::all();
            if(count($data) == 0){
                throw new Exception('Please Create Article');

            }
            return view('article.index', ['data'=>$data]);
            
        }catch(Exception $e){
            return view('errors.article', ['error'=>$e->getMessage()]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = auth()->id();
        return view('article/create', ['id'=>$id]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subheading' => 'required',
            'metakey' => 'required',
            'shortdescription' => 'required',
            'shortmeta' => 'required',
            'content'=>'required|max:10000|min:10',
        ]);
        try{
            $article = new Article();
            $article->title = $request->title;
            $article->sub_heading = $request->subheading;
            $article->meta_key = $request->metakey;
            $article->short_description = $request->shortdescription;
            $article->meta_description = $request->shortmeta;
            $article->content = $request->content;
            $save = $article->save();
            if($save ){
                return redirect()->route('article.index')->with('success', "Succesfully Article created.");
            }else{
                return redirect()->back()->with('error', "Created");
            }
            
            
        }catch(Exception $e){
            return view('errors.article', ['error'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('article/update', ['id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate(
            ['article' => 'required|min:10',
            ]
        );

        try{
            Article::where(['id'=>$request->id])->update(['name'=>$request->article]);
            return redirect('article.index')->with('success', 'Successfully Updated');

        }catch(Exception $e){
            return view('errors.article', ['error'=>$e]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Article::destroy($id);
        }catch(Exception $e){
            return view('errors.article', ['error'=>$e]);

        }
        
        return redirect('article.index');
    }
}
