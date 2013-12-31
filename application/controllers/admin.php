<?php  
  
	class admin extends CI_Controller {  
    	public function index(){
        	//echo "Hello World!";
        	//session_start();
            //不使用php的session了，CI对php原生session支持很差，使用CI自己的Session，在autoload.php中自动加载

        	$this->load->helper("url");
            $this->load->database();
        	//if (isset($_SESSION['id'])) {
            if($this->session->userdata('name')!=FALSE){
                if($this->session->userdata('admin')==0){
                    redirect('teacher');
                    //echo 'jump to teacher';
                }

                //$data['adminname']=$_SESSION['name'];
                //$data['adminname']=$this->session->userdata('name');


                $sql="select username,(select count(studentid) from studentinfo where teachername=username and studentdegree='硕士') as masternum from user order by username";
                $result=$this->db->query($sql)->result();

                //echo $result[0]->username;

                
                $sql="select username,(select count(studentid) from studentinfo where teachername=username and studentdegree='硕士' and leaveok=1) as masterleavenum from user order by username";
                $result2=$this->db->query($sql)->result();

                $sql="select username,(select count(studentid) from studentinfo where teachername=username and studentdegree='博士') as phdnum from user order by username";
                $result3=$this->db->query($sql)->result();

                $sql="select username,(select count(studentid) from studentinfo where teachername=username and studentdegree='博士' and leaveok=1) as phdleavenum from user order by username";
                $result4=$this->db->query($sql)->result();

                $length=count($result);
                for ($i=0; $i < $length; $i++) {
                    /*
                    //for test 
                    if($result[$i]->username != $result4[$i]->username)
                        echo "123123123";
                    */
                    $result[$i]->masterleavenum=$result2[$i]->masterleavenum;
                    $result[$i]->phdnum=$result3[$i]->phdnum;
                    $result[$i]->phdleavenum=$result4[$i]->phdleavenum;
                }            

                $data['results']=$result;
                $data['adminname']=$this->session->userdata('name');

                $this->load->helper('url');
                $this->load->view('admin',$data);
        	}
        	else{
        		redirect('login');
                //echo 'jump to login';
        	}
        	
		}

        public function teacher(){
            $this->load->helper('url');
            $this->load->database();
            if($this->session->userdata('name')==FALSE){
                redirect('login');
            }
            else if($this->session->userdata('admin')==0){
                redirect('teacher');
            }
            else{
                $teachername=urldecode($this->uri->segment(3,0));
                //echo $teachername;

                $sql="SELECT * from user where username='".$teachername."' LIMIT 1";
                $querydata=$this->db->query($sql);
                if($querydata->num_rows()==0){
                    //echo "老师不存在，请重试！";
                    $this->load->view("teachererror_admin");
                    return ;
                }
                $teacherinfo=$querydata->result();

                $sql="SELECT * from studentinfo where teachername='".$teachername."' and studentdegree='硕士'";
                //echo $sql;
                $querydata=$this->db->query($sql);
                $studentmaster=$querydata->result();
                $studentmasterleavenum=0;
                foreach ($studentmaster as $key => $value) {
                    if ($value->leaveok == 1) {
                        # code...
                        $studentmasterleavenum+=1;
                    }
                }


                $sql="SELECT * from studentinfo where teachername='".$teachername."' and studentdegree='博士'";
                //echo $sql;
                $querydata=$this->db->query($sql);
                $studentphd=$querydata->result();
                $studentphdleavenum = 0;
                foreach ($studentphd as $key => $value) {
                    # code...
                    if ($value->leaveok == 1) {
                        # code...
                        $studentphdleavenum+=1;
                    }
                }

                $data['studentmaster']=$studentmaster;
                $data['studentphd']=$studentphd;
                $data['studentphdleavenum']=$studentphdleavenum;
                $data['studentmasterleavenum']=$studentmasterleavenum;
                $data['teacherinfo']=$teacherinfo;


                //echo $result[0]->studentid;
                $this->load->view("teacher_admin",$data);
            }
        }

        public function student(){

            $this->load->helper("url");
            $this->load->database();

            if($this->session->userdata('name')==FALSE){
                redirect('login');
            }
            else if($this->session->userdata('admin')!=TRUE){
                redirect('teacher');
                //echo 'jump to admin';
            }

            $studentid=$this->uri->segment(3,0);
            //echo $studentid;
            
            $sql="SELECT * from studentinfo where studentid=".$studentid;
            //echo $sql;
            $querydata=$this->db->query($sql);
            $studentdetail=$querydata->result();
            
            if ($studentid==0 || count($studentdetail)==0) {
                # code...
                $this->load->view('studenterror_admin');
            }
            else{
                $data['studentdetail']=$studentdetail[0];
                $this->load->view('studentdetail_admin',$data);
            }
        }

        public function modify(){
            if($this->session->userdata('name')==FALSE){
                //redirect('login');
                echo "{'status':-1,'info':'dont hack'}";
                return;
            }
            else if($this->session->userdata('admin')!=TRUE){
                //redirect('teacher');
                echo "{'status':-1,'info':'dont hack'}";
                //echo 'jump to admin';
                return;
            }

            $this->load->helper('url');
            $this->load->database();
            $studentid = $_POST['uid'];
            $leaveok = $_POST['leaveok'];

            $studentid=$this->uri->segment(3,0);
            $sql="UPDATE studentinfo set leaveok=".$leaveok." where studentid=".$studentid." and paperok=1 and projectok=1 and bisheok=1";
            //echo $sql;
            $querydata=$this->db->query($sql);
            if ($querydata==0) {
                # code...
                echo "{'status':0,'info':'cannot'}";
            }
            else{
                echo "{'status':1}";
            }


        }

        public function changepsw(){
            $this->load->helper("url");

            if($this->session->userdata('name') && $this->session->userdata('admin')){

                $this->load->view("changepsw_admin");
            }
            else{
                redirect('login');
            }
        }


        public function doChangePsw(){
            $this->load->database();
            if(!$this->session->userdata('name') || !$this->session->userdata('admin')){
                echo "{'status':-1,'info':'error, dont hack'}";
                return ;
                //redirect('login');
            }

            $adminname=$this->session->userdata('name');
            //echo $adminname;

            $OriPsw=$_POST['oriPsw'];
            $NewPsw=$_POST['newPsw'];
            $sql="SELECT * from admin where username='".$adminname."' and password='".$OriPsw."'";
            //echo $sql;
            $querydata=$this->db->query($sql);
            $result=$querydata->result();
            if (count($result)==0) {
                echo "{'status':'-1'}";
                return;
            }

            $sql="UPDATE admin set password='".$NewPsw."' where username='".$adminname."'";
            $result=$this->db->query($sql);
            //echo $result;
            if ($result==0) {
                echo "{'status':'-2'}";
            }
            else{
                echo "{'status':'1'}";
            }
        }

        public function manageall(){
            $this->load->helper('url');
            $this->load->view('manageall_admin');
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