<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backendrental extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("general/General_model", 'M_general');
        $this->load->model("backendrental/M_backendrental", 'M_backendrental');
        $this->load->model("rental/Rental_model", 'Rental_model');
        $this->load->model("category/Category_model", 'Category_model');
    }

    public function list_rental()
    {
        $data['kategori'] = $this->M_general->getcategori(["parent" => 0, "etc" => 2]);
        $idKategori = $data['kategori'][0]['id'];
        $data['rental'] = $this->Category_model->getProductsInCategoryTree($idKategori);
        $data["js"] = array('/modules/backendrental/js/backendrental.js');
        $data['css'] = ['/modules/backendrental/css/backendrental.css'];
        $data['content'] = 'listRental';
        $this->load->view('backend/template_front1', $data);
    }
    public function add_rental()
    {
        $data['kategori'] = $this->M_general->getcategori(["parent" => 0, "etc" => 2]);
        $idKategori = $data['kategori'][0]['id'];
        $data['subKategori'] = $this->M_general->getcategori(["parent" => $idKategori, "etc" => 2]);
        $data["js"] = array('/modules/backendrental/js/backendrental.js', base_url() . "asset/js/select2.min.js");
        $data['css'] = ['/modules/backendrental/css/backendrental.css', base_url() . "asset/css/select2.min.css"];
        $data['content'] = 'addRental';
        $this->load->view('backend/template_front1', $data);
    }

    public function attributeList()
    {
        $query = $this->input->get('query');
        $result = $this->M_backendrental->getAttribute($query);
        echo json_encode($result);
    }

    public function addRental()
    {
        $name = $this->input->post('name');
        $stock = $this->input->post('stock');
        $made = $this->input->post('made');
        $str_made = strtotime($made);
        $description = $this->input->post('description');
        $brand = $this->input->post('brand');
        $category = $this->input->post('category');
        $rentCategory = explode(',', $category);
        $jenisproduct = $rentCategory[0];
        $component = $rentCategory[1];
        $area = $this->input->post('area');
        $rent_description = $this->input->post('rent_description');
        $rent_time_unit = $this->input->post('rent_time_unit');
        $hour_meter = $this->input->post('hour_meter');
        $str_hour_meter = str_replace('.', '', $hour_meter);
        $minimum_rent = $this->input->post('minimum_rent');
        $rent_price = $this->input->post('rent_price');
        $str_rent_price = str_replace('.', '', $rent_price);
        $pa_name = $this->input->post('pa_name');
        $pa_id = $this->input->post('pa_id');
        $pa_value = $this->input->post('pa_value');

        $config['upload_path'] = './public/image/product/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '5000';
        $config['max_width']  = '3000';
        $config['max_height']  = '3000';
        $this->load->library('upload', $config);
        if (isset($_FILES['img'])) {
            if (!empty($_FILES['img']['name'])) {
                $config['file_name'] = microtime() . ".jpg";
                $this->upload->initialize($config);
                if (!$this->upload->do_upload("img")) {
                    $this->session->set_flashdata('message', 'Gambar tidak bisa di upload' . $this->upload->display_errors());
                    redirect(base_url() . "backendrental/add_rental");
                    exit();
                } else {
                    $data = $this->upload->data();
                    $nameimg = $data["file_name"];
                    $this->watermarkoverlay("product", $nameimg);
                }
            }
        } else {
            $nameimg = null;
        }
        if (isset($_FILES['gallery_file'])) {
            if (!empty($_FILES['gallery_file']['name'][0])) {
                $configgallery['upload_path'] = './public/image/galery';
                $configgallery['allowed_types'] = 'png|jpg|jpeg|JPG|PNG';
                $configgallery['encrypt_name'] = TRUE;
                $configgallery['max_size'] = '5000';
                $configgallery['max_width']  = '3000';
                $configgallery['max_height']  = '3000';
                $namegallery = [];
                foreach ($_FILES['gallery_file']['name'] as $key => $value) {
                    if (!empty($value)) {
                        $_FILES['file']['name'] = $_FILES['gallery_file']['name'][$key];
                        $_FILES['file']['type'] = $_FILES['gallery_file']['type'][$key];
                        $_FILES['file']['tmp_name'] = $_FILES['gallery_file']['tmp_name'][$key];
                        $_FILES['file']['error'] = $_FILES['gallery_file']['error'][$key];
                        $_FILES['file']['size'] = $_FILES['gallery_file']['size'][$key];
                        $this->upload->initialize($configgallery);
                        if ($this->upload->do_upload('file')) {
                            $fileData = $this->upload->data();
                            $namegallery[] = $fileData['file_name'];
                        } else {
                            $this->session->set_flashdata('message', 'File galeri tidak bisa diupload: ' . $this->upload->display_errors());
                            redirect(base_url() . "backendrental/add_rental");
                            exit();
                        }
                    }
                }
            }
        }
        $dataRental = [
            'tittle' => $name,
            'stock' => $stock,
            'img' => $nameimg,
            'is_rent' => 1,
            'quality' => 1,
            'area' => $area,
            'made' => $str_made,
            'description' => $description,
            'rent_description' => $rent_description,
            'rent_time_unit' => $rent_time_unit,
            'hour_meter' => $str_hour_meter,
            'minimum_rent' => $minimum_rent,
            'rent_price' => $str_rent_price,
            'jenisproduct' => $jenisproduct,
            'component' => $component,
            'brand' => $brand,
        ];
        $this->db->trans_start();
        $this->M_backendrental->insert('product', $dataRental);
        $id_product = $this->db->insert_id();
        if (!empty($pa_id)) {
            foreach ($pa_id as $i => $id) {
                if (!empty($id)) {
                    $dataProductAttribute = [
                        'product_id' => $id_product,
                        'attribute_id' => $id,
                        'value' => $pa_value[$i],
                    ];
                    $this->M_backendrental->insert('product_attribute', $dataProductAttribute);
                } else {
                    $dataAttribute = [
                        'name' => $pa_name[$i],
                    ];
                    $this->M_backendrental->insert('attribute', $dataAttribute);
                    $id_attribute = $this->db->insert_id();
                    $dataProductAttribute = [
                        'product_id' => $id_product,
                        'attribute_id' => $id_attribute,
                        'value' => $pa_value[$i],
                    ];
                    $this->M_backendrental->insert('product_attribute', $dataProductAttribute);
                }
            }
        }
        if (!empty($namegallery)) {
            foreach ($namegallery as $i => $galeri) {
                $this->watermarkoverlay("galery", $galeri);
                $dataGalery = [
                    'product' => $id_product,
                    'img' => $galeri,
                ];
                $this->M_backendrental->insert('galery', $dataGalery);
            }
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('message', 'Rental di tambah');
        redirect(base_url() . "backendrental/list_rental");
        exit();
    }

    public function detail_rental($id)
    {
        $data['rental'] = $this->Rental_model->getRentalDetail($id);
        $data['rental_gallery'] = $this->Rental_model->getGalleryExpert($id);
        $data['rental_attribute'] = $this->Rental_model->getProductAttribute($id);
        $data["js"] = array('/modules/backendrental/js/backendrental.js', base_url() . "asset/js/select2.min.js");
        $data['css'] = ['/modules/backendrental/css/backendrental.css', base_url() . "asset/css/select2.min.css"];
        $data['content'] = 'detailRental';
        $this->load->view('backend/template_front1', $data);
    }
    public function edit_rental($id)
    {
        $data['kategori'] = $this->M_general->getcategori(["parent" => 0, "etc" => 2]);
        $idKategori = $data['kategori'][0]['id'];
        $data['subKategori'] = $this->M_general->getcategori(["parent" => $idKategori, "etc" => 2]);
        $data['rental'] = $this->Rental_model->getRentalDetail($id);
        $data['rental_gallery'] = $this->Rental_model->getGalleryExpert($id);
        $data['rental_attribute'] = $this->Rental_model->getProductAttribute($id);
        $data["js"] = array('/modules/backendrental/js/backendrental.js', base_url() . "asset/js/select2.min.js");
        $data['css'] = ['/modules/backendrental/css/backendrental.css', base_url() . "asset/css/select2.min.css"];
        $data['content'] = 'editRental';
        $this->load->view('backend/template_front1', $data);
    }

    public function editRental($id)
    {
        $name = $this->input->post('name');
        $stock = $this->input->post('stock');
        $imgBefore = $this->input->post('img-before');
        $made = $this->input->post('made');
        $str_made = strtotime($made);
        $description = $this->input->post('description');
        $brand = $this->input->post('brand');
        $category = $this->input->post('category');
        $rentCategory = explode(',', $category);
        $jenisproduct = $rentCategory[0];
        $component = $rentCategory[1];
        $area = $this->input->post('area');
        $rent_description = $this->input->post('rent_description');
        $rent_time_unit = $this->input->post('rent_time_unit');
        $hour_meter = $this->input->post('hour_meter');
        $str_hour_meter = str_replace('.', '', $hour_meter);
        $minimum_rent = $this->input->post('minimum_rent');
        $rent_price = $this->input->post('rent_price');
        $str_rent_price = str_replace('.', '', $rent_price);
        $pa_name = $this->input->post('pa_name');
        $pa_id = $this->input->post('pa_id');
        $pa_value = $this->input->post('pa_value');

        $config['upload_path'] = './public/image/product/';
        $config['allowed_types'] = 'jpeg|jpg|png|JPG|PNG';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '5000';
        $config['max_width']  = '3000';
        $config['max_height']  = '3000';
        $this->load->library('upload', $config);
        if (isset($_FILES['img'])) {
            if (!empty($_FILES['img']['name'])) {
                $config['file_name'] = microtime() . ".jpg";
                $this->upload->initialize($config);
                if (!$this->upload->do_upload("img")) {
                    $this->session->set_flashdata('message', 'Gambar tidak bisa di upload' . $this->upload->display_errors());
                    redirect(base_url() . "backendrental/add_rental");
                    exit();
                } else {
                    $data = $this->upload->data();
                    $nameimg = $data["file_name"];
                    $this->watermarkoverlay("product", $nameimg);
                }
            }
        } else {
            $nameimg = null;
        }
        if (isset($_FILES['gallery_file'])) {
            if (!empty($_FILES['gallery_file']['name'][0])) {
                $configgallery['upload_path'] = './public/image/galery';
                $configgallery['allowed_types'] = 'png|jpg|jpeg|JPG|PNG';
                $configgallery['encrypt_name'] = TRUE;
                $configgallery['max_size'] = '5000';
                $configgallery['max_width']  = '3000';
                $configgallery['max_height']  = '3000';
                $namegallery = [];
                foreach ($_FILES['gallery_file']['name'] as $key => $value) {
                    if (!empty($value)) {
                        $_FILES['file']['name'] = $_FILES['gallery_file']['name'][$key];
                        $_FILES['file']['type'] = $_FILES['gallery_file']['type'][$key];
                        $_FILES['file']['tmp_name'] = $_FILES['gallery_file']['tmp_name'][$key];
                        $_FILES['file']['error'] = $_FILES['gallery_file']['error'][$key];
                        $_FILES['file']['size'] = $_FILES['gallery_file']['size'][$key];
                        $this->upload->initialize($configgallery);
                        if ($this->upload->do_upload('file')) {
                            $fileData = $this->upload->data();
                            $namegallery[] = $fileData['file_name'];
                        } else {
                            $this->session->set_flashdata('message', 'File galeri tidak bisa diupload: ' . $this->upload->display_errors());
                            redirect(base_url() . "backendrental/add_rental");
                            exit();
                        }
                    }
                }
            }
        }
        $dataRental = [
            'tittle' => $name,
            'stock' => $stock,
            'img' => $nameimg !== null ? $nameimg : $imgBefore,
            'is_rent' => 1,
            'quality' => 1,
            'area' => $area,
            'made' => $str_made,
            'description' => $description,
            'rent_description' => $rent_description,
            'rent_time_unit' => $rent_time_unit,
            'hour_meter' => $str_hour_meter,
            'minimum_rent' => $minimum_rent,
            'rent_price' => $str_rent_price,
            'jenisproduct' => $jenisproduct,
            'component' => $component,
            'brand' => $brand,
        ];
        $this->db->trans_start();
        $this->M_backendrental->update('product', $dataRental, 'id', $id);
        if (!empty($pa_id)) {
            $this->M_backendrental->delete('product_attribute', 'product_id', $id);
            foreach ($pa_id as $i => $id_pa) {
                if (!empty($id_pa)) {
                    $dataProductAttribute = [
                        'product_id' => $id,
                        'attribute_id' => $id_pa,
                        'value' => $pa_value[$i],
                    ];
                    $this->M_backendrental->insert('product_attribute', $dataProductAttribute);
                } else {
                    $dataAttribute = [
                        'name' => $pa_name[$i],
                    ];
                    $this->M_backendrental->insert('attribute', $dataAttribute);
                    $id_attribute = $this->db->insert_id();
                    $dataProductAttribute = [
                        'product_id' => $id,
                        'attribute_id' => $id_attribute,
                        'value' => $pa_value[$i],
                    ];
                    $this->M_backendrental->insert('product_attribute', $dataProductAttribute);
                }
            }
        }
        if (!empty($imgBeforeGalery)) {
            $this->M_backendrental->delete('galery', 'product', $id);
            foreach ($imgBeforeGalery as $i => $galeri) {
                $dataGalery = [
                    'product' => $id,
                    'img' => $galeri,
                ];
                $this->M_backendrental->insert('galery', $dataGalery);
            }
        }
        if (!empty($namegallery)) {
            foreach ($namegallery as $i => $galeri) {
                $this->watermarkoverlay("galery", $galeri);
                $dataGalery = [
                    'product' => $id,
                    'img' => $galeri,
                ];
                $this->M_backendrental->insert('galery', $dataGalery);
            }
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('message', 'Rental Berhasil di update');
        redirect(base_url() . "backendrental/detail_rental/" . $id);
        exit();
    }
    public function deleteRental($id)
    {
        $this->db->trans_start();
        $this->M_backendrental->delete('product', 'id', $id);
        $this->M_backendrental->delete('product_attribute', 'product_id', $id);
        $this->M_backendrental->delete('galery', 'product', $id);
        $this->db->trans_complete();
        $this->session->set_flashdata('message', 'Rental Berhasil di hapus');
        redirect(base_url() . "backendrental/list_rental");
        exit();
    }

    public function watermarkoverlay($folder, $nameimage)
    {
        $this->load->library('image_lib');
        $config['image_library']    = 'NetPBM';
        $config['source_image']     = './public/image/' . $folder . '/' . $nameimage;
        $config['wm_type']          = 'overlay';
        $config['wm_overlay_path']  = './public/image/watermarking.png'; //the overlay image
        $config['wm_opacity']       = 80;
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';

        $this->image_lib->initialize($config);

        if (!$this->image_lib->watermark()) {
            echo $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
    }

    public function getRegenciesJson()
    {
        $term = $this->input->get('term');
        $data = $this->M_backendrental->getRegenciesJson($term);
        $results = [];
        foreach ($data as $row) {
            $results[] = [
                'id' => $row['id'],
                'text' => "{$row['name']}",
            ];
        };
        header('Content-Type: application/json');
        echo json_encode(['results' => array_values($results)]);
    }

    public function getBrandJson()
    {
        $term = $this->input->get('term');
        $data = $this->M_backendrental->getBrandJson($term);
        $results = [];
        foreach ($data as $row) {
            $results[] = [
                'id' => $row['id'],
                'text' => "{$row['name']}",
            ];
        };
        header('Content-Type: application/json');
        echo json_encode(['results' => array_values($results)]);
    }
}