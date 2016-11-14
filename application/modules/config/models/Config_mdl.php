<?php
/**
 * Description of Config_mdl
 *
 * @author felipe de jesus
 */
class Config_mdl extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function _insert($table,$data) {
        return $this->db->insert($table,$data);
    }
    public function _get_data($table) {
        return $this->db->get($table)->result_array();
    }
    public function _get_data_condition($table,$condicion) {
        return $this->db->get_where($table,$condicion)->result_array();
    }
    public function _update_data($table,$data,$condicion) {
        return $this->db->update($table,$data,$condicion);
    }
    public function _get_data_order($table,$condition,$attr,$order) {
        return $this->db->where($condition)->order_by($attr,$order)->get($table)->result_array();
    }
    public function _delete_data($table,$condicion) {
        return $this->db->delete($table,$condicion);
    } 
    public function _query($query) {
        return $this->db->query($query)->result_array();
    }
    public function _get_last_id($table,$id) {
        $sql= $this->db->select_max($id,'last_id')->get($table)->result_array();
        return $sql[0]['last_id'];
    }
}
