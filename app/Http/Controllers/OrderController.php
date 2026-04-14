<?php
// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CustomerUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')
                ->with('error', 'Your cart is empty.');
        }
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);
        return view('shop.checkout', compact('cart', 'total'));
    }

    public function place(Request $request)
    {
        $request->validate([
            'customer_name'    => 'required|string|max:100',
            'customer_phone'   => 'required|string|max:15',
            'customer_email'   => 'nullable|email|max:255',
            'customer_address' => 'required|string|max:500',
            'city'             => 'required|string|max:100',
            'pincode'          => 'required|string|max:10',
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')
                ->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

            $order = Order::create([
                'order_number'     => Order::generateOrderNumber(),
                'customer_name'    => $request->customer_name,
                'customer_phone'   => $request->customer_phone,
                'customer_email'   => $request->customer_email,
                'customer_address' => $request->customer_address,
                'city'             => $request->city,
                'pincode'          => $request->pincode,
                'subtotal'         => $subtotal,
                'discount'         => 0,
                'total'            => $subtotal,
                'status'           => 'pending',
                'notes'            => $request->notes,
            ]);

            foreach ($cart as $rowId => $item) {
                OrderItem::create([
                    'order_id'          => $order->id,
                    'product_id'        => $item['product_id'],
                    'product_name'      => $item['name'],
                    'price'             => $item['price'],
                    'quantity'          => $item['quantity'],
                    'custom_image_path' => $item['custom_image_path'] ?? null,
                    'total'             => $item['price'] * $item['quantity'],
                ]);

                if (!empty($item['custom_image_path'])) {
                    CustomerUpload::create([
                        'order_id'       => $order->id,
                        'product_id'     => $item['product_id'],
                        'file_path'      => $item['custom_image_path'],
                        'original_name'  => basename($item['custom_image_path']),
                        'customer_name'  => $request->customer_name,
                        'customer_phone' => $request->customer_phone,
                        'status'         => 'pending',
                    ]);
                }
            }

            DB::commit();
            Session::forget('cart');

            return redirect()->route('checkout.whatsapp', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Order failed: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function whatsapp(Order $order)
    {
        $waNumber = env('WHATSAPP_NUMBER', '919994141294');

        $message  = "🌟 *New Order — PK Photography* 🌟\n\n";
        $message .= "📋 *Order ID:* `{$order->order_number}`\n";
        $message .= "👤 *Name:* {$order->customer_name}\n";
        $message .= "📞 *Phone:* {$order->customer_phone}\n";
        $message .= "📍 *Address:* {$order->customer_address}, {$order->city} - {$order->pincode}\n\n";
        $message .= "🛍️ *Items:*\n";

        foreach ($order->items as $item) {
            $message .= "  • {$item->product_name} × {$item->quantity} = ₹" . number_format($item->total, 2) . "\n";
            if ($item->custom_image_path) {
                $message .= "    📸 Custom photo uploaded\n";
            }
        }

        $message .= "\n💰 *Total: ₹" . number_format($order->total, 2) . "*\n\n";
        $message .= "🔍 *Track:* " . url('/track-order') . "\n";
        $message .= "_(Order ID: {$order->order_number})_\n\n";
        $message .= "_Thank you! — PK Photography 📷_";

        $order->update(['whatsapp_sent' => 'yes']);

        $waUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode($message);

        return view('shop.whatsapp-redirect', compact('order', 'waUrl'));
    }

    public function success(Order $order)
    {
        return view('shop.success', compact('order'));
    }

    // ✅ TRACK ORDER — FORM PAGE
    public function trackForm()
    {
        return view('shop.track-order');
    }

    // ✅ TRACK ORDER — SEARCH RESULT
    public function trackResult(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string|max:50',
        ], [
            'order_number.required' => 'Please enter your Order ID.',
        ]);

        $order = Order::with('items.product')
            ->where('order_number', strtoupper(trim($request->order_number)))
            ->first();

        if (!$order) {
            return back()
                ->with('error', '❌ Order not found! Please check your Order ID.')
                ->withInput();
        }

        return view('shop.track-result', compact('order'));
    }
}