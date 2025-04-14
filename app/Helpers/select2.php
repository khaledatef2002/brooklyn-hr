<?php

namespace App\Helpers;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use App\Models\Author;
use App\Models\BooksCategory;
use App\Models\User;
use App\PeopleType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class select2 extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('role:manager|admin')
        ];
    }
    /**
     * Create a new class instance.
     */
    public function users(Request $request)
    {
        $search = $request->get('q'); // For searching functionality

        $users = User::when($search, function($query) use ($search) {
            return $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
        })
        ->get();

        return response()->json($users);
    }
}
