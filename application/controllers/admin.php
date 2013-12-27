<?php  
  
	class admin extends CI_Controller {  
    	public function index(){
        	//echo "Hello World!";
        	//session_start();
            //不使用php的session了，CI对php原生session支持很差，使用CI自己的Session，在autoload.php中自动加载

        	$this->load->helper("url");
        	//if (isset($_SESSION['id'])) {
            if($this->session->userdata('id')!=FALSE){
                if($this->session->userdata('admin')==0){
                    redirect('teacher');
                    //echo 'jump to teacher';
                }

                //$data['adminname']=$_SESSION['name'];
                $data['adminname']=$this->session->userdata('name');
                $this->load->helper('url');
                $this->load->view('admin',$data);
        	}
        	else{
        		redirect('login');
                //echo 'jump to login';
        	}
        	
		}

        public function quit(){
            $this->load->helper("url");
            //session_start();
            //unset($_SESSION['id']);
            //session_destroy($_SESSION['id']);
            //session_destroy();

            $this->session->sess_destroy();

            redirect('login');
        }

        public function search(){
            $type=$_POST['type'];
            $key=$_POST['key'];

            $this->load->helper("url");
            $this->load->database();

            if($type=='student'){
                $sql="SELECT * from studentinfo where studentname like '%".$key."%'";
                $query=$this->db->query($sql);
                $result=$query->result();
                echo json_encode($result);
            }
            else if($type=='teacher' || $type=='all'){
                $sql="SELECT * from studentinfo where teachername like '%".$key."%'";
                $query=$this->db->query($sql);
                $result=$query->result();
                echo json_encode($result);
            }
            else if($type=='leaveok'){
                $sql="SELECT * from studentinfo where paperok=1 and projectok=1 and leaveok=0";
                $query=$this->db->query($sql);
                $result=$query->result();
                echo json_encode($result);
            }
            else if($type=='allleave'){
                $sql="SELECT * from studentinfo where leaveok=1";
                $query=$this->db->query($sql);
                $result=$query->result();
                echo json_encode($result);
            }
            else{
                echo "unkonwn type";
            }

        } 

        public function agreetoleave(){
            $studentid=$_POST['studentid'];
            $leaveok=$_POST['leaveok'];

            $sql="UPDATE studentinfo SET leaveok=".$leaveok." where studentid='".$studentid."'";
            $this->load->database();
            $this->db->query($sql);
        }

	}
?>