<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\Student;   // Your User model
use App\Models\Score;     // Score model

class StudentController extends Controller
{
    public function register(Request $request)
    {
        Log::info("🎓 Student registration started.", [
            'input' => $request->only(['name', 'reg_no', 'username', 'email'])
        ]);

        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'name'              => 'required|string|max:255',
                'reg_no'            => 'required|string',
                'username'          => 'required|string|max:255',
                'email'             => 'required|email',
                'password'          => 'required|min:6',
                'confirm_password'  => 'required|same:password'
            ]);

            if ($validator->fails()) {
                $errorMsg = $validator->errors()->first();
                Log::warning("❌ Validation failed: {$errorMsg}");

                return response()->json([
                    'message' => $errorMsg
                ], 422);
            }

            // Manual duplicate checks
            if (Student::where('reg_no', $request->reg_no)->exists()) {
                Log::warning("❌ Registration failed — Reg No already exists", [
                    'reg_no' => $request->reg_no
                ]);

                return response()->json([
                    'message' => 'This registration number already exists.'
                ], 409);
            }

            if (Student::where('email', $request->email)->exists()) {
                Log::warning("❌ Registration failed — Email already exists", [
                    'email' => $request->email
                ]);

                return response()->json([
                    'message' => 'This email is already in use.'
                ], 409);
            }

            if (Student::where('username', $request->username)->exists()) {
                Log::warning("❌ Registration failed — Username already exists", [
                    'username' => $request->username
                ]);

                return response()->json([
                    'message' => 'This username is already taken.'
                ], 409);
            }

            // Create student
            $student = Student::create([
                'name'      => strtoupper($request->name),
                'reg_no'    => strtoupper($request->reg_no),
                'username'  => $request->username,
                'email'     => $request->email,
                'role'      => 'student',
                'password'  => Hash::make($request->password),
            ]);

            Log::info("✅ Student registered successfully.", [
                'student_id' => $student->id,
                'reg_no'     => $student->reg_no,
                'username'   => $student->username
            ]);

            // Auto-login after registration
            Session::put('loggedInStudent', true);
            Session::put('user', [
                'id'       => $student->id,
                'email'    => $student->email,
                'name'     => $student->name,       // already uppercased
                'role'     => 'student',
                'reg_no'   => $student->reg_no,     // already uppercased
            ]);
            Session::put('last_activity', now());


            Log::info("🔐 Student automatically logged in after registration.", [
                'student_id' => $student->id
            ]);

            return response()->json([
                'message' => 'Student registered successfully!',
                'user'    => $student,
                'redirect' => '/student-dashboard',
            ]);

        } catch (\Exception $e) {

            Log::error("🔥 Unexpected registration error: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'An unexpected error occurred. Please try again.'
            ], 500);
        }
    }




    // Student Login
    public function login(Request $request)
    {
        Log::info("🔐 Student login attempt started.", [
            'email' => $request->email
        ]);

        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'email'     => 'required|email',
                'password'  => 'required|string|min:6'
            ]);

            if ($validator->fails()) {
                $errorMsg = $validator->errors()->first();
                Log::warning("❌ Login validation failed: {$errorMsg}");

                return response()->json([
                    'message' => $errorMsg
                ], 422);
            }

            // Find student
            $student = Student::where('email', $request->email)->first();

            if (!$student) {
                Log::warning("❌ Login failed: email not found or not a student", [
                    'email' => $request->email
                ]);

                return response()->json([
                    'message' => 'Student with this email does not exist.'
                ], 401);
            }

            // Check password
            if (!Hash::check($request->password, $student->password)) {
                Log::warning("❌ Login failed: incorrect password", [
                    'student_id' => $student->id,
                    'email' => $student->email
                ]);

                return response()->json([
                    'message' => 'Incorrect password.'
                ], 401);
            }

            // SUCCESS → Store session
            Session::put('loggedInStudent', true);
            Session::put('user', [
                'id'       => $student->id,
                'email'    => $student->email,
                'name'     => $student->name,
                'role'     => 'student',
                'reg_no'   => $student->reg_no,
            ]);
            Session::put('last_activity', now());

            Log::info("✅ Student logged in successfully.", [
                'student_id' => $student->id,
                'email'      => $student->email
            ]);

            return response()->json([
                'message' => 'Login successful!',
                'redirect' => '/student-dashboard'
            ]);

        } catch (\Exception $e) {

            Log::error("🔥 Student login error: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'An unexpected error occurred. Please try again.'
            ], 500);
        }
    }





    /**
    * Check student result
    */

    public function checkResult(Request $request)
    {
        try {
            // Validate input
            $request->validate([
                'reg_no'   => 'required',
                'name'     => 'required',
                'class'    => 'required',
                'semester' => 'required',
                'password' => 'required'
            ]);

            Log::info("Result check requested", [
                'reg_no'   => $request->reg_no,
                'name'     => $request->name,
                'class'    => $request->class,
                'semester' => $request->semester,
                'password' => '****'
            ]);

            // 1️⃣ Find student ONLY by reg_no + name
            $student = Student::where('reg_no', $request->reg_no)
                            ->where('name', $request->name)
                            ->first();

            if (!$student) {
                Log::warning("Invalid student details", [
                    'reg_no' => $request->reg_no,
                    'name'   => $request->name
                ]);

                return response()->json(['message' => 'Invalid student details.'], 404);
            }

            // 2️⃣ Validate password
            if (!Hash::check($request->password, $student->password)) {
                Log::warning("Incorrect password attempt", [
                    'reg_no' => $student->reg_no
                ]);

                return response()->json(['message' => 'Incorrect password.'], 401);
            }

            // 3️⃣ Fetch scores USING user selected class & semester (not student's stored class)
            $scores = Score::where('reg_no', $student->reg_no)
                            ->where('class', $request->class)
                            ->where('semester', $request->semester)
                            ->get();

            if ($scores->isEmpty()) {
                Log::info("No scores found", [
                    'reg_no'   => $student->reg_no,
                    'class'    => $request->class,
                    'semester' => $request->semester
                ]);

                return response()->json(['message' => 'No result found.'], 404);
            }

            // 4️⃣ Build HTML for subjects
            $subjects = '';
            foreach ($scores as $s) {
                $subjects .= "<p><strong>{$s->subject}:</strong> {$s->total}</p>";
            }

            Log::info("Result fetched successfully", [
                'reg_no'   => $student->reg_no,
                'class'    => $request->class,
                'semester' => $request->semester
            ]);

            return response()->json([
                'name'        => $student->name,
                'reg_no'      => $student->reg_no,
                'class'       => $request->class,     // use selected class
                'semester'    => $request->semester,  // use selected semester
                'scores_html' => $subjects
            ]);

        } catch (\Exception $e) {
            Log::error("Error fetching student result", [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'An unexpected error occurred. Please try again later.'
            ], 500);
        }
    }






    /**
     * Fetch student account details.
    */
    public function fetchAccount()
    {
        try {
            if (!Session::has('loggedInStudent')) {
                Log::warning("Fetch account attempt without login");
                return response()->json(['message' => 'Not logged in.'], 401);
            }

            $user = Session::get('user');
            $studentId = $user['id'];

            Log::info("Fetching student account", [
                'student_id' => $studentId,
                'email'      => $user['email']
            ]);

            $student = Student::find($studentId);

            if (!$student) {
                Log::warning("Student record not found", [
                    'student_id' => $studentId
                ]);

                return response()->json(['message' => 'Student record not found.'], 404);
            }

            Log::info("Student account fetched successfully", [
                'student_id' => $student->id
            ]);

            return response()->json($student);

        } catch (\Exception $e) {
            Log::error("Error fetching student account", [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'An unexpected error occurred. Try again later.'
            ], 500);
        }
    }










    /**
     * Update student account details.
     */
    public function updateAccount(Request $request)
    {
        try {
            if (!Session::has('loggedInStudent')) {
                Log::warning("Update attempt without login");
                return response()->json(['message' => 'Not logged in.'], 401);
            }

            // Validate input
            $request->validate([
                'name'     => 'required',
                'reg_no'   => 'required',
                'username' => 'required',
                'email'    => 'required|email'
            ]);

            $user = Session::get('user');
            $studentId = $user['id'];

            Log::info("Account update requested", [
                'student_id' => $studentId,
                'email'      => $request->email,
                'reg_no'     => $request->reg_no
            ]);

            $student = Student::find($studentId);

            if (!$student) {
                Log::warning("Student not found for update", [
                    'student_id' => $studentId
                ]);

                return response()->json(['message' => 'Student not found.'], 404);
            }

            // Update fields
            $student->name     = $request->name;
            $student->reg_no   = $request->reg_no;
            $student->username = $request->username;
            $student->email    = $request->email;
            $student->save();

            // Update session
            Session::put('user', [
                'id'     => $student->id,
                'email'  => $student->email,
                'name'   => $student->name,
                'role'   => 'student',
                'reg_no' => $student->reg_no,
            ]);

            Log::info("Student account updated successfully", [
                'student_id' => $student->id,
                'email'      => $student->email
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Account updated successfully'
            ]);

        } catch (\Exception $e) {
            Log::error("Error updating student account", [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'An unexpected error occurred. Please try again later.'
            ], 500);
        }
    }












    /**
     * Update student password.
     */ 
    public function updateStudentPassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:6'
        ]);

        try {
            // Make sure student is logged in
            if (!Session::has('loggedInStudent')) {
                Log::warning("Password update failed: student not logged in.");
                return response()->json(['message' => 'You are not logged in'], 401);
            }

            // Retrieve logged-in student session
            $user = Session::get('user'); // stored as array
            $studentId = $user['id'];

            $student = Student::find($studentId);

            if (!$student) {
                Log::warning("Password update failed: student not found.", [
                    'student_id' => $studentId
                ]);
                return response()->json(['message' => 'Student not found'], 404);
            }

            // Check current password
            if (!Hash::check($request->currentPassword, $student->password)) {
                Log::warning("Student password change failed: incorrect password.", [
                    'reg_no' => $student->reg_no
                ]);
                return response()->json(['message' => 'Current password incorrect'], 403);
            }

            // Update new password
            $student->password = Hash::make($request->newPassword);
            $student->save();

            Log::info("Student password updated successfully.", [
                'reg_no' => $student->reg_no
            ]);

            return response()->json(['message' => 'Password updated successfully']);

        } catch (\Exception $e) {
            Log::error("Student password update error: " . $e->getMessage());
            return response()->json([
                'message' => 'Update error: ' . $e->getMessage()
            ], 500);
        }
    }



}
