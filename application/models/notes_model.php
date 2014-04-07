<?php 
class Notes_Model extends CI_Model
{
	public function get_all_notes()
	{
		return $this->db->query("SELECT id, title, description FROM notes")->result_array();
	}

	public function add_note($title)
	{
		$query = "INSERT INTO notes (title, created_at, updated_at)
				  VALUES (?, NOW(), NOW())";
		$values = array($title['title']);
		$this->db->query($query, $values);
	}

	public function add_description($note_info)
	{
		$query = "UPDATE notes
				  SET description = ?
				  WHERE id = ?";
		$values = array($note_info['description'], $note_info['id']);
		$this->db->query($query, $values);
	}

	public function delete_note($id)
	{
		$query = "DELETE FROM notes WHERE id=?";
		$values = array($id['id']);
		return $this->db->query($query, $values);
	}
}
 ?>