<?php

namespace App\Http\Controllers;
use Cart;
use Illuminate\Http\Request;

class PanierController extends Controller
{
  public function index()
    {
        return response()->json([
            'items' => Cart::content(),
            'total' => Cart::total(),
            'count' => Cart::count(),
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|integer|min:1',
        ]);

        $item = Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'options' => $request->options ?? [],
        ]);

        return response()->json([
            'message' => 'Produit ajouté au panier',
            'item' => $item,
            'cart' => Cart::content(),
        ], 201);
    }

    public function update(Request $request, $rowId)
    {
        $request->validate(['qty' => 'required|integer|min:1']);

        Cart::update($rowId, $request->qty);

        return response()->json([
            'message' => 'Quantité mise à jour',
            'cart' => Cart::content(),
        ]);
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);

        return response()->json([
            'message' => 'Article supprimé du panier',
            'cart' => Cart::content(),
        ]);
    }

    public function clear()
    {
        Cart::destroy();

        return response()->json(['message' => 'Panier vidé']);
    }
}
