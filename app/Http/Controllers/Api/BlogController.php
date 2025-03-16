<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function AllBlog()
    {
        $data = Blog::all();

        return response()->json([
            'status' => true,
            'message' => 'All Blogs Retrieved Successfully',
            'data' => $data
        ], 200);
    }
    public function getBlogById($id)
    {
        $blog = Blog::find($id);
    
        if (!$blog) {
            return response()->json([
                'status' => false,
                'message' => 'Blog not found',
                'data' => null
            ], 404);
        }
    
        return response()->json([
            'status' => true,
            'message' => 'Blog Retrieved Successfully',
            'data' => $blog
        ], 200);
    }
    
}
