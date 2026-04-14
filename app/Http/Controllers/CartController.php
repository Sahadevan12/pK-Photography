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
        $cart  = Session::get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('shop.cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'product_id'   => 'required|exists:products,id',
            'quantity'     => 'required|integer|min:1|max:10',
            'custom_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'custom_image.image'  => 'Please upload a valid image file.',
            'custom_image.mimes'  => 'Only JPG, PNG, WEBP images are allowed.',
            'custom_image.max'    => 'Image must be less than 5MB.',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart    = Session::get('cart', []);

        // ✅ Handle custom image upload
        $customImagePath = null;
        if ($request->hasFile('custom_image') && $request->file('custom_image')->isValid()) {
            // Store in public disk
            $customImagePath = $request->file('custom_image')
                ->store('customer-uploads/' . date('Y/m'), 'public');
        }

        // ✅ Create unique row ID
        $rowId = $product->id . '_' . ($customImagePath ? md5($customImagePath) : 'no_img_' . time());

        if (isset($cart[$rowId]) && !$customImagePath) {
            $cart[$rowId]['quantity'] += $request->quantity;
        } else {
            $cart[$rowId] = [
                'product_id'        => $product->id,
                'name'              => $product->name,
                'price'             => $product->current_price,
                'quantity'          => (int) $request->quantity,
                'main_image'        => $product->main_image,
                'custom_image_path' => $customImagePath,
                'allow_custom_image'=> $product->allow_custom_image,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', '🛒 ' . $product->name . ' added to cart!');
    }

    public function update(Request $request, string $rowId)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:10']);
        $cart = Session::get('cart', []);
        if (isset($cart[$rowId])) {
            $cart[$rowId]['quantity'] = (int) $request->quantity;
            Session::put('cart', $cart);
        }
        return back()->with('success', 'Cart updated.');
    }

    public function remove(string $rowId)
    {
        $cart = Session::get('cart', []);

        // Delete uploaded image if exists
        if (isset($cart[$rowId]['custom_image_path']) && $cart[$rowId]['custom_image_path']) {
            Storage::disk('public')->delete($cart[$rowId]['custom_image_path']);
        }

        unset($cart[$rowId]);
        Session::put('cart', $cart);
        return back()->with('success', 'Item removed.');
    }

    public function clear()
    {
        Session::forget('cart');
        return back()->with('success', 'Cart cleared.');
    }
}