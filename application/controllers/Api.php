<?php
header('Content-Type: application/json');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller
{

    protected $tbl_customer;
    protected $tbl_category;
    protected $tbl_location_category;
    protected $tbl_location;
    protected $tbl_activity;
    protected $tbl_user_activity;
    function __construct()
    {
        parent::__construct();
        $this->output->set_header('Content-Type: application/json');
        $this->load->database();
        $this->tbl_customer = "tbl_customer";
    		$this->tbl_notification = "tbl_notification";
    }
    public function register_gcm_id()
    {
        $gcm_id = $this->input->post('gcm_id');
        $result = $this->db->get_where('tbl_gcm',array('gcm_id'=>$gcm_id))->result_array();
        $return_ary = array();
        if(!$result)
        {
            $data = array();
            $data['gcm_id'] = $gcm_id;
            $this->db->insert('tbl_gcm',$data);
        }
        $return_ary['response'] = 'success';
        echo json_encode($return_ary);
    }
    public function register_token()
    {
      $token = $this->input->post('token');
      $result = $this->db->get_where('tbl_token',array('token'=>$token))->result_array();
      $return_ary = array();
      if(!$result)
      {
          $data = array();
          $data['token'] = $token;
          $this->db->insert('tbl_token',$data);
      }
      $return_ary['response'] = 'success';
      echo json_encode($return_ary);
    }


    public function user_login()
    {
            $device_id = $this->input->post('device_id');
            $gcm_id = $this->input->post('gcm_id');
      			//facebook
      			$sql = "SELECT * FROM {$this->tbl_customer} WHERE device_id = '$device_id'";
      			$result = get_sql_value($sql);
      			if($result)
      			{
      				$userid = $result['id'];
              if( $gcm_id != null && $gcm_id != $result['gcm_id'])
      				{
      					$sql = "UPDATE {$this->tbl_customer} set token = '$gcm_id' where id = {$userid}";
      					get_sql_value($sql);
      				  $result['gcm_id'] = $gcm_id;
      				}
              $return_ary['response'] = 'success';
              $return_ary['msg'] = 'Login Success';
              $return_ary['user_id']= $result['id'];
              $return_ary['device_id'] = $result['device_id'];
              $return_ary['gcm_id'] = $result['gcm_id'];
            }else
      			{
      					$data = array();
                $data["device_id"] = $device_id;
                $data["gcm_id"] = $gcm_id;
      					$this->db->insert($this->tbl_customer, $data);
      					$user_id = $this->db->insert_id();
      					$return_ary['response'] = 'success';
      			}
      		echo json_encode($return_ary);
    }

    public function getNotifications()
    {
        $user_id = $this->input->post('user_id');
        $result = $this->db->get_where('tbl_notification')->result_array();
        $return_ary = array();
        $return_ary['response'] = "success";
        $return_ary['data'] = $result;
        echo json_encode($return_ary);
    }

    public function getUnReadNotifications()
    {
        $user_id = $this->input->post('user_id');
        $result = $this->db->get_where('tbl_notification_user',array('customer_id'=>$user_id))->result_array();
        $return_ary['response'] = "success";
        $return_ary['data'] = $result;
        echo json_encode($return_ary);
    }

    public function readNotification()
    {
        $user_id = $this->input->post('user_id');
        $notification_id = $this->input->post('notification_id');
        $result = $this->db->get_where('tbl_notification_user',array('customer_id'=>$user_id, 'notification_id' => $notification_id))->result_array();
        $return_ary['response'] = "success";
        if(!$result)
        {
            $data= array();
            $data['customer_id'] = $user_id;
            $data['notification_id'] = $notification_id;
            $this->db->insert('tbl_notification_user',$data);
        }
            echo json_encode($return_ary);
    }
}
