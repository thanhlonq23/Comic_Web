<?php
class readinglist extends Controller
{
    private $table = 'reading_list';

    public function __construct()
    {
        Session::checkSession();
        parent::__construct();
    }

    // Thêm vào Reading List

    public function add_to_reading_list($webtoon_id, $chapter_id)
    {
        $user_id = Session::get('user_id');

        if ($user_id) {
            $readingModel = $this->load->model("readingModel");
            $data = [
                'user_id' => $user_id,
                'webtoon_id' => $webtoon_id,
                'chapter_id' => $chapter_id
            ];

            $result = $readingModel->insert($this->table, $data);

            if ($result) {
                // Xử lý khi thêm thành công và chuyển hướng người dùng
                // Ví dụ: Chuyển hướng đến trang chi tiết chapter hoặc trang Reading List
            } else {
                // Xử lý khi thêm không thành công và thông báo lỗi
            }
        } else {
            // Xử lý khi không có user_id trong session
            // Ví dụ: Chuyển hướng người dùng đến trang đăng nhập
        }
    }

    public function remove_from_reading_list($chapter_id)
    {
        $user_id = Session::get('user_id');

        if ($user_id) {
            $cond = "user_id = '$user_id' AND chapter_id = '$chapter_id'";
            $readingModel = $this->load->model("readingModel");
            $result = $readingModel->delete($this->table, $cond);

            if ($result) {
                // Xử lý khi xóa thành công và chuyển hướng người dùng hoặc cập nhật trang Reading List
            } else {
                // Xử lý khi xóa không thành công và thông báo lỗi
            }
        } else {
            // Xử lý khi không có user_id trong session
            // Ví dụ: Chuyển hướng người dùng đến trang đăng nhập
        }
    }

    // public function get_user_reading_list($user_id)
    // {
    //     $data = [];

    //     if ($user_id) {
    //         $cond = "user_id = '$user_id'";
    //         $readingModel = $this->load->model("readingModel");
    //         $data['reading_list'] = $readingModel->selectByCond($this->table, $cond);
    //         // Xử lý dữ liệu
    //     } else {
    //         // Xử lý khi không có user_id trong session
    //         // Ví dụ: Chuyển hướng người dùng đến trang đăng nhập
    //     }

    //     return $data;
    // }
    public function get_user_reading_list($user_id)
    {
        $data = [];
        $webtoon_info = [];
        $chapter_info = [];

        if ($user_id) {
            $cond = "user_id = '$user_id'";
            $readingModel = $this->load->model("readingModel");
            $reading_list = $readingModel->selectByCond($this->table, $cond);

            // Tạo một array để lưu trữ thông tin webtoon và chapter tương ứng với webtoon_id và chapter_id
            $result = [];
            foreach ($reading_list as $item) {
                $webtoon_id = $item['webtoon_id'];
                $chapter_id = $item['chapter_id'];

                $cond1 = "id = '$webtoon_id'";
                $cond2 = "id = '$chapter_id'";
                // Lấy thông tin từ bảng webtoons
                $webtoonModel = $this->load->model("webtoonModel");
                $webtoon_info[] = $webtoonModel->selectByCond('webtoons', $cond1); // Change 'id' to your webtoon table's primary key

                // Lấy thông tin từ bảng chapters
                $chapterModel = $this->load->model("chapterModel");
                $chapter_info[] = $chapterModel->selectByCond('chapters', $cond2); // Change 'id' to your chapter table's primary key

                // Tạo một array mới chứa thông tin của webtoon và chapter
                $result[] = [
                    // 'webtoon_name' => $webtoon_info['name'], // Thay 'name' bằng tên cột chứa tên webtoon trong bảng webtoons
                    // 'chapter_name' => $chapter_info['name'], // Thay 'name' bằng tên cột chứa tên chapter trong bảng chapters
                    'webtoon_id' => $webtoon_id,
                    'chapter_id' => $chapter_id
                ];
            }

            $data['reading_list'] = $result;
            // Xử lý dữ liệu
        } else {
            // Xử lý khi không có user_id trong session
            // Ví dụ: Chuyển hướng người dùng đến trang đăng nhập
        }

        // return $data;
        return [
            'reading_list' => $data['reading_list'],
            'chapter_info' => $chapter_info,
            'webtoon_info' => $webtoon_info
        ];
    }
}
