<?php
	class Job{
		private $db;

		public function __construct(){
			$this->db = new Database;
		}

		// Get All Jobs
		public function getAllJobs(){
			$this->db->query("SELECT jobs.*, categories.name AS cname
						FROM jobs
						INNER JOIN categories
						ON jobs.category_id = categories.id
						ORDER BY post_date DESC
						");
			// Assign Result Set
			$results = $this->db->resultSet();

			return $results;
		}

		// Get All Categories
		public function getCategories(){
			$this->db->query("SELECT * FROM categories");
			// Assign Result Set
			$results = $this->db->resultSet();

			return $results;
		}

		// Get All Jobs by category
		public function getByCategory($category){
			$this->db->query("SELECT jobs.*, categories.name AS cname
						FROM jobs
						INNER JOIN categories
						ON jobs.category_id = categories.id
						WHERE jobs.category_id = $category
						ORDER BY post_date DESC
						");
			// Assign Result Set
			$results = $this->db->resultSet();

			return $results;
		}

		public function getCategory($category_id)
		{
			$this->db->query("SELECT * from categories WHERE id = :category_id");
			$this->db->bind(':category_id', $category_id);

			$result = $this->db->single();
			return $result;
		}

		public function getJob($job_id)
		{
			$this->db->query("SELECT * FROM jobs where id = :job_id");
			$this->db->bind(':job_id', $job_id);

			$result = $this->db->single();
			return $result;

		}

		public function create($data)
		{
			$this->db->query("INSERT INTO jobs (category_id, company, job_title, description, salary, location, contact_user, contact_email) VALUES (:category_id, :company, :job_title, :description, :salary, :location, :contact_user, :contact_email)");
			$this->db->bind(':category_id', $data['category_id']);
			$this->db->bind(':company', $data['company']);
			$this->db->bind(':job_title', $data['job_title']);
			$this->db->bind(':description', $data['description']);
			$this->db->bind(':salary', $data['salary']);
			$this->db->bind(':location', $data['location']);
			$this->db->bind(':contact_user', $data['contact_user']);
			$this->db->bind(':contact_email', $data['contact_email']);

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function delete($del_id)
		{
			$this->db->query("DELETE FROM jobs WHERE id=:del_id");
			$this->db->bind(':del_id', $del_id);

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		// public function update($id, $data)
		// {
		// 	$this->db->query("UPDATE jobs SET category_id=:category_id, company=:company, job_title=:job_title, description=:description, salary=:salary, location=:location, contact_user=:contact_user, contact_email=:contact_email WHERE id=:id");
		// 	$this->db->bind(':category_id', $data['category_id']);
		// 	$this->db->bind(':company', $data['company']);
		// 	$this->db->bind(':job_title', $data['job_title']);
		// 	$this->db->bind(':description', $data['description']);
		// 	$this->db->bind(':salary', $data['salary']);
		// 	$this->db->bind(':location', $data['location']);
		// 	$this->db->bind(':contact_user', $data['contact_user']);
		// 	$this->db->bind(':contact_email', $data['contact_email']);
		// 	$this->db->bind(':id', $id);
		// 	if ($this->db->execute()) {
		// 		return true;
		// 	} else {
		// 		return false;
		// 	}
		// }

		// Update Job
		public function update($id, $data){
						//Insert Query
						$this->db->query("UPDATE jobs
										SET
										category_id = :category_id,
										job_title = :job_title,
										company = :company,
										description = :description,
										location = :location,
										salary = :salary,
										contact_user = :contact_user,
										contact_email = :contact_email
										WHERE id = $id");
						// Bind Data
						$this->db->bind(':category_id', $data['category_id']);
						$this->db->bind(':job_title', $data['job_title']);
						$this->db->bind(':company', $data['company']);
						$this->db->bind(':description', $data['description']);
						$this->db->bind(':location', $data['location']);
						$this->db->bind(':salary', $data['salary']);
						$this->db->bind(':contact_user', $data['contact_user']);
						$this->db->bind(':contact_email', $data['contact_email']);
						//Execute
						if($this->db->execute()){
										return true;
						} else {
										return false;
						}
		}
	}
