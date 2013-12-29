<?php
class teacher extends CI_Controller {  
    	public function index(){
        	//echo "Hello World!";
        	//session_start();

        	$this->load->helper("url");
        	//if (isset($_SESSION['id'])) {
            if($this->session->userdata('name')!=FALSE){
                //echo $this->session->userdata('name');
                //if($_SESSION['admin']==1){
                if($this->session->userdata('admin')==TRUE){
                    redirect('admin');
                    //echo 'jump to admin';
                }
                $this->load->database(); 

                //$teacherid=$_SESSION['id'];
                //$teachername=$_SESSION['name'];
                //$teacherid=$this->session->userdata('id');
                $teachername=$this->session->userdata('name');

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

                $sql="SELECT * from user where username='".$teachername."' LIMIT 1";
                $querydata=$this->db->query($sql);
                $teacherinfo=$querydata->result();


                $data['studentmaster']=$studentmaster;
                $data['studentphd']=$studentphd;
                $data['studentphdleavenum']=$studentphdleavenum;
                $data['studentmasterleavenum']=$studentmasterleavenum;
                $data['teacherinfo']=$teacherinfo;


                //echo $result[0]->studentid;
        		$this->load->view("teacher",$data);
        	}
        	else{
        		redirect('login');
        	}
 		}

		public function modify(){
            $this->load->database();
			$paperok = $_POST['paperok'];
            $projectok = $_POST['projectok'];
            $bisheok = $_POST['bisheok'];
            $studentid = $_POST['uid'];
            $teachername=$this->session->userdata('name');

            $sql = "SELECT * from studentinfo where studentid=".$studentid." and teachername='".$teachername."'";
            //echo $sql;
            $querydata = $this->db->query($sql);
            $result = $querydata->result();
            if (count($result)==0) {
                # code...
                echo "{'status':'-1'}";
            }
            else{
                $sql = "UPDATE studentinfo set paperok=".$paperok." , projectok=".$projectok." , bisheok=".$bisheok." WHERE studentid='".$studentid."'";
                $querydata = $this->db->query($sql);
                //$result = $querydata->result();
                if($querydata==0){
                    echo "{'status':0}";
                }
                else{
                    echo "{'status':1}";
                }

                //echo $sql;
            }
            
            //$this->db->query($sql);
		}

        public function detail(){

            $this->load->helper("url");
            $this->load->database();

            if($this->session->userdata('name')!=FALSE){
                //if($_SESSION['admin']==1){
                if($this->session->userdata('admin')==TRUE){
                    redirect('admin');
                    //echo 'jump to admin';
                }
            }
            else{
                redirect('login');
                //echo 'jump to login'
            }

            $studentid=$this->uri->segment(3,0);
            $teachername=$this->session->userdata('name');
            //echo $studentid;
            
            $sql="SELECT * from studentinfo where studentid=".$studentid." and teachername='".$teachername."'";
            //echo $sql;
            if ($studentid) {
                # code...
                $querydata=$this->db->query($sql);
                $studentdetail=$querydata->result();

            }
            
            if ($studentid==0 || count($studentdetail)==0) {
                # code...
                $this->load->view('studenterror');
            }
            else{
                $data['studentdetail']=$studentdetail[0];
                $this->load->view('studentdetail',$data);
            }
        }

        public function statistics(){
            $this->load->helper('url');
            $this->load->database();

            /*
            $sql="select username,
                (select count(studentid) from studentinfo where teachername=username and studentdegree='硕士') as masternum,
                (select count(studentid) from studentinfo where teachername=username and studentdegree='硕士' and leaveok=1) as masterleavenum,
                (select count(studentid) from studentinfo where teachername=username and studentdegree='博士') as phdnum,
                (select count(studentid) from studentinfo where teachername=username and studentdegree='博士' and leaveok=1) as phdleavenum
                from user order by username
                ";
            $result=$this->db->query($sql)->result();
            */
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
            $this->load->view('statistics',$data);
            
        }

        public function changepsw(){
            $this->load->helper("url");

            if($this->session->userdata('name')!=FALSE){

                $this->load->view("changepsw");
            }
            else{
                redirect('login');
            }
        }

        public function doChangePsw(){
            $this->load->database();
            $teachername=$this->session->userdata('name');

            $OriPsw=$_POST['oriPsw'];
            $NewPsw=$_POST['newPsw'];
            $sql="SELECT * from user where username='".$teachername."' and password='".$OriPsw."'";
            $querydata=$this->db->query($sql);
            $result=$querydata->result();
            if (count($result)==0) {
                echo "{'status':'-1'}";
                return;
            }

            $sql="UPDATE user set password='".$NewPsw."' where username='".$teachername."'";
            $result=$this->db->query($sql);
            //echo $result;
            if ($result==0) {
                echo "{'status':'-1'}";
            }
            else{
                echo "{'status':'1'}";
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
}?>