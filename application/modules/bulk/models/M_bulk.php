<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_bulk extends MX_Controller
{
    var $table = "villages";  
    var $select_column = array('v.id', 'v.name as village', 'd.name as district', 'r.name as regencies', 'p.name as province');  
    var $columns = array('v.id', 'v.name', 'd.name', 'r.name', 'p.name');  
    var $order_column = array('v.id', 'v.name as village', 'd.name as district', 'r.name as regencies', 'p.name as province');  
    
    
    function __construct()
    {
        parent::__construct();
    }

    private function _query()
    {

        $this->db->select($this->select_column);
        $this->db->from($this->table . ' v');
        $this->db->join('districts d', 'v.district_id = d.id');
        $this->db->join('regencies r', 'r.id = d.regency_id');
        $this->db->join('provinces p', 'p.id = r.province_id');
        $this->db->group_by('v.id');
        if(!empty($_POST["search"]["value"]))  
        {  
            foreach ($this->columns as $key => $value) {
                if($key == 0){
                     $this->db->like($value, $_POST["search"]["value"]);  
                 }else{
                    $this->db->or_like($value, $_POST["search"]["value"]);  
                }
            }
            
        }  
        
        if(isset($_POST["order"])){  
            $this->db->order_by($this->columns[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        }else {  
            $this->db->order_by('id', 'DESC');  
        }  
    }

    public function getAddressDetailFromVillage($village_id)
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table . ' v');
        $this->db->join('districts d', 'v.district_id = d.id');
        $this->db->join('regencies r', 'r.id = d.regency_id');
        $this->db->join('provinces p', 'p.id = r.province_id');
        $this->db->where('v.id', $village_id);
        return $this->db->get()->row_array();
    }


    public function make_datatables()
    {
        $this->_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_filtered_data()
    {
        $this->_query();
        return $this->db->get()->num_rows();
    }

    public function get_all_data()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        if (!empty($this->where)) {
            $this->db->where($this->where);
        }
        return $this->db->count_all_results();
    }

    public function save($data)
    {
        $this->db->insert('sourcing', $data);
        $month = date('Ymd');
        $id = $this->db->insert_id();
        $format = "RFQ/" . $month . "/" . $id;
        $nama = array(
            'nama_rfq' => $format
        );
        $this->db->update('sourcing', $nama, ["id" => $id]);
        return $id;
    }
    public function update($data, $id)
    {
        $this->db->update('sourcing', $data, ["id" => $id]);
        return true;
    }

    public function updateListItem($data, $id)
    {
        $this->db->update('sourcing_item', $data, ["id" => $id]);
        return true;
    }
    public function updateListItemLog($data, $id)
    {
        $this->db->update('sourcing_item_log', $data, ["sourcing_item_id" => $id]);
        return true;
    }
    public function saveCommentLog($data)
    {
        $update = $this->db->insert('sourcing_comment_log', $data);
        return $update;
    }

    public function record_count($id)
    {
        $query = $this->db
            ->from("sourcing")
            ->where('member_id', $id);
        return $query->get()->num_rows();
    }

    public function save_file($data, $sourcing_id)
    {
        $oldPath = 'public/tmp/';
        $path = 'public/sourcing/';
        foreach ($data as $item) {
            $fileInfo = pathinfo($item);
            $extension = $fileInfo['extension'];
            switch ($extension) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                    $targetPath = $path . 'foto/';
                    break;
                default:
                    $targetPath = $path;
            }
            if (copy($oldPath . $item, $targetPath . $item)) {
                if (unlink($oldPath . $item)) {
                    $file = array(
                        'sourcing_id' => $sourcing_id,
                        'filename' => $item,
                    );
                    $this->db->insert('sourcing_files', $file);
                }
            }
        }
        return true;
    }

    public function save_items($data)
    {
        $this->db->insert_batch('sourcing_item', $data);
    }
}