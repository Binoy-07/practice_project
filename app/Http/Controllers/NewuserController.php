<?php

namespace App\Http\Controllers;

use App\Models\newuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class NewuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('newusers')->paginate(10);
        return view('newuser',['data'=>$users]);
    }

    public function getUser(string $id)
    {
        $users = DB::table('newusers')->where('id',$id)->get();
        return view('newuser',['data'=>$users]);
    }

    public function deleteUser(string $id)
{
    // Retrieve the user's image path
    $user = DB::table('newusers')->where('id', $id)->first();

    if ($user) {
        // Delete the image file if it exists
        if ($user->image_path) {
            Storage::delete($user->image_path);
        }

        // Delete the user record
        $deleted = DB::table('newusers')->where('id', $id)->delete();

        if ($deleted) {
            echo '<h1>Data deleted successfully!</h1>';
            return redirect()->route('view.user');
        } else {
            echo '<h1>Error!</h1>';
        }
    } else {
        echo '<h1>User not found!</h1>';
    }
}

    public function addUser(Request $req)
    {
        $req->validate(
            [    
                'name'=>'required',
                'email'=>'required|email',
                'age'=>'required',
                'city'=>'required',
                 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
            $imageName = time().'.'.$req->image->extension();  
            $req->image->move(public_path('images'), $imageName);
        $user = DB::table('newusers')->insert([
                    'name' => $req->name,
                    'email' => $req->email,
                    'age' => $req->age,
                    'city' => $req->city,
                    'image_path' => $imageName,
        ]);

        if($user)
        {
            echo '<h1>Data Added successfully!</h1>';
        }
        else
        {
            echo '<h1>Error!</h1>';
        }
    }

    public function fetchData(string $id)
    {
        $users = DB::table('newusers')->find($id);
        return view('updateuser',['data'=>$users]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\newuser  $newuser
     * @return \Illuminate\Http\Response
     */
    public function show(newuser $newuser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\newuser  $newuser
     * @return \Illuminate\Http\Response
     */
    public function edit(newuser $newuser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\newuser  $newuser
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $req, string $id)
{
    $req->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'age' => 'required|integer',
        'city' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Find the user using Eloquent
    $user = newuser::findOrFail($id);

    // Update user attributes
    $user->name = $req->name;
    $user->email = $req->email;
    $user->age = $req->age;
    $user->city = $req->city;

    // Handle image upload
    if ($req->hasFile('image')) {
        // Delete old image if it exists
        if ($user->image_path) {
            Storage::delete($user->image_path);
        }

        $imageName = time().'.'.$req->image->extension(); 
        $req->image->move(public_path('images'), $imageName);
        $user->image_path = $imageName;
    }

    // Save the user data
    if ($user->save()) {
        echo '<h1>Data Updated successfully!</h1>';
    } else {
        echo '<h1>Error!</h1>';
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\newuser  $newuser
     * @return \Illuminate\Http\Response
     */
    public function destroy(newuser $newuser)
    {
        //
    }

   /* public function imageUpload()
    {
        return view('imageUpload');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            ['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);

        

        

        return back()
                    ->with('success', 'You have successfully upload image.')
                    ->with('image', $imageName); 

    }*/
}
