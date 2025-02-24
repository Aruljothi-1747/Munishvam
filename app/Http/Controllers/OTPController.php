<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Customers;
use Illuminate\Support\Facades\Auth;

class OTPController extends Controller
{
    public function sendOTP(Request $request)
    {
        $request->validate([
            'phonenumber' => 'required|regex:/^[6-9]\d{9}$/'
        ]);

        $otp = rand(1111, 9999);
        $phonenumber = $request->phonenumber;

        // ✅ Store OTP and phone number in session for verification
        Session::put('otp', $otp);
        Session::put('phonenumber', $phonenumber);
        Session::put('otp_expiry', now()->subSeconds(30));
    
       
        // ✅ Send OTP via SMS (Fast2SMS API)
        $fields = [
            "variables_values" => "$otp",
            "route" => "otp",
            "numbers" => "$phonenumber",
            
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => [
                "authorization:owMImny7rsGbvDQ9eqpYSBL0Zud8lczjECPaAfHxhtF1V4KX5R4bHrId2ZSgOwLu5PWpjKC8Aa6vNfyG",
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json",
            ],
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
       

        if ($error) {
            Log::error("OTP Send Failed: $error");
            return back()->withErrors(['phonenumber' => 'Failed to send OTP. Please try again.'])->withInput();
        } else {
            $data = json_decode($response, true); // Decode as array

if (isset($data['return']) && $data['return'] == true) {
    Log::info("OTP Sent Successfully to: $phonenumber");
    return redirect()->route('otp.verify.form')->with('success', 'OTP sent successfully.');
} else {
    Log::error("Error Sending OTP: " . json_encode($data));
    return back()->withErrors(['phonenumber' => 'Error sending OTP. Please try again.'])->withInput();
}

        }
    }
    public function showVerifyForm()
    {
        return view('otp_login.verify'); // Ensure this view exists
    }
    
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4'
        ]);
    
        $userOtp = $request->otp;
        $sessionOtp = Session::get('otp');
        $phonenumber = Session::get('phonenumber'); 
    
        if ($userOtp == $sessionOtp) {
            // Check if user already exists
            $user = User::where('phonenumber', $phonenumber)->first();
    
            if (!$user) {
                // Assign 'admin' role if phone number matches
                $role = ($phonenumber == "8754290365") ? 'admin' : 'client';
    
                // Create new user
                $user = User::create([
                    'name' => 'User' . rand(1000, 9999), 
                    'phonenumber' => $phonenumber, 
                    'role' => $role,
                ]);
    
                // Create customer entry for clients only
                if ($role === 'client') {
                    Customers::create([
                        'UserId' => $user->id, 
                        'Name' => $user->name,
                        'Phonenumber' => $user->phonenumber,
                    ]);
                }
            }
    
            // Log in the user
            Auth::login($user);
    
            // Clear OTP session
            Session::forget(['otp', 'phonenumber']);
    
            // Redirect based on role
            return ($user->role === 'admin')
                ? redirect('/productindex')->with('success', 'Welcome Admin!')
                : redirect('/productindex')->with('success', 'Welcome Client!');
                Session::forget(['otp', 'phonenumber']);
        } else {
            return back()->with('error', 'Invalid OTP. Please try again.');
        }
    }
    
}