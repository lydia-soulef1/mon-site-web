<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentModel; // If you're using a model for parents
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ParentRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.parents'); // The view that contains your registration form
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:parents,email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $hashedPassword = Hash::make($request->password);

            // إنشاء سجل في جدول parents
            $parent = ParentModel::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $hashedPassword,
            ]);

            // إنشاء سجل في جدول users بناءً على بيانات جدول parents
            User::create([
                'name' => $parent->name,
                'email' => $parent->email,
                'password' => $parent->password,
                'is_pediatrician' => false, // لأنه ولي أمر وليس طبيب أطفال
            ]);

            Session::put('parent_id', $parent->id);
            Session::put('parent_name', $parent->name);
            Session::put('parent_email', $parent->email);

            return redirect()->route('login');
        } catch (\Exception $e) {

            return redirect()->route('register.parent')->with('error', 'database_error');
        }
    }
}