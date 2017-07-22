<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        return view('admin.image.index', ['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/image/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            Storage::put($file->getClientOriginalName(), file_get_contents($file));
            $image = url('/') . '/storage/app/' . $file->getClientOriginalName();
            $data = [
                'name' => $input['name'],
                'url' => $image
            ];
        }
        $result = Image::create($data);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Save image success'
            ];
        } else {
            $response = [
                'status' => 'fail',
                'message' => 'Save image fail!'
            ];
        }
        session()->flash('response', $response);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::find($id);
        if (!empty($image)) {
            return view('admin.image.edit', ['image' => $image]);
        }
        return view('admin.image.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $data = [
            'name' => $input['name'],
        ];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            Storage::put($file->getClientOriginalName(), file_get_contents($file));
            $image = url('/') . '/storage/app/' . $file->getClientOriginalName();
            $data['url'] = $image;
        }
        $image = Image::find($id);
        if (!empty($image)) {
            $image->update($data);
            $response = [
                'status' => 'success',
                'message' => 'Update image success'
            ];
        } else {
            $response = [
                'status' => 'fail',
                'message' => 'Update image fail!'
            ];
        }
        session()->flash('response', $response);
        return redirect()->route('home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Image::destroy($id);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Destroy image success'
            ];
        } else {
            $response = [
                'status' => 'fail',
                'message' => 'Destroy image fail!'
            ];
        }
        session()->flash('response', $response);
        return redirect()->route('home');
    }
}
