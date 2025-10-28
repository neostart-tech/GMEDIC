<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

// use Darryldecode\Cart\Cart;

class PanierController extends Controller
{
    public function index()
    {
        return response()->json([
            'items' => CartFacade::content(),
            'total' => CartFacade::total(),
            'count' => CartFacade::count(),
        ]);
    }

    public function add(Request $request)
    {
        $article = Article::find($request->id);

        if (! $article) {
            return response()->json(['message' => 'Article introuvable'], 404);
        }

        $cartItem = CartFacade::get($request->id);

        if ($cartItem) {
            $item = CartFacade::update($request->id, [
                'quantity' => [
                    'relative' => true,
                    'value' => 1,
                ],
            ]);
            $message = 'Quantité mise à jour dans le panier';
        } else {
            $item = CartFacade::add([
                'id' => $article->id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity ?? 1,
                'attributes' => [
                    'image' => $article->article_image,
                    'category' => $request->category,
                    'description' => $request->description,
                ],
            ]);
            $message = 'Produit ajouté au panier';
        }

        return response()->json([
            'message' => $message,
            'item' => $item,
            'cart' => CartFacade::getContent(),
        ], 201);
    }

 public function sub(Request $request)
{
    try {
        $request->validate([
            'id' => 'required|integer|exists:articles,id'
        ]);

        $article = Article::find($request->id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article introuvable'
            ], 404);
        }

        $cartItem = CartFacade::get($request->id);

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Article non trouvé dans le panier'
            ], 404);
        }

        $message = '';
        $item = null;
        $removed = false;

        // Si la quantité actuelle est supérieure à 1, on décrémente
        if ($cartItem->quantity > 1) {
            $item = CartFacade::update($cartItem->id, [
                'quantity' => [
                    'relative' => true,
                    'value' => -1, 
                ],
            ]);
            $message = 'Quantité diminuée avec succès';
        } else {
            CartFacade::remove($cartItem->id);
            $removed = true;
            $message = 'Article retiré du panier';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'item' => $item,
            'removed' => $removed,
            'cart' => CartFacade::getContent(),
            'cart_count' => CartFacade::getTotalQuantity(),
            'cart_total' => CartFacade::getTotal()
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de la décrémentation: ' . $e->getMessage()
        ], 500);
    }
}
    public function get()
    {
        $items = CartFacade::getContent();

        return response()->json($items);
    }

    public function update(Request $request, $rowId)
    {
        $request->validate(['qty' => 'required|integer|min:1']);

        CartFacade::update($rowId, $request->qty);

        return response()->json([
            'message' => 'Quantité mise à jour',
            'cart' => CartFacade::content(),
        ]);
    }

    public function remove($rowId)
    {
        CartFacade::remove($rowId);

        return response()->json([
            'message' => 'Article supprimé du panier',
            'cart' => CartFacade::content(),
        ]);
    }

    public function clear()
    {
        CartFacade::destroy();

        return response()->json(['message' => 'Panier vidé']);
    }
}
