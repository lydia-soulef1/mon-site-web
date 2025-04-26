<?php

namespace App\Http\Controllers;

use App\Models\Child; // Assuming you have a Child model for children
use App\Models\Notification; // Assuming you have a Notification model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the pediatrician dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function pediatricianDashboard()
    {
        // Get the authenticated pediatrician
        $pediatrician = Auth::user();

        // You can add logic here to fetch pediatrician-specific data
        // Example: Get the pediatrician's patients, notifications, etc.

        return view('meddash', compact('pediatrician'));
    }

    /**
     * Show the parent dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function parentDashboard()
    {
        // Get the authenticated parent
        $parent = Auth::user();

        // Get the parent's children
        $children = Child::where('parent_id', $parent->id)->get();
        $childIds = $children->pluck('id');
        // Get the parent's notifications
        $notifications = Notification::whereIn('child_id', $childIds)->get();

        // Return the dashboard view with the parent data
        return view('pardash', compact('parent', 'children', 'notifications'));
    }
}
