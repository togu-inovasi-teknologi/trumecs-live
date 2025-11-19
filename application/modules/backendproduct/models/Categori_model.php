<?php
defined('BASEPATH') or exit('No direct script access allowed');

class categori_model extends CI_Model
{
    private $table = 'categori';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Get all main categories (parent = 0, is_brand = 0)
    public function get_main_categories()
    {
        return $this->db->where(['parent' => 0, 'is_brand' => 0, 'etc' => 0])
            ->get($this->table)
            ->result();
    }

    public function get_main_categories_expert()
    {
        return $this->db->where(['parent' => 0, 'is_brand' => 0, 'etc' => 1])
            ->get($this->table)
            ->result();
    }

    public function get_main_categories_rent()
    {
        return $this->db->where(['parent' => 0, 'is_brand' => 0, 'etc' => 2])
            ->get($this->table)
            ->result();
    }

    // Get sub categories by parent ID
    public function get_sub_categories($parent_id)
    {
        return $this->db->where(['parent' => $parent_id, 'is_brand' => 0])
            ->get($this->table)
            ->result();
    }

    // Get subsub categories by parent ID (sub category)
    public function get_subsub_categories($parent_id)
    {
        return $this->db->where(['parent' => $parent_id, 'is_brand' => 0])
            ->get($this->table)
            ->result();
    }

    // Get all brands (parent = 0, is_brand = 1)
    public function get_brands()
    {
        return $this->db->where(['parent' => 0, 'is_brand' => 1])
            ->get($this->table)
            ->result();
    }

    // Get models by brand ID (semua model dari sebuah brand)
    public function get_models_by_brand($brand_id)
    {
        return $this->db->where(['parent_brand' => $brand_id, 'is_brand' => 0])
            ->get($this->table)
            ->result();
    }

    // Get categories path untuk sebuah model
    public function get_model_categories_path($model_id)
    {
        $model = $this->get_categori_by_id($model_id);
        if (!$model || $model->parent_brand == 0) {
            return [];
        }

        $categories_path = [];

        // Get semua records dengan nama yang sama dan brand yang sama (multiple categories)
        $all_model_instances = $this->db->where([
            'name' => $model->name,
            'parent_brand' => $model->parent_brand,
            'is_brand' => 0
        ])->get($this->table)->result();

        foreach ($all_model_instances as $instance) {
            $path = $this->get_category_path($instance->parent);
            if ($path) {
                $categories_path[] = $path;
            }
        }

        return $categories_path;
    }

    // Get category path lengkap (main -> sub -> subsub)
    private function get_category_path($subsub_category_id)
    {
        $subsub = $this->get_categori_by_id($subsub_category_id);
        if (!$subsub) return null;

        $sub = $this->get_categori_by_id($subsub->parent);
        if (!$sub) return null;

        $main = $this->get_categori_by_id($sub->parent);
        if (!$main) return null;

        return [
            'main_category' => [
                'id' => $main->id,
                'name' => $main->name
            ],
            'sub_category' => [
                'id' => $sub->id,
                'name' => $sub->name
            ],
            'subsub_category' => [
                'id' => $subsub->id,
                'name' => $subsub->name
            ]
        ];
    }

    // Get brand dengan semua models dan categories mereka
    public function get_brand_with_models_and_categories($brand_id)
    {
        $brand = $this->get_categori_by_id($brand_id);
        if (!$brand || $brand->is_brand != 1) {
            return null;
        }

        $brand_data = [
            'id' => $brand->id,
            'name' => $brand->name,
            'models' => []
        ];

        // Get semua unique models untuk brand ini (group by name)
        $this->db->select('name, GROUP_CONCAT(id) as model_ids, GROUP_CONCAT(parent) as category_ids')
            ->where(['parent_brand' => $brand_id, 'is_brand' => 0])
            ->group_by('name');

        $models = $this->db->get($this->table)->result();

        foreach ($models as $model) {
            $model_ids = explode(',', $model->model_ids);
            $category_ids = explode(',', $model->category_ids);

            $categories = [];
            foreach ($category_ids as $index => $category_id) {
                $path = $this->get_category_path($category_id);
                if ($path) {
                    $categories[] = $path;
                }
            }

            $brand_data['models'][] = [
                'name' => $model->name,
                'model_ids' => $model_ids,
                'categories' => $categories
            ];
        }

        return $brand_data;
    }

    // Get model by name dan brand (semua instances-nya)
    public function get_model_instances($model_name, $brand_id)
    {
        return $this->db->where([
            'name' => $model_name,
            'parent_brand' => $brand_id,
            'is_brand' => 0
        ])
            ->get($this->table)
            ->result();
    }

    // Create model di multiple categories
    public function create_model_in_categories($model_name, $brand_id, $subsub_category_ids)
    {
        $results = [];

        foreach ($subsub_category_ids as $category_id) {
            $model_data = [
                'name' => $model_name,
                'parent' => $category_id,
                'parent_brand' => $brand_id,
                'is_brand' => 0,
                'is_tag' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $results[] = $this->db->insert($this->table, $model_data);
        }

        return $results;
    }

    // Get complete hierarchical tree
    public function get_complete_tree()
    {
        $result = [];

        // Get main categories
        $main_categories = $this->get_main_categories();

        foreach ($main_categories as $main_cat) {
            $main_category = [
                'id' => $main_cat->id,
                'name' => $main_cat->name,
                'sub_categories' => []
            ];

            // Get sub categories
            $sub_categories = $this->get_sub_categories($main_cat->id);

            foreach ($sub_categories as $sub_cat) {
                $sub_category = [
                    'id' => $sub_cat->id,
                    'name' => $sub_cat->name,
                    'subsub_categories' => []
                ];

                // Get subsub categories
                $subsub_categories = $this->get_subsub_categories($sub_cat->id);

                foreach ($subsub_categories as $subsub_cat) {
                    $subsub_category = [
                        'id' => $subsub_cat->id,
                        'name' => $subsub_cat->name,
                        'brands_with_models' => []
                    ];

                    // Get all brands
                    $brands = $this->get_brands();

                    foreach ($brands as $brand) {
                        // Get models untuk brand ini di subsub category ini
                        $models = $this->db->where([
                            'parent_brand' => $brand->id,
                            'parent' => $subsub_cat->id,
                            'is_brand' => 0
                        ])->get($this->table)->result();

                        if (!empty($models)) {
                            $subsub_category['brands_with_models'][] = [
                                'brand_id' => $brand->id,
                                'brand_name' => $brand->name,
                                'models' => $models
                            ];
                        }
                    }

                    $sub_category['subsub_categories'][] = $subsub_category;
                }

                $main_category['sub_categories'][] = $sub_category;
            }

            $result['categories'][] = $main_category;
        }

        // Get all brands separately
        $result['all_brands'] = $this->get_brands();

        return $result;
    }

    public function get_datatables_by_type($start, $length, $search, $order, $type = null)
    {
        $this->_get_datatables_query_by_type($search, $order, $type);

        if ($length != -1) {
            $this->db->limit($length, $start);
        }

        return $this->db->get()->result();
    }

    // Count filtered dengan type
    public function count_filtered_by_type($search, $type = null)
    {
        $this->_get_datatables_query_by_type($search, null, $type);
        return $this->db->get()->num_rows();
    }

    // Build query dengan filter type
    private function _get_datatables_query_by_type($search, $order, $type = null)
    {
        $this->db->from($this->table);

        // Filter berdasarkan type
        if ($type) {
            switch ($type) {
                case 'main_category':
                    $this->db->where(['is_brand' => 0, 'parent_brand' => 0, 'etc' => 0]);
                    break;
                case 'main_category_expert':
                    $this->db->where(['is_brand' => 0, 'parent_brand' => 0, 'etc' => 1]);
                    break;
                case 'main_category_rent':
                    $this->db->where(['is_brand' => 0, 'parent_brand' => 0, 'etc' => 2]);
                    break;
                case 'sub_category':
                    $this->db->where('parent !=', 0);
                    $this->db->where('is_brand', 0);
                    $this->db->where('parent_brand', 0);
                    break;
                case 'subsub_category':
                    $this->db->where('parent !=', 0);
                    $this->db->where('is_brand', 0);
                    $this->db->where('parent_brand', 0);
                    // Subsub category punya parent yang merupakan sub category
                    break;
                case 'brand':
                    $this->db->where(['parent' => 0, 'is_brand' => 1]);
                    break;
                case 'model':
                    $this->db->where('parent_brand !=', 0);
                    $this->db->where('is_brand', 0);
                    break;
            }
        }

        $i = 0;
        if ($search) {
            foreach (['name', 'is_brand'] as $item) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $search);
                } else {
                    $this->db->or_like($item, $search);
                }
                if (count(['name', 'is_brand']) - 1 == $i) {
                    $this->db->group_end();
                }
                $i++;
            }
        }

        if ($order) {
            $this->db->order_by($this->get_order_column($order['column']), $order['dir']);
        } else {
            $this->db->order_by('id', 'DESC');
        }
    }

    // Get category type info
    public function get_category_type_info($category_id)
    {
        $category = $this->get_categori_by_id($category_id);
        if (!$category) return null;

        if ($category->is_brand == 1) {
            return 'brand';
        } elseif ($category->parent_brand != 0) {
            return 'model';
        } elseif ($category->parent == 0) {
            return 'main_category';
        } else {
            // Cek level untuk bedakan sub vs subsub
            $parent = $this->get_categori_by_id($category->parent);
            if ($parent && $parent->parent == 0) {
                return 'sub_category';
            } else {
                return 'subsub_category';
            }
        }
    }

    // Get parent name untuk display
    public function get_parent_info($category_id)
    {
        $category = $this->get_categori_by_id($category_id);
        if (!$category) return '';

        $type = $this->get_category_type_info($category_id);

        switch ($type) {
            case 'main_category':
                return $category->name; // 1 baris: nama kategori

            case 'sub_category':
                $parent = $this->get_categori_by_id($category->parent);
                if ($parent) {
                    return '<div class="fbold">' . $category->name . '</div>' .
                        '<div class="text-muted fs-6">' . $parent->name . '</div>';
                }
                return $category->name;

            case 'subsub_category':
                $parent_sub = $this->get_categori_by_id($category->parent);
                if ($parent_sub) {
                    $parent_main = $this->get_categori_by_id($parent_sub->parent);
                    if ($parent_main) {
                        return '<div class="fbold">' . $category->name . '</div>' .
                            '<div class="text-muted fs-6">' . $parent_main->name . ' - ' . $parent_sub->name . '</div>';
                    }
                    return '<div class="fbold">' . $category->name . '</div>' .
                        '<div class="text-muted fs-6">' . $parent_sub->name . '</div>';
                }
                return $category->name;

            case 'brand':
                return $category->name; // 1 baris: nama brand

            case 'model':
                $brand = $this->get_categori_by_id($category->parent_brand);
                $subsub_category = $this->get_categori_by_id($category->parent);
                if ($brand && $subsub_category) {
                    $parent_sub = $this->get_categori_by_id($subsub_category->parent);
                    $parent_main = $this->get_categori_by_id($parent_sub->parent);

                    return '<div class="fbold">' . $category->name . '</div>' .
                        '<div class="text-muted fs-6">'  . $parent_main->name . ' - ' . $parent_sub->name . ' - ' . $subsub_category->name . ' - ' .  $brand->name . '</div>';
                }
                return $category->name;

            default:
                return $category->name;
        }
    }

    // Existing methods...
    public function get_datatables($start, $length, $search, $order)
    {
        $this->_get_datatables_query($search, $order);
        if ($length != -1) {
            $this->db->limit($length, $start);
        }
        return $this->db->get()->result();
    }

    public function count_filtered($search)
    {
        $this->_get_datatables_query($search, null);
        return $this->db->get()->num_rows();
    }

    public function count_all()
    {
        return $this->db->get($this->table)->num_rows();
    }

    private function _get_datatables_query($search, $order)
    {
        $this->db->from($this->table);
        $i = 0;
        if ($search) {
            foreach (['name', 'is_brand'] as $item) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $search);
                } else {
                    $this->db->or_like($item, $search);
                }
                if (count(['name', 'is_brand']) - 1 == $i) {
                    $this->db->group_end();
                }
                $i++;
            }
        }
        if ($order) {
            $this->db->order_by($this->get_order_column($order['column']), $order['dir']);
        } else {
            $this->db->order_by('id', 'DESC');
        }
    }

    private function get_order_column($column_index)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'url',
            3 => 'parent',
            4 => 'parent_brand',
            5 => 'etc',
            6 => 'image',
            7 => 'name_en',
            8 => 'name_ch',
            9 => 'url_en',
            10 => 'url_ch',
            11 => 'is_brand',
            12 => 'is_tag',
        ];
        return $columns[$column_index] ?? 'id';
    }

    public function get_categori_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function update_categori($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function get_image_path($category_id)
    {
        $category = $this->get_categori_by_id($category_id);
        return $category ? $category->img : null;
    }

    // Delete category dengan handle image
    public function delete_categori($category_id)
    {
        // Get image name sebelum delete
        $image_name = $this->get_image_path($category_id);

        // Delete dari database
        $this->db->where('id', $category_id);
        $result = $this->db->delete($this->table);

        // Jika delete berhasil dan ada image, hapus file
        if ($result && $image_name) {
            $image_path = FCPATH . 'public/upload/categori/' . $image_name;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        return $result;
    }

    public function insert_categori($data)
    {
        return $this->db->insert($this->table, $data);
    }
}
