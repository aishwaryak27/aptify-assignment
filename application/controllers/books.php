<?php
class Books extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model( 'books_model' );
                $this->load->helper( 'url' );
                $this->load->helper( 'form' );
                $this->load->library('form_validation');

        }

        //function to list out books and if book id is passed sae function is used f
        public function view()
        {
                $data['books'] = $this->books_model->fetch_books();
                $this->load->view( 'header', $data );
                $this->load->view( 'books/view_books', $data );
                $this->load->view( 'footer' );
        }

        public function add_book()
        {
                $this->load->view( 'header' );
                $this->load->view( 'books/add_book' );
                $this->load->view( 'footer' );
        }


        public function return_book()
        {
                if ( $this->books_model->return_book( $this->input->post( 'book_id' ) ) )
                {
                        echo json_encode( '{"success" : "1"}' );
                        exit;
                }
                echo json_encode( '{"success" : "0"}' );
                exit;
        
        }

        public function issue_book()
        {
                if( $this->books_model->issue_book( $this->input->post( 'book_id' ) ) )
                {
                        echo json_encode( '{"success" : "1"}' );
                        exit;
                }
                echo json_encode( '{"success" : "0"}' );
                exit;
        
        }

        public function search_book()
        {
                $books  = $this->books_model->search_book( $this->input->post( 'book_name' ) );
                if(0 >= count( $books ) )
                {
                        echo json_encode( '{"message" : "No Books Found!"}' );
                        exit;
                }
                $books_tr = '';
                foreach ( $books as $book) 
                {
                        $str_availability = 'No';
                        $str_button = '';
                        if( $book['is_available'] )
                        {
                                $str_availability = 'Yes';
                                if( $book['is_issued'] )
                                {
                                     $str_button = '<button class=\'return\' id=\''.$book['id'].'\' type=\'button\'>Return Book</button>'; 
                                } else {
                                        $str_button ='<button class=\'issue\' id=\''.$book['id'].'\' type=\'button\'>Issue Book</button>';
                                }
                        }
                        $books_tr .= '<tr><th>'.$book['id'].'</th><th>'.$book['name'].'</th><th>'.$book['author'].'</th><th>'.$str_availability.'</th><th>'. $str_button .'</th></tr>';
                                        
                }
                $str_final_html = '<table><tr><th>Id</th><th>Name</th><th>Author Name</th><th>Availability for Actions</th><th>Actions</th></tr>'.$books_tr.'</table>';

                echo json_encode( '{"message" : "'.$str_final_html.'"}' );
                exit;
        
        }

        public function insert_book() 
        {

                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

                //Validating Name Field
                $this->form_validation->set_rules('name', 'name', 'required');

                //Validating Author Field
                $this->form_validation->set_rules('author', 'author', 'required');

                if ($this->form_validation->run() == FALSE) {
                        $this->load->view( 'header' );
                        $this->load->view( 'books/add_book' );
                        $this->load->view( 'footer' );
                } else {
                        //Setting values for tabel columns
                        $data = array(
                                'name' => $this->input->post('name'),
                                'author' => $this->input->post('author'),
                                'is_available' => (NULL == $this->input->post('is_available'))?false:true
                                );

                        //Transfering data to Model
                        $this->books_model->insert_book($data);
                        //redirct to oriinal url
                        redirect(base_url().'index.php/add_book');                

                }
        }

}
?>