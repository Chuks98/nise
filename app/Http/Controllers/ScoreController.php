<?php

namespace App\Http\Controllers;

use App\Imports\ScoreImport;
use App\Models\Score;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;

class ScoreController extends Controller
{
    // -----------------------------------------
    // 📌 CREATE SINGLE SCORE
    // -----------------------------------------
    public function createScore(Request $request)
    {
        try {
            Log::info("📝 Create score request", [
                'data' => $request->all()
            ]);

            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'name'     => 'required|string|max:255',
                'reg_no'   => 'required|string|max:100',
                'class'    => 'required|string|max:100',
                'semester' => 'required|string|max:50',
                'session'  => 'required|string|max:50',
                'total'    => 'required|numeric|min:0',
                'average'  => 'required|numeric|min:0|max:100',
                'position' => 'required|integer|min:1',
                'remarks'  => 'required|string|max:255'
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                Log::warning("⚠️ Validation failed", [
                    'errors' => $validator->errors()
                ]);

                return response()->json([
                    'status'  => false,
                    'message' => 'Validation failed',
                    'errors'  => $validator->errors()
                ], 422);
            }

            // Prepare uppercase values for duplicate check
            $nameUpper = strtoupper($request->name);
            $regNoUpper = strtoupper($request->reg_no);
            $classUpper = strtoupper($request->class);
            $semesterUpper = strtoupper($request->semester);
            $sessionUpper = $request->session;
            $remarksUpper = strtoupper($request->remarks);

            // Check for complete duplicate record
            $duplicateExists = Score::where('name', $nameUpper)
                ->where('reg_no', $regNoUpper)
                ->where('class', $classUpper)
                ->where('semester', $semesterUpper)
                ->where('session', $sessionUpper)
                ->where('total', $request->total)
                ->where('average', $request->average)
                ->where('position', $request->position)
                ->where('remarks', $remarksUpper)
                ->exists();

            if ($duplicateExists) {
                Log::warning("⚠️ Duplicate record detected", [
                    'name'   => $nameUpper,
                    'reg_no' => $regNoUpper
                ]);

                return response()->json([
                    'status'  => false,
                    'message' => 'A complete duplicate record already exists with the same details.'
                ], 409); // 409 Conflict
            }

            // Create the score record
            $score = Score::create([
                's_no'     => $request->serialNumber, 
                'name'     => $nameUpper,
                'reg_no'   => $regNoUpper,
                'class'    => $classUpper,
                'semester' => $semesterUpper,
                'session'  => $sessionUpper,
                'total'    => $request->total,
                'average'  => $request->average,
                'position' => $request->position,
                'remarks'  => $remarksUpper
            ]);

            Log::info("✅ Score created successfully", [
                'id'     => $score->id,
                'reg_no' => $score->reg_no
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Student record created successfully',
                'data'    => $score
            ], 201);

        } catch (Exception $e) {
            Log::error("❌ Failed to create score", [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);

            return response()->json([
                'status'  => false,
                'message' => 'Failed to create student record. Please try again.'
            ], 500);
        }
    }

    // -----------------------------------------
    // 📌 IMPORT SCORES FROM EXCEL
    // -----------------------------------------
    public function importScores(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {

            Log::info('📥 Import started', [
                'filename' => $request->file('file')->getClientOriginalName(),
                'size'     => $request->file('file')->getSize()
            ]);

            Excel::import (new ScoreImport,$request->file('file'));

            Log::info('✅ Import finished successfully');

            return back()->with('success', 'Records Imported Successfully!');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {

            // Excel-specific validation error
            Log::error('❌ Excel Validation Error', [
                'errors' => $e->failures()
            ]);

            return back()->with('error', 'Excel validation failed. Check the logs.');

        } catch (Exception $e) {

            // General error
            Log::error('❌ Import failed due to an unexpected error', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                'trace'   => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Import failed! See logs for details.');
        }
    }


    // List scores with pagination
    public function listScores(Request $request)
    {
        try {
            $perPage = $request->limit ?? 10;

            $query = \App\Models\Score::query();

            // Apply filters
            if ($request->filled('class')) {
                $query->where('class', $request->class);
            }

            if ($request->filled('semester')) {
                $query->where('semester', $request->semester);
            }

            if ($request->filled('session')) {
                $query->where('session', $request->session);
            }

            if ($request->filled('search')) {
                $query->where(function($q) use ($request){
                    $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('reg_no', 'like', '%'.$request->search.'%');
                });
            }

            $scores = $query->paginate($perPage);

            \Log::info('📤 Score list requested', [
                'perPage' => $perPage,
                'total'   => $scores->total()
            ]);

            return response()->json([
                'status'      => 'success',
                'data'        => $scores->items(),
                'currentPage' => $scores->currentPage(),
                'totalPages'  => $scores->lastPage(),
            ]);

        } catch (Exception $e) {
            \Log::error('❌ Failed to fetch scores', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to fetch scores'
            ], 500);
        }
    }


    // -----------------------------------------
    // 📌 GET SINGLE SCORE
    // -----------------------------------------
    public function getSingle($id)
    {
        try {

            Log::info("📥 Fetching score ID: $id");

            $score = Score::findOrFail($id);

            Log::info("📤 Score fetched successfully", ['id' => $id]);

            return response()->json([
                'status'  => true,
                'message' => 'Record fetched successfully',
                'data'    => $score
            ]);

        } catch (Exception $e) {

            Log::error("❌ Failed to fetch score", [
                'id'      => $id,
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'status'  => false,
                'message' => 'Record not found'
            ], 404);
        }
    }

    // -----------------------------------------
    // 📌 UPDATE SINGLE SCORE
    // -----------------------------------------
    public function updateSingle(Request $request, $id)
    {
        try {

            Log::info("✏️ Update score request", [
                'id'   => $id,
                'data' => $request->all()
            ]);

            $score = Score::findOrFail($id);
            $score->update($request->all());

            Log::info("✅ Score updated successfully", ['id' => $id]);

            return response()->json([
                'status'  => true,
                'message' => 'Record updated successfully'
            ]);

        } catch (Exception $e) {

            Log::error("❌ Failed to update score", [
                'id'      => $id,
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'status'  => false,
                'message' => 'Failed to update record'
            ], 500);
        }
    }

    // -----------------------------------------
    // 📌 DELETE SINGLE
    // -----------------------------------------
    public function deleteSingle($id)
    {
        try {

            Log::info("🗑️ Delete score request", ['id' => $id]);

            Score::findOrFail($id)->delete();

            Log::info("✅ Score deleted successfully", ['id' => $id]);

            return response()->json([
                'status'  => true,
                'message' => 'Record deleted successfully'
            ]);

        } catch (Exception $e) {

            Log::error("❌ Failed to delete score", [
                'id'      => $id,
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'status'  => false,
                'message' => 'Failed to delete record'
            ], 500);
        }
    }

    // -----------------------------------------
    // 📌 BULK DELETE
    // -----------------------------------------
    public function bulkDelete(Request $request)
    {
        try {

            Log::info("🗑️ Bulk delete started", [
                'ids' => $request->ids
            ]);

            Score::whereIn('id', $request->ids)->delete();

            Log::info("✅ Bulk delete completed", [
                'count' => count($request->ids)
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Selected records deleted successfully'
            ]);

        } catch (Exception $e) {

            Log::error("❌ Bulk delete failed", [
                'ids'     => $request->ids,
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'status'  => false,
                'message' => 'Bulk delete failed'
            ], 500);
        }
    }
}