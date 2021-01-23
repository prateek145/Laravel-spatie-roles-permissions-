<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Article;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->can('list page')){
            try{
                $data = Page::paginate(10);
                if(count($data) == 0){
                    throw new Exception('Nothing to show');
    
                }
                return view('page.index', ['data'=>$data]);
                
            }catch(Exception $e){
                return view('errors.page', ['error'=>$e->getMessage()]);
    
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
            return view('page.create', ['id'=>$id]);

        }else{
            return redirect()->back()->with('error', 'You are not authorize contact to admin.');
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
                    $page = new Page();
                    $page->title = $request->title;
                    $page->sub_heading = $request->subheading;
                    $page->meta_key = $request->metakey;
                    $page->short_description = $request->shortdescription;
                    $page->meta_description = $request->shortmeta;
                    $page->content = $request->content;

                    if($request->hasFile('image')){
                        $filename = $request->image->getClientOriginalName();
                        $request->image->storeAs('images', $filename, 'public');
                        $page->image = $filename;
                    }

                    $save = $page->save();
                    if($save ){
                        return redirect('page')->with('success', "Succesfully Article created.");
                    }else{
                        return redirect()->back()->with('error', "Created");
                    }
                    
                    
                }catch(Exception $e){
                    return view('errors.page', ['error'=>$e->getMessage()]);
                }
            }else{
                return redirect()->back()->with('error', 'You are not authorize contact to admin.');
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
        
        if(auth()->user()->can('view page')){

            $data = Page::find($id);
            return view('page.show', ['data'=>$data]);
        }else{
            return redirect()->back()->with('error', 'You are not authorize contact to admin.');
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
        if(auth()->user()->can('edit page')){

            $data = Page::find($id);
            return view('page/edit', ['id'=>$id, 'data'=>$data]);
        }else{
            return redirect()->back()->with('error', 'You are not authorize contact to admin.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->can('edit page')){

            $request->validate(
                [
                'title' => 'required',
                'metakey' => 'required',
                'page' => 'required'
                ]
            );
            
            try{
                if($request->hasFile('image')){
                    $filename = $request->image->getClientOriginalName();
                    $image = Page::find($request->id);
                    Storage::delete('/public/images/' . $image->image);
                    $request->image->storeAs('images', $filename, 'public');
                }else{
                    $image = Page::find($request->id);
                    $filename = $image->image;

                }

                Page::where(['id'=>$request->id])->update([
                    'title'=>$request->title,
                    'sub_heading'=>$request->subheading,
                    'meta_key'=>$request->metakey,
                    'short_description'=>$request->shortdescription,
                    'meta_description'=>$request->metadescription,
                    'content'=>$request->page,
                    'image'=>$filename, 
                ]);
                return redirect('page')->with('success', 'Successfully Updated');
                
            }catch(Exception $e){
                return view('errors.page', ['error'=>$e]);
                
            }
        }else{
            return redirect()->back()->with('error', 'You are not authorize contact to admin.');
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
        if(auth()->user()->can('delete page')){

            try{
                Page::destroy($id);
            }catch(Exception $e){
                return view('errors.page', ['error'=>$e]);
                
            }
            
            return redirect()->back()->with('success', 'Page deleted');
        }else{
            return redirect()->back()->with('error', 'You are not authorize contact to admin.');
        }
    }
}
