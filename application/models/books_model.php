<?php
class Books_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    //function to fetch all books in system
    public function fetch_books()
	{
       	$query = $this->db->get( 'books' );
        return $query->result_array();
        
	}

	//function processes return
	public function return_book( $book_id )
    {
        $this->db->set( 'is_issued', false ); //value that used to update column  
		$this->db->where( 'id', $book_id ); //which row want to upgrade  
		$this->db->update( 'books' ); 
		return ( $this->db->affected_rows() > 0 ) ? TRUE : FALSE;
    }

    //function processes issue
    public function issue_book( $book_id )
    {
        $this->db->set( 'is_issued', true ); //value that used to update column  
		$this->db->where( 'id', $book_id ); //which row want to upgrade  
		$this->db->update( 'books' );
		return ( $this->db->affected_rows() > 0 ) ? TRUE : FALSE; 
        
    }

    //fuunction used for search book by author or name
    public function search_book( $book_name )
	{	
		$query = "SELECT * FROM books where name like '%$book_name%' OR author like '%$book_name%'";
    	$query = $this->db->query( $query );
    	return $query->result_array();
	}

	//function used for insertion
	public function insert_book( $data )
	{
		$this->db->insert( 'books', $data );
	}

}