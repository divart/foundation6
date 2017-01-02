<?php
class DynamicAdmin{
    public $list_field = array();

    public $acf_list_field = array();

    private $filter_fn = array();

    // Add custom field
    public function addField($post_type, $field_key, $filed_name, $callback,  $after = 'title'){
        $this->list_field[] = array(
            'post_type' => $post_type,
            'key' => $field_key,
            'field' => $filed_name,
            'after' => $after,
            'callback' => $callback
        );
    }

    // Add basic ACF field
    public function addACFField($post_type, $field_key, $field_name, $after = 'title'){
        $this->acf_list_field[] = array(
            'post_type' => $post_type,
            'key' => $field_key,
            'field' => $field_name,
            'after' => $after
        );
    }

    // Add custom tax
    public function addFiledTax($post_type, $field_key, $filed_name, $tax_name,  $after = 'title'){
        $this->list_field[] = array(
            'post_type' => $post_type,
            'key' => $field_key,
            'field' => $filed_name,
            'after' => $after,
            'callback' => function($column_name, $post_id) use ($tax_name, $field_key){
                if( $column_name == $field_key ){
                    $terms = get_the_terms($post_id, $tax_name);
                    foreach($terms as $term){
                        echo $term->name;
                        if(end($terms) != $term){
                            echo ', ';
                        }
                    }
                }
            }
        );
    }


    public function addFilter($post_type, $meta_key, $label, $value_list){
        $args_arr = compact($post_type, $meta_key, $label, $value_list);
        $this->filter_fn[] = $args_arr;
    }

    public function run(){
        if($this->list_field){
            foreach($this->list_field as $field){
                /* Add new column */
                $manage_edit_callback = function($columns) use($field){
                    $res = array();
                    foreach($columns as $key=>$col){
                        $res[$key] = $col;
                        if($key == $field['after']){
                            $res[$field['key']] = $field['field'];
                        }
                    }
                    return $res;
                };
                add_filter('manage_edit-'.$field['post_type'].'_columns', $manage_edit_callback, 30);

                /* Fill new column */
                add_filter('manage_'.$field['post_type'].'_posts_custom_column', $field['callback'], 5, 2);
            }
        }
        if($this->filter_fn){
            foreach ($this->filter_fn as $filter){
                $create_filter_callback = function() use ($filter){
                    $type = $filter['post_type'];
                    if (isset($_GET['post_type'])) {
                        $type = $_GET['post_type'];
                    }
                    if($type == $filter['post_type']){
                        echo "<select name='{$filter['meta_key']}' id='{$filter['meta_key']}'>";
                        foreach ($filter['list'] as $key => $item){
                            $current = isset($_GET[$filter['meta_key']])?' selected="selected"':'';
                            echo "<option value='{$key}' {$current}>{$item}</option>";
                        }
                        echo "</select>";
                    }
                };
                add_action( 'restrict_manage_posts', $create_filter_callback );

                $parse_query_callback = function($query) use($filter){
                    global $pagenow;
                    if (isset($_GET['post_type'])) {
                        $type = $_GET['post_type'];
                        if ( $filter['post_type'] == $type && is_admin() && $pagenow=='edit.php' && isset($_GET[$filter['meta_key']]) && $_GET[$filter['meta_key']] != '') {
                            $query->query_vars['meta_key'] = $filter['meta_key'];
                            $query->query_vars['meta_value'] = $_GET[$filter['meta_key']];
                        }
                    }
                };

                add_filter( 'parse_query', $parse_query_callback );
            }
        }

        if($this->acf_list_field){
            foreach ($this->acf_list_field as $field){
                /* Add new column */
                $manage_edit_callback = function($columns) use($field){
                    $res = array();
                    foreach($columns as $key=>$col){
                        $res[$key] = $col;
                        if($key == $field['after']){
                            $res[$field['key']] = $field['field'];
                        }
                    }
                    return $res;
                };
                add_filter('manage_edit-'.$field['post_type'].'_columns', $manage_edit_callback, 30);

                $acf_render_callback = function( $column_name, $post_id) use ($field){
                    if($column_name == $field['key'] && is_callable('get_field')){
                        echo get_field($field['key'], $post_id);
                    }
                };
                add_filter('manage_'.$field['post_type'].'_posts_custom_column', $acf_render_callback, 5, 2);
                //add_filter('manage_edit-'.$field['post_type'].'_columns', $acf_render_callback, 30);
            }
        }
    }
}