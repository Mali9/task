<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact(['companies']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate(
            [
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'unique:companies'],
                'url' => ['required', 'max:255'],
                'logo' => ['max:255', 'dimensions:min_width=100,min_height=200', 'image'],
            ]
        );

        if (!$validatedData) {
            return redirect()->back()->withInput($validatedData);
        }
        $Company = new Company();
        $Company->name = $request->name;
        $Company->url = $request->url;
        $Company->email = $request->email;

        $file_name = time();
        $file_name .= rand();
        $file_name = sha1($file_name); /* todo  use UUID for file name*/
        if ($request->logo) {
            $resized_image = Image::make($request->logo)->resize(100, 100)->stream('png', 100);
            $url1 = '/' . "$file_name.png";
            Storage::disk('public')->put($url1, $resized_image);
            $Company->logo = asset('storage') . $url1;

        }

        $Company->save();
        return redirect('/companies')->with('success', 'well Done!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $Company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('companies/create', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate(
            [
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'unique:companies,email,' . $id],
                'url' => ['required', 'max:255'],
                'logo' => ['max:255', 'dimensions:min_width=100,min_height=200', 'image'],
            ]
        );

        if (!$validatedData) {
            return redirect()->back()->withInput($validatedData);
        }
        $Company = Company::find($id);
        $Company->name = $request->name;
        $Company->url = $request->url;
        $Company->email = $request->email;

        $file_name = time();
        $file_name .= rand();
        $file_name = sha1($file_name); /* todo  use UUID for file name*/
        if (isset($request->logo)) {
            $resized_image = Image::make($request->logo)->resize(100, 100)->stream('png', 100);
            $url1 = '/' . "$file_name.png";
            Storage::disk('public')->put($url1, $resized_image);
            $Company->logo = asset('storage') . $url1;

        }

        $Company->save();
        return redirect('/companies')->with('success', 'well Done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Company = Company::find($id);
        $Company->delete();
        return redirect('/companies')->with('success', 'well Done!');
    }
}
