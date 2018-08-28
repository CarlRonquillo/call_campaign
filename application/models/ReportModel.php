<?php 
	class ReportModel extends CI_Model
	{
		public function get_rows()
		{
			$this->db->select('orders.*,users.Name');
			$this->db->from('orders');
			$this->db->join('users', 'users.ID = orders.callerID','left');
			$this->db->order_by('orders.ID', 'DESC');
			$this->db->where("orders.campaign",date('Y'));
			$query = $this->db->get();
			return $query->result();
		}

		public function search($name,$from,$to,$caller)
		{
			$toPlus1Day = date('Y-m-d H:i:s', strtotime($to . ' +1 day'));
			$this->db->select('*');
			$this->db->from('orders');
			$this->db->join('users', 'users.ID = orders.callerID');
			if(!empty($from) || !empty($to))
			{
				$this->db->where('orders.DateOrdered >=', $from);
				$this->db->where('orders.DateOrdered <=', $toPlus1Day);
			}
			if(!empty($name))
			{
				$this->db->or_like("concat(orders.FirstName,' ',orders.LastName)",$name);
			}
			if(!empty($caller))
			{
				$this->db->where("orders.CallerID",$caller);
			}
			$this->db->order_by('orders.ID', 'DESC');
			$query = $this->db->get();
			return $query->result();
		}

		public function get_Callers()
		{
			$this->db->select('ID,Name');
			$this->db->from('users');
			$this->db->where('users.Active =', 1);
			$this->db->where('users.Name <>', 'admin');
			$this->db->order_by('users.Name', 'DESC');
			$query = $this->db->get();
			return $query->result();
		}

		public function get_CallerDetails($caller_id)
		{
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('users.ID =', $caller_id);
			$query = $this->db->get();
			return $query->row();
		}

		public function saveRecord($data,$tableName)
		{
			return $this->db->insert($tableName,$data);
		}

		public function can_login($username,$password)
		{
			$this->db->where('Username',$username);
			$this->db->where('Password',$password);
			$query = $this->db->get('users');

			if($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function user_details($username,$password)
		{
			$this->db->where('Username',$username);
			$this->db->where('Password',$password);
			$query = $this->db->get('users');

			return $query->row_array();
		}

		public function summary()
		{
			$toPlus1Day = date('Y-m-d H:i:s', strtotime(date('Y-m-d') . ' +1 day'));
			$this->db->select('
				users.ID,
		        users.Name,
		        SUM(orders.Brochure) as BrochureCount,
		        SUM(orders.DVD) as DVDCount,
		        SUM(orders.Envelope) as EnvelopeCount,
		        SUM(orders.Catalog) as CatalogCount,
		        SUM(orders.Completed) as CompletedCount,
		        SUM(orders.Closed) as ClosedCount');

			$this->db->from('users');
			$this->db->join('orders', 'users.ID = orders.callerID');
			$this->db->where('orders.DateOrdered >=', date('Y-m-d'));
			$this->db->where('orders.DateOrdered <=', $toPlus1Day);
			$this->db->group_by('users.ID');
			$this->db->order_by('ClosedCount','DESC');
			$query = $this->db->get();
			return $query->result();
		}

		/*public function updateOneField($networkValue)
		{
			$this->db->insert('Network',$networkValue);
     		return $this->db->insert_id();
		}*/

		public function summary_search($from,$to)
		{
			$toPlus1Day = date('Y-m-d H:i:s', strtotime($to . ' +1 day'));
			$this->db->select('
				users.ID,
		        users.Name,
		        SUM(orders.Brochure) as BrochureCount,
		        SUM(orders.DVD) as DVDCount,
		        SUM(orders.Envelope) as EnvelopeCount,
		        SUM(orders.Catalog) as CatalogCount,
		        SUM(orders.Completed) as CompletedCount,
		        SUM(orders.Closed) as ClosedCount');

			$this->db->from('users');
			$this->db->join('orders', 'users.ID = orders.callerID');
			if(!empty($from) || !empty($to))
			{
				$this->db->where('orders.DateOrdered >=', $from);
				$this->db->where('orders.DateOrdered <=', $toPlus1Day);
			}
			$this->db->group_by('users.ID');
			$this->db->order_by('ClosedCount','DESC');
			$query = $this->db->get();
			return $query->result();
		}

		public function getLatest($lastCheck)
		{
			$this->db->select('orders.*,users.Name');
			$this->db->from('orders');
			$this->db->join('users', 'users.ID = orders.callerID','left');
			$this->db->where('DateOrdered > ',$lastCheck);
			$this->db->order_by('orders.DateOrdered', 'DESC');
			$query = $this->db->get();
			return $query->result();
		}

		public function getLatest_Summary($lastCheck)
		{
			$this->db->select('sum(Brochure) as Brochure,
					        sum(Envelope) as Envelope,
					        sum(Completed) as Completed,
					        sum(Closed) as Closed,
					        users.Name');
			$this->db->from('orders');
			$this->db->join('users', 'users.ID = orders.callerID','inner');
			$this->db->where('DateOrdered > ',$lastCheck);
			$this->db->group_by('orders.CallerID');
			$query = $this->db->get();
			return $query->result();
		}

		public function getSummary($lastCheck)
		{
			$this->db->select('sum(DVD) as DVD,
					        sum(Catalog) as Catalog,
					        sum(Brochure) as Brochure,
					        sum(Envelope) as Envelope,
					        sum(Completed) as Completed,
					        sum(Closed) as Closed,
					        (sum(Completed) - sum(Closed)) as NoOrder,
					        SUM(Network) as Network,
       						CONCAT(Round((sum(Closed)/sum(Completed)) * 100),"%") as percentage');
			$this->db->from('orders');
			$query = $this->db->get();
			return $query->result();
		}

		public function now()
		{
			$this->db->select('NOW() as latestCheck');
			$query = $this->db->get();
			return $query->row()->latestCheck;
		}

		public function getRecord($id)
		{
			$this->db->select('orders.*,users.Name');
			$this->db->from('orders');
			$this->db->join('users', 'users.ID = orders.callerID','left');
			$this->db->where('orders.ID',$id);
			$this->db->order_by('orders.ID', 'DESC');
			$query = $this->db->get();
			return $query->row();
		}

		public function delRecord($id)
		{
			$this->db->where('ID', $id);
  			return $this->db->delete('orders');
		}

		public function updateRecord($id,$data)
		{
			$this->db->where('ID', $id);
			return $this->db->update('orders', $data);
		}
	}
?>