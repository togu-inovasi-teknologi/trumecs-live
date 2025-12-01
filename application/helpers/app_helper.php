<?php


if (!function_exists('main_categories')) {
    function main_categories()
    {
        $CI = &get_instance();
        $CI->load->model('general/general_model');
        return $CI->general_model->getcategori(["parent" => 0, "is_brand" => 0]);
    }

    function base_production_url($url)
    {
        return 'https://www.trumecs.com/timthumb?src=https://www.trumecs.com/public/image/product/' . $url;
    }
}
if (!function_exists('product_categories')) {
    function product_categories($categoryId, $offset)
    {
        $CI = &get_instance();
        $CI->load->model('category/Category_model');

        $category = new Category_model(['id' => $categoryId]);

        $category->products(10, $offset);

        return $category->products;
    }
}

if (!function_exists('generate_sourcing_name')) {
    function generate_sourcing_name($delimiter)
    {
        $CI = &get_instance();

        $count = $CI->db->count_all_results('sourcing');
        $year = date('y');
        $day = date('d');

        $unique = str_pad($count + 1, +5, '0', STR_PAD_LEFT);


        $format = $delimiter . '/trumecs' . '/' . $year . '/' . $day . "/" . $unique;

        return $format;
    }
}
if (!function_exists('generate_orderId')) {
    function generate_orderId()
    {
        $CI = &get_instance();

        $count = $CI->db->count_all_results('order');
        $year = date('y');
        $day = date('d');

        $unique = str_pad($count + 1, +5, '0', STR_PAD_LEFT);


        $format = $year . $day . $unique;

        return $format;
    }
}

if (!function_exists('getAge')) {
    function getAge($birthTimestamp)
    {
        $currentTimestamp = time();
        $age = date('Y', $currentTimestamp) - date('Y', $birthTimestamp);
        if (date('md', $currentTimestamp) < date('md', $birthTimestamp)) {
            $age--;
        }
        return $age;
    }
}

if (!function_exists('getAvailableDate')) {
    function getAvailableDate($dateAvailable)
    {
        $all = [];
        $currentTimestamp = time();
        if ($dateAvailable < $currentTimestamp) {
            $all[] = 'Tersedia';
        } else {
            $minusDate = $dateAvailable - $currentTimestamp;
            if ($minusDate > 86400) {
                $date = floor($minusDate / 86400);
            } else if ($minusDate > 0 && $minusDate < 86400) {
                $date = ceil($minusDate / 86400);
            }
            $tanggal = date('d M Y', $dateAvailable);
            $all[] = $date . ' Hari Lagi';
            $all[] = 'Tersedia pada ' . $tanggal;
        }
        return $all;
    }
}

if (!function_exists('getLastDate')) {
    function getLastDate($date)
    {
        $currentTimestamp = time();
        $tanggal = date('d M Y', $date);
        $hari = floor(($currentTimestamp - $date) / 86400);
        return $tanggal . ' ' . '(' . $hari . ' Hari lalu)';
    }
}



if (!function_exists('grossprofite')) {
    function grossprofite($buying, $selling)
    {

        $dppPlusPPn = $buying->total_price + $buying->calculateppn();

        $dppPlusPPnSelling = $selling->total_price + $selling->calculateppn();

        $grossProfite = $dppPlusPPnSelling - $dppPlusPPn;

        return $grossProfite;
    }
}


if (!function_exists('do_upload_file')) {
    function do_upload_file($name, $dir)
    {

        $CI = &get_instance();

        $config['upload_path']          = './public/' . $dir;
        $config['allowed_types']        = 'pdf|jpg|jpeg|png|xls|xlsx';
        $config['max_size']             = 1000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['remove_spaces']        = TRUE;
        $config['encrypt_name']         = TRUE;

        $CI->load->library('upload', $config);

        if (!$CI->upload->do_upload($name)) {
            return false;
        } else {
            return true;
        }
    }
}

if (!function_exists('status_order')) {
    function status_order($order)
    {

        $alert = '';
        if (strtolower($order['status']) == 'waiting_po') {
            $alert .= '<strong class="f22">Status Pesanan</strong>';
            $alert .= '<hr>';
            $alert .= '<div class="alert alert-info d-flex justify-content-between align-items-center" role="alert">';
            $alert .= '<div><strong>Status Pesanan : </strong> Menunggu PO Dari Pembeli</div>';
            $alert .= '</div>';
        } else if (strtolower($order['status']) == 'waiting_invoice') {
            $alert .= '<strong class="f22">Status Pesanan</strong>';
            $alert .= '<hr>';
            $alert .= '<div class="alert alert-warning d-flex justify-content-between" role="alert">';
            $alert .= '<div><strong>Status Pesanan : </strong> Menunggu Invoice Dari CS</div>';
            $alert .= '<div class="d-flex gap-2">';
            $alert .= '<a href="' . base_url('public/order/' . $order['file_po']) . '" class="btn btn-sm btn-primary" download> <i class="fa fa-fw fa-download"></i> Download PO</a>';
            $alert .= '<form method="POST" action="' . base_url('backendorder/update_status') . '">';
            $alert .= '<input type="hidden" name="order_id" value="' . $order['id'] . '">';
            $alert .= '<input type="hidden" name="order_number" value="' . $order['iduniq'] . '">';
            $alert .= '<button type="submit" class="btn btn-sm btnnew">Sudah Upload Invoice</button>';
            $alert .= '</form>';
            $alert .= '</div>';
            $alert .= '</div>';
        } else if (strtolower($order['status']) == 'waiting_payment') {
            $alert .= '<strong class="f22">Status Pesanan</strong>';
            $alert .= '<hr>';
            $alert .= '<div class="alert alert-danger" role="alert">';
            $alert .= '<strong>Status Pesanan : </strong> Menunggu Bukti Pembayaran';
            $alert .= '</div>';
        } else if (strtolower($order['status']) == 'paid') {
            $alert .= '<strong class="f22">Status Pesanan</strong>';
            $alert .= '<hr>';
            $alert .= '<div class="alert alert-success d-flex justify-content-between" role="alert">';
            $alert .= '<div><strong>Status Pesanan : </strong> Pesanan telah di bayar, Menunggu konfirmasi dari CS</div>';
            $alert .= '<div class="d-flex gap-2">';
            $alert .= '<a href="' . base_url('public/order/' . $order['file_po']) . '" class="btn btn-sm btn-primary" download> <i class="fa fa-fw fa-download"></i> Download PO</a>';
            $alert .= '<a href="' . base_url('public/order/' . $order['file_payment']) . '" class="btn btn-sm btn-warning" download> <i class="fa fa-fw fa-download"></i> Download Bukti Pembayaran</a>';
            $alert .= '<a href="' . base_url('backendorder/set_delivery/' . $order['iduniq']) . '" class="btn btn-sm btn-info"> <i class="fa fa-fw fa-truck"></i> Prosess Pengiriman</a>';
            $alert .= '</form>';
            $alert .= '</div>';
            $alert .= '</div>';
        } else if (strtolower($order['status']) == 'waiting_delivery') {
            $alert .= '<strong class="f22">Status Pesanan</strong>';
            $alert .= '<hr>';
            $alert .= '<div class="alert alert-success d-flex flex-column gap-2 justify-content-between" role="alert">';
            $alert .= '<div><strong>Status Pesanan : </strong> Pesanan telah di bayar, Menunggu konfirmasi pengiriman dari CS</div>';
            $alert .= '<div class="d-flex gap-2">';
            $alert .= '<a href="' . base_url('public/order/' . $order['file_po']) . '" class="btn btn-sm btn-primary" download> <i class="fa fa-fw fa-download"></i> Download PO</a>';
            $alert .= '<a href="' . base_url('public/order/' . $order['file_payment']) . '" class="btn btn-sm btn-warning" download> <i class="fa fa-fw fa-download"></i> Download Bukti Pembayaran</a>';
            $alert .= '<a href="' . base_url('backendorder/set_delivery/' . $order['iduniq']) . '" class="btn btn-sm btn-info"> <i class="fa fa-fw fa-truck"></i> Prosess Pengiriman</a>';
            $alert .= '<a href="' . base_url('backendorder/set_delivery/' . $order['iduniq']) . '" class="btn btn-sm btn-danger"> <i class="fa fa-fw fa-close"></i>Pembayaran Tidak Sesuai?</a>';
            $alert .= '</form>';
            $alert .= '</div>';
            $alert .= '</div>';
        } else if (strtolower($order['status']) == 'delivery') {
            $alert .= '<strong class="f22">Status Pesanan</strong>';
            $alert .= '<hr>';
            $alert .= '<div class="alert alert-info d-flex justify-content-between" role="alert">';
            $alert .= '<div><strong>Status Pesanan : </strong> Pesanan Sedang Dikirim</div>';
            $alert .= '<div class="d-flex gap-2">';
            $alert .= '<a href="' . base_url('public/order/' . $order['file_po']) . '" class="btn btn-sm btn-primary" download> <i class="fa fa-fw fa-download"></i> Download PO</a>';
            $alert .= '<a href="' . base_url('public/order/' . $order['file_payment']) . '" class="btn btn-sm btn-warning" download> <i class="fa fa-fw fa-download"></i> Download Bukti Pembayaran</a>';
            $alert .= '<a href="' . base_url('public/order/' . $order['file_delivery']) . '" class="btn btn-sm btn-info" download> <i class="fa fa-fw fa-truck"></i> Download Bukti Pengiriman</a>';
            $alert .= '<button class="btn btn-sm btn-success btn-upload-file-receive" data-id="' . $order['id'] . '" data-toggle="modal" data-target="#modal-upload-receive-file"> <i class="fa fa-fw fa-check"></i> Selesaikan Pesanan</button>';
            $alert .= '</form>';
            $alert .= '</div>';
            $alert .= '</div>';
        } else if (strtolower($order['status']) == 'complete') {
            $alert .= '<strong class="f22">Status Pesanan</strong>';
            $alert .= '<hr>';
            $alert .= '<div class="alert alert-success d-flex justify-content-between" role="alert">';
            $alert .= '<div><strong>Status Pesanan : </strong> Pesanan Telah Selesai</div>';
            $alert .= '<div class="d-flex gap-2">';
            $alert .= '</form>';
            $alert .= '</div>';
            $alert .= '</div>';
        }
        return $alert;
    }
}

if (!function_exists('alert_status_buyer')) {
    function alert_status_buyer($order)
    {

        $CI = &get_instance();

        $alert = '';
        if (strtolower($order['status']) == 'waiting_po') {

            $alert .= '<div class="alert alert-info gap-2 d-flex justify-content-between align-items-start flex-column" role="alert">';
            $alert .= '<div><strong>Status Pesanan</strong></div>';
            $alert .= '<p>Menunggu PO Dari Anda</p>';
            $alert .= '<div class="d-flex gap-2">';
            $alert .= '<button class="btn btn-sm bg-tru-primary text-white order-number-label" data-toggle="modal" data-target="#modal-upload-po" data-id="' . $order['id'] . '"> <i class="fa fa-fw fa-upload"></i> Upload PO</button>';
            $alert .= '</div>';
            $alert .= '</div>';
        } else if (strtolower($order['status']) == 'waiting_invoice') {

            $alert .= '<div class="alert alert-info gap-2 d-flex justify-content-between align-items-start flex-column" role="alert">';
            $alert .= '<div><strong>Status Pesanan</strong></div>';
            $alert .= '<p>Menunggu Invoice</p>';
            $alert .= '<div class="d-flex gap-2">';
            $alert .= '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#file_po_view"> <i class="fa fa-fw fa-download"></i> Download PO</button>';
            $alert .= '</div>';
            $alert .= '</div>';
        } else if (strtolower($order['status']) == 'waiting_payment') {

            $alert .= '<div class="alert alert-info gap-2 d-flex justify-content-between align-items-start flex-column " role="alert">';
            $alert .= '<div><strong>Status Pesanan</strong></div>';
            $alert .= '<p>Menunggu Invoice</p>';
            if ($CI->agent->is_mobile()) {
                $alert .= '<div class="d-flex gap-2 flex-column w-100">';
            } else {
                $alert .= '<div class="d-flex gap-2">';
            }

            $alert .= '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#file_po_view"> <i class="fa fa-fw fa-download"></i> Download PO</button>';
            $alert .= '<button class="btn btn-sm btnnew upload-payment-file" data-toggle="modal" data-target="#modal-upload-payment-file" data-id="' . $order['id'] . '"><i class="fa fa-fw fa-upload"></i> Upload Bukti Pembayaran</button>';
            $alert .= '</div>';
            $alert .= '</div>';
        } else if (strtolower($order['status']) == 'waiting_delivery') {
            $alert .= '<div class="alert alert-info gap-2 d-flex justify-content-between align-items-start flex-column" role="alert">';
            $alert .= '<div><strong>Status Pesanan</strong></div>';
            $alert .= '<p>Menunggu Konfirmasi Pembayaran, jika selesai akan langsung dilakukan pengiriman</p>';
            if ($CI->agent->is_mobile()) {
                $alert .= '<div class="d-flex gap-2 flex-column w-100">';
            } else {
                $alert .= '<div class="d-flex gap-2">';
            }

            $alert .= '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#file_po_view"> <i class="fa fa-fw fa-download"></i> Download PO</button>';
            $alert .= '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#file_pembayaran_view"> <i class="fa fa-fw fa-download"></i> Download Bukti Pembayaran</button>';
            $alert .= '</div>';
            $alert .= '</div>';
        } else if (strtolower($order['status']) == 'delivery') {

            $alert .= '<div class="alert alert-info gap-2 d-flex justify-content-between align-items-start flex-column" role="alert">';
            $alert .= '<div><strong>Status Pesanan</strong></div>';
            $alert .= '<p>Pesanan Sedang Dikirim</p>';
            if ($CI->agent->is_mobile()) {
                $alert .= '<div class="d-flex gap-2 flex-column w-100">';
            } else {
                $alert .= '<div class="d-flex gap-2">';
            }
            $alert .= '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#file_po_view"> <i class="fa fa-fw fa-download"></i> Download PO</button>';
            $alert .= '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#file_pembayaran_view"> <i class="fa fa-fw fa-download"></i> Download Bukti Pembayaran</button>';
            $alert .= '<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#file_delivery_view"> <i class="fa fa-fw fa-download"></i> Download Bukti Pengiriman</button>';
            $alert .= '<button class="btn btn-sm btnnew btn-upload-file-receive" data-id="' . $order['id'] . '" data-toggle="modal" data-target="#modal-upload-receive-file"> Pesanan Diterima</button>';

            $alert .= '</div>';
            $alert .= '</div>';
        } else if (strtolower($order['status']) == 'complete') {

            $alert .= '<div class="alert alert-info gap-2 d-flex justify-content-between align-items-start flex-column" role="alert">';
            $alert .= '<div><strong>Status Pesanan</strong></div>';
            $alert .= '<p>Pesanan telah selesai</p>';
            if ($CI->agent->is_mobile()) {
                $alert .= '<div class="d-flex gap-2 flex-column w-100">';
            } else {
                $alert .= '<div class="d-flex gap-2">';
            }
            $alert .= '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#file_po_view"> <i class="fa fa-fw fa-download"></i> PO</button>';
            $alert .= '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#file_pembayaran_view"> <i class="fa fa-fw fa-download"></i> Bukti Pembayaran</button>';
            $alert .= '<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#file_delivery_view"> <i class="fa fa-fw fa-download"></i> Bukti Pengiriman</button>';
            $alert .= '<button class="btn btn-sm btnnew btn-download-file-receive" data-id="' . $order['id'] . '" data-toggle="modal" data-target="#modal-download-receive-file"> <i class="fa fa-fw fa-download"></i> Bukti Penerimaan</button>';

            $alert .= '</div>';
            $alert .= '</div>';
        }
        return $alert;
    }
}
