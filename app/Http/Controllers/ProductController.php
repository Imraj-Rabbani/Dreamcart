<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function index()
    {
        // Create a Guzzle HTTP client
        $client = new Client();

        // Make a GET request to the FakeStore API
        $response = $client->get('https://fakestoreapi.com/products');

        // Check if the request was successful
        if ($response->getStatusCode() === 200) {
            // Parse the JSON response
            $products = json_decode($response->getBody());
            dd($products);
            // Store the products in your database
            foreach ($products as $product) {
                DB::table('products')->insert([
                    'name' => $product->title,
                    'price' => $product->price,
                    'quantity' => rand(1,100),
                    'desc' => $product->description,
                    'category_id' => rand(2,4),
                    'img_url' => $product->image,
                ]);
            }

            return redirect()->route('all.product')->with('message', 'Product Imported successfully');
        }
        // return view('admin.allcategory');
    }
}
