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
        if(auth()->user()->can('list article')){
            try{
                $data = Article::paginate(10);
                if(count($data) == 0){
                    throw new Exception('Please Create Article');
    
                }
                return view('article.index', ['data'=>$data]);
                
            }catch(Exception $e){
                return view('errors.article', ['error'=>$e->getMessage()]);
    
            }

        }
        else{
            return view('errors.unauthenticate');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->can('create article')){
            $id = auth()->id();
            return view('article/create', ['id'=>$id]);

        }else{
            return view('errors.unauthenticate');
        }
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->can('create article')){

            
            $request->validate([
                'title' => 'required',
                'metakey' => 'required',
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
                        return redirect()->back()->with('success', "Succesfully Article created.");
                    }else{
                        return redirect()->back()->with('error', "Created");
                    }
                    
                    
                }catch(Exception $e){
                    return view('errors.article', ['error'=>$e->getMessage()]);
                }
            }else{
                return view('errors.unauthenticate');
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
        if(auth()->user()->can('view article')){

            $data = Article::find($id);
            return view('article.show', ['data'=>$data]);
        }else{
            return view('errors.unauthenticate');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->can('edit article')){

            $data = Article::find($id);
            return view('article/edit', ['id'=>$id, 'data'=>$data]);
        }else{
            return view('errors.unauthenticate');
        }
        
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
        if(auth()->user()->can('edit article')){

            $request->validate(
                ['article' => 'required|min:10',
                'title' => 'required',
                'metakey' => 'required'
                ]
            );
            
            try{
                Article::where(['id'=>$request->id])->update([
                    'title'=>$request->title,
                    'sub_heading'=>$request->subheading,
                    'meta_key'=>$request->metakey,
                    'short_description'=>$request->shortdescription,
                    'meta_description'=>$request->metadescription,
                    'content'=>$request->article
                ]);
                return redirect('article')->with('success', 'Successfully Updated');
                
            }catch(Exception $e){
                return view('errors.article', ['error'=>$e]);
                
            }
        }else{
            return view('errors.unauthenticate');
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
        if(auth()->user()->can('delete article')){

            try{
                Article::destroy($id);
            }catch(Exception $e){
                return view('errors.article', ['error'=>$e]);
                
            }
            
            return redirect()->back()->with('success', 'Article deleted');
        }else{
            return view('errors.unauthenticate');
        }
    }
}
