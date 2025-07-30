<?php

use App\SettingGeneral;
use App\Model\RoleModel;
use App\Model\Notifikasi;
use App\Model\User;
use App\Model\Blog;
use App\Model\Contact;
use App\Model\Page;
use App\Model\Testimonial;
use App\Model\InfoBox;
use App\Model\ClientData;
use App\Model\Category;
use App\UserDescription;



function AppSeting($keywords)
{
    $data = SettingGeneral::select('value')->where('name', $keywords)->where('status',1)->first();
    return $data->value;
}


function AppName()
{
    $data = SettingGeneral::select('value')->where('name', 'app_name')->first();
    return $data->value;
}

function AppLogo()
{
    $data = SettingGeneral::select('value')->where('name', 'logo')->first();
    return $data->value;
}

function AppSplashscreen()
{
    $data = SettingGeneral::select('value')->where('name', 'spalshsreen')->first();
    return $data->value;
}

function AppBgMenu()
{
    $data = SettingGeneral::select('value')->where('name', 'bg_menu_app')->first();
    return $data->value;
}



function AppFooter()
{
    $data = SettingGeneral::select('value')->where('name', 'footer_text')->first();
    return $data->value;
}

function AppVersion()
{
    // $data = SettingGeneral::select('value')->where('name','footer_text')->first();
    return 'v.0.0.1';
}


function AppFutureImageDefault()
{
    $data = SettingGeneral::select('value')->where('name', 'future_image')->first();
    return $data->value;
}


function phone_link()
{
    $data = SettingGeneral::select('value')->where('name', 'phone_link')->first();
    return $data->value;
}

function office_address()
{
    $data = SettingGeneral::select('value')->where('name', 'office_address')->first();
    return $data->value;
}




function getSetting()
{
    $get_setting = SettingGeneral::where('status', 1)->get();


    $data = [];
    foreach ($get_setting as $r) {
        $data[$r['name']] = $r['value'];
    }
    return $data;
}


function FrontAppTitle()
{
    $data = SettingGeneral::select('value')->where('name', 'front_app_title')->first();
    return $data->value;
}


function AppThemeDashboard()
{
    $data = SettingGeneral::select('value')->where('name', 'dashboard_mode')->first();
    return $data->value;
}

function AppThemeSidebar()
{
    $data = SettingGeneral::select('value')->where('name', 'sidebar_mode')->first();
    return $data->value;
}

function AppThemeBoxes()
{
    $data = SettingGeneral::select('value')->where('name', 'dashboard_boxed')->first();
    return $data->value;
}

function UserRole()
{
    $user = auth()->user();
    $roles = RoleModel::pluck('name', 'name')->all();
    return $userRole = $user->roles->pluck('deskripsi')->first();
}


function imploadValue($types)
{
    $strTypes = implode(",", $types);
    return $strTypes;
}

function explodeValue($types)
{
    $strTypes = explode(",", $types);
    return $strTypes;
}

function random_code()
{

    return rand(1111, 9999);
}

function remove_special_char($text)
{

    $t = $text;

    $specChars = array(
        ' ' => '-',    '!' => '',    '"' => '',
        '#' => '',    '$' => '',    '%' => '',
        '&amp;' => '',    '\'' => '',   '(' => '',
        ')' => '',    '*' => '',    '+' => '',
        ',' => '',    '₹' => '',    '.' => '',
        '/-' => '',    ':' => '',    ';' => '',
        '<' => '',    '=' => '',    '>' => '',
        '?' => '',    '@' => '',    '[' => '',
        '\\' => '',   ']' => '',    '^' => '',
        '_' => '',    '`' => '',    '{' => '',
        '|' => '',    '}' => '',    '~' => '',
        '-----' => '-',    '----' => '-',    '---' => '-',
        '/' => '',    '--' => '-',   '/_' => '-',

    );

    foreach ($specChars as $k => $v) {
        $t = str_replace($k, $v, $t);
    }

    return $t;
}

function arrStatusActive()
{
    return array(1 => __('main.active'), 0 => __('main.inactive'));
}

function arrStatusPublihs()
{
    return array('publish' => 'Publish', 'draft' => 'Draft');
}

function arrCategoryCompany()
{
    return array(
        'Certification', 
        'Consultation'
    );
}


function arrTypeTraining()
{
    return array('reguler' => 'Reguler', 'non_reguler' => 'Non Reguler');
}

function arrTarget()
{
    return array('1' => '_self', '2' => '_blank');
}

function orientate($image, $orientation)
{
    switch ($orientation) {

            // 888888
            // 88
            // 8888
            // 88
            // 88
        case 1:
            return $image;

            // 888888
            //     88
            //   8888
            //     88
            //     88
        case 2:
            return $image->flip('h');


            //     88
            //     88
            //   8888
            //     88
            // 888888
        case 3:
            return $image->rotate(180);

            // 88
            // 88
            // 8888
            // 88
            // 888888
        case 4:
            return $image->rotate(180)->flip('h');

            // 8888888888
            // 88  88
            // 88
        case 5:
            return $image->rotate(-90)->flip('h');

            // 88
            // 88  88
            // 8888888888
        case 6:
            return $image->rotate(-90);

            //         88
            //     88  88
            // 8888888888
        case 7:
            return $image->rotate(-90)->flip('v');

            // 8888888888
            //     88  88
            //         88
        case 8:
            return $image->rotate(90);

        default:
            return $image;
    }
}

function arrMonth($locale)
{
    if ($locale == 'id') {
        return array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu', 9 => 'Sept', 10 => 'Okt', 11 => 'Nov', 12 => 'Des');
    } elseif ($locale == 'zh') {
        return array(1 => '一月', 2 => '二月', 3 => '游行', 4 => '四月', 5 => '可能', 6 => '六月', 7 => '七月', 8 => '八月', 9 => '九月', 10 => '十月', 11 => '十一月', 12 => '十二月');
    } elseif ($locale == 'en') {
        return array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
    }
}

function setUrlSlug($kata)
{
    $new_string = strip_tags(trim($kata));
    $new_string1 = preg_replace("/[^a-zA-Z0-9-_\s]/", "", $new_string);
    $new_string2 = urlencode($new_string1);
    $new_string3 = str_replace('+', '-', $new_string2);
    $new_string4 = str_replace('--', '-', $new_string3);

    return strtolower($new_string4);
}


function issetOr($arr, $key)
{
    if (isset($arr[$key])) {
        return $arr[$key];
    } else {
        return null;
    }
}


function rupiah($angka)
{

    $hasil_rupiah = number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}


function countPaymentPending()
{

    $count = TrainingBooking::where('status_booking', 'reg')
        ->whereNotNull('bukti_transfer')
        ->count();

    return $count;
}


function getNotifikasi()
{

    $user = auth()->user();


    $get_notifikasi = Notifikasi::where('id_user', $user->id)
        ->where('status', 'un_read')
        ->count();

    return $get_notifikasi;
}


function formatDate($date)
{

    return $newDate = date("d-M-Y", strtotime($date));
}

function formatDateJadwal($date)
{

    return $newDate = date("d-F-Y", strtotime($date));
}


function formatDateTime($date)
{

    return $newDate = date("d-M-Y H:i:s", strtotime($date));
}



function formatHariJadwal($date)
{

    $hari = date("D", strtotime($date));
    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return $hari_ini;
}




function TotalAccounts()
{

    $total_members = User::select([
        'id',
        'name',
        'email',
        'status',
        'created_at'
    ])
    ->where('id', '!=', auth()->user()->id)
    ->where('status',1)
    ->count();


    return $total_members;
}




function recent_post()
{
    $blogs_all = Blog::select('id', 'published_on', 'slug', 'image')
        ->where('status', 1)
        ->orderBy('published_on', 'DESC')
        ->limit(3)
        ->get();
    return $blogs_all;
}



function getCountInbox()
{
    $get_inbox = Contact::where('status_read', 'N')->count();

    return $get_inbox;
}



function customDateNow()
{
    $nowDate  =  new DateTime();
    return $nowDate->format('Y-m-d');
}

function customDateTimeNow(){
    $nowDate  =  new DateTime();
    return $nowDate->format('Y-m-d H:i:s');
}


function customDateExp($dates, $limit)
{
    $exp  =  date('Y-m-d', strtotime($dates . " +" . ($limit - 3) . " days"));
    return $exp;
}

function customDateTimeExp($dates, $limit)
{
    $exp  =  date('Y-m-d H:i:s', strtotime($dates . " +" . ($limit) . " hours"));
    return $exp;
}



function newLine($count)
{
    for ($x = 1; $x <= $count; $x++) {
        echo "<br>";
    }
}

function firstString($text)
{
    $initKapal = '';
    $aa = explode(' ', $text);
    for ($i = 0; $i < count($aa); $i++) {
        $initKapal .= $aa[$i][0];
    }
    return $initKapal;
}

function convert_durasi($sum)
{
    $years = floor($sum / 365);
    $months = floor(($sum - ($years * 365)) / 30.5);
    $result = ($years <= 0 ? ($months <= 1 ? '' : $months.' ') : ($years <= 1 ? '' : $years.' ')) . ($years <= 0 ? 'Bulan' : 'Tahun');
    return $result;
}


function numberToRoman(int $integer): string
{
    static $conversions = [
        1000 => 'M',
        900 => 'CM',
        500 => 'D',
        400 => 'CD',
        100 => 'C',
        90 => 'XC',
        50 => 'L',
        40 => 'XL',
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        1 => 'I'
    ];
    $romanString = '';
    foreach ($conversions as $int => $roman) {
        while ($integer >= $int) {
            $integer -= $int;
            $romanString .= $roman;
            if (!$integer) {
                break 2;
            }
        }
    }
    return $romanString;
}



function menu_layayan()
{
    $menu = Fasilitas::where('status', 1)
        ->where('category', 'layanan')
        ->orderBy('created_at', 'ASC')
        ->get();
    return $menu;
}


function tentang_kami()
{
    $menu = Page::where('status', 1)->where('jenis', 1)->where('id_category', 11)->get();
    return $menu;
}

function menu_aspek_hukum()
{
    $menu = Page::where('status', 1)->where('jenis', 2)->where('id_category', 4)->get();
    return $menu;
}




function testimonial()
{
    return Testimonial::where('status', 1)->get();
}







function kode_trans(){
    // Mendapatkan tanggal dan waktu saat ini
    $currentDateTime = new DateTime();

    // Format tanggal dan waktu menjadi string
    $dateTimeString = $currentDateTime->format('YmdHis');

    // Mengambil 6 karakter pertama dari tanggal dan waktu (tahun, bulan, hari, jam, menit, detik)
    $dateTimeCode = substr($dateTimeString, 0, 6);

    // Membuat string acak untuk 4 karakter terakhir
    $randomCode = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 4);

    // Menggabungkan kode tanggal dan waktu dengan kode acak
    $uniqueCode = $dateTimeCode . $randomCode;

    return $uniqueCode; // Output kode unik 10 karakter
}


function infobox(){
    return $infobox = InfoBox::first();
}



function getClient()
{
    $data = ClientData::where('status',1)->get();

    return $data;
}


function getKategori(){
    return Category::where('status',1)
    ->where('main',1)
    ->get();
}

function getKategoriId($id){
    return Category::where('id',$id)
    ->first();
}


function Get_recent_post(){
    return Blog::select('id', 'published_on', 'slug', 'image')
            ->where('status',1)
            ->limit(4)
            ->orderBy('created_at','desc')
            ->get();
}


function getUserName($id){
    $data = UserDescription::where('users_id',$id)->first();

    if($data){
        $data;
    }else{
        $data =null;
    }

    return $data;

}