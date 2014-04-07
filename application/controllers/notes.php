<?php 
class Notes extends CI_Controller
{
	public function index()
	{
		$this->load->model('notes_model');
		$all_notes = $this->notes_model->get_all_notes();
		$this->data = array(
			'notes' => $all_notes
		);
		$this->load->view('notes_view', $this->data);
	}

	public function add_note()
	{
		if(!empty($this->input->post('title')))
		{
			$this->load->model('notes_model');
			$note_details = array(
				'title' => $this->input->post('title'),
						);
			$note_id = $this->notes_model->add_note($note_details);
			$note_details['id'] = $this->db->insert_id();
			$note_details['error'] = false;
		}
		else
		{
			$note_details['error'] = 'Note title cannot be blank';
		}
		
		echo json_encode($note_details);
	}

	public function describe($id)
	{
		$this->load->model('notes_model');
		$note_describe = array(
			'description' => $this->input->post('description'),
			'id' => $id
		);
		$this->notes_model->add_description($note_describe);
	}

	public function delete($id)
	{
		$this->load->model('notes_model');
		$note_delete['id'] = $id;
		
		$this->notes_model->delete_note($note_delete);

		echo json_encode($note_delete);
	}
}
 ?>