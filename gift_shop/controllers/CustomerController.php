<?php


class CustomerController extends Controller
{

 public function _404(){
   $this->view('customers/_404');
 }

public function about(){
    $this->view('customers/about-us');
}

public function cart(){
    $this->view('customers/cart');
 }


public function checkout(){
    $this->view('customers/checkout');
}

public function contact(){
    $this->view('customers/contact-us');
 }

public function faq(){
    $this->view('customers/faq');
}

public function index(){
    $this->view('customers/index');
 }

public function login()
{
    $this->view('customers/login');
}

public function account(){
    $this->view('customers/my-account');
}

public function privacy(){
    $this->view('customers/privacy');
}

public function product(){
    $this->view('customers/product-details-default');
 }

 public function wishlist(){
     $this->view('customers/wishlist');
 }


}