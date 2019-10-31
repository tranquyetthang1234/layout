<?php

function spacePhone($phone){
   $result = substr($phone,0,4).' '.substr($phone,4,4).' '.substr($phone,8,3);
   return $result;
}

function subMenu($data,$id){

    foreach ($data as $item ){
        if($item->parent_id == $id){
            echo '<li><a href=" '.'sub-'.$item->id.'-'.$item->slug.'">'.$item->name.'</a>';
            subMenu($data , $item->id);
            echo '</li>';
        }

    }

}
function getFirstArray($string){

    $array = explode('-',$string);

    return $array[0];
}
function categorie($data,$id){
    foreach ($data as $item ){
        if($item->parent_id == $id && $item->id !=1){
            echo '<li><a href="'.$item->slug.'">'.$item->name.'</a>';
             subMenu($data , $item->id);
            echo '</li>';
        }
    }

}
 function dowloadfile($type,$data ='')
{
    return Excel::create('mutistore', function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
            $sheet->fromArray($data);
        });
    })->download($type);
}
function adddotstring($strNum) {  // hàm thêm dâu chấm  mỗi chuỗi

    $len = strlen($strNum);
    $counter = 3;
    $result = "";
    while ($len - $counter >= 0)
    {
        $con = substr($strNum, $len - $counter , 3);
        $result = '.'.$con.$result;
        $counter+= 3;
    }
    $con = substr($strNum, 0 , 3 - ($counter - $len) );
    $result = $con.$result;
    if(substr($result,0,1)=='.'){
        $result=substr($result,1,$len+1);
    }
    return $result;
}
function recursionList ($data,$checked = array(),$parent = 0,$level = 0) {
    $child = array();
    foreach ($data as $key => $value) {
        if ($value->parent_id == $parent) {
            $child[] = $value;
            unset($data[$key]);
        }
    }

    if ($child) {
        echo '<ul>';
        foreach ($child as $key => $value) {
            $id        = $value->id;
            $name      = $value->name;
            $parent_id = $value->parent_id;
            if (!empty($checked) && in_array($id,$checked)) {
                $input = '<input class="chkCategory" type="checkbox" name="chkCategory[]" value="'.$id.'" checked /> '.$name;
            } else {
                $input = '<input class="chkCategory" type="checkbox" name="chkCategory[]" value="'.$id.'" /> '.$name;
            }

            echo '<li>'.$input;
            recursionList ($data,$checked,$id,++$level);
            echo '</li>';
        }
        echo '</ul>';
    }
}
function percent_price($price,$sale_price)
{

    if ($sale_price >= $price) {
        $percent = 100 - ($price / $sale_price) * 100;
        $c = ceil($percent);
    }else{
        $c = 0;
    }
    return $c;

}
function format_Number($price){
    $price_new = number_format($price,'0',',','.');
    return $price_new;
}
function trumcateString($strs,$maxChar = 20,$hoder = "..."){

    if(strlen($strs) > $maxChar)
    {
        $result=  substr($strs,0,$maxChar).$hoder;
    }
    else{
        $result = substr($strs,0,strlen($strs));
    }
    return  $result;
}
function dequy3($data , $parent_id = 0 , $select = '',$selected =0 ){

    foreach ($data as $key => $value){
        if($value->parent_id == $parent_id){
            $id = $value->id;
            if($selected == $id && $selected != 0){
                echo "<option  selected ='selected' value='".$value->id."'>".$select.$value->name."</option>";
            }else{
                echo "<option   value='".$value->id."'>".$select.$value->name."</option>";
            }
            unset($data[$key]);
            dequy3($data,$id,$select.'---|',$selected);
        }
    }
}
function recursionTable ($data,$parent = 0,$str = '') {
    foreach ($data as $key => $value) {
        $id        = $value->id;
        $name      = $value->name;
        $parent_id = $value->parent_id;
        $position  = $value->position;
        $status    = ($value->status == 1) ? "checked" : "";
        $time      = \Carbon\Carbon::createFromTimeStamp(strtotime($value->updated_at))->diffForHumans();
       /* if (empty($value["user"]["firstname"]) && empty($value["user"]["lastname"])) {
            $fullname = 'Unknown';
        } else {
            $fullname  = '<a href="'.route('admin.user.edit',['id' => $value["user"]["id"]]).'" target="_blank">'.$value["user"]["firstname"] .' '. $value["user"]["lastname"].'</a>';
        }*/

        if ($parent_id == $parent) {
            echo'
			<tr>
				<td>'.$str.' <input name="txtPosition"  type="text"  class="text-center" value="'.$position.'" style="width: 30px" data-id="'.$id.'" readonly></td>
				<td>'.$str.' <a href="" target="_blank"><img src="images/cats/'.$value->image.'" width="40px" alt=""></a></td>
				<td>'.$str.' <a href="" target="_blank">'.$name.'</a></td>
				<td>'.'123'.'</td>
				<td><input type="checkbox" '.$status.' class="btn btn-danger btn-sm" style="width: 18px;height: 18px;   background: #3d404e;" >
               </td>
				<td>'.$time.'</td>
				<td class="text-center" >
					<ul class="icons-list">
						<li class="btn btn-info btn-xs"><a href="'.route('admin.category.edit',$id).'" style="text-decoration: none;color: white" data-popup="tooltip" title="Edit" ><span class=""> </span> Edit<i class="icon-pencil7" ></i></a></li>
						<li class="btn btn-danger btn-xs"><a href="'.route('admin.category.delete',$id).'" style="text-decoration: none;color: white"  onclick=" return confirm(\'Bạn Có Muốn Xóa Không ?\')"  data-popup="tooltip" title="Remove" class="sweet_warning"><span class="glyphicon glyphicon-trash"></span> Remove<i class="icon-trash"></i></a></li>
					</ul>
				</td>
			</tr>';
            unset($data[$key]);
            recursionTable ($data,$id,$str . "---| ");
        }
    }
}
function recursionSelect ($data,$selected = 0,$id_edit = '',$parent = 0,$str = '') {
    foreach ($data as $key => $value) {
        $id        = $value->id;
        $name      = $value->name;
        $parent_id = $value->parent_id;
        if ($parent_id == $parent) {
            if ($id == $selected) {
                echo '<option value="'.$id.'" selected>'.$str.$name.'</option>';
            } else {
                echo '<option value="'.$id.'">'.$str.$name.'</option>';
            }
            unset($data[$key]);
            recursionSelect ($data,$selected,$id_edit,$id,$str . "---| ");
        }
    }
}
function listcate ($data,$parent_id =0,$str="")
{
    $stt = 0;

    foreach ($data as $val){
        $id = $val->id;
        $ten= $val->name;
        if ($val->parent_id == $parent_id) {
            $stt ++;
            echo '<tr>';
            if ($str == "") {
                echo '<td ><strong>'.$stt.'</strong></td>';

                echo '<td ><strong style="color:blue;">'.$str.'- '.$ten.'</strong></td>';
                echo '<td ><strong>'.date($val->updated_at).'</strong></td>';
            } else {
                echo '<td ><strong>'.$stt.'</strong></td>';

                echo '<td style="color:green;">'.$str.'--|'.$ten.'</td>';
                echo '<td ><strong>'.date($val->updated_at).'</strong></td>';
            }
            echo '<td class="list_td aligncenter">
		            <a href="'.route('qt_admin.categories.edit',['id'=>$id]).'" class="btn btn-info btn-sm"   title="Sửa"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;&nbsp;
		            <a href="'.route('qt_admin.categories.delete',['id' => $id]).'" class="btn btn-success" title="Xóa" onclick="return confirm(\'Xóa danh mục này ?\') "> <span class="glyphicon glyphicon-remove"></span> </a>
			      </td>
			    </tr>';
            listcate ($data,$id,$str." ---| ");
        }
    }
}



 function saveImage($image ,$folder) {
    if (!empty($image) ) {
        $folderName = date('Y-m');
        $fileNameWithTimestamp = md5($image->getClientOriginalName() . time());
        $fileName = $fileNameWithTimestamp . '.' . $image->getClientOriginalExtension();
        if (!file_exists(public_path($folder . $folderName))) {
            mkdir(public_path($folder . $folderName), 0755,true);
        }
//                    Di chuyển file vào folder Uploads
        $imageName = "$folderName/$fileName";
        $image->move(public_path($folder . $folderName), $fileName);


//            Tạo các hình ảnh theo tỉ lệ giao diện
        /*$createImage = function($suffix = '_thumb', $width = 250, $height = 170) use($folderName, $fileName, $fileNameWithTimestamp, $image) {
            $thumbnailFileName = $fileNameWithTimestamp . $suffix . '.' . $image->getClientOriginalExtension();
            Image::make(public_path("front-end/images/products/$folderName/$fileName"))
                ->resize($width, $height)
                ->save(public_path("front-end/images/products/$folderName/$thumbnailFileName"))
                ->destroy();
        };
        $createImage();
        $createImage('_450x337', 450, 337);
        $createImage('_80x80', 80, 80);*/

        return $imageName;
    }
}

function recursiveCategory($data, $parent = 1)
{
 $child = array();
 foreach ($data as $key => $value) {
  if ($value->parent_id == $parent) {
   $child[] = $value;
   unset($data[$key]);
  }
 }
 echo '  <ul class="submenu-list">';
 foreach ($child as $key => $value) {
  $id = $value->id;
  $name = $value->name;
  $parent_id = $value->parent_id;
  if ($parent_id == $parent) {
   echo ' <li data-id="' . $value->id . '"  id="menuItem_' . $value->id . '" > <a href="javascript:void(0)">' . $value['name'] . '
                            <span style="color: #9ba09c; margin-left: 15px;font-size: 11px;">
                            ' . ($value->exchange == 1 ? '- Mua bán' : '') . '   ' . ($value->rent == 1 ? '- Cho Thuê' : '') . '
                          </span>
                        <div class="kt-portlet__head-toolbar">
                            <div class="selected-all">
                                <label class="toggle"><input data-id="1" data-type="cat"
                                    ' . ($value->status == 1 ? 'checked' : '') . '
                                        type="checkbox" id="check-show" onchange="changeActive(' . $value->id . ')">
                                    <div class="slide-toggle">
                                    </div>
                                </label>
                            </div>
                            <div>
                                <button data-toggle="modal" data-target="#kt_modal_edit_cat" type="button" data-id="1" data-name="Chủ đề 1" onclick="UpdateCat(' . $value->id . ')"
                                    class="btn btn-clean btn-sm btn-icon btn-icon-md edit-cat">
                                     <i style="font-size:16px" class="fa fa-gear"></i>
                                </button>
                            </div>
                            <div>
                                <button onclick="deleteCat(' . $value->id . ')"  type="button" data-id="1"
                                    class="btn btn-clean btn-sm btn-icon btn-icon-md delete-cat">
                                     <i style="font-size:16px" class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </a>
                   ';
   recursiveCategory($data, $id);
  }
 }
 echo '
        </li>
    </ul>';
}

if (! function_exists('phone_number_format')) {
    function phone_number_format($number) {
        // Allow only Digits, remove all other characters.
        $number = preg_replace("/[^\d]/","",$number);

        // get number length.
        $length = strlen($number);

        // if number = 10
        if($length == 10) {
        $number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1.$2.$3", $number);
        }

        return $number;
    }
}
if (! function_exists('format_money')) {
    function format_money($number)
    {
        if($number==="")
        {
            return "0 Đồng";
        }
        else{
            if($number<1000)
            {
                return number_format($number)." Đồng";
            }
            else if($number<1000000)
            {
                return number_format($number/1000000)." Nghìn ";
            }
            else  if($number<1000000000){
                return number_format($number/1000000)." Triệu ";
            }
            else if($number<1000000000000) {
                return number_format($number/1000000000)." Tỉ ";
            }
        }

    }
}
if (! function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $full = false)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = new DateTime();
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        if ($diff->days > 6) return $datetime;

        $string = array(
            'y' => 'năm',
            'm' => 'tháng',
            'w' => 'tuần',
            'd' => 'ngày',
            'h' => 'giờ',
            'i' => 'phút',
            's' => 'giây',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . '' : 'mới đây';
    }
}

if (!function_exists('toASII'))
{
    /**
     * Hàm này dùng để chuyển Tiếng việt có dấu thành không dấu
     * ví dụ : Khách sạn Serene Đà Nẵng = > khach-san-serene-da-nang
     * @param mixed $str Là chuổi cần chuyển đổi
     * @return mixed
     */
    function toASII($str = '')
    {
        // In thường
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        // In đậm
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);

        $str = preg_replace("/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|”|“|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/","-",$str);
        $str = preg_replace("/-+-/","-",$str);
        $str = preg_replace("/^\-+|\-+$/","",$str);

        return strtolower($str); // Trả về chuỗi đã chuyển
    }


}
if(!function_exists('compressImage')){
     function compressImage($source_image, $compress_image) {
        $image_info = getimagesize($source_image);
        if ($image_info['mime'] == 'image/jpeg') {
            header('Content-Type: image/jpeg');
             $source_image = imagecreatefromjpeg($source_image);
             imagejpeg($source_image, $compress_image, 80);

        } elseif ($image_info['mime'] == 'image/gif') {

            header('Content-Type: image/gif');
             $source_image = imagecreatefromgif($source_image);
             imagegif($source_image, $compress_image, 80);
        } elseif ($image_info['mime'] == 'image/png') {
            header('Content-Type: image/png');
             $source_image = imagecreatefrompng($source_image);
            //  imagepng($source_image, $compress_image, 9);
        }
        return $compress_image;
        }
}
if(!function_exists('cutTitle')){
    function cutTitle($title) {
        if (strlen($title)>80) {
             $motacut = substr($title, 0, 80); // cắt mô tả
             $title = substr($motacut, 0, strrpos($motacut, ' ')).'...'; // (vi tri cuoi)tranh cat khong het chu
        }
       return $title;
       }
}
if(!function_exists('cutContent')){
    function cutContent($content) {
        if (strlen($content)>480) {
            $motacut = substr($content, 0, 480); // cat noi udng
             $mota = substr($motacut, 0, strrpos($motacut, ' ')).'...';
             $content = $mota ;
        }
       return $content;
       }
}
if(!function_exists('slideBarShow')){
    function slideBarShow($path){
        if(strpos(url()->current(), $path))
        {
            return "show";
        }
        return "";
    }
}

if(!function_exists('slideBarActive')){
    function slideBarActive($path){
        if(url()->current() == $path)
        {
            return "active";
        }
        return "";
    }
}
if(!function_exists('format_money_VND')){
    function format_money_VND($num){
    if( !is_numeric( $num ) )
    {
        return 0;
    }
    if( ($num >= 0 && (int)$num < 0) || (int)$num < 0 - PHP_FLOAT_MAX )
    {
        return 'Giá vượt giới hạng';
    }
    if( $num < 0 )
    {
        return 0;
    }
    $str = '';
    $num = trim($num);
    $arr = str_split($num);
    $count = count($arr);
    $f = number_format($num);
    if ($count < 4) {
        $str = $num;
    } else {
        $r = explode(',', $f);
        switch (count($r)) {
            case 4:
                $str = $r[0] . ' tỉ';
                if ((int) $r[1]) {
                    $str .= ' ' . $r[1] . ' triệu';
                }
                break;
            case 3:
                $str = $r[0] . ' triệu';
                if ((int) $r[1]) {
                    $str .= ' ' . $r[1] . ' ngàn';
                }
                break;
            case 2:
                $str = $r[0] . ' ngàn';
                if ((int) $r[1]) {
                    $str .= ' ' . $r[1] . ' đồng';
                }
                break;
        }
    }
    return ($str);

    }
}

if (! function_exists('time_elapsed_string_2')) {
    function time_elapsed_string_2($datetime, $full = false)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = new DateTime();
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        if ($diff->days > 6) return $datetime;

        $string = array(
            'y' => 'năm',
            'm' => 'tháng',
            'w' => 'tuần',
            'd' => 'ngày',
            'h' => 'giờ',
            'i' => 'phút',
            's' => 'giây',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? ' trước ' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . '' : 'vừa đăng';
    }
}
if(!function_exists('uploadImage')) {

    function uploadImage($image ,$folder ='', array $extend = array(),$resize = true) {
        $code = 1;
        $data = [];
        if(!empty($image)) {

            $folderName = date('Y/m');
            $fileNameWithTimestamp = md5($image->getClientOriginalName() . time());
            $fileName = $fileNameWithTimestamp . '.' . $image->getClientOriginalExtension();
            if (!$extend) {
                $extend = ['png', 'jpg', 'jpeg'];
            }
            if (!in_array(strtolower($image->getClientOriginalExtension()), $extend)) {
                return $data['code'] = 0;
            }
            if (!file_exists(public_path($folder.'/'. $folderName))) {
                mkdir(public_path($folder.'/'. $folderName), 0755, true);
            }
            $imageName = '/'.$folder.'/'.$folderName.'/'.$fileName;

            $image->move(public_path($folder.'/' . $folderName), $fileName);
            $data = [
                'name' => $fileName,
                'code' => $code,
                'path_img' => $imageName,
            ];

            if($resize) {
                resizeImage($folder.'/'. $folderName,$fileName,$fileNameWithTimestamp,$image);
            }
            return $data;
        }

        return $data['code'] = 0;
    }

}

if(!function_exists('resizeImage')) {
    function resizeImage($folderName, $fileName, $fileNameWithTimestamp, $image) {
         $createImage = function($suffix = '_thumb', $width = 800, $height = 200) use($folderName, $fileName, $fileNameWithTimestamp, $image) {
            $thumbnailFileName = $fileNameWithTimestamp . $suffix . '.' . $image->getClientOriginalExtension();

            $imageFolder =  Image::make(public_path("$folderName/$fileName"))
                ->resize($width, $height)
                ->save(public_path("$folderName/$thumbnailFileName"))
                ->destroy();
                // ->insert(public_path().'/watermark-512.png', 'bottom-right', 20, 20)
        };
        $createImage();
        $createImage('_450x337', 450, 337);
        $createImage('_80x80', 80, 80);
    }
}



        if (!function_exists('upload_image')) {
        /**
         * @param $file [tên file trùng tên input]
         * @param array $extend [ định dạng file có thể upload được]
         * @return array|int [ tham số trả về là 1 mảng - nếu lỗi trả về int ]
         */
        function upload_image($file, $folder = '', array $extend = array())
        {
        $code = 1;
        // lay duong dan anh
        $baseFilename = public_path() . '/uploads/' . $_FILES[$file]['name'];
        // thong tin file
        $info = new SplFileInfo($baseFilename);
        // duoi file
        $ext = strtolower($info->getExtension());
        // kiem tra dinh dang file
        if (!$extend) {
            $extend = ['png', 'jpg', 'jpeg'];
        }
        if (!in_array($ext, $extend)) {
        return $data['code'] = 0;
        }
        // Tên file mới
        $nameFile = trim(str_replace('.' . $ext, '', strtolower($info->getFilename())));
        $filename = date('Y-m-d__') . str_slug($nameFile) . '.' . $ext;
        // thu muc goc de upload
        $path = public_path() . '/uploads/' . date('Y/m/d/');
        if ($folder) {
        $path = public_path() . '/uploads/' . $folder . '/' . date('Y/m/d/');
        }
        if (!\File::exists($path)) {
        mkdir($path, 0777, true);
        }
        // di chuyen file vao thu muc uploads
        move_uploaded_file($_FILES[$file]['tmp_name'], $path . $filename);
        $data = [
        'name' => $filename,
        'code' => $code,
        'path_img' => 'uploads/' . $filename,
        ];
        return $data;
        }
        }
if (!function_exists('pare_url_file')) {
    function pare_url_file($image, $folder = '')
    {
        if (!$image) {
            return '/images/no-image.jpg';
        }
        $explode = explode('__', $image);
        if (isset($explode[0])) {
            $time = str_replace('_', '/', $explode[0]);
            return '/uploads/' . $folder . '/' . date('Y/m/d', strtotime($time)) . '/' . $image;
        }
    }
}
 if (!function_exists('get_data_user')) {
    function get_data_user($type, $field = 'id')
    {
        return Auth::guard($type)->user() ? Auth::guard($type)->user()->$field : '';
    }
}

?>
