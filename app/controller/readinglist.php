<?php
class readinglist extends Controller
{
    private $table = 'reading_list';

    public function __construct()
    {
        Session::checkSession();
        parent::__construct();
    }

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
                $date = $item['timestamp'];

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
                    'webtoon_id' => $webtoon_id,
                    'chapter_id' => $chapter_id,
                    'Moc_thoigian'=> $date
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
