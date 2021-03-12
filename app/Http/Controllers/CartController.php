<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Mail\OrderShipped;
use App\Mail\InboxMessage;
use Illuminate\Support\Facades\Mail;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    // Cart Functions

    public function checkSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ( ! isset($_SESSION['key'])){
            $this->openSession();
        }
    }
    
    public function openSession()
    {
            $key = rand();
            $_SESSION['key'] = $key;
            Cart::session($key);
    }

    public function getContent()
    {
        $this->checkSession();
        $cartCollection = Cart::session($_SESSION['key'])->getContent();
        return $cartCollection;
    }
    
    public function getTotalQuantity()
    {
        $cartTotalQuantity  = Cart::session($_SESSION['key'])->getTotalQuantity();
        return $cartTotalQuantity ;
    }

    public function clearCart()
    {
        $this->checkSession();
        Cart::session($_SESSION['key'])->clear();
        session_destroy ();
    }

    public function getSubTotal()
    {
        $subTotal  = Cart::session($_SESSION['key'])->getSubTotal();
        return $subTotal ;
    }

    public function getCartInfo()
    {
        $this->checkSession();
        $subTotal = $this->getSubTotal();
        $cartCollection = $this->getContent();
        $cartTotalQuantity = $cartCollection->count();

        $cartInfo = array(
            'content' => $cartCollection,
            'quantity' => $cartTotalQuantity,
            'subtotal' => $subTotal,
        );
        return $cartInfo;
    }
    
    // Get Total Price and Products

    public function getTotalCart(Request $request)
    {
        $this->checkSession();
        $cart = $request->input('content');
        $productos = array();
        foreach ($cart as $key => $item){
            $db = Productos::find($key);
            $producto['id'] = $db->id;
            $producto['nombre'] = $db->nombre;
            $producto['precio'] = $db->precio;
            $producto['unidad'] = $db->unidad;
            $producto['categoria'] = $db->categoria;
            $producto['imagen'] = $db->imagen;
            $producto['cantidad'] = $item['quantity'];
            array_push($productos, $producto);
        }
        return $productos;
    }


    // Product Functions

    public function addProduct(Request $request)
    {
        $id =  $request->input('id');
        $name = $request->input('nombre');
        $price = $request->input('precio');
        $quantity = $request->input('cantidad');
        //$attributes = $request->input('categoria');
        //$CartCondition = $request->input('CartCondition');
        
        session_start();
        if(Cart::session($_SESSION['key'])->add(
            $id, 
            $name,
            $price,
            $quantity,
        )){
            return true;
        }else{
            return false;
        }
    }

    public function getProduct($productoId)
    {
        return true;
    }

    public function updateProduct($productoId)
    {
        return true;
    }

    public function addQantity(Request $request)
    {
        $id =  $request->input('id');
        $quantity = $request->input('quantity');
        session_start();
        if(
            Cart::session($_SESSION['key'])->update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $quantity
                ),
             ))
        ){
            return true;
        }
        else{
            return false;
        }
    }

    public function removeProduct($productoId)
    {
        session_start();
        if(
            Cart::session($_SESSION['key'])->remove($productoId)
        ){
            return true;
        }else{
            return false;
        }
        
    }

    // Mails

    public function makeOrder(Request $request)
    {
        $dataOrder = array(
            'content' => json_decode($request->input('content')),
            'client' =>  json_decode($request->input('client')),
            'subtotal' =>  $request->input('subtotal'),
            'sendCost' => $request->input('sendCost'),
        );

        $reciever = $dataOrder['client']->correo;
        
        if(
            Mail::to($reciever)->send(new OrderShipped($dataOrder))
            ){
                return true;
            }else{
                return false;
            }
    }

    public function sendInbox(Request $request)
    {
        $inbox = json_decode($request->input('inbox'));
        $message = array( 
            'name' => $inbox->name,
            'phone' => $inbox->phone,
            'email' => $inbox->email,
            'message' => $inbox->message,
        );
        $reciever = env('MAIL_USERNAME', 'ambfruver@gmail.com');
// Ver legaligad de concentiendo de datos de cliente
// Revisar contraseña de aplicacion de coreo ~~~
        if(
            Mail::to($reciever)->send(new InboxMessage($message))
            ){
                return true;
            }else{
                return false;
            }
    }


}
