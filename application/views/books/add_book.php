<a href="<?php echo base_url(); ?>index.php/view_books">View Books</a>
<div class="add_book_form">
	<?php echo form_open('insert_book'); ?>
	<?php if (isset($message)) { ?>
	<CENTER><h3 style="color:green;">Data inserted successfully</h3></CENTER><br>
	<?php } ?>
	<?php echo form_label('Book Name :'); ?> <?php echo form_error('name'); ?><br />
	<?php echo form_input(array('id' => 'name', 'name' => 'name')); ?><br />

	<?php echo form_label('Author :'); ?> <?php echo form_error('author'); ?><br />
	<?php echo form_input(array('id' => 'author', 'name' => 'author')); ?><br />

	<?php echo form_label('Is Book Available to Issue :'); ?> 
	<?php echo form_checkbox('is_available', '1', TRUE); ?><br />

	<?php echo form_submit(array('id' => 'submit', 'value' => 'Submit')); ?>
	<?php echo form_close(); ?><br/>
</div>