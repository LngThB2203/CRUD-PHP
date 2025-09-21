<?php
namespace App\Controllers;
use App\Models\CategoryModel;
class CategoryController extends Controller{
    public function index(){
        $model = new CategoryModel();
        $categories = $model-> getAllCategories();
        // var_dump($categories);
        return $this-> view('admin.categories.index', compact('categories')); 
    }
    public function create()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();
        return $this->view('admin.categories.add', compact('categories'));
    }

    public function store()
    {
        $errors = [];
        if (empty($_POST['name'])) {
            $errors[] = "Bạn cần phải nhập tên sản phẩm";
        }
   
        if ($_FILES['image']['error'] != 0 && $_FILES['image']['size'] == 0) {
            $errors[] = "Bạn cần phải chọn ảnh gửi lên hoặc lỗi trong quá trình gửi ảnh";
        }

        if (count($errors) > 0) {
            flash('errors', $errors, 'category/create');
        } else {
            $tagetDir = __DIR__ . '/../../storage/uploads/';
            $newNameFile = time() . "_" . $_FILES['image']['name'];
            $imagePath = $tagetDir . $newNameFile;
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

            if (!file_exists($imagePath)) {
                $errors[] = "Lỗi ảnh không tồn tại";
                flash('errors', $errors, 'category/create');
            } else {
                $modelPro = new CategoryModel();
                $result = $modelPro->addCategory(
                    $_POST['name'],
                    $newNameFile,
                );
                if ($result) {
                    flash('success', "Thêm thành công", 'category/');
                } else {
                    flash('errors', "Thêm thất bại", 'category/create');
                }
            }
        }
    }

    public function delete($id)
    {
        $modelPro = new CategoryModel();
        if ($modelPro->deleteCategory($id)) {
            flash('success', "Xóa thành công", 'category');
        }
    }

    public function edit($id)
    {
        $modelPro = new CategoryModel();
        $categoryModel = new CategoryModel();

        $category = $modelPro->getCategoryById($id);
        $categories = $categoryModel->getAllCategories();

        return $this->view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update($id)
    {
        $modelPro = new CategoryModel();
        $category = $modelPro->getCategoryById($id);

        $errors = [];
        if (empty($_POST['name'])) {
            $errors[] = "Bạn cần phải nhập tên sản phẩm";
        }
        if ($_FILES['image']['error'] != 0 || $_FILES['image']['size'] == 0) {
            $newNameFile = $category->image;
        } else {
            $tagetDir = __DIR__ . '/../../storage/uploads/';
            $newNameFile = time() . "_" . $_FILES['image']['name'];
            $imagePath = $tagetDir . $newNameFile;
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

            if (!file_exists($imagePath)) {
                $errors[] = "Lỗi ảnh không tồn tại";
                flash('errors', $errors, 'category/edit/' . $id);
            }
        }
        if (count($errors) > 0) {
            flash('errors', $errors, 'category/edit/' . $id);
        } else {
            $result = $modelPro->updateCategory(
                $_POST['name'],
                $newNameFile,
                $id
            );
            if ($result) {
                flash('success', "Chỉnh sửa thành công", 'category/edit/' . $id);
            } else {
                flash('errors', "Chỉnh sửa thất bại", 'category/edit/' . $id);
            }
        }
    }
}
?>