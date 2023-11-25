 <!-- Thanh bên, menu -->
 <div class="sidebar">
     <a href="<?php echo BASE_URL ?>/?url=admin" class="logo">
         <img src="./public/Logo/logo.png" alt="Logo" class="logo-img">
         <div class="logo-name"><span>F4 </span>Comics</div>
     </a>

     <ul class="side-menu ">
         <li>
             <a href="<?php echo BASE_URL ?>/?url=admin">
                 <i class='bx bxs-dashboard'></i>Dashboard </a>
         </li>
         <li>
             <a href="<?php echo BASE_URL ?>?url=admin/comic_List">
                 <i class='bx bx-store-alt'></i>Comics List</a>
         </li>
         <li>
             <a href="#">
                 <i class='bx bx-analyse'></i>Setting</a>
         </li>
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
             <img src="./public/Logo/logo.png">
         </a>
     </nav>