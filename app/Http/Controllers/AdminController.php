<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Order;
use App\Models\Promotion;
use Illuminate\Http\Request;

use App\Mail\OrderStatusChanged;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
 
    public function users()
    {
        $users = User::where('role' , '!=' , 'admin')->get();
        return view('dashboard', compact('users'));
    }

    public function changeUserStatus(Request $request, $id)
    {
        $user = user::find($id);

        if($user['status'] == "Active"){

            $user->update(['status' => "Deactivated"]);

        }else{
            $user->update(['status' => "Active"]);
        }
        return redirect()->back()->with('success', 'User role updated successfully!');
    }

  

 

    // Orders Management
    public function orders()
    {
        $orders = Order::with('user', 'service')->get();
        return view('admin.orders.view', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Order::STATUSES)),
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->input('status');

        $order->status = $newStatus;
        $order->save();
        Mail::to($order->user->email)->send(new OrderStatusChanged($order, $oldStatus, $newStatus));


        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
     

    // Promotions Management
    public function promotions()
    {
        $promotions = Promotion::all();
        return view('admin.promotions.view', compact('promotions'));
    }

    public function createPromotion(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:promotions,code',
            'discount' => 'required',
            'expires_at' => 'required|date',
        ]);

        // Create the promo code
        Promotion::create([
            'code' => $request->input('code'),
            'discount_percentage' => $request->input('discount'),
            'valid_until' => $request->input('expires_at'),
        ]);

        return redirect()->back()->with('success', 'Promo code created successfully!');
    }

    public function deletePromotion($id)
    {
        $promotion = Promotion::find($id);
        $promotion->delete();
        return redirect()->back()->with('success', 'Promotion deleted successfully!');
    }


    #services

    public function services(){

        $services = Service::all();
        return view('admin.services', compact('services'));

    }
}
