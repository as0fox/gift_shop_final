<?php
require_once 'BaseController.php';

class DashboardController extends Controller {
    private $userModel;
    private $productModel;
    private $commentModel;
    private $couponModel;
    private $data;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
        $this->productModel = $this->model('Product');
        $this->commentModel = $this->model('CommentModel');
        $this->couponModel = $this->model('CouponModel');
        $this->data = [
            'totalUsers' => $this->userModel->getTotalUsers(),
            'totalProducts' => $this->productModel->all(),
            'totalComments' => $this->commentModel->getTotalComments(),
            'totalCoupons' => $this->couponModel->getTotalCoupons()
        ];
    }

    public function index() {
        $data = $this->data;
        $this->view('admin/dashboard/index', $data);
    }

    public function manageProducts() {
        $data = $this->data;
        $this->view('admin/dashboard/products/products', $data);
    }

    // Handle new product creation form
    public function createProduct() {
        $this->view('admin/dashboard/products/create_product');
    }


    public function addProduct() {
        $productData = [
            'product_name' => $_POST['product_name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'stock_quantity' => $_POST['stock_quantity'],
            'category_id' => $_POST['category_id']
        ];
    
        // Check if the file was uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Directory to save the uploaded image
            $targetDir = __DIR__ . '/../public/images/product/';
            
            // Generate a unique file name using the timestamp
            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $targetFilePath = $targetDir . $fileName;
    
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                // Save only the file name (not the full path) in the database
                $productData['image_url'] = $fileName;
            } else {
                die("Error uploading image file.");
            }
        }
    
        // Insert product data, including image file name, into the database
        $this->productModel->create($productData);
        header('Location: /dashboard/manageProducts');
    }
    
    

    // Edit a product
    public function editProduct($id) {
        $product = $this->productModel->find($id);
        $this->view('admin/dashboard/products/edit_product', ['product' => $product]);
    }

    // Update an existing product
    public function updateProduct($id) {
        $productData = [
            'product_name' => $_POST['product_name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'stock_quantity' => $_POST['stock_quantity'],
            'category_id' => $_POST['category_id'],
            'image_url' => $_POST['image_url'],
        ];
        $this->productModel->update($id, $productData);
        header('Location: /dashboard/manageProducts');
    }

    // Delete a product
    public function deleteProduct($id) {
        $this->productModel->delete($id);
        header('Location: /dashboard/manageProducts');
    }
}
?>
