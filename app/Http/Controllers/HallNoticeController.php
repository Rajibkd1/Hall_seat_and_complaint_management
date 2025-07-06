<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HallNotice;
use Illuminate\Http\Request;

class HallNoticeController extends Controller
{
    public function index(Request $request)
    {
        $query = HallNotice::with('admin')->active()->orderBy('date_posted', 'desc');

        if ($request->has('type') && $request->type !== 'all') {
            $query->byType($request->type);
        }

        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $notices = $query->paginate(6);

        if ($request->ajax()) {
            return response()->json([
                'notices' => $notices->items(),
                'has_more' => $notices->hasMorePages()
            ]);
        }

        return view('student.hall_notices', compact('notices'));
    }

   public function show($id)
{
    $notice = HallNotice::with('admin')->findOrFail($id);
    
    if (request()->ajax()) {
        return response()->json($notice);
    }
    
    return view('student.hall_notice_show', compact('notice'));
}

}
