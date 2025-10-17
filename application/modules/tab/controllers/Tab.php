<?php 

class Tab extends MX_Controller
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model("general/general_model");
    }


    public function index()
    {
        $data["getcategory"] = $this->general_model->getcategori("0");

        if (!$this->agent->is_mobile()) {
            $data['content'] = 'desktop/tabs';
            
        } else {
            $data['content'] = 'mobile/tabs';
            
        }
        $this->load->view($data['content'], $data);

    }

    public function search()
    {
        $component = $this->db->get_where('categori', ['id' => $this->input->post('komponen')])->row();

       

        $merk = $this->db->select('*')
                     ->from('category_brand cb')
                     ->join('categori c', 'c.id = cb.category_id')
                     ->join('categori b', 'b.id = cb.brand_id')
                     ->where('cb.brand_id', $this->input->post('merk'))
                     ->get()->row();

        $keyword = $this->input->post('keyword');
        
        if($component == null){
            redirect(base_url('c/all/query?q=on&nama=' . $keyword));
        }else{
            if($merk == null){
                redirect(base_url('c/'. $component->name .'/query?q=on&nama=' . $keyword));
            }else{
                redirect(base_url('c/'. $component->name .'/'. $merk->name .'/query?q=on&nama=' . $keyword));
            }
        }

        // die;
    }

}

?>