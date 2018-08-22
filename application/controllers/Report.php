<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function index()
	{
		if(!empty($this->session->userdata('Username')))
		{
			$this->load->model('ReportModel');
			$data['records'] = $this->ReportModel->get_rows('orders');
			$data['callers'] = $this->ReportModel->get_Callers();
			//$data['countCompleted'] = $this->db->count_all_results('orders');
			//$data['countClosed'] = $this->db->where('Closed',1)->count_all_results('orders');
			//$data['countEnvelope'] = $this->db->select_sum('Envelope')->get('orders')->row()->Envelope;
			//$data['countBrochure'] = $this->db->select_sum('Brochure')->get('orders')->row()->Brochure;
			//$data['countCatalog'] = $this->db->select_sum('Catalog')->get('orders')->row()->Catalog;
			//$data['countDVD'] = $this->db->select_sum('DVD')->get('orders')->row()->DVD;

			$this->load->view('home',$data);
		}
		else
		{
			$this->Login();
		}

	}

	public function get_latestRecord()
	{
		$lastcheck = $this->input->post('lastcheck');
        /*

        You should add a date field to each new created comment,then filter by "orderby date > $lastcheck" so you get comments since your last check
        You get the new comments here
        ...
        ...
        ..
        */

        $this->load->model('ReportModel');
		$data['records'] = $this->ReportModel->getLatest($lastcheck);
		$data['summary'] = $this->ReportModel->getSummary($lastcheck);
		//$data['lastcheck'] = $this->ReportModel->now();
		$data['lastcheck'] = date('Y-m-d H:i:s');

        if (!empty($data['records'])){
             /*The output*/
            echo json_encode($data); 
        }else{/*No new comments*/
            echo 'nothing_new';
        }
	}

	public function get_latestSummary()
	{
		$lastcheck= $this->input->get('lastcheck');

        $this->load->model('ReportModel');
		$data['records'] = $this->ReportModel->getLatest_Summary($lastcheck);
		//$data['lastcheck'] = $this->ReportModel->now();
		$data['lastcheck'] = date('Y-m-d H:i:s');

        if (!empty($data['records'])){
            echo json_encode($data); 
        }else{
            echo 'nothing_new';
        }
	}

	public function edit_order($record_id)
	{
		$this->load->model('ReportModel');
		$data['record'] = $this->ReportModel->getRecord($record_id);
		$this->load->view('edit_order',$data);
	}

	public function edit_completed($record_id)
	{
		$this->load->model('ReportModel');
		$data['record'] = $this->ReportModel->getRecord($record_id);
		$this->load->view('edit_completed',$data);
	}

	public function Register()
	{
		if(!empty($this->session->userdata('Username')))
		{
			$this->load->view('register');
		}
		else
		{
			$this->Login();
		}
	}

	public function delete($recordID)
	{
		if(!empty($this->session->userdata('Username')))
		{
			$this->load->model('ReportModel');
			$this->ReportModel->delRecord($recordID);
			redirect('report/index');
		}
		else
		{
			$this->Login();
		}
	}

	public function Summary()
	{
		$this->load->model('ReportModel');
		$data['records'] = $this->ReportModel->summary();
		$data['searched_from'] = date('Y-m-d');
		$data['searched_to'] = date('Y-m-d');
		$this->load->view('summary',$data);
	}

	public function summary_search()
	{
		$searched_from = $this->input->post('dateFrom');
		$searched_to = $this->input->post('dateTo');

		$this->load->model('ReportModel');
		$data['records'] = $this->ReportModel->summary_search($searched_from,$searched_to);
		$data['searched_from'] = $searched_from;
		$data['searched_to'] = $searched_to;
		$this->load->view('summary',$data);
	}

	public function Login()
	{
		$this->load->view('login');
	}

	public function Logout()
	{
		$this->session->sess_destroy();
		$this->Login();
	}

	public function login_validation()
	{
		$this->form_validation->set_rules('Username','Username','required');
		$this->form_validation->set_rules('Password','Username','required');

		if ($this->form_validation->run())
        {
        	$username = $this->input->post('Username');
        	$password = $this->input->post('Password');

        	$this->load->model('ReportModel');
        	if($this->ReportModel->can_login($username,$password))
        	{
        		$session_data = $this->ReportModel->user_details($username,$password);
        		$this->session->set_userdata($session_data);
        		redirect('report/index');
        	}
        	else
        	{
        		$this->session->set_flashdata('response','Username or Password is Invalid!');
        		redirect('report/Login');
        	}
        }
        else
        {
        	$this->Login();
        }
	}

	public function Completed()
	{
		if(!empty($this->session->userdata('Username')))
		{
			$this->load->view('completed');
		}
		else
		{
			$this->Login();
		}
	}

	public function Order()
	{
		if(!empty($this->session->userdata('Username')))
		{
			$this->load->view('order');
		}
		else
		{
			$this->Login();
		}
	}

	public function update_order($id)
	{
		$this->load->model('ReportModel');
		$data = $this->input->post();
		if(!isset($data['Network']))
		{
			$data['Network'] = 0;
		}
		
		if($this->ReportModel->updateRecord($id,$data))
	    {
	        $this->session->set_flashdata('response','Record wassuccessfully updated.');
	    }
	    else
	    {
			$this->session->set_flashdata('response','Record was not successfully updated.');
	    }
		redirect("report/edit_order/{$id}");
	}

	public function update_completed($id)
	{
		$this->load->model('ReportModel');
		$data = $this->input->post();
		
		if(!isset($data['Network']))
		{
			$data['Network'] = 0;
		}

		if($this->ReportModel->updateRecord($id,$data))
	    {
	        $this->session->set_flashdata('response','Record wassuccessfully updated.');
	    }
	    else
	    {
			$this->session->set_flashdata('response','Record was not successfully updated.');
	    }
		redirect("report/edit_completed/{$id}");
	}

	public function save_user()
	{
		$this->form_validation->set_rules('Username','Username','is_unique[users.Username]');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->load->model('ReportModel');
		$data = $this->input->post();

		if ($this->form_validation->run())
        {
        	if($this->ReportModel->saveRecord($data,'users'))
	        {	
	            $this->session->set_flashdata('response',$data['Username'].' successfully saved.');
	        }
	        else
	        {
				$this->session->set_flashdata('response',$data['Username'].' was not saved.');
	        }
        }
		$this->load->view('register');
	}

	public function save_completed()
	{
		if(!empty($this->session->userdata('Username')))
		{
			$this->load->model('ReportModel');
			$data = $this->input->post();

			$data['Closed'] = 0;
			$data['CallerID'] = $this->session->userdata('ID');

			if(isset($data['Network']))
			{
				$data['Network'] = 1;
			}
			else
			{
				$data['Network'] = 0;
			}

	        	if($this->ReportModel->saveRecord($data,'orders'))
		        {
		            $this->session->set_flashdata('response','Record successfully saved.');
		            /*$arr['success'] = true;

		            $records = $this->ReportModel->getRecord($this->db->insert_id());

		            $arr['FirstName'] = $records->FirstName;
		            $arr['LastName'] = $records->LastName;
		            $arr['State'] = $records->State;
		            $arr['PhoneNo'] = $records->PhoneNo;
		            $arr['Email'] = $records->Email;
		            $arr['DateOrdered'] = $records->DateOrdered;
		            $arr['DVD'] = $records->DVD;
		            $arr['Catalog'] = $records->Catalog;
		            $arr['Brochure'] = $records->Brochure;
		            $arr['Envelope'] = $records->Envelope;
		            $arr['Name'] = $records->Name;
		            $arr['Completed'] = $records->Completed;
		            $arr['Closed'] = $records->Closed;*/
		        }
		        else
		        {
					$this->session->set_flashdata('response','Record was not saved.');
					//$arr['success'] = false;
		        }

		        //$arr['new_count_record'] = $this->db->where('Completed',1)->count_all_results('orders');
		        //$detail = $this->db->select('*')->from('orders')->where('ID',$this->db->insert_id())->get()->row();

		        //$arr['FirstName'] = 'Test';
		        //$arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Message sent ...</div>';

		    //echo json_encode($arr);
			return redirect('report/Completed');
		}
		else
		{
			$this->Login();
		}
	}

	public function save_order()
	{
		if(!empty($this->session->userdata('Username')))
		{
			$this->form_validation->set_rules('PhoneNo','Contact No','max_length[12]');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if($this->form_validation->run())
			{
				error_reporting(E_ERROR | E_PARSE);
				$ncm_full_array = array();

				$ncm_full_array["element_2"] = $this->input->post('Brochure');
				$ncm_full_array["element_3"] = $this->input->post('Envelope');
				$ncm_full_array["element_5_1"] = $this->input->post('FirstName');
				$ncm_full_array["element_5_2"] = $this->input->post('LastName');
				$ncm_full_array["element_6_1"] = $this->input->post('Street_Address');
				$ncm_full_array["element_6_2"] = $this->input->post('Address2');
				$ncm_full_array["element_6_3"] = $this->input->post('City');
				$ncm_full_array["element_6_4"] = $this->input->post('State');
				$ncm_full_array["element_6_5"] = $this->input->post('PostalCode');
				$ncm_full_array["element_6_6"] = $this->input->post('Country');

				$Phone = explode("-",$this->input->post('PhoneNo'));
				$ncm_full_array["element_7_1"] = $Phone[0];
				$ncm_full_array["element_7_2"] = $Phone[1];
				$ncm_full_array["element_7_3"] = $Phone[2];

				$ncm_full_array["element_9"] = $this->input->post('Email');
				$ncm_full_array["element_8"] = $this->input->post('Comments');
				$ncm_full_array["element_11_1"] = $this->input->post('Network');

				$ncm_full_array["form_id"] = 23;
				$ncm_full_array["submit"] = "Submit";
				$ncm_full_array["element_10"] = $this->session->userdata('ID');

				$url = 'http://fulfillment.ncm.org/view.php?id=23';

				$options['http'] = array(
					'method' => "POST",
					'content' => http_build_query($ncm_full_array)
				);

				$context = stream_context_create($options);
				$body = file_get_contents($url, NULL, $context);

				if($body)
				{
					$this->session->set_flashdata('response','Record successfully saved.');

					//$arr['success'] = true;

			        /*$records = $this->ReportModel->getRecord($this->db->insert_id());

			        $arr['FirstName'] = $records->FirstName;
			        $arr['LastName'] = $records->LastName;
			        $arr['State'] = $records->State;
			        $arr['PhoneNo'] = $records->PhoneNo;
			        $arr['Email'] = $records->Email;
			        $arr['DateOrdered'] = $records->DateOrdered;
			        $arr['DVD'] = $records->DVD;
			        $arr['Catalog'] = $records->Catalog;
			        $arr['Brochure'] = $records->Brochure;
			        $arr['Envelope'] = $records->Envelope;
			        $arr['Name'] = $records->Name;
			       	$arr['Completed'] = $records->Completed;
			        $arr['Closed'] = $records->Closed;*/
				}
				else
				{
					$this->session->set_flashdata('response','Record was not saved.');
					//$arr['success'] = false;
				}

				//$arr['new_count_record'] = $this->db->where('Completed',1)->count_all_results('orders');

				return redirect('report/Order');
				//echo json_encode($arr);

				//$arr['new_count_record'] = $this->db->where('Completed',1)->count_all_results('orders');
				//echo json_encode($arr);

				/*$this->load->model('ReportModel');
				$data = $this->input->post();

				$data['Closed'] = 1;
				$data['CallerID'] = $this->session->userdata('ID');

		        	if($this->ReportModel->saveRecord($data,'orders'))
			        {
			            $this->session->set_flashdata('response','Record successfully saved.');
			            $arr['success'] = true;

			            $records = $this->ReportModel->getRecord($this->db->insert_id());

			            $arr['FirstName'] = $records->FirstName;
			            $arr['LastName'] = $records->LastName;
			            $arr['State'] = $records->State;
			            $arr['PhoneNo'] = $records->PhoneNo;
			            $arr['Email'] = $records->Email;
			            $arr['DateOrdered'] = $records->DateOrdered;
			            $arr['DVD'] = $records->DVD;
			            $arr['Catalog'] = $records->Catalog;
			            $arr['Brochure'] = $records->Brochure;
			            $arr['Envelope'] = $records->Envelope;
			            $arr['Name'] = $records->Name;
			            $arr['Completed'] = $records->Completed;
			            $arr['Closed'] = $records->Closed;
			        }
			        else
			        {
						$this->session->set_flashdata('response','Record was not saved.');
						$arr['success'] = false;
			        }

			        $arr['new_count_record'] = $this->db->where('Completed',1)->count_all_results('orders');
			        //$detail = $this->db->select('*')->from('orders')->where('ID',$this->db->insert_id())->get()->row();

			        //$arr['FirstName'] = 'Test';
			        //$arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Message sent ...</div>';

			    echo json_encode($arr);
				//$this->load->view('completed');*/
			}
		}
		else
		{
			$this->Login();
		}
	}

	public function search()
	{
		if(!empty($this->session->userdata('Username')))
		{
			$searched_name = $this->input->post('Name');
			$searched_from = $this->input->post('dateFrom');
			$searched_to = $this->input->post('dateTo');
			$searched_caller = $this->input->post('CallerID');

			$this->load->model('ReportModel');
			$data['records'] = $this->ReportModel->search($searched_name,$searched_from,$searched_to,$searched_caller);
			$data['isSearched'] = 1;
			$data['searched_name'] = $searched_name;
			$data['searched_from'] = $searched_from;
			$data['searched_to'] = $searched_to;
			if(!empty($searched_caller))
			{
				$data['searched_caller'] = $this->ReportModel->get_CallerDetails($searched_caller)->Name;
			}
			$data['callers'] = $this->ReportModel->get_Callers();
			$this->load->view('home',$data);
		}
		else
		{
			$this->Login();
		}
	}

	public function circle_icon($bool)
			{
				if($bool)
				{
					$Icon = "<i class='fa fa-circle text-success'></i>";
				}
				else
				{
					$Icon = "<i class='fa fa-circle text-danger'></i>";
				}
				echo $Icon;
			}
}
