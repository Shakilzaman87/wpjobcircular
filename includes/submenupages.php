<?php
ob_start();
function jobcircular_metabox($metabox){
	$metabox[] = array(
	
		'id'=> 'company_details',
		'title'=> 'Company Details',
		'object_types' => array('jobcircular'),
		'fields' => array(
		    array(
			  'name' => 'Company Name',
			  'type' => 'text',
			  'id' => 'company-name',
			  'desc' => 'Name of the Company'
			),
			
			array(
			  'name' => 'Company Address',
			  'type' => 'textarea_small',
			  'id' => 'company-address',
			  'desc' => 'Company location'
			),
			
			array(
			  'name' => 'Company Email',
			  'type' => 'text',
			  'id' => 'company-email',
			  'desc' => 'Company Email'
			),
		),
		
	);		
	return $metabox;
}

add_filter('cmb2_meta_boxes','jobcircular_metabox');

function jobcircular_metabox2($metabox){
	$metabox[] = array(	
		'id'=> 'job_details',
		'title'=> 'Job Details',
		'object_types' => array('jobcircular'),
		'fields' => array(			
			array(
			  'name'             => 'Job Category',
				'desc'             => 'Select the type of the job',
				'id'               => 'job_category',
				'type'             => 'select',
				'show_option_none' => true,
				'default'          => 'custom',
				'options'          => array(
					'Accounting/Finance' => __( 'Accounting/Finance', 'jobcircular' ),
					'Bank/ Non-Bank Fin. Institution' => __( 'Bank/ Non-Bank Fin. Institution', 'jobcircular' ),
					'Commercial/Supply Chain' => __( 'Commercial/Supply Chain', 'jobcircular' ),
					'Education/Training' => __( 'Education/Training', 'jobcircular' ),
					'Engineer/Architects' => __( 'Engineer/Architects', 'jobcircular' ),
					'Garments/Textile' => __( 'Garments/Textile', 'jobcircular' ),
					'HR/Org. Development' => __( 'HR/Org. Development', 'jobcircular' ),
					'Gen Mgt/Admin' => __( 'Gen Mgt/Admin', 'jobcircular' ),
					'Design/Creative' => __( 'Design/Creative', 'jobcircular' ),
					'Production/Operation' => __( 'Production/Operation', 'jobcircular' ),
					'Hospitality/ Travel/ Tourism' => __( 'Hospitality/ Travel/ Tourism', 'jobcircular' ),
					'Beauty Care/ Health & Fitness' => __( 'Beauty Care/ Health & Fitness', 'jobcircular' ),
					'Electrician/ Construction/ Repair' => __( 'Electrician/ Construction/ Repair', 'jobcircular' ),
					'IT & Telecommunication' => __( 'IT & Telecommunication', 'jobcircular' ),
					'Marketing/Sales' => __( 'Marketing/Sales', 'jobcircular' ),
					'Customer Support/Call Centre' => __( 'Customer Support/Call Centre', 'jobcircular' ),
					'Media/Ad./Event Mgt' => __( 'Media/Ad./Event Mgt', 'jobcircular' ),
					'Medical/Pharma' => __( 'Medical/Pharma', 'jobcircular' ),
					'Agro (Plant/Animal/Fisheries)' => __( 'Agro (Plant/Animal/Fisheries)', 'jobcircular' ),
					'NGO/Development' => __( 'NGO/Development', 'jobcircular' ),
					'NGO/Development' => __( 'Research/Consultancy', 'jobcircular' ),
					'Secretary/Receptionist' => __( 'Secretary/Receptionist', 'jobcircular' ),
					'Data Entry/Operator/BPO' => __( 'Data Entry/Operator/BPO', 'jobcircular' ),
					'Driving/Motor Technician' => __( 'Driving/Motor Technician', 'jobcircular' ),
					'Security/Support Service' => __( 'Security/Support Service', 'jobcircular' ),
					'Law/Legal' => __( 'Law/Legal', 'jobcircular' ),
					'Others' => __( 'Others', 'jobcircular' ),
				),
			),
			
			array(
			  'name' => 'Job Location',
			  'type' => 'textarea_small',
			  'id' => 'job-location',
			  'desc' => 'Job location where applicants have to work'
			),
			
			array(
			  'name' => 'Vacancy',
			  'type' => 'text',
			  'id' => 'vacancy',
			  'desc' => 'How many employee needed '
			),
			
			array(
			  'name' => 'Salary',
			  'type' => 'text',
			  'id' => 'salary',
			  'desc' => 'Expected salary range '
			),
			
			array(
			  'name' => 'Deadline',
			  'type' => 'text_date',
			  'id' => 'deadline',
			  'desc' => 'Last date of submission '
			),
		),
		
	);
	return $metabox;
}

add_filter('cmb2_meta_boxes','jobcircular_metabox2');

function all_jobs_page(){
?>
<div class="wrap">
<h1 class="wp-heading-inline">All Jobs List</h1>
</div>

<table class="table widefat fixed" style="margin-top:20px">
    <thead>
      <tr>
        <th><b>Job Title</b></th>
        <th><b>Category</b></th>
        <th><b>Vacancy</b></th>
        <th><b>Salary</b></th>
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
if ( $query->have_posts() ) {
while ( $query->have_posts() ) { 
$query->the_post();
?>		
	
    <tr>
        <td><?php the_title(); ?></td>
        <td><?php echo get_post_meta(get_the_ID(),'job_category',true); ?></td>
        <td><?php echo get_post_meta(get_the_ID(),'vacancy',true); ?> </td>
        <td><?php echo get_option('new_option_name');?><?php echo get_post_meta(get_the_ID(),'salary',true); ?></td>
        <td><?php echo get_post_meta(get_the_ID(),'deadline',true); ?></td>
		<td><?php echo get_post_meta(get_the_ID(),'company-name',true); ?></td>
		<td><?php echo get_post_meta(get_the_ID(),'company-email',true); ?></td>
        <td>
		<a href="<?php echo site_url();?>/wp-admin/edit.php?post_type=jobcircular&page=job-single&pid=<?php echo get_the_ID(); ?>">View</a> | 
		<a href="<?php echo site_url();?>/wp-admin/post.php?post=<?php echo get_the_ID(); ?>&action=edit">Edit</a> |  
		<a href="<?php echo site_url();?>/wp-admin/edit.php?post_type=jobcircular&page=jobs&did=<?php echo get_the_ID(); ?>">Delete</a>
		</td>
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

// Delete Job
if(isset($_GET['did'])){	  
  $id = $_GET['did'];
  wp_delete_post( $id);
}
// Single Post
function job_single_page(){
?>

<div class="wrap">
<h1 class="wp-heading-inline">Job Details</h1>
<a href="<?php echo site_url();?>/wp-admin/edit.php?post_type=jobcircular&page=jobs" class="page-title-action">View All Jobs</a>
<hr class="wp-header-end">
</div>

<?php 
$single_args = array(
'post_type'=>'jobcircular',
'p'=>$_GET['pid']
);
 
// Custom query.
$query = new WP_Query( $single_args );
 
// Check that we have query results.
if ( $query->have_posts() ) {
 
     while ( $query->have_posts() ) {
 
$query->the_post();
?>		
 
<table class="widefat" style="margin-top:20px">
	<tbody>
	<tr>
	<td><b>Job Title</b></td>
	<td><?php the_title(); ?></td>
	</tr>

	<tr>
	<td><b>Job Category</b></td>
	<td><?php echo get_post_meta(get_the_ID(),'job_category',true); ?></td>
	</tr>

	<tr>
	<td><b>Job Location</b></td>
	<td><?php echo get_post_meta(get_the_ID(),'job-location',true); ?></td>
	</tr>

	<tr>
	<td><b>Vacancy</b></td>
	<td><?php echo get_post_meta(get_the_ID(),'vacancy',true); ?></td>
	</tr>

	<tr>
	<td><b>Salary</b></td>
	<td><?php echo get_option('new_option_name');?><?php echo get_post_meta(get_the_ID(),'salary',true); ?></td>
	</tr>
	<tr>
	<td><b>Deadline</b></td>
	<td><?php echo get_post_meta(get_the_ID(),'deadline',true); ?></td>
	</tr>

	<tr>
	<td><b>Company Name</b></td>
	<td><?php echo get_post_meta(get_the_ID(),'company-name',true); ?></td>
	</tr>

	<tr>
	<td><b>Company Address</b></td>
	<td><?php echo get_post_meta(get_the_ID(),'company-address',true); ?></td>
	</tr>

	<tr>
	<td><b>Company Email</b></td>
	<td><?php echo get_post_meta(get_the_ID(),'company-email',true); ?></td>
	</tr>

	<tr>
	<td><b>Details</b></td>
	<td><?php the_content(); ?></td>
	</tr>

	</tbody>
</table>
		
<?php 		
 } 
} 
// Restore original post data.
wp_reset_postdata();
}

//Applicants
function applicants_page(){
?>

<div class="wrap">
<h1 class="wp-heading-inline">Applicants</h1>
</div>

<?php
global $wpdb; 
// Delete To Do
if(isset($_GET['aid'])){
  
  $id = $_GET['aid']; 
  $deleteTodo = $wpdb->delete( 'applicant', array( 'applicant_id' => $id ) );
  if($deleteTodo){
	  echo "Applicant Deleted Successfully";
  }
}
?>
<table class="table widefat fixed" style="margin-top:20px">
    <thead>
      <tr>
        <th><b>Job Title</b></th>
        <th><b>Name</b></th>
        <th><b>Email</b></th>
        <th><b>Phone</b></th>
        <th><b>Delete</b></th>
      </tr>
    </thead>
    <tbody>
	
<?php
$applicants = $wpdb->get_results('SELECT * FROM applicant ORDER BY applicant_id DESC');
foreach($applicants as $applicant){
?>		
	
    <tr>
        <td><?php echo get_the_title($applicant->job_id); ?></td>
        <td><?php echo $applicant->name; ?></td>
        <td><?php echo $applicant->email; ?> </td>
        <td><?php echo $applicant->phone; ?></td>
		
        <td>
		<a href="<?php echo site_url();?>/wp-admin/admin.php?page=applicants&aid=<?php echo $applicant->applicant_id; ?>">Delete</a>
		</td>
    </tr>

<?php 
}
?>	  
    </tbody>
</table>
		
<?php 		
}
?>

<?php
// create custom plugin settings menu
add_action('admin_menu', 'my_cool_plugin_create_menu',99999);

function my_cool_plugin_create_menu() {
	add_submenu_page('edit.php?post_type=jobcircular','Job Settings', 'Settings', 'administrator', __FILE__, 'my_cool_plugin_settings_page' , plugins_url('/images/icon.png', __FILE__));
}

function register_my_cool_plugin_settings() {
	//register our settings
	register_setting( 'my-cool-plugin-settings-group', 'new_option_name' );
	register_setting( 'my-cool-plugin-settings-group', 'some_other_option' );
}
add_action( 'admin_init', 'register_my_cool_plugin_settings' );

function my_cool_plugin_settings_page() {
?>
<div class="wrap">
<h1>Job Settings</h1>

<form method="post" action="options.php">
<?php settings_fields( 'my-cool-plugin-settings-group' ); ?>
<?php do_settings_sections( 'my-cool-plugin-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Currency</th>
        <td><input type="text" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Admin Email</th>
        <td><input type="text" name="some_other_option" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
        </tr>
    </table>
    
<?php submit_button();?>

</form>
</div>
<?php } ?>

<?php
// Manage Custom Columns 
add_filter( 'manage_edit-jobcircular_columns', 'edit_jobcircular_columns' ) ;

function edit_jobcircular_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( '<b>Jobs</b>' ),
		'job_category' => __( '<b>Category</b>' ),
		'company' => __( '<b>Company</b>' ),
		'salary' => __( '<b>Salary</b>' ),
		'vacancy' => __( '<b>Vacancy</b>' ),
		'deadline' => __( '<b>Deadline</b>' ),
		'job-location' => __( '<b>Location</b>' )
	);

	return $columns;
}

function jobcircular_columns( $columns, $post_id ) {
	global $post;

	switch( $columns ) {
		
		case 'job_category' :
			$category =  get_post_meta( $post_id, 'job_category', true );
			echo $category;
			break;

		case 'company' :
			$company =  get_post_meta( $post_id, 'company-name', true );
			echo $company;
			break;
		
		case 'salary' :
			$salary =  get_post_meta( $post_id, 'salary', true );
			echo $salary;
			break;
		
		case 'vacancy' :
			$vacancy =  get_post_meta( $post_id, 'vacancy', true );
			echo $vacancy;
			break;
		
		case 'deadline' :
			$deadline =  get_post_meta( $post_id, 'deadline', true );
			echo $deadline;
			break;
		
		case 'job-location' :
			$joblocation =  get_post_meta( $post_id, 'job-location', true );
			echo $joblocation;
			break;	
		
		
			break;
	}
}

add_action( 'manage_jobcircular_posts_custom_column', 'jobcircular_columns', 10, 2 );
?>