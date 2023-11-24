<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F4 Comics</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/admin/admin.css">
    <style>
        .container {
            /* max-width: 650px;
            width: 100%;
            padding: 30px; */
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 20px;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        }

        .drag-area {
            height: 400px;
            border: 3px dashed #e0eafc;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 10px auto;
        }

        h3 {
            margin-bottom: 20px;
            font-weight: 500;
        }

        .drag-area .icon {
            font-size: 50px;
            color: #1683ff;
        }

        .drag-area .header {
            font-size: 20px;
            font-weight: 500;
            color: #34495e;
        }

        .drag-area .support {
            font-size: 12px;
            color: gray;
            margin: 10px 0 15px 0;
        }

        .drag-area .button {
            font-size: 20px;
            font-weight: 500;
            color: #1683ff;
            cursor: pointer;
        }

        .drag-area.active {
            border: 2px solid #1683ff;
        }

        .drag-area img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php
    require_once 'nav.php';
    ?>
    <main class="main">
        <div class="container">
            <h3>Upload your File :</h3>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="drag-area">
                    <div class="icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <span class="header">Drag & Drop Folder to Upload</span>
                    <!-- <span class="header">or<span class="button">browse</span></span> -->
                    <input type="file" hidden />
                    <span class="support">Supports: JPEG, JPG, PNG</span>
                </div>
                <div style="display: block; text-align:center;">
                    <input type="button" value="Submit Upload">
                </div>
            </form>
        </div>

    </main>
    <script src="../../js/admin/admin.js"></script>
</body>

</html>