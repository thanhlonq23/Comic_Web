 <!-- Thanh bên, menu -->
 <div class="sidebar">
     <a href="dashboard.php" class="logo">
         <img src="../../css/admin/images/logo.png" alt="Logo" class="logo-img">
         <div class="logo-name"><span>F4 </span>Comics</div>
     </a>

     <!-- <ul class="side-menu">
            <li><a href="dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="comicslist.php"><i class='bx bx-store-alt'></i>Comics List</a></li>
            <li><a href="setting.php"><i class='bx bx-analyse'></i>Setting</a></li>
        </ul> -->

     <ul class="side-menu">
         <li<?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php')
                echo ' class="active"'; ?>>
             <a href="dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a>
             </li>
             <li<?php if (basename($_SERVER['PHP_SELF']) == 'comicslist.php')
                    echo ' class="active"'; ?>>
                 <a href="comicslist.php"><i class='bx bx-store-alt'></i>Comics List</a>
                 </li>
                 <li<?php if (basename($_SERVER['PHP_SELF']) == 'setting.php')
                        echo ' class="active"'; ?>>
                     <a href="setting.php"><i class='bx bx-analyse'></i>Setting</a>
                     </li>
     </ul>

     <ul class="side-menu">
         <li>
             <a href="#" class="logout">
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
         <!-- <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label> -->
         <!-- <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a> -->
         <label for="profile" id="label-profile" class="ellipsis" style="justify-self: end;">
             Hello, Nguyễn Châu!
         </label>
         <a href="#" class="profile">
             <img src="../../css/admin/images/2.jpg">
         </a>
     </nav>