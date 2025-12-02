<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    /**
     * Create a new blog post
     */
    public function createBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:blogs,title',
            'message' => 'required|string',
            'image' => 'nullable|image|max:10240' 
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/blog'), $filename);
                $imagePath = 'images/blog/' . $filename;
            }

            $blog = Blog::create([
                'title' => $request->title,
                'message' => $request->message,
                'image' => $imagePath
            ]);

            Log::info("Blog '{$blog->title}' created successfully.");
            return response()->json([
                'message' => 'Blog created successfully.',
                'data' => $blog
            ], 201);

        } catch (\Exception $e) {
            Log::error('❌ createBlog error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create blog.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all blogs with pagination
     */
    public function getAllBlogs(Request $request)
    {
        $page = $request->query('page', 1);
        $limit = $request->query('limit', 10);

        try {
            $blogs = Blog::orderBy('created_at', 'desc')->paginate($limit, ['*'], 'page', $page);

            return response()->json([
                'message' => 'Blogs retrieved successfully.',
                'data' => $blogs->items(),
                'totalItems' => $blogs->total(),
                'currentPage' => $blogs->currentPage(),
                'totalPages' => $blogs->lastPage()
            ]);

        } catch (\Exception $e) {
            Log::error('❌ getAllBlogs error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to fetch blogs.',
                'error' => $e->getMessage()
            ], 500);
        }
    }






    /**
     * Get latest 10 blogs
     */
    public function latestNews()
    {
        try {
            $latestBlogs = Blog::orderBy('created_at', 'desc')->limit(5)->get();
            Log::info('✅ latestNews fetched successfully:', $latestBlogs->toArray());

            return response()->json([
                'message' => 'Latest blogs retrieved successfully.',
                'data' => $latestBlogs
            ]);

        } catch (\Exception $e) {
            Log::error('❌ latestNews error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to fetch latest news.',
                'error' => $e->getMessage()
            ], 500);
        }
    }





    /**
     * Get a single blog by ID
     */
    public function getSingleBlog($id)
    {
        try {
            $blog = Blog::find($id);

            if (!$blog) {
                return response()->json(['message' => 'Blog not found.'], 404);
            }

            // COMMENTS PAGINATION
            $page = request()->get('page', 1);
            $perPage = 5;

            $comments = collect($blog->comments);
            $total = $comments->count();

            $paginated = $comments->slice(($page - 1) * $perPage, $perPage)->values();

            return response()->json([
                'blog' => $blog,
                'comments' => $paginated,
                'pagination' => [
                    'current_page' => (int)$page,
                    'per_page' => $perPage,
                    'total' => $total,
                    'last_page' => ceil($total / $perPage),
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('❌ getSingleBlog error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to fetch blog.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Update a blog post
     */
    public function updateBlog(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|unique:blogs,title,' . $id,
            'message' => 'required|string',
            'image' => 'nullable|image|max:10240' 
        ]);

        try {
            $blog = Blog::find($id);

            if (!$blog) {
                Log::warning("⚠️ updateBlog: Blog with ID {$id} not found.");
                return response()->json(['message' => 'Blog not found.'], 404);
            }

            $blog->title = $request->title;
            $blog->message = $request->message;

            if ($request->hasFile('image')) {

                Log::info("📁 updateBlog: New image uploaded for Blog ID {$id}");

                // Ensure folder exists
                $folder = public_path('images/blog');
                if (!file_exists($folder)) {
                    Log::notice("📂 Folder missing. Creating: {$folder}");
                    mkdir($folder, 0777, true);
                }

                // Delete old image
                if ($blog->image) {
                    $oldImagePath = public_path($blog->image);

                    if (file_exists($oldImagePath)) {
                        if (!unlink($oldImagePath)) {
                            Log::error("❌ Failed to delete old image: {$oldImagePath}");
                        } else {
                            Log::info("🗑️ Deleted old image: {$oldImagePath}");
                        }
                    } else {
                        Log::warning("⚠️ Old image not found at: {$oldImagePath}");
                    }
                }

                // Upload new image
                try {
                    $image = $request->file('image');
                    $filename = time() . '_' . $image->getClientOriginalName();
                    $image->move($folder, $filename);

                    $blog->image = 'images/blog/' . $filename;

                    Log::info("✅ New image saved: images/blog/{$filename}");

                } catch (\Exception $e) {
                    Log::error("❌ Error uploading new image for Blog ID {$id}: {$e->getMessage()}", [
                        'trace' => $e->getTraceAsString()
                    ]);

                    return response()->json([
                        'message' => 'Image upload failed.',
                        'error' => $e->getMessage()
                    ], 500);
                }
            }

            $blog->save();

            Log::info("✔️ Blog updated successfully: ID {$id}");

            return response()->json([
                'message' => 'Blog updated successfully.',
                'data' => $blog
            ]);

        } catch (\Exception $e) {

            // Log full exception details
            Log::error('❌ updateBlog exception: ' . $e->getMessage(), [
                'id'     => $id,
                'trace'  => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            // Sends exception to Laravel error handler too
            report($e);

            return response()->json([
                'message' => 'Failed to update blog.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Delete a blog post
     */
    public function deleteBlog($id)
    {
        try {
            \Log::info("🗑️ deleteBlog: Attempting to delete blog with ID {$id}");
            // Attempt to find the blog
            $blog = Blog::find($id);
            if (!$blog) {
                Log::warning("❌ deleteBlog warning: Blog with ID {$id} not found.");
                return response()->json(['message' => 'Blog not found.'], 404);
            }

            // Attempt to delete the associated image if it exists
            if ($blog->image) {
                $imagePath = public_path($blog->image);
                if (file_exists($imagePath)) {
                    try {
                        unlink($imagePath);
                        Log::info("🗑️ deleteBlog: Deleted image '{$blog->image}' for blog ID {$id}.");
                    } catch (\Exception $imgEx) {
                        Log::error("❌ deleteBlog error: Failed to delete image '{$blog->image}' for blog ID {$id}. Error: " . $imgEx->getMessage());
                    }
                } else {
                    Log::warning("⚠️ deleteBlog warning: Image '{$blog->image}' for blog ID {$id} does not exist.");
                }
            }

            // Delete the blog record
            $blog->delete();
            Log::info("✅ deleteBlog: Blog with ID {$id} deleted successfully.");

            return response()->json([
                'message' => 'Blog deleted successfully.',
                'success' => true
            ]);

        } catch (\Exception $e) {
            Log::error("❌ deleteBlog exception: Failed to delete blog ID {$id}. Error: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Failed to delete blog.',
                'error' => $e->getMessage()
            ], 500);
        }
    }





    /**
     * Add a comment to a blog post
     */
    public function addComment(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'comment' => 'required|string'
        ]);

        try {
            $blog = Blog::find($id);

            if (!$blog) {
                Log::warning("⚠️ addComment: Blog with ID {$id} not found.");
                return response()->json(['message' => 'Blog not found.'], 404);
            }

            // Append new comment
            $newComment = [
                'name' => $request->name,
                'email' => $request->email,
                'comment' => $request->comment,
                'created_at' => now()
            ];

            $blog->comments = array_merge($blog->comments ?? [], [$newComment]);
            $blog->save();

            Log::info("✅ addComment: Comment added to blog ID {$id}", ['comment' => $newComment]);

            return response()->json([
                'message' => 'Comment added successfully.',
                'data' => $blog
            ]);

        } catch (\Exception $e) {
            Log::error("❌ addComment error for blog ID {$id}: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Failed to add comment.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
