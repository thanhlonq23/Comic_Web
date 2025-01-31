<?php
class webtoon extends Controller
{
    private $table = 'webtoons';
    public function __construct()
    {
        // Session::checkSession();
        parent::__construct();
    }


    public function index()
    {
        $this->list_Webtoon();
    }



    // Trang truyện chính
    public function webtoon_Main()
    {
        $id = $_GET['id'];

        // Lấy ra thông tin webtoon
        $cond = "id = '$id'";
        $data1 =  $this->getByCond($cond);

        // Lấy danh sách categories của webtoon
        $data2 = $this->selectCategories($id);

        // Gộp dữ liệu
        $data = array_merge_recursive($data1, $data2);

        $this->load->view("Admin/Webtoon/webtoon", $data);
    }



    // Danh sách truyện
    public function list_Webtoon()
    {
        $data = $this->list();
        $this->load->view("Admin/Webtoon/comicslist", $data);
    }



    // Trang thêm truyện
    public function add_Webtoon()
    {
        $categoryModel = $this->load->model("categoryModel");
        $data['categories'] = $categoryModel->selectAll('categories');
        $this->load->view("Admin/nav");
        $this->load->view("Admin/Webtoon/addWebtoon", $data);
    }

    public function edit_Webtoon($id)
    {
        $cond = "id = '$id'";
        $webtoonModel = $this->load->model("webtoonModel");
        $categoryModel = $this->load->model("categoryModel");
        $data['webtoonByID'] = $webtoonModel->selectByCond($this->table, $cond);
        // Lấy danh sách categories của webtoon
        $data['selectedCategories'] = $this->selectCategories($id)['categories'];
        $data['categoriesDatabase'] = $categoryModel->selectAll('categories');
        $this->load->view("Admin/nav");
        $this->load->view("Admin/Webtoon/editWebtoon", $data);
    }


    // Tìm kiếm truyện
    public function search_Webtoon($tuKhoa)
    {
        $data1 = $this->search($tuKhoa);
        $data2['tuKhoa'] = $tuKhoa;

        $data = array_merge_recursive($data1, $data2);
        $this->load->view("User/Search/search", $data);
    }





    //==================================================================Các hàm xử lý==================================================================//





    // Xử lý sửa truyện
    public function add()

    {
        $id = $this->getid();
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Tên thư mục chứa chapter = id
        $newDir = $id;

        // Xử lý tạo tên bìa
        $uploadedFileName = $_FILES["cover"]["name"];
        $fileName = uniqid() . "_" . $uploadedFileName;

        $data = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'cover' => $fileName
        ];

        // Không lưu được ảnh / không tạo được thư mục => k lưu vào db
        if ($this->upload($fileName) && $this->createDir($newDir)) {

            // Thực hiện truy vấn db
            $webtoonModel = $this->load->model("webtoonModel");

            $result = $webtoonModel->insert($this->table, $data);

            if ($result != 0) {
                $categoryModel = $this->load->model("categoryModel");

                // Lấy danh sách categories từ form
                $selectedCategories = isset($_POST['categories']) ? implode(',', $_POST['categories']) : '';

                // Liên kết các categories với truyện vừa được thêm vào
                if (!empty($selectedCategories)) {
                    $categoriesArray = explode(',', $selectedCategories);
                    // hàm xử lý chuỗi thành các giá trị
                    foreach ($categoriesArray as $categoryID) {
                        $categoryModel->addCategoryToWebtoon($id, $categoryID);
                    }
                }

                $message['msg'] = "Thêm truyện thành công";
                header("Location:" . BASE_URL . "/?url=webtoon/add_Webtoon/&msg=" . urlencode(serialize($message)));
            } else {
                $message['msg'] = "Thêm truyện thất bại";
                header("Location:" . BASE_URL . "/?url=webtoon/add_Webtoon/&msg=" . urlencode(serialize($message)));
            }
        } else {
            $message['msg'] = "Thêm truyện thất bại";
            header("Location:" . BASE_URL . "/?url=webtoon/add_Webtoon/&msg=" . urlencode(serialize($message)));
        }
    }



    // Lấy ra danh sách truyện
    public function list()
    {
        $webtoonModel = $this->load->model("webtoonModel");
        $data['webtoons'] = $webtoonModel->selectWebtoonWithChapter($this->table);
        return $data;
    }

    public function delete_Webtoon($id)
    {
        $webtoonModel = $this->load->model('webtoonModel');
        $categoryModel = $this->load->model("categoryModel");

        // Tên file là id
        $file = $id;

        // Điều kiện
        $cond = "id = '$id'";

        // Lấy tên bìa
        $getCover = $webtoonModel->selectByCond($this->table, $cond);
        $cover = $getCover[0]['cover'];


        // Xóa được thư mục,bìa thành công mới đến xóa trong db
        if ($this->deleteDir($file) && $this->deleteFile($cover)) {
            try {
                // Xóa tất cả các liên kết với categories trong bảng webtoons_categories
                $categoryModel->removeCategoryFromWebtoon($id);

                $webtoonModel->delete($this->table, $cond);
            } catch (Exception  $th) {
                $message['msg'] = "Xóa không thành công ! Vui lòng kiểm tra lại";
                header("Location:" . BASE_URL . "/?url=admin/comic_List/&msg=" . urlencode(serialize($message)));
                exit;
            }
            header("Location:" . BASE_URL . "/?url=admin/comic_List");
        } else {
            $message['msg'] = "Xóa không thành công ! Vui lòng kiểm tra lại";
            header("Location:" . BASE_URL . "/?url=admin/comic_List/&msg=" . urlencode(serialize($message)));
        }
    }


    // Xử lý cập nhật
    public function edit($id)
    {
        $cond = "id = '$id'";
        $data = [
            'name' => $_POST['name'],
            'status' => $_POST['status'],
            'description' => $_POST['description']
        ];

        $webtoonModel = $this->load->model("webtoonModel");
        $result = $webtoonModel->update($this->table, $data, $cond);

        if ($result != 0) {
            $categoryModel = $this->load->model("categoryModel");

            // Xóa tất cả các liên kết với categories trong bảng webtoons_categories
            $categoryModel->removeCategoryFromWebtoon($id);

            // Lấy danh sách categories từ form
            $selectedCategories = isset($_POST['categories']) ? implode(',', $_POST['categories']) : '';

            // Liên kết các categories với truyện vừa được thêm vào
            if (!empty($selectedCategories)) {
                // Xử lý chuỗi thành các giá trị
                $categoriesArray = explode(',', $selectedCategories);
                foreach ($categoriesArray as $categoryID) {
                    $categoryModel->addCategoryToWebtoon($id, $categoryID);
                }
            }

            $message['msg'] = "Cập nhật truyện thành công";
            header("Location:" . BASE_URL . "/?url=webtoon/edit_Webtoon/$id&msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Cập nhật truyện thất bại";
            header("Location:" . BASE_URL . "/?url=webtoon/edit_Webtoon/$id&msg=" . urlencode(serialize($message)));
        }
    }

    public function editCover($id)
    {
        // Lấy tên ảnh bìa
        $uploadedFileName = $_FILES["cover"]["name"];

        // Tạo tên duy nhất
        $fileName = uniqid() . "_" . $uploadedFileName;

        $cond = "id = '$id'";
        $data = [
            'cover' => $fileName,
        ];

        $webtoonModel = $this->load->model("webtoonModel");
        $getCover = $webtoonModel->selectByCond($this->table, $cond);
        $filePath = "public/Uploads/Cover/Webtoon/" . $getCover[0]['cover'];

        if (file_exists($filePath)) {
            $result = $webtoonModel->update($this->table, $data, $cond);

            if ($result != 0) {
                unlink($filePath);
                $this->upload($fileName);

                $message['msg'] = "Cập nhật cover thành công";
                header("Location:" . BASE_URL . "/?url=admin/info/&id=$id&msg=" . urlencode(serialize($message)));
            } else {
                $message['msg'] = "Cập nhật cover thất bại";
                header("Location:" . BASE_URL . "/?url=admin/info/&id=$id&msg=" . urlencode(serialize($message)));
            }
        } else {
            $message['msg'] = "Cập nhật đường link cover thất bại";
            header("Location:" . BASE_URL . "/?url=admin/info/&id=$id&msg=" . urlencode(serialize($message)));
        }
    }

    // Lưu ảnh
    private function upload($fileName)
    {
        $path_uploads = "public/Uploads/Cover/Webtoon/";
        $target_file = $path_uploads . basename($fileName);

        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            return true;
        } else {
            return false;
        }
    }

    // Tạo id
    private function getid()
    {
        $randomID = '';
        for ($i = 0; $i < 3; $i++) {
            $randomID .= rand(0, 9);
        }

        return 'webtoon' . $randomID;
    }

    // Tạo thư mục chứa ảnh
    private function createDir($newDir)
    {
        $dirPath = "public/Uploads/Comic";
        $path = $dirPath . '/' . $newDir;

        if (!is_dir($path)) {
            mkDir($path);
            return true;
        } else {
            return false;
        }
    }



    // Xử lý xóa thư mục
    private function deleteDir($dir)
    {
        $dirPath = "public/Uploads/Comic/" . $dir;

        if (is_dir($dirPath)) {
            return rmdir($dirPath);
        }
        return false;
    }



    // Xử lý xóa file
    private function deleteFile($cover)
    {
        $filePath = "public/Uploads/Cover/Webtoon/" . $cover;

        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }


    // Lấy ra id và tên
    public function get_Webtoon()
    {
        $collum = 'id,name';
        $webtoonModel = $this->load->model("webtoonModel");
        $data['webtoons'] = $webtoonModel->select($collum, $this->table);
        return $data;
    }


    // Lấy ra truyện
    public function recent_Webtoon()
    {
        $cond = "1=1 ORDER BY date DESC";
        $collum = 'id,name,status,cover,date';
        $webtoonModel = $this->load->model("webtoonModel");
        $data['recent_Webtoon'] = $webtoonModel->selectCollum($this->table, $collum, $cond);
        return $data;
    }


    public function recentComics($number)
    {
        $cond = "1=1 ORDER BY date DESC LIMIT $number";
        $collum = 'id,name,status,cover,date';
        $webtoonModel = $this->load->model("webtoonModel");
        $data['recommended_Webtoon'] = $webtoonModel->selectCollum($this->table, $collum, $cond);
        return $data;
    }


    // Lấy ra truyện có điều kiện
    public function getByCond($cond)
    {
        $webtoonModel = $this->load->model("webtoonModel");
        $data['webtoons'] = $webtoonModel->selectByCond($this->table, $cond);
        return $data;
    }



    // Lấy ra truyện được đề xuất
    public function recommended_Webtoon($number)
    {
        $collum = 'webtoons.id, webtoons.name, webtoons.cover, SUM(chapters.views) AS TongLuotXem';
        $cmd = "JOIN chapters ON webtoons.id = chapters.webtoon_id GROUP BY webtoons.id ORDER BY TongLuotXem DESC LIMIT $number";
        $webtoonModel = $this->load->model("webtoonModel");
        $data['recommended_Webtoon'] = $webtoonModel->selectJoin($this->table, $collum, $cmd);
        return $data;
    }


    // Tìm kiếm truyện
    public function search($tuKhoa)
    {
        $cond = "name LIKE '%$tuKhoa%'";
        $webtoonModel = $this->load->model("webtoonModel");
        $data['search'] = $webtoonModel->selectByCond($this->table, $cond);
        return $data;
    }

    // Lấy ra thể loại
    public function selectCategories($webtoonID)
    {
        // Lấy danh sách categories của webtoon dựa trên ID
        $categoryModel = $this->load->model("categoryModel");
        $data['categories'] = $categoryModel->selectCategoriesByWebtoon($webtoonID);
        return $data; // Trả về danh sách categories
    }

    public function addCategory($webtoonID, $categoryID)
    {
        // Thêm category vào webtoon
        $categoryModel = $this->load->model("categoryModel");
        $result = $categoryModel->addCategoryToWebtoon($webtoonID, $categoryID);

        // Kiểm tra và xử lý kết quả
        if ($result != 0) {
            // Thêm thành công
            // Redirect hoặc hiển thị thông báo
            $message['msg'] = "Thêm category thành công!";
        } else {
            // Thêm thất bại
            $message['msg'] = "Thêm category thất bại!";
            // Redirect hoặc hiển thị thông báo
        }
    }


    // Hàm lấy tổng truyện
    public function countWebtoons()
    {
        $webtoonModel = $this->load->model("webtoonModel");
        $result = $webtoonModel->countWebtoons($this->table);

        $data['totalWebtoons'] = 0; // Mặc định là 0 nếu không có kết quả trả về
        if (!empty($result)) {
            $data['totalWebtoons'] = $result;
        }
        return $data;
    }
}
