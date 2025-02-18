<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Customers; // Include Customer model at the top
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('user.index', compact('data'));
    }

    public function Login()
    {
        return view('user.login');
    }

 public function LoginPage(Request $request)
{
    // Validate the form input
    $request->validate([
        'phonenumber' => 'required|regex:/^[6-9][0-9]{9}$/', // Ensure valid phone number format
        'password' => 'required'
    ]);

    // Attempt login using phonenumber and password
    if (Auth::attempt(['phonenumber' => $request->phonenumber, 'password' => $request->password])) {
        // Check user role and redirect accordingly
        $user = Auth::user();

        if ($user->role === 'Admin') {
            return redirect()->route('OrderDetails.OrderIndex'); // Redirect Admins to User Index
        } elseif ($user->role === 'Client') {
            return redirect()->route('app.cashew_Layout'); // Redirect Clients to cashew_layout
        } else {
            Auth::logout(); // Logout if role is unrecognized
            return redirect()->route('user.login')->withErrors(['error' => 'Unauthorized access']);
        }
    } else {
        // Redirect back with an error if credentials are invalid
        return redirect()->route('user.login')->withErrors(['error' => 'Invalid phone number or password']);
    }
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('app.cashew_Layout')->with('success', 'You have been logged out successfully.');
    }

    public function usercreate()
    {
        return view('user.usercreate');
    }


// public function store(Request $request)
// {
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|string|email|unique:user|max:255',
//         'password' => ['required', 'string', 'min:5', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}$/'],
//         'confirmpassword' => 'required|same:password',
//         'phonenumber' => ['required|unique:user|', 'regex:/^[6-9][0-9]{9}$/'],

//     ]);

//     // Create the new user
//     $user = new User;
//     $user->name = $request->input('name');
//     $user->email = $request->input('email');
//     $user->password = bcrypt($request->input('password'));
//     $user->confirmpassword = $request->input('confirmpassword');
//     $user->phonenumber = $request->input('phonenumber');
//     $user->role = $request->input('role');
//     $user->save();

//     // Log in the new user
//     Auth::login($user);

//     // Redirect to the specific layout page with a success message
//     return redirect()->route('app.cashew_Layout')->with('success', $user->name . ' - Registered and logged in successfully');
// }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        // 'email' => 'required|string|email|unique:users|max:255',
        'password' => ['required', 'string', 'min:5', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}$/'],
        'confirmpassword' => 'required|same:password',
        'phonenumber' => ['required', 'regex:/^[6-9][0-9]{9}$/', 'unique:users' ],
        'role' => 'required', // Ensure a role is specified
    ]);

    // Create the new user
    $user = new User;
    $user->name = $request->input('name');
    $user->password = bcrypt($request->input('password'));
    $user->confirmpassword = $request->input('confirmpassword');
    $user->phonenumber = $request->input('phonenumber');
    $user->role = $request->input('role');
    $user->save();

    // Automatically create an associated customer record
    Customers::create([
        'UserId' => $user->id, // Ensure UserId is set
        'Name' => $user->name,
        'Phonenumber' => $user->phonenumber,
    ]);

    // Log in the new user
    Auth::login($user);

    // Redirect to the specific layout page with a success message
    return redirect()->route('app.cashew_Layout')->with('success', $user->name . ' - Registered and logged in successfully');
}


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => ['required', 'string', 'min:5', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}$/'],
            'confirmpassword' => 'required|same:password',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($id),
                'max:255'
            ]
        ]);
        $inputdata = User::findOrFail($id);
        $inputdata->name = $request->input('name');
        $inputdata->email = $request->input('email');
        $inputdata->password = bcrypt($request->input('password'));
        $inputdata->confirmpassword = $request->input('confirmpassword');
        $inputdata->update();
        return redirect()->route('user.index')->with('success', $inputdata->name . ' - Updated Successfully');
    }


    public function destroy($id)
    {
        $userrole = User::findOrFail($id);
        $userrole->delete();
        return back()->with('success', 'User Role record deleted successfully');
    }

    //Superadmin
    public function Superadminindex()
    {
        $data = User::where('role', 'Superadmin')->get();
        return view('superadmindashboard.Superadmin.Superadminindex', compact('data'));
    }

    public function SuperadminCreate()
    {
        return view('superadmindashboard.superadmin.superadmincreate');
    }

    public function Superadminstore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'confirmpassword' => 'required|same:password',
        ]);
        $inputdata = new User;
        $inputdata->name = $request->input('name');
        $inputdata->restaurantname = $request->input('restaurantname');
        $inputdata->restaurantid = $request->input('restaurantid');
        $inputdata->email = $request->input('email');
        $inputdata->password = bcrypt($request->input('password'));
        $inputdata->confirmpassword = $request->input('confirmpassword');
        $inputdata->phonenumber = $request->input('phonenumber');
        $inputdata->role = $request->input('role');
        $inputdata->save();
        return redirect()->route('superadmindashboard.Superadmin.Superadminindex')->with('success', $inputdata->name . ' - Updated Successfully');
    }

    public function Superadminedit($id)
    {
        $user = User::findOrFail($id);
        return view('Superadmin.Superadminedit', compact('user'));
   
    }

    public function Superadminupdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => ['required', 'string', 'min:5', 'regex:/^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[@$!%?&])[A-Za-z\d@$!%?&]{5,}$/'],
            'confirmpassword' => 'required|same:password',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($id),
                'max:255'
            ]
        ]);
        $inputdata = User::findOrFail($id);
        $inputdata->name = $request->input('name');
        $inputdata->email = $request->input('email');
        $inputdata->password = bcrypt($request->input('password'));
        $inputdata->confirmpassword = $request->input('confirmpassword');
        $inputdata->update();
        return redirect()->route('Superadmin.Superadminindex')->with('success', $inputdata->name . ' - Updated Successfully');
    }

}