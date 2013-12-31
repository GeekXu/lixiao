<?php 
class login extends CI_Controller {  
    public function index(){
    	//session_start();
		$this->load->helper('url');
		//if(isset($_SESSION['id'])){
        if($this->session->userdata('name')!=FALSE){
			//$this->load->view('index');
			//echo "<script>window.location.href='index.php/teacher';</script>";
			redirect("teacher");
		}
		else{
        	$this->load->view('login_view');
		}
    }

    public function verify(){
    	$uname = $_POST['uname'];
    	$psw = $_POST['psw'];
    	
    	$sql= "SELECT * FROM user WHERE username='".$uname."' and password='".$psw."'";

    	$this->load->database();
    	$this->load->helper('url');

    	$this->db->where('username',$uname);
    	$query_admin=$this->db->get('admin');
    	//$this->db->where('userid',$uname);
    	//$query_admin_id=$this->db->get('admin');
    	if($query_admin->num_rows()){
    		//echo "123123";
    		$sql="SELECT * FROM admin WHERE username='".$uname."' and password='".$psw."'";
    		$query_adminpsw=$this->db->query($sql);
    		if(!$query_adminpsw->num_rows()){
    			echo "{'info':'密码错误！','status':0}";
    		}
    		else{
    			//redirect('');
                /*
                session_start();
				$result=$query_adminpsw->result();
				$_SESSION['id'] = $result[0]->userid;
				$_SESSION['name'] = $result[0]->username;
				$_SESSION['admin'] = 1;
                */

                $result=$query_adminpsw->result();
                $newdata = array(
                   'name'     => $result[0]->username,
                   'admin' => TRUE
                );
                $this->session->set_userdata($newdata);

                echo "{'info':'admin登录成功！','status':1}";
    		}
    		return;
    	}

    	//echo $sql;
		$this->db->where('username',$uname);
		$query_user=$this->db->get('user');
		//$this->db->where('userid',$uname);
    	//$query_user_id=$this->db->get('user');

		$query_userpsw=$this->db->query($sql);
		if(!$query_user->num_rows()){
			echo "{'info':'没有此用户','status':2}";
		}
		else if(!$query_userpsw->num_rows()){
			echo "{'info':'密码错误','status':3}";
		}else{
            $result=$query_userpsw->result();
            
            /*
            session_start();
			$_SESSION['id'] = $result[0]->userid;
			$_SESSION['name'] = $result[0]->username;
			$_SESSION['admin'] = 0;
            */

            $newdata = array(
                   'name'     => $result[0]->username,
                   'admin' => FALSE
            );
            $this->session->set_userdata($newdata);
            echo "{'info':'登录成功！','status':1}";
		}
    }
}?>