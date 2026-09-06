<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseOrder;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Today's purchases
        $todayPurchases = Purchase::whereDate(
            'purchase_date',
            today()
        )->sum('total_amount');

        // Today's purchase count
        $todayPurchaseCount = Purchase::whereDate(
            'purchase_date',
            today()
        )->count();

        // Recent purchases
        $recentPurchases = Purchase::latest()
            ->take(5)
            ->get();

        // Pending purchase orders
        $pendingOrders = PurchaseOrder::where(
            'status',
            'pending'
        )->count();

        return view('dashboard', compact(
            'todayPurchases',
            'todayPurchaseCount',
            'recentPurchases',
            'pendingOrders'
        ));
    }
}