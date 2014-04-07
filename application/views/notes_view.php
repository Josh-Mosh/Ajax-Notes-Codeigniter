<html>
<head>
	<title>Notes</title>
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/notes_css.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#new_note').submit(function(){
				$.post($(this).attr('action'), 
					$(this).serialize(), 
					function(note){
						if(note.error !== false)
						{
							$('#errors').append(note.error);
						}
						else
						{
							$('#notes').append(
								"<div class='note'>"+
									"<h3>"+note.title+"</h3>"+
									"<form class='update' action='notes/describe/"+note.id+"' method='post'>"+
										"<textarea class='description' name='description' placeholder='Click to enter description'></textarea>"+
									"</form>"+
									"<form class='delete' action='notes/delete/"+note.id+"' method='post'>"+
										"<input type='submit' value='Delete'>"+
									"</form>"+
								"</div>");
						}
				}, 'json')
				return false;
		})
		$(document).on('focusout', '.update', function(){
			$(this).submit();
		})

		$('#notes').sortable();

		$(document).on('submit', '.delete', function(){
			var note = $(this);
			$.post($(this).attr('action'),
				$(this).serialize(),
				function(data){
					$(note).parent().remove();
				}, 'json')
			return false;
			})

			$(document).on('submit', '.update', function(){
					$.post($(this).attr('action'),
						$(this).serialize())
					return false;
			})
		})
	</script>
</head>
<body>
	<div id='container'>
		<h2>Add New Note</h2>
		<div id='errors'>

		</div>
		<form id='new_note' action='notes/add_note' method='post'>
			<input type='text' name='title' placeholder = 'Insert note title here...'>
			<input type='submit' value='Add Note'>
		</form>	
		<h2>Notes</h2>
		<div id='notes'>
			<?php 
			foreach($notes as $note)
			{
			?>
				<div class='note'>
					<h3><?= $note['title'] ?></h3>
					<form class='update' action='notes/describe/<?= $note['id'] ?>' method='post'>
						<textarea class='description' name='description' placeholder='Click to enter description'><?= $note['description'] ?></textarea>
					</form>
					<form class='delete' action='notes/delete/<?= $note['id'] ?>' method='post'>
						<input type='submit' value='Delete'>
					</form>
				</div>
			<?php
			}
			 ?>
		</div>
		
	</div>
</body>
</html>