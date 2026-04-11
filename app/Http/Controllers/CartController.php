<?php
// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('shop.cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1|max:10',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart    = Session::get('cart', []);

        $customImagePath = null;
        if ($request->hasFile('custom_image')) {
            $request->validate(['custom_image' => 'image|mimes:jpg,jpeg,png,webp|max:5120']);
            $customImagePath = $request->file('custom_image')->store('customer-uploads', 'public');
        }

        $rowId = $product->id . '_' . ($customImagePath ? md5($customImagePath) : 'no_img');

        if (isset($cart[$rowId])) {
            $cart[$rowId]['quantity'] += $request->quantity;
        } else {
            $cart[$rowId] = [
                'product_id'        => $product->id,
                'name'              => $product->name,
                'price'             => $product->current_price,
                'quantity'          => $request->quantity,
                'main_image'        => $product->main_image,
                'custom_image_path' => $customImagePath,
            ];
        }

        Session::put('cart', $cart);
        return redirect()->route('cart.index')->with('success', '🛒 Added to cart!');
    }

    public function update(Request $request, string $rowId)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:10']);
        $cart = Session::get('cart', []);
        if (isset($cart[$rowId])) {
            $cart[$rowId]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
        }
        return back()->with('success', 'Cart updated.');
    }

    public function remove(string $rowId)
    {
        $cart = Session::get('cart', []);
        unset($cart[$rowId]);
        Session::put('cart', $cart);
        return back()->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        Session::forget('cart');
        return back()->with('success', 'Cart cleared.');
    }
}