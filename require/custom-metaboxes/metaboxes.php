<?php
// Define custom metaboxes directory path in the wp theme
define('CMB_DIR', str_replace( get_template_directory(), '', __DIR__) );

// define all field props with defalt values
const CMB_FIELD_PROPS = [
    'title'         => '', 
    'description'   => '',
    'name'          => 'name', 
    'type'          => 'text',
    'value'         => '',
    'label'         => '',
    'placeholder'   => '',
    'checked'       => '',
    'rows'          => 3,
    'options'       => [],
    'post_type'     => '',
    'in_col'        => false,
    'sub_fields'    => [],
    'term_in_edit'  => false,
    'related_field_name' => '',
    'errors'        => '',
];

// Parse an ini file with metaboxes data
$data = parse_ini_file_multi(__DIR__ .'/metaboxes.ini', true);

// Write metaboxes data in $metaboxes global var
$metaboxes = [];
foreach($data as $title => $item){
    // Add a title prop for each metabox
    // In the ini file the title is a [section_name]
    // Use the section name as a metabox name in $metaboxes
    $item['id'] = 'metabox-' . sanitize_title($title);
    $item['title'] = $title;
    $item['post_type'] = $item['post_type'] ?? ['post', 'page'];
    $item['fields'] = $item['fields'] ?? [];
    
    if( ! empty( $item['fields'] ) ){
        foreach( $item['fields'] as $fi => $field ){

            $field_type = $field['type'];
            $ini_file = '<small>(' . CMB_DIR . '/metaboxes.ini</small>)';
            
            if( ! isset( $field['name'] ) ){
                $item['fields'][$fi]['errors'] = "<li>${field_type} field name is empty! ${ini_file}</li>";
            }
            
            if(
                ( 
                    $field_type=='radio'
                    || $field_type=='checkbox'
                    || $field_type=='order'
                    || $field_type=='select' 
                )
                &&
                ( 
                    ! isset( $field['options'] )
                    && ! isset( $field['post_type'] )
                )
            ){
                $item['fields'][$fi]['errors'] .= "<li>${field_type} options are empty! Add options or post_type. ${ini_file}</li>";
            }
        }
    }
    // $item['taxonomy'] = $item['taxonomy'] ?? [];
    $metaboxes[] = $item;
}

// $taxonomies = [];
//     foreach( $metaboxes as $metabox ){
//         if( isset( $metabox['taxonomy'] ) ){
//             foreach( $metabox['taxonomy'] as $taxonomy ){
//                 $taxonomies[] = $taxonomy;
//             }
//         }
//     }
//     return array_unique($taxonomies);

// every file below depends on $metaboxes
require_once 'require/init.php';
require_once 'require/save.php';
require_once 'require/functions.php';
require_once 'require/classes.php';
require_once 'require/rest.php';
require_once 'require/scripts.php';

// It needs to read metaboxes.ini file
function parse_ini_file_multi($file, $process_sections = false, $scanner_mode = INI_SCANNER_NORMAL) {
    $explode_str = '.';
    $escape_char = "'";
    // load ini file the normal way
    $data = parse_ini_file($file, $process_sections, $scanner_mode);
    if (!$process_sections) {
        $data = array($data);
    }
    foreach ($data as $section_key => $section) {
        // loop inside the section
        foreach ($section as $key => $value) {
            if (strpos($key, $explode_str)) {
                if (substr($key, 0, 1) !== $escape_char) {
                    // key has a dot. Explode on it, then parse each subkeys
                    // and set value at the right place thanks to references
                    $sub_keys = explode($explode_str, $key);
                    $subs =& $data[$section_key];
                    foreach ($sub_keys as $sub_key) {
                        if (!isset($subs[$sub_key])) {
                            $subs[$sub_key] = [];
                        }
                        $subs =& $subs[$sub_key];
                    }
                    // set the value at the right place
                    $subs = $value;
                    // unset the dotted key, we don't need it anymore
                    unset($data[$section_key][$key]);
                }
                // we have escaped the key, so we keep dots as they are
                else {
                    $new_key = trim($key, $escape_char);
                    $data[$section_key][$new_key] = $value;
                    unset($data[$section_key][$key]);
                }
            }
        }
    }
    if (!$process_sections) {
        $data = $data[0];
    }
    return $data;
}

?>