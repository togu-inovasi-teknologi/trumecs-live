<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attribute_model extends CI_Model
{

    private $table = 'attribute';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getattribute()
    {
        return $this->db->get('attribute')->result();
    }

    // Get all grades for DataTables
    public function get_datatables($start, $length, $search, $order)
    {
        $this->_get_datatables_query($search, $order);

        if ($length != -1) {
            $this->db->limit($length, $start);
        }

        return $this->db->get()->result();
    }

    // Count filtered records
    public function count_filtered($search)
    {
        $this->_get_datatables_query($search, null);
        return $this->db->get()->num_rows();
    }

    // Count total records
    public function count_all()
    {
        return $this->db->get($this->table)->num_rows();
    }

    // Build query for DataTables
    private function _get_datatables_query($search, $order)
    {
        $this->db->from($this->table);

        $i = 0;
        // Search functionality
        if ($search) {
            foreach (['name'] as $item) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $search);
                } else {
                    $this->db->or_like($item, $search);
                }
                if (count(['name']) - 1 == $i) {
                    $this->db->group_end();
                }
                $i++;
            }
        }

        // Order functionality
        if ($order) {
            $this->db->order_by($this->get_order_column($order['column']), $order['dir']);
        } else {
            $this->db->order_by('id', 'DESC');
        }
    }

    // Map column index to actual column name
    private function get_order_column($column_index)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'created_at',
            3 => 'created_by',
            4 => 'name_en',
            5 => 'name_ch'
        ];
        return $columns[$column_index] ?? 'id';
    }

    // Get attribute by ID
    public function get_attribute_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Update attribute
    public function update_attribute($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete attribute
    public function delete_attribute($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Add new attribute
    public function insert_attribute($data)
    {
        return $this->db->insert($this->table, $data);
    }
}
