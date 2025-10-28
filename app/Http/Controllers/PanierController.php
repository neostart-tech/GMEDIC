<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use  App\Models\Article;
use Darryldecode\Cart\Facades\CartFacade;

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
        $article=Article::find($request->id);

        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|integer|min:1',
        ]);

        $item = CartFacade::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'options' => [
                "image"=>$article->article_image,
            ],
        ]);

        return response()->json([
            'message' => 'Produit ajouté au panier',
            'item' => $item,
            'cart' => CartFacade::content(),
        ], 201);
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
