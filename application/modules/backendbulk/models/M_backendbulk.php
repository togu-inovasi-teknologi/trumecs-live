<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_Backendbulk extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->select('*, sourcing.id AS id, sourcing.status as status, sourcing.name as name_member');
        $this->db->join('member', 'sourcing.member_id = member.id', 'left');
        $this->db->order_by('sourcing.updated_at', 'desc');
        $this->db->order_by('sourcing.id', 'desc');
        return $this->db->get('sourcing');
    }

    public function get_detail($id_prospek, $id_sales = null)
    {
        $detail = $this->db->select('s.*, sc.id as comment_log_id, s.id as id, s.created_at as created_at, s.name as name, sc.admin_note as note_admin')->from('sourcing s')->where('s.id', $id_prospek)
            ->join('sourcing_comment_log sc', "s.id = sc.sourcing_id", 'left')
            ->order_by("sc.id", "desc")
            ->get();
        return $detail->row();
    }

    public function get_file($id_prospek)
    {
        $this->db->where('sourcing_id', $id_prospek)
            ->order_by('id', 'desc');
        return $this->db->get('sourcing_files');
    }
    
    public function get_item($id_prospek)
    {
        $item = $this->db->where('sourcing_id', $id_prospek)
            ->order_by('id', 'asc')
            ->get("sourcing_item");
        return $item->result_array();
    }
    
    public function get_all_item()
    {
        $item = $this->db->order_by('s.id', 'desc')
            ->select('*, s.id as id, si.uom as uom, si.qty as qty, COUNT(DISTINCT(sis.id)) as status')
            ->where('s.type','buyer')
            ->join('sourcing s','si.sourcing_id = s.id')
            ->join('sourcing_item_source sis','sis.sourcing_item = si.id','left')
            ->group_by('si.id')
            ->get("sourcing_item si");
        return $item;
    }
    
    public function get_item_source($id_prospek)
    {
        $this->db->select('id');
        $items = $this->get_item($id_prospek);
        
        if(count($items) == 0){
            return null;
        }
        
        $item = array();
        foreach($items as $index){
            $item[] = $index['id'];
        }
        //var_dump($item);
        
        $sourcing = $this->db->select('*, sis.price AS price, sis.qty AS qty')
                ->where_in('sis.sourcing_item',$item)
                ->join('sourcing_item si','si.id = sis.sourcing_item_supplier')
                ->join('sourcing s', 's.id = si.sourcing_id')
                ->get('sourcing_item_source sis');
        return $sourcing->result_array();
                 
    }

    public function getCommentLog($id)
    {
        $log = $this->db->where('sourcing_id', $id)
            ->order_by('id', 'asc')
            ->get('sourcing_comment_log');
        return $log->result_array();
    }

    public function get_provinsi()
    {
        return $this->db->get('provinces');
    }

    public function get_regency($id_province)
    {
        return $this->db->where('province_id', $id_province)->get('regencies');
    }

    public function get_district($id_regency)
    {
        return $this->db->where('regency_id', $id_regency)->get('districts');
    }

    public function get_village($id_district)
    {
        return $this->db->where('district_id', $id_district)->get('villages');
    }

    public function view_prospek($id_prospek)
    {
        $admin = $this->session->userdata('admin');

        $cek = $this->db->where('id', $id_prospek)->where('viewed', '0')->get('sourcing');

        if ($cek->num_rows() > 0) {
            return $this->db->where('id', $id_prospek)->set('viewed', '1')->update('sourcing');
        }
    }

    // public function get_new($last_id)
    // {
    //     $this->db->where('viewed', '0');
    //     $this->db->where('sourcing.id >', $last_id);
    //     return $this->get_all();
    // }

    public function search($query)
    {
        $this->db->like('tittle', $query);
        return $this->db->get('product');
    }


    public function saveItem($item)
    {
        $source = $this->db->insert('sourcing_item', $item);
        return $source;
    }
    public function updateItem($item, $where)
    {
        $source = $this->db->update('sourcing_item', $item, ['id' => $where]);
        return $source;
    }

    public function saveItemLog($item)
    {
        $source = $this->db->insert('sourcing_item_log', $item);
        return $source;
    }

    public function updateSourcing($id, $include)
    {
        $this->db->where('id', $id);
        $this->db->update('sourcing', $include);
    }

    public function saveCommentLog($data, $comment_id)
    {
        $update = $this->db->update('sourcing_comment_log', $data, ['id' => $comment_id]);
        return $update;
    }
    public function insertCommentLog($data)
    {
        $update = $this->db->insert('sourcing_comment_log', $data);
        return $update;
    }
    public function saveOrder($sourcing)
    {
        $source = $this->db->insert('order', $sourcing);
        return $source;
    }
    public function saveOrderItem($item)
    {
        $source = $this->db->insert('order_detail', $item);
        return $source;
    }
    
    public function save_item_supplier($sourcingItems) {
        $source_item_supplier = $this->input->post('source_id[]');
        $qty_supplier1 = $this->input->post('qty_supplier[]');
        $price_supplier1 = $this->input->post('price_supplier[]');
        $source_product_id = $this->input->post('source_item_id[]');
        $qty_supplier = str_replace('.', '', $qty_supplier1);
        $price_supplier = str_replace('.', '', $price_supplier1);
        
        if(!empty($source_product_id)){
        $sourcing_item_source = [];
        
        foreach ($source_product_id as $key => $value) {
            
            //$search = $this->array_multidimensional_search($value, $source_product_id);
            
            //if(!empty($search)){
                //foreach ($search as $valueKey) {
                    $data = [
                        'sourcing_item_supplier' => $source_item_supplier[$key],
                        'sourcing_item' => $value,
                        'qty' => $qty_supplier[$key],
                        'price' => $price_supplier[$key],
                    ];
                    array_push($sourcing_item_source, $data);
                //}
               
            //}
            $this->db->where('sourcing_item',$value);
            $this->db->delete('sourcing_item_source');
            
        }

        $this->db->insert_batch('sourcing_item_source',$sourcing_item_source);

        }
    }
    
    public function array_multidimensional_search($value, $array)
    {
        $return = [];
        foreach ($array as $key => $data) {
            if($value == $data){
                array_push($return, $key);
            }
        }

        return $return;
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
}