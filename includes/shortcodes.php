<?php
function job_circular_list(){
?>
<table class="table">
	<thead>
		<tr>
		<th><b>Job Title</b></th>
		<th><b>Category</b></th>
		<th><b>Deadline</b></th>
		<th><b>Company</b></th>
		<th><b>Email</b></th>
		<th><b>Action</b></th>
		</tr>
	</thead>
    <tbody>
<?php
$args = array(
'post_type'=>'jobcircular'
); 
// Custom query.
$query = new WP_Query( $args ); 
// Check that we have query results.
if($query->have_posts() ) {
while ($query->have_posts() ) { 
$query->the_post();
?>
		<tr>
			<td><?php the_title(); ?></td>
			<td><?php echo get_post_meta(get_the_ID(),'job_category',true); ?></td>
			<td><?php echo get_post_meta(get_the_ID(),'deadline',true); ?></td>
			<td><?php echo get_post_meta(get_the_ID(),'company-name',true); ?></td>
			<td><?php echo get_post_meta(get_the_ID(),'company-email',true); ?></td>
			<td><a href="<?php the_permalink();?>">View Details</a></td>
		</tr>
<?php
}
} 
// Restore original post data.
wp_reset_postdata(); 
?>
	</tbody>
</table>
<?php
}
add_shortcode('job_circular','job_circular_list');
?>
<?php
function job_content_meta($content){
	if ( is_single()) {		
		if(isset($_POST['submit']) AND !empty($_POST['name']) AND !empty($_POST['email']) AND !empty($_POST['phone'])){
		mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		extract($_POST);
		
		// Mail Start
		$to = get_post_meta(get_the_ID(),'company-email',true);
		$subject = "Job Circular";
		$message ="
		Name : $name,
		Email : $email,
		phone : $phone,
		About : $about		
		";
		
		wp_mail($to, $subject, $message);
		// Mail End	
		
		// Insert Query
		global $wpdb;
		$insertTodo = $wpdb->insert('applicant', array(

		   'job_id' => get_the_ID(),
		   'name' =>  esc_html($name),
		   'email' => esc_html($email),
		   'phone' => esc_html($phone),	   
		   'about' => esc_html($about),	   
		));
		
		if($insertTodo){
			 echo "<span style='color:green'>Application Submited Successfully</span>";
		}
		else{
			mysqli_error();
		}	
	}
		
	return $content.
	"<h4>Job Category </h4>" . get_post_meta(get_the_ID(),'job_category',true).
	"<h4>Deadline </h4>" . get_post_meta(get_the_ID(),'deadline',true).
	"<h4>Company Name </h4>" . get_post_meta(get_the_ID(),'company-name',true).
	"<h4>Company Email </h4>" . get_post_meta(get_the_ID(),'company-email',true).
	"<h4>Salary </h4>" . get_option('new_option_name').get_post_meta(get_the_ID(),'salary',true).
	"<h4>Vacancy </h4>" . get_post_meta(get_the_ID(),'vacancy',true).
	"<h4>Job Location </h4>" . get_post_meta(get_the_ID(),'job-location',true).
	"<h4>Company Address </h4>".get_post_meta(get_the_ID(),'company-address',true).'<br>'.'<br>'.
	"
	<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal' data-whatever='@mdo'>Apply For This Job</button>
	    
	<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
	  <div class='modal-dialog' role='document'>
		<div class='modal-content'>
		  <div class='modal-header'>
			<h1 class='modal-title' id='exampleModalLabel'>". get_post_meta(get_the_ID(),'company-name',true)."</h1>
		  </div>
		  <div class='modal-body'>"
		  
			."<form action='' method='POST'>
			  
			  <div class='form-group'>
				<label for='recipient-name' class='form-control-label'>NAME</label>
				<input type='text' class='form-control' name='name' required>
			  </div>
			  
			  <div class='form-group'>
				<label for='recipient-name' class='form-control-label'>EMAIL</label>
				<input type='email' class='form-control' name='email' required>
			  </div>

			  <div class='form-group'>
				<label for='recipient-name' class='form-control-label'>PHONE</label>
				<input type='text' class='form-control' name='phone' required>
			  </div>

			  <div class='form-group'>
				<label for='recipient-name' class='form-control-label'>ABOUT YOU</label>
				<textarea row='10' col='30' name='about'></textarea>
			  </div>
			 
			  <div class='modal-footer'>				
				<input type='submit' value='Submit' name='submit' class='btn btn-primary' >	
			  </div>
			</form>
		  </div>
		  
		</div>
	  </div>
	</div>";
	}
	elseif(is_singular() OR 'page' == get_post_type() ){
	return $content;	
	}
	
	else{
	return $content;	
	}
}
add_filter('the_content','job_content_meta');
?>