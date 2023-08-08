<?php


function wl_register_admin_bar_menus(WP_Admin_Bar $wl_admin_bar)
{
    $menuID = 'wl_admin_bar_menus';
    $wl_admin_bar->add_menu(
        [
            'id' => $menuID,
            'parent' => null,
            'title' => '<span class="ab-icon dashicons dashicons-admin-links"></span>تنظیمات قالب'
        ]
    );
    $wl_admin_bar->add_menu(
        [
//            'id'=>$menuID,
            'parent' => $menuID,
            'title' => 'فایل آپلودر',
            'href' => admin_url('admin.php?page=cjf_file_uploader'),
        ]
    );
}

function wl_register_menus()
{
    add_menu_page('تنظیمات قالب',
        'تنظیمات قالب',
        'manage_options',
        'cjf_home',
        'cjf_home_handler'
    );
    add_submenu_page('cjf_home',
        'فایل آپلودر',
        'فایل آپلودر',
        'manage_options',
        'cjf_file_uploader',
        'cjf_file_uploader_handler'
    );
}

 function cjf_home_handler(){

 }
function cjf_file_uploader_handler()
{
    if (isset($_POST['upload'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $file = $_FILES['file'];

        //    echo '<pre>';
        //    var_dump($file);
        //    echo '</pre>';
            $wpFilePath = wp_upload_dir();
            $filePath = $wpFilePath['basedir'] . "/custom_uploads_dir" . '/'. date('Y') .'/'. date('m').'\/';

            if(!file_exists($filePath)){
                wp_mkdir_p($filePath);
            }

            $fileNamePart = explode('.',$file['name']);
            $newFileName = $fileNamePart[0] . rand(1000,9999) . '.' . end($fileNamePart);
          
            echo '<pre>';
            var_dump($filePath . $newFileName);
            echo '</pre>';

            $result = move_uploaded_file($file['tmp_name'],$filePath . $newFileName );
            if($result){
                echo '<script>alert("فایل مورد نظر شما با موفقیت آپلود گردید");</script>';
            }else{
                echo '<script>alert("خطا در آپلود فایل !!!");</script>';
            }
//
//            echo '<pre>';
//            var_dump($wpFilePath);
//            echo '</pre>';
//            exit; 

        }
    }


   include CJF_PLUGIN_VIEW . 'admin/file_uploader_layout.php';


}


add_action('admin_menu', 'wl_register_menus');
add_action('admin_bar_menu', 'wl_register_admin_bar_menus', 100);
