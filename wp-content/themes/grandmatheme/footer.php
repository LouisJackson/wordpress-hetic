	</section>
	<script src="<?= get_template_directory_uri(); ?>/grandma-script.js"></script>
	<script type="text/javascript">
		$('.upvote-btn').on('click', function(){
			var that = this;

			$.ajax({
			    type: 'post',
				url: '<?= get_template_directory_uri(); ?>/update-likes.php',
			    data: {
			    	tipId: $(that).attr('data-tipId')
			    },
			    success: function(data){
			    	$('.likes-count').html(data);
			    	$('.upvote-btn').addClass('active');
			    }
			});
		});
	</script>
</body>
</html>