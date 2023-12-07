 <!-- Thanh bên, menu -->
 <div class="sidebar">
     <a href="<?php echo BASE_URL ?>" class="logo">
         <img src="./public/Logo/logo.png" alt="Logo" class="logo-img">
         <div class="logo-name"><span>F4 </span>Comics</div>
     </a>
     <?php
        $currentURL = $_SERVER['REQUEST_URI'];

        $menuItems = [
            'admin/dashboard' => ['label' => 'Dashboard', 'icon' => 'bx bxs-dashboard'],
            'admin/comic_List' => ['label' => 'Comics List', 'icon' => 'bx bx-store-alt'],
            'admin/category_List' => ['label' => 'Category List', 'icon' => 'bx bx-category'],
            // Các mục menu khác
            'admin/users_List' => ['label' => 'Users list', 'icon' => 'bx bx-user'],
            'admin/authors_List' => ['label' => 'Authors list', 'icon' => 'bx bx-book'],
        ];
        ?>

     <ul class="side-menu">
         <?php foreach ($menuItems as $url => $item) : ?>
             <li <?php if (strpos($currentURL, $url) !== false) echo 'class="active"'; ?>>
                 <a href="<?php echo BASE_URL ?>/?url=<?php echo $url; ?>">
                     <i class='<?php echo $item['icon']; ?>'></i>
                     <?php echo $item['label']; ?>
                 </a>
             </li>
         <?php endforeach; ?>
     </ul>


     <ul class=" side-menu">
         <li>
             <a href="<?php echo BASE_URL ?>/?url=login/logout" class="logout">
                 <i class='bx bx-log-out-circle'></i>
                 Logout
             </a>
         </li>
     </ul>
 </div>
 <!-- End of Sidebar thanh bên, menu -->

 <!-- Main Content -->
 <div class="content">
     <!-- Navbar, thanh điều hướng -->
     <nav>
         <!-- Các phần tử khác: thanh tìm kiếm, chuyển đổi chủ đề, thông báo, hồ sơ, v.v. -->
         <i class='bx bx-menu'></i>
         <form action="#">
             <div class="form-input" id="search-index">
                 <input type="search" placeholder="Search...">
                 <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
             </div>
         </form>
         <label for="profile" id="label-profile" class="ellipsis" style="justify-self: end;">
             Hello, Admin
         </label>
         <a href="#" class="profile">
             <img src="./public/Logo/f4.jpg">
         </a>
     </nav>