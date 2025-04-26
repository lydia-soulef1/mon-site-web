<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pediatrician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PediatricianRegistrationController extends Controller
{
    // Show the registration form
    public function showForm()
    {
        return view('auth.medecin');
    }

    // Handle registration form submission
    public function register(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pediatricians,email',
            'password' => 'required|min:8|regex:/[A-Z]/|regex:/[0-9]/',
            'hospital' => 'required|string|max:255',
            'rpps_number' => 'required|string|unique:pediatricians,rpps_number',
        ]);

        // Create the pediatrician record in the database
        $pediatrician = new Pediatrician();
        $pediatrician->name = $validated['name'];
        $pediatrician->email = $validated['email'];
        $pediatrician->password = Hash::make($validated['password']); // Hash the password
        $pediatrician->hospital = $validated['hospital'];
        $pediatrician->rpps_number = $validated['rpps_number'];
        $pediatrician->save();

        // Also create a user entry with 'is_pediatrician' set to true
        User::create([
            'name' => $pediatrician->name,
            'email' => $pediatrician->email,
            'password' => $pediatrician->password, // already hashed
            'is_pediatrician' => true,
        ]);

        // Start a session and store the user information
        session(['pediatrician_id' => $pediatrician->id]);
        session(['pediatrician_name' => $pediatrician->name]);
        session(['pediatrician_email' => $pediatrician->email]);

        // Redirect to the welcome page
        return redirect()->route('login');  // Adjust this as needed
    }
}


