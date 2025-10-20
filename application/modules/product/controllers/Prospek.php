<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prospek extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("backendprospek/M_Prospek", 'M_Prospek');
        $this->load->model("product_model");
        $this->load->model("m_polling");
    }

    public function set_kontak($id_produk = null)
    {
        $data['company'] = $this->input->post('company');
        $data['company_phone'] = $this->input->post('company_phone');
        $data['email'] = $this->input->post('email');
        $data['name'] = $this->input->post('name');
        $data['preferred_time'] = $this->input->post('preferred_time');

        //$product = $this->product_model->getproduct($id_produk);

        $data['type'] = "appointment";
        $data['title'] = "Appointment";
        /* $data['description'] = "Saya tertarik dengan produk berikut ini, tolong hubungi saya sesuai informasi di bawah ini: \n\n <strong>Produk:</strong> <a href=\"".base_url('product/'.$id_produk)."\">".$product[0]["tittle"]."</a> \n <strong>Waktu</strong>: ".$data["preferred_time"].""; */
        $data['description'] = "Saya tertarik dengan produk berikut ini, tolong hubungi saya sesuai informasi di bawah ini: \n\n <strong>Waktu</strong>: " . $data["preferred_time"] . "";

        $response = $this->input->post("g-recaptcha-response");
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $content = array(
            'secret' => '6LcuyIoUAAAAAJC6C-2pI482rf-DAU_PEF2nsf2y',
            'response' => $this->input->post("g-recaptcha-response")
        );

        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                    "Content-Length: " . strlen(http_build_query($content)) . "\r\n" .
                    "User-Agent:MyAgent/1.0\r\n",
                'content' => http_build_query($content)
            )
        );

        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success = json_decode($verify);
        if ($captcha_success->success == false) {
            $this->session->set_flashdata('form_error', '<div class="alert alert-danger"><span class="fa fa-exclamation-circle"></span> <strong>Error!</strong> Silahkan isi captcha terlebih dahulu</div>');
            redirect('product/contact/');
        } else if ($captcha_success->success == true) {
            /* $email_content = array_merge($data, $product[0]); */
            $email_content = array_merge($data, array());
            $message = $this->load->view('email/ask_for_appointment', $data, true);
            $this->send_email("Trumecs siap berpartner dengan anda", $data['email'], $message);
            $this->M_Prospek->set_prospek($data);
            /* redirect('product/prospek/success/'.$id_produk); */
            redirect('product/prospek/success/');
        }
    }

    public function set_buy($id_produk)
    {
        $data['company'] = $this->input->post('company');
        $data['company_phone'] = $this->input->post('company_phone');
        $data['email'] = $this->input->post('email');
        $data['name'] = $this->input->post('name');
        $data['preferred_time'] = $this->input->post('preferred_time');
        $data['company_address'] = $this->input->post('company_address');
        //$data['id_produk'] = $this->input->post('id_produk[]');
        $data['qty'] = $this->input->post('qty[]');
        $data['item_tambahan'] = $this->input->post('item_tambahan');
        $data['method'] = $this->input->post('method');

        //var_dump($data);
        $location = $this->M_Prospek->get_location($this->input->post('district'));

        $text_product = "";
        /* foreach($data['id_produk'] as $key=>$item):
            $product = $this->product_model->getproduct($item);
            $text_product .= "<strong>Produk:</strong> <a href=\"".base_url('product/'.$item)."\">".$product[0]["tittle"]."</a> \n <strong>Jumlah</strong>: ".$data["qty"][$key].' '.$product[0]["unit"]."\n <strong>Perkiraan Harga</strong>: Rp ".number_format($product[0]["price"]*$data["qty"][$key],0,',','.')." \n";
        endforeach; */
        foreach ($this->cart->contents() as $key) :
            //$product = $this->product_model->getproduct($item);
            $text_product .= "<div class='items'><strong>Produk:</strong>";
            $text_product .= "<a class='item-id' data-id_produk='" . $key["id"] . "' href=\"" . base_url('product/' . $key["id"]) . "\">" . $key["name"] . "</a> \n ";
            $text_product .= "<strong>Jumlah</strong>: <span class='item-qty'>" . $key["qty"] . '</span> ' . $key["unit"] . "\n ";
            $text_product .= "<strong>Perkiraan Harga</strong>: Rp <span class='item-price'>" . number_format($key["price"] * $key["qty"], 0, ',', '.') . "</span></div>\n\n";
        endforeach;

        $text_tambahan = '';
        if ($data['item_tambahan']) :
            $text_tambahan .= "\n <strong>Item Tambahan</strong>\n";
            $text_tambahan .= $data['item_tambahan'] . "\n\n";
        endif;

        $data['type'] = "buy";
        $data['title'] = "Permintaan";
        $data['description'] = "Saya tertarik dengan produk berikut ini, tolong kirimkan saya penawaran untuk permintaan di bawah ini: \n\n  " . $text_product . $text_tambahan . "<strong>Via</strong>: " . ($data["method"] == 1 ? "Email" : "Whatsapp") . " \n <strong>Alamat</strong>: " . $data['company_address'] . ', ' . $location;

        $response = $this->input->post("g-recaptcha-response");
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $content = array(
            'secret' => '6LcuyIoUAAAAAJC6C-2pI482rf-DAU_PEF2nsf2y',
            'response' => $this->input->post("g-recaptcha-response")
        );

        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                    "Content-Length: " . strlen(http_build_query($content)) . "\r\n" .
                    "User-Agent:MyAgent/1.0\r\n",
                'content' => http_build_query($content)
            )
        );

        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success = json_decode($verify);
        if ($captcha_success->success == false) {
            $this->session->set_flashdata('form_error', '<div class="alert alert-danger"><span class="fa fa-exclamation-circle"></span> <strong>Error!</strong> Silahkan isi captcha terlebih dahulu</div>');
            redirect('cart');
        } else if ($captcha_success->success == true) {
            $email_content = array_merge($data, $product[0]);
            $message = $this->load->view('email/contact_to_buy', $email_content, true);
            $this->send_email("Berpartner dengan Trumecs adalah keputusan tepat", $data['email'], $message);
            if ($_FILES['filecompare']['size'] > 0) :
                $newname = time();
                $config['upload_path'] = './public/image/prospek';
                $config['allowed_types'] = 'jpg|png|pdf';
                $config['max_size'] = '200000';
                $config['file_name'] = $newname;
                //load the upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->set_allowed_types('*');

                if (!$this->upload->do_upload('filecompare')) {
                    $this->session->set_flashdata('message', 'Terjadi kesalah saat mengunggah file, pastikan file berextensi .JPG atau .PDF<br>dengan ukuran file maksimal 2Mb');
                    redirect("cart/");
                    exit();
                } else {
                    $datafile = $this->upload->data();
                    $data['img_compare'] = $newname . $datafile["file_ext"];
                    $data['description'] .= "\n\n<strong>Banding Harga</strong>\nBerikut saya lampirkan bukti banding harga untuk membantu proses penawaran:\n<a href='" . base_url("public/image/prospek/" . $newname . $datafile["file_ext"]) . "'>Download</a>";
                }
            endif;

            $this->M_Prospek->set_prospek($data);
            redirect('product/prospek/success/' . $id_produk);
        }
    }

    public function set_tender()
    {
        $data['company'] = $this->input->post('company');
        $data['company_field'] = $this->input->post('company_field');
        $data['phone'] = $this->input->post('phone');
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['product'] = $this->input->post('product');
        $data['due_date'] = $this->input->post('due_date');

        $response = $this->input->post("g-recaptcha-response");
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $content = array(
            'secret' => '6LcuyIoUAAAAAJC6C-2pI482rf-DAU_PEF2nsf2y',
            'response' => $this->input->post("g-recaptcha-response")
        );

        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                    "Content-Length: " . strlen(http_build_query($content)) . "\r\n" .
                    "User-Agent:MyAgent/1.0\r\n",
                'content' => http_build_query($content)
            )
        );

        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success = json_decode($verify);
        if ($captcha_success->success == false) {
            $this->session->set_flashdata('form_error', '<div class="alert alert-danger"><span class="fa fa-exclamation-circle"></span> <strong>Error!</strong> Silahkan isi captcha terlebih dahulu</div>');
            redirect('product/tender');
        } else if ($captcha_success->success == true) {
            $email_content = $data;
            $message = $this->load->view('email/tender', $email_content, true);
            $this->send_email("Berpartner dengan Trumecs adalah keputusan tepat", $data['email'], $message);

            $this->M_Prospek->set_tender($data);
            redirect('product/prospek/tender_success');
        }
    }

    private function send_email($subject, $receiver, $message)
    {
        $from = "no-reply@trumecs.com";
        $password = "no-reply#trumecs#123abc";
        $to = $receiver;
        $subject = $subject;
        $message = $message;
        $emailstatus = $this->emailer->sent($from, $password, $to, $subject, $message);
    }

    public function success($id_product = null)
    {
        $data['product'] = $this->product_model->getproduct($id_product);
        $data['content'] = 'success';

        $this->load->view('front/template_front', $data);
    }

    public function tender_success()
    {
        $data['content'] = 'tender_success';
        $this->load->view('front/template_front', $data);
    }

    public function get_regencies()
    {
        $regencies = $this->M_Prospek->get_regency($this->input->post('id_province'));

        echo json_encode($regencies->result_array());
    }

    public function get_districts()
    {
        $districts = $this->M_Prospek->get_district($this->input->post('id_regency'));

        echo json_encode($districts->result_array());
    }

    public function get_villages()
    {
        $villages = $this->M_Prospek->get_village($this->input->post('id_district'));

        echo json_encode($villages->result_array());
    }

    public function get_products()
    {
        $item = $this->M_Prospek->search($this->input->get('q'));
        $data = array();
        foreach ($item->result() as $key => $product) :
            $data[$key]['id'] = $product->id;
            $data[$key]['text'] = $product->tittle . " - " . $product->partnumber;
            $data[$key]['partnumber'] = $product->partnumber;
            $data[$key]['price'] = $product->price;
            $data[$key]['weight'] = $product->weight;
            $data[$key]['unit'] = $product->unit;
            $data[$key]['warranty'] = $product->warranty;
        endforeach;
        //echo json_encode($data);
        echo json_encode($data);
    }

    public function feedback()
    {
        $post = $this->input->post();

        $data['participant'] = array(
            'session_id' => $this->input->cookie('ci_session'),
            'email' => $post['email'],
            'phone' => $post['phone'],
            'feedback' => $post['feedback'],
            'referrer' => $_SERVER['HTTP_REFERER'],
            'ga' => $this->input->cookie('_ga'),
            'id_polling' => 1,
            'created' => time()
        );
        $data['id_polling'] = 1;
        $data['answer'] = $post['answer'];
        $this->m_polling->saveanswer($data);

        $this->session->set_flashdata('message_feedback', 'Terimakasih atas partisipasi anda!');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
