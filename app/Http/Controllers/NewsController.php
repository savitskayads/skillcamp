<?php

namespace App\Http\Controllers;

use Request;

use Requests;
use App\Http\Controllers\Controller;
use App\News;
use Input;
use Illuminate\Routing;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_news=News::all();
        return view('admin.news', ['all_news'=> $all_news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $news = new News();
        return view('admin.edit_news',['news'=> $news]);
    }



    public function save(){
        $id = Request::input('id');
        $news = News::find($id);
        $flag = 0;
        if(!$news){
            $news = new News;
            $flag = 1;
        }
        $news->title = Request::input('title');
        $news->description = Request::input('description');
        $news->active = Request::input('active');
        $news->date = Request::input('date') ;
        $news->save();
        if(Request::hasFile('img')){

            $image = Input::file('img');
            $validator = Validator::make(
                array(

                    'image' => $image,
                ),
                array(
                    'image' => 'mimes:jpeg,bmp,png',

                )
            );

            if ($validator->fails())
            {
                $error_messages = $validator->messages();
                $message = "Invalid Input File";
                $type = "failed";
                return Redirect::to('admin/news/{id}/edit')->with('message',$message);

            } else{
                $news->image = upload_news_image(Input::file('img'));
                $news->save();
            }

        } else{
            if($flag == 1){
                //$news->image_url ="default_product.png";
            }
        }
        return redirect('admin/news/'.$news->id.'/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        $all_news = News::where('active','=','1')
            ->get();
        return view('news', ['news' => $news, 'all_news'=>$all_news]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);

        return view('admin.edit_news',['news'=> $news]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
        return 'true';
    }

    public function publish($id)
    {
        $news = News::find($id);
        $news->active = 1;
        $news -> save();
        return 'true';
    }
    public function unpublish($id)
    {
        $news = News::find($id);
        $news->active = 0;
        $news -> save();
        return 'true';
    }
}
