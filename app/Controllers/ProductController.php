<?php
namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class ProductController extends Controller
{
    public function index()
    {
        $modelPro = new ProductModel();
        $products = $modelPro->getAllProducts();
        return $this->view('admin.products.index', compact('products'));
    }
    public function home()
    {
        $modelPro = new ProductModel();
        $products = $modelPro->getAllProducts();
        return $this->view('user.home', compact('products'));
    }

    public function create()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();
        return $this->view('admin.products.add', compact('categories'));
    }

    public function store()
    {
        $errors = [];
        if (empty($_POST['name'])) {
            $errors[] = "Bạn cần phải nhập tên sản phẩm";
        }
        if (empty($_POST['price'])) {
            $errors[] = "Bạn cần phải nhập giá sản phẩm";
        }
        if (empty($_POST['category_id'])) {
            $errors[] = "Bạn cần chọn danh mục sản phẩm";
        }
        if ($_FILES['image']['error'] != 0 && $_FILES['image']['size'] == 0) {
            $errors[] = "Bạn cần phải chọn ảnh gửi lên hoặc lỗi trong quá trình gửi ảnh";
        }

        if (count($errors) > 0) {
            flash('errors', $errors, 'product/create');
        } else {
            $tagetDir = __DIR__ . '/../../storage/uploads/';
            $newNameFile = time() . "_" . $_FILES['image']['name'];
            $imagePath = $tagetDir . $newNameFile;
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

            if (!file_exists($imagePath)) {
                $errors[] = "Lỗi ảnh không tồn tại";
                flash('errors', $errors, 'product/create');
            } else {
                $modelPro = new ProductModel();
                $result = $modelPro->addProduct(
                    null,
                    $_POST['name'],
                    $_POST['price'],
                    $newNameFile,
                    $_POST['quantity'],
                    $_POST['status'],
                    $_POST['category_id']
                );
                if ($result) {
                    flash('success', "Thêm thành công", 'product/');
                } else {
                    flash('errors', "Thêm thất bại", 'product/create');
                }
            }
        }
    }

    public function delete($id)
    {
        $modelPro = new ProductModel();
        if ($modelPro->deleteProduct($id)) {
            flash('success', "Xóa thành công", 'product');
        }
    }

    public function edit($id)
    {
        $modelPro = new ProductModel();
        $categoryModel = new CategoryModel();

        $product = $modelPro->getIDProduct($id);
        $categories = $categoryModel->getAllCategories();

        return $this->view('admin.products.edit', compact('product', 'categories'));
    }

    public function update($id)
    {
        $modelPro = new ProductModel();
        $product = $modelPro->getIDProduct($id);

        $errors = [];
        if (empty($_POST['name'])) {
            $errors[] = "Bạn cần phải nhập tên sản phẩm";
        }
        if (empty($_POST['price'])) {
            $errors[] = "Bạn cần phải nhập giá sản phẩm";
        }
        if (empty($_POST['category_id'])) {
            $errors[] = "Bạn cần chọn danh mục sản phẩm";
        }

        if ($_FILES['image']['error'] != 0 || $_FILES['image']['size'] == 0) {
            $newNameFile = $product->image;
        } else {
            $tagetDir = __DIR__ . '/../../storage/uploads/';
            $newNameFile = time() . "_" . $_FILES['image']['name'];
            $imagePath = $tagetDir . $newNameFile;
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

            if (!file_exists($imagePath)) {
                $errors[] = "Lỗi ảnh không tồn tại";
                flash('errors', $errors, 'product/edit/' . $id);
            }
        }
        if (count($errors) > 0) {
            flash('errors', $errors, 'product/edit/' . $id);
        } else {
            $result = $modelPro->updateProduct(
                $_POST['name'],
                $_POST['price'],
                $newNameFile,
                $_POST['quantity'],
                $_POST['status'],
                $_POST['category_id'],
                $id
            );
            if ($result) {
                flash('success', "Chỉnh sửa thành công", 'product/edit/' . $id);
            } else {
                flash('errors', "Chỉnh sửa thất bại", 'product/edit/' . $id);
            }
        }
    }
}
