<script type="text/javascript">
  var baseurl = "<?php print base_url(); ?>";
</script>
<script src="<?php echo base_url(); ?>js/books.js"></script>

<h2>Our Books</h2>
<p id="error_msg"></p>
<p id="success_msg"></p>

<input type="text" class="book_name" placeholder="Enter Book or Author"><button type="button" class="search">Search</button>
<a href="<?php echo base_url(); ?>index.php/add_book"  class="add">Add Book</a>
</br>
</br>
<div id="book_details">
<table>
  <tr>
    <th>Id</th>
    <th>Name</th>
    <th>Author Name</th>
    <th>Availability for Actions</th>
    <th>Actions</th>
  </tr>
  <?php if(0<count($books)){
  	foreach($books as $book) { ?>
  <tr>
    
    <td><?=$book['id']?></td>
    <td><?=$book['name']?></td>
    <td><?=$book['author']?></td>
    <td><?php if( $book['is_available'] ) { ?> 
    		Yes 
    	<?php } else { ?> 
    		No
    	<?php } ?>
    </td>
    <td><?php if( $book['is_available'] ) {
    			if(!$book['is_issued'] ) { ?> 
    				<button class="issue" id="<?=$book['id']?>" type="button">Issue Book</button> 
    			<?php } else { ?> 
    				<button class="return" id="<?=$book['id']?>" type="button">Return Book</button>  
    			<?php } } ?>
    	</td>
    
  </tr>
  <?php }} ?>
</table>
</div>

