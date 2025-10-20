<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backendmekanik extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->securitylog->cekadmin();
        $this->load->model("general/General_model", 'M_general');
        $this->load->model("category/Category_model", 'Category_model');
        $this->load->model("mechanic/Mechanic_model", 'Mechanic_model');
        $this->load->model("backendmekanik/M_backendmekanik", 'M_backendmekanik');
    }

    public function index()
    {
        $data['kategori'] = $this->M_general->getcategori(["parent" => 0, "etc" => 1]);
        $idKategori = $data['kategori'][0]['id'];
        $data['mechanic'] = $this->Category_model->getProductsInCategoryTree($idKategori);
        $data["js"] = array('/modules/backendmekanik/js/backendmekanik.js', base_url() . "asset/js/select2.min.js");
        $data['css'] = [base_url() . "asset/css/select2.min.css"];
        $data['content'] = 'listMekanik';
        $this->load->view('backend/template_front', $data);
    }
    public function detail_mekanik($id)
    {
        $data['mechanic'] = $this->Mechanic_model->getMechanic($id);
        $data['mechanic_variant'] = $this->Mechanic_model->getProductVariants($id);
        $dataMechanicExp = $this->Mechanic_model->getExpertExperience($id);
        foreach ($dataMechanicExp as &$exp) {
            $exp['positions'] = explode('|', $exp['positions']);
            $exp['descriptions'] = explode('|', $exp['descriptions']);
        }
        $data['mechanic_exp'] = $dataMechanicExp;
        $data['mechanic_service_expertise'] = $this->Mechanic_model->getServiceExpertise($id);
        $data['mechanic_file'] = $this->Mechanic_model->getProductFile($id);
        $data['mechanic_gallery'] = $this->Mechanic_model->getGalleryExpert($id);
        $data['content'] = 'detailMekanik';
        $this->load->view('backend/template_front', $data);
    }
    public function add_mekanik()
    {
        $data['grade'] = $this->M_backendmekanik->getGrade();
        $data['regencies'] = $this->M_backendmekanik->getRegencies();
        $data['kategori'] = $this->M_general->getcategori(["parent" => 0, "etc" => 1]);
        $idKategori = $data['kategori'][0]['id'];
        $data['subKategori'] = $this->M_general->getcategori(["parent" => $idKategori, "etc" => 1]);
        $data["js"] = array('/modules/backendmekanik/js/backendmekanik.js', base_url() . "asset/js/select2.min.js");
        $data['css'] = [base_url() . "asset/css/select2.min.css"];
        $data['content'] = 'addMekanik';
        $this->load->view('backend/template_front', $data);
    }

    public function organizationList()
    {
        $query = $this->input->get('query');
        $result = $this->M_backendmekanik->getOrganization($query);
        echo json_encode($result);
    }

    public function addMekanik()
    {
        $name = $this->input->post('name');
        $last_education = $this->input->post('last_education');
        $made = $this->input->post('made');
        $str_made = strtotime($made);
        $last_medical = $this->input->post('last_medical');
        $str_last_medical = strtotime($last_medical);
        $estimated_deliveryindent = $this->input->post('estimated_deliveryindent');
        $str_estimated_deliveryindent = strtotime($estimated_deliveryindent);
        $grade = $this->input->post('grade');
        $area = $this->input->post('area');
        $category = $this->input->post('category');
        $expCategory = explode(',', $category);
        $jenisproduct = $expCategory[0];
        $component = $expCategory[1];
        $tag = $this->input->post('tag');
        $service_coverage = $this->input->post('service_coverage');
        $description = $this->input->post('description');
        $price_description = $this->input->post('price_description');
        $pv_name = $this->input->post('pv_name');
        $pv_value = $this->input->post('pv_value');
        $str_pv_value = str_replace('.', '', $pv_value);
        $ee_id_organization = $this->input->post('ee_id_organization');
        $ee_name_organization = $this->input->post('ee_name_organization');
        $ee_position = $this->input->post('ee_position');
        $ee_year_start = $this->input->post('ee_year_start');
        $ee_year_end = $this->input->post('ee_year_end');
        $ee_description = $this->input->post('ee_description');
        $se_name = $this->input->post('se_name');
        $se_description = $this->input->post('se_description');
        $sertificate_name = $this->input->post('sertificate_name');
        $sertificate_caption = $this->input->post('sertificate_caption');
        $sertificate_description = $this->input->post('sertificate_description');

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
                    redirect(base_url() . "backendmekanik/add_mekanik");
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
        if (isset($_FILES["sertificate_file"])) {
            if (!empty($_FILES['sertificate_file']['name'][0])) {
                $configfile['upload_path'] = './public/image/product/file';
                $configfile['allowed_types'] = 'pdf|xlsx|xls';
                $configfile['encrypt_name'] = TRUE;
                $configfile['max_size'] = '5000';
                $configfile['max_width']  = '3000';
                $configfile['max_height']  = '3000';
                $namesertificate = [];
                foreach ($_FILES['sertificate_file']['name'] as $key => $value) {
                    if (!empty($value)) {
                        $_FILES['file']['name'] = $_FILES['sertificate_file']['name'][$key];
                        $_FILES['file']['type'] = $_FILES['sertificate_file']['type'][$key];
                        $_FILES['file']['tmp_name'] = $_FILES['sertificate_file']['tmp_name'][$key];
                        $_FILES['file']['error'] = $_FILES['sertificate_file']['error'][$key];
                        $_FILES['file']['size'] = $_FILES['sertificate_file']['size'][$key];

                        $this->upload->initialize($configfile);
                        if ($this->upload->do_upload('file')) {
                            $fileData = $this->upload->data();
                            $namesertificate[] = $fileData['file_name'];
                        } else {
                            $this->session->set_flashdata('message', 'File sertifikat tidak bisa diupload: ' . $this->upload->display_errors());
                            redirect(base_url() . "backendmekanik/add_mekanik");
                            exit();
                        }
                    }
                }
            }
        } else {
            $namesertificate = '';
        }

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
                        redirect(base_url() . "backendmekanik/add_mekanik");
                        exit();
                    }
                }
            }
        }

        $dataProduct = [
            'tittle' => $name,
            'img' => $nameimg,
            'last_education' => $last_education,
            'last_medical' => $str_last_medical,
            'estimated_deliveryindent' => $str_estimated_deliveryindent,
            'made' => $str_made,
            'quality' => $grade,
            'description' => $description,
            'area' => $area,
            'price_description' => $price_description,
            'jenisproduct' => $jenisproduct,
            'component' => $component,
            'is_service' => 1,
        ];
        $this->db->trans_start();
        $this->M_backendmekanik->insert('product', $dataProduct);
        $id_product = $this->db->insert_id();
        if (!empty($tag)) {
            foreach ($tag as $productTag) {
                $dataProductTag = [
                    'product_id' => $id_product,
                    'tag_id' => $productTag,
                ];
                $this->M_backendmekanik->insert('product_tag', $dataProductTag);
            }
        }
        if (!empty($service_coverage)) {
            foreach ($service_coverage as $sc) {
                $dataServiceCoverage = [
                    'product_id' => $id_product,
                    'regency_id' => $sc,
                ];
                $this->M_backendmekanik->insert('service_coverage', $dataServiceCoverage);
            }
        }
        if (!empty($se_name)) {
            foreach ($se_name as $i => $serviceExpertise) {
                $dataServiceExpertise = [
                    'product_id' => $id_product,
                    'name' => $serviceExpertise,
                    'description' => $se_description[$i],
                    'created_at' => strtotime('now'),
                    'updated_at' => strtotime('now'),
                ];
                $this->M_backendmekanik->insert('service_expertise', $dataServiceExpertise);
            }
        }
        if (!empty($sertificate_name)) {
            foreach ($sertificate_name as $i => $serName) {
                $dataProductFile = [
                    'product_id' => $id_product,
                    'name' => $serName,
                    'caption' => $sertificate_caption[$i],
                    'description' => $sertificate_description[$i],
                    'file' => $namesertificate[$i],
                    'created_at' => strtotime('now'),
                ];
                $this->M_backendmekanik->insert('product_file', $dataProductFile);
            }
        }
        if (!empty($namegallery)) {
            foreach ($namegallery as $i => $galeri) {
                $this->watermarkoverlay("galery", $galeri);
                $dataGalery = [
                    'product' => $id_product,
                    'img' => $galeri,
                ];
                $this->M_backendmekanik->insert('galery', $dataGalery);
            }
        }
        if (!empty($pv_name)) {
            foreach ($pv_name as $i => $productVariant) {
                $dataProductVariant = [
                    'product_id' => $id_product,
                    'name' => $productVariant,
                    'price' => $str_pv_value[$i],
                    'created_at' => strtotime('now'),
                    'updated_at' => strtotime('now'),
                ];
                $this->M_backendmekanik->insert('product_variant', $dataProductVariant);
            }
        }
        if (!empty($ee_id_organization)) {
            foreach ($ee_id_organization as $i => $ee_id) {
                if (!empty($ee_id)) {
                    $dataExpertExperience = [
                        'product_id' => $id_product,
                        'organization_id' => $ee_id,
                        'position' => $ee_position[$i],
                        'year_start' => $ee_year_start[$i],
                        'year_end' => $ee_year_end[$i],
                        'description' => $ee_description[$i],
                        'created_at' => strtotime('now'),
                        'updated_at' => strtotime('now'),
                    ];
                    $this->M_backendmekanik->insert('expert_experience', $dataExpertExperience);
                } else {
                    $dataExpertOrganization = [
                        'organization_name' => $ee_name_organization[$i],
                    ];
                    $this->M_backendmekanik->insert('expert_organization', $dataExpertOrganization);
                    $id_organization = $this->db->insert_id();
                    $dataExpertExperience = [
                        'product_id' => $id_product,
                        'organization_id' => $id_organization,
                        'position' => $ee_position[$i],
                        'year_start' => $ee_year_start[$i],
                        'year_end' => $ee_year_end[$i],
                        'description' => $ee_description[$i],
                        'created_at' => strtotime('now'),
                        'updated_at' => strtotime('now'),
                    ];
                    $this->M_backendmekanik->insert('expert_experience', $dataExpertExperience);
                }
            }
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('message', 'Mekanik di tambah');
        redirect(base_url() . "backendmekanik");
        exit();
    }
    public function edit_mekanik($id)
    {
        $data['grade'] = $this->M_backendmekanik->getGrade();
        $data['mechanic'] = $this->Mechanic_model->getMechanic($id);
        $data['regencies'] = $this->M_backendmekanik->getRegencies();
        $data['kategori'] = $this->M_general->getcategori(["parent" => 0, "etc" => 1]);
        $idKategori = $data['kategori'][0]['id'];
        $data['subKategori'] = $this->M_general->getcategori(["parent" => $idKategori, "etc" => 1]);
        $data['mechanic_variant'] = $this->Mechanic_model->getProductVariants($id);
        $data['mechanic_exp'] = $this->M_backendmekanik->getExpertExperience($id);
        $data['mechanic_service_coverage'] = $this->M_backendmekanik->getServiceCoverage($id);
        $data['mechanic_service_expertise'] = $this->Mechanic_model->getServiceExpertise($id);
        $data['mechanic_file'] = $this->Mechanic_model->getProductFile($id);
        $data['mechanic_gallery'] = $this->Mechanic_model->getGalleryExpert($id);
        $data["js"] = array('/modules/backendmekanik/js/backendmekanik.js', base_url() . "asset/js/select2.min.js");
        $data['css'] = [base_url() . "asset/css/select2.min.css"];
        $data['content'] = 'editMekanik';
        $this->load->view('backend/template_front', $data);
    }
    public function editMekanik($id)
    {
        $name = $this->input->post('name');
        $imgBefore = $this->input->post('img-before');
        $imgBeforeGalery = $this->input->post('img-before-galery');
        $sertificateFileBefore = $this->input->post('sertificate-file-before');
        $last_education = $this->input->post('last_education');
        $made = $this->input->post('made');
        $str_made = strtotime($made);
        $last_medical = $this->input->post('last_medical');
        $str_last_medical = strtotime($last_medical);
        $estimated_deliveryindent = $this->input->post('estimated_deliveryindent');
        $str_estimated_deliveryindent = strtotime($estimated_deliveryindent);
        $grade = $this->input->post('grade');
        $area = $this->input->post('area');
        $category = $this->input->post('category');
        $expCategory = explode(',', $category);
        $jenisproduct = $expCategory[0];
        $component = $expCategory[1];
        $tag = $this->input->post('tag');
        $service_coverage = $this->input->post('service_coverage');
        $description = $this->input->post('description');
        $price_description = $this->input->post('price_description');
        $pv_name = $this->input->post('pv_name');
        $pv_value = $this->input->post('pv_value');
        $str_pv_value = str_replace('.', '', $pv_value);
        $ee_id_organization = $this->input->post('ee_id_organization');
        $ee_name_organization = $this->input->post('ee_name_organization');
        $ee_position = $this->input->post('ee_position');
        $ee_year_start = $this->input->post('ee_year_start');
        $ee_year_end = $this->input->post('ee_year_end');
        $ee_description = $this->input->post('ee_description');
        $se_name = $this->input->post('se_name');
        $se_description = $this->input->post('se_description');
        $sertificate_name = $this->input->post('sertificate_name');
        $sertificate_caption = $this->input->post('sertificate_caption');
        $sertificate_description = $this->input->post('sertificate_description');

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
                    redirect(base_url() . "backendmekanik/edit_mekanik/" . $id);
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
        if (isset($_FILES['sertificate_file'])) {
            if (!empty($_FILES['sertificate_file']['name'][0])) {
                $configfile['upload_path'] = './public/image/product/file';
                $configfile['allowed_types'] = 'pdf|xlsx|xls';
                $configfile['encrypt_name'] = TRUE;
                $configfile['max_size'] = '5000';
                $configfile['max_width']  = '3000';
                $configfile['max_height']  = '3000';
                $namesertificate = [];
                foreach ($_FILES['sertificate_file']['name'] as $key => $value) {
                    if (!empty($value)) {
                        $_FILES['file']['name'] = $_FILES['sertificate_file']['name'][$key];
                        $_FILES['file']['type'] = $_FILES['sertificate_file']['type'][$key];
                        $_FILES['file']['tmp_name'] = $_FILES['sertificate_file']['tmp_name'][$key];
                        $_FILES['file']['error'] = $_FILES['sertificate_file']['error'][$key];
                        $_FILES['file']['size'] = $_FILES['sertificate_file']['size'][$key];

                        $this->upload->initialize($configfile);
                        if ($this->upload->do_upload('file')) {
                            $fileData = $this->upload->data();
                            $namesertificate[] = $fileData['file_name'];
                        } else {
                            $this->session->set_flashdata('message', 'File sertifikat tidak bisa diupload: ' . $this->upload->display_errors());
                            redirect(base_url() . "backendmekanik/edit_mekanik/" . $id);
                            exit();
                        }
                    }
                }
            }
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
                            redirect(base_url() . "backendmekanik/edit_mekanik/" . $id);
                            exit();
                        }
                    }
                }
            }
        }
        $dataProduct = [
            'tittle' => $name,
            'img' => $nameimg !== null ? $nameimg : $imgBefore,
            'last_education' => $last_education,
            'last_medical' => $str_last_medical,
            'estimated_deliveryindent' => $str_estimated_deliveryindent,
            'made' => $str_made,
            'quality' => $grade,
            'description' => $description,
            'area' => $area,
            'price_description' => $price_description,
            'jenisproduct' => $jenisproduct,
            'component' => $component,
            'is_service' => 1,
        ];
        $this->db->trans_start();
        $this->M_backendmekanik->update('product', $dataProduct, 'id', $id);
        if (!empty($tag)) {
            $this->M_backendmekanik->delete('product_tag', 'product_id', $id);
            foreach ($tag as $productTag) {
                $dataProductTag = [
                    'product_id' => $id,
                    'tag_id' => $productTag,
                ];
                $this->M_backendmekanik->insert('product_tag', $dataProductTag);
            }
        }
        if (!empty($service_coverage)) {
            $this->M_backendmekanik->delete('service_coverage', 'product_id', $id);
            foreach ($service_coverage as $sc) {
                $dataServiceCoverage = [
                    'product_id' => $id,
                    'regency_id' => $sc,
                ];
                $this->M_backendmekanik->insert('service_coverage', $dataServiceCoverage);
            }
        }
        if (!empty($se_name)) {
            foreach ($se_name as $i => $serviceExpertise) {
                $this->M_backendmekanik->delete('service_expertise', 'product_id', $id);
                $dataServiceExpertise = [
                    'product_id' => $id,
                    'name' => $serviceExpertise,
                    'description' => $se_description[$i],
                    'created_at' => strtotime('now'),
                    'updated_at' => strtotime('now'),
                ];
                $this->M_backendmekanik->insert('service_expertise', $dataServiceExpertise);
            }
        }
        if (!empty($sertificateFileBefore)) {
            $this->M_backendmekanik->delete('product_file', 'product_id', $id);
            foreach ($sertificate_name as $i => $serName) {
                $dataProductFile = [
                    'product_id' => $id,
                    'name' => $serName,
                    'caption' => $sertificate_caption[$i],
                    'description' => $sertificate_description[$i],
                    'file' => $sertificateFileBefore[$i],
                    'created_at' => strtotime('now'),
                ];
                $this->M_backendmekanik->insert('product_file', $dataProductFile);
            }
        }
        if (!empty($namesertificate)) {
            foreach ($namesertificate as $i => $serName) {
                $dataProductFile = [
                    'product_id' => $id,
                    'name' => $sertificate_name[$i],
                    'caption' => $sertificate_caption[$i],
                    'description' => $sertificate_description[$i],
                    'file' => $serName,
                    'created_at' => strtotime('now'),
                ];
                $this->M_backendmekanik->insert('product_file', $dataProductFile);
            }
        }
        if (!empty($imgBeforeGalery)) {
            $this->M_backendmekanik->delete('galery', 'product', $id);
            foreach ($imgBeforeGalery as $i => $galeri) {
                $dataGalery = [
                    'product' => $id,
                    'img' => $galeri,
                ];
                $this->M_backendmekanik->insert('galery', $dataGalery);
            }
        }
        if (!empty($namegallery)) {
            foreach ($namegallery as $i => $galeri) {
                $this->watermarkoverlay("galery", $galeri);
                $dataGalery = [
                    'product' => $id,
                    'img' => $galeri,
                ];
                $this->M_backendmekanik->insert('galery', $dataGalery);
            }
        }

        if (!empty($pv_name)) {
            $this->M_backendmekanik->delete('product_variant', 'product_id', $id);
            foreach ($pv_name as $i => $productVariant) {
                $dataProductVariant = [
                    'product_id' => $id,
                    'name' => $productVariant,
                    'price' => $str_pv_value[$i],
                    'created_at' => strtotime('now'),
                    'updated_at' => strtotime('now'),
                ];
                $this->M_backendmekanik->insert('product_variant', $dataProductVariant);
            }
        }
        if (!empty($ee_id_organization)) {
            $this->M_backendmekanik->delete('expert_experience', 'product_id', $id);
            foreach ($ee_id_organization as $i => $ee_id) {
                if (!empty($ee_id)) {
                    $dataExpertExperience = [
                        'product_id' => $id,
                        'organization_id' => $ee_id,
                        'position' => $ee_position[$i],
                        'year_start' => $ee_year_start[$i],
                        'year_end' => $ee_year_end[$i],
                        'description' => $ee_description[$i],
                        'created_at' => strtotime('now'),
                        'updated_at' => strtotime('now'),
                    ];
                    $this->M_backendmekanik->insert('expert_experience', $dataExpertExperience);
                } else {
                    $dataExpertOrganization = [
                        'organization_name' => $ee_name_organization[$i],
                    ];
                    $this->M_backendmekanik->insert('expert_organization', $dataExpertOrganization);
                    $id_organization = $this->db->insert_id();
                    $dataExpertExperience = [
                        'product_id' => $id,
                        'organization_id' => $id_organization,
                        'position' => $ee_position[$i],
                        'year_start' => $ee_year_start[$i],
                        'year_end' => $ee_year_end[$i],
                        'description' => $ee_description[$i],
                        'created_at' => strtotime('now'),
                        'updated_at' => strtotime('now'),
                    ];
                    $this->M_backendmekanik->insert('expert_experience', $dataExpertExperience);
                }
            }
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('message', 'Mekanik Berhasil di edit');
        redirect(base_url() . "backendmekanik/detail_mekanik/" . $id);
        exit();
    }
    public function deleteMekanik($id)
    {
        $this->db->trans_start();
        $this->M_backendmekanik->delete('product', 'id', $id);
        $this->M_backendmekanik->delete('expert_experience', 'product_id', $id);
        $this->M_backendmekanik->delete('product_variant', 'product_id', $id);
        $this->M_backendmekanik->delete('galery', 'product', $id);
        $this->M_backendmekanik->delete('product_file', 'product_id', $id);
        $this->M_backendmekanik->delete('product_tag', 'product_id', $id);
        $this->M_backendmekanik->delete('service_coverage', 'product_id', $id);
        $this->M_backendmekanik->delete('service_expertise', 'product_id', $id);
        $this->db->trans_complete();
        $this->session->set_flashdata('message', 'Mekanik Berhasil di hapus');
        redirect(base_url() . "backendmekanik");
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

    public function getDropdownData()
    {
        $data = $this->M_backendmekanik->getAllData();
        echo json_encode($data);
    }

    public function getProvincesAndRegencies()
    {
        $term = $this->input->get('term');
        $data = $this->M_backendmekanik->getProvincesAndRegencies($term);
        $results = [];
        foreach ($data as $row) {
            if (!isset($results[$row['id_province']])) {
                $results[$row['id_province']] = [
                    'id' => $row['id_province'],
                    'text' => "PROVINSI {$row['name_province']}",
                ];
            }
            if (!empty($row['id_regency'])) {
                $results[] = [
                    'id' => $row['id_regency'],
                    'text' => "{$row['name_regency']}",
                ];
            }
        }
        header('Content-Type: application/json');
        echo json_encode(['results' => array_values($results)]);
    }
    public function getRegenciesJson()
    {
        $term = $this->input->get('term');
        $data = $this->M_backendmekanik->getRegenciesJson($term);
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
    public function getMechanicServiceCoverage($id)
    {
        $mechanic_service_coverage = $this->M_backendmekanik->getServiceCoverage($id);
        $processedCoverage = [];

        foreach ($mechanic_service_coverage as $item) {
            $processedCoverage[] = [
                'id' => $item['id_regencies'] ?? $item['id_province'],
                'text' => $item['name_regencies'] ?? $item['name_province'],
            ];
        }
        echo json_encode($mechanic_service_coverage);
    }

    public function updateDateAvailable($id)
    {
        $estimated_deliveryindent = $this->input->post('tanggal_tersedia');
        $str_estimated_deliveryindent = strtotime($estimated_deliveryindent);
        $this->db->trans_start();
        $data = [
            'estimated_deliveryindent' => $str_estimated_deliveryindent,
        ];
        $this->M_backendmekanik->update('product', $data, 'id', $id);
        $this->db->trans_complete();
        $this->session->set_flashdata('message', 'Tanggal Ketersediaan Berhasil diubah');
        redirect(base_url() . "backendmekanik");
        exit();
    }
}
