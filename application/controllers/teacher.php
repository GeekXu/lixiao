<?php  
  
	class teacher extends CI_Controller {  
    	public function index(){
        	//echo "Hello World!";
        	//session_start();

        	$this->load->helper("url");
        	//if (isset($_SESSION['id'])) {
            if($this->session->userdata('id')!=FALSE){
                //if($_SESSION['admin']==1){
                if($this->session->userdata('admin')==TRUE){
                    redirect('admin');
                    //echo 'jump to admin';
                }
                $this->load->database(); 

                //$teacherid=$_SESSION['id'];
                //$teachername=$_SESSION['name'];
                $teacherid=$this->session->userdata('id');
                $teachername=$this->session->userdata('name');

                $sql="SELECT * from studentinfo where leaveok=0 and teacherid='".$teacherid."' and teachername='".$teachername."'";
                //echo $sql;
                $querydata=$this->db->query($sql);
                $result=$querydata->result();

                $data['students']=$result;
                $data['teachername']=$teachername;

                //echo $result[0]->studentid;
        		$this->load->view("teacher",$data);
        	}
        	else{
        		redirect('login');
        	}
        	
		}

		public function modify(){
			$changetype = $_POST['changetype'];
            $changeto = $_POST['changeto'];
            $studentid= $_POST['studentid'];
            $sql = "UPDATE studentinfo set ".$changetype."=".$changeto." WHERE studentid='".$studentid."'";
            //echo $sql;

            $this->load->database(); 
            $this->db->query($sql);
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
	}
?>