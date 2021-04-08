<?php
/*
*
Template Name: Results
*/
get_header(); 
include('../../../wp-load.php');
global $wpdb;
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

?>
 
    <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
	<div class="container">
	<!-- .result table -->
	<div class="row">	
	
		<div class="col-md-8 col-sm-12 col-xs-12 gt-site-left gt-fixed-sidebar">
			<div class="gt-page-content event_table" id="single_event_result">
			<h3 class="main_heading"> <?php the_title(); ?></h3>
			<div class="serch_event_frm">
			  <div class="row">
			    <div class="col-md-8">	
					<div class="row">
						<div class="serch_event_frm_section">
							<h6>Search Event</h6>
							<form action="" class="event_search__form">
								<div class="col-md-4">
									<select name="event_type">
										<option value="">Event type</option>
										<option value="">Event Name</option>
										<option value="">Event Name</option>
										   
									</select>
								</div>	
								<div class="col-md-3">
									<select name="age_group">
										<option value="">Age group</option>
										<option value="all">All </option>
										<option value="">Youth </option>
										<option value="">Junior	Senior</option>
									</select>
								</div>
								<div class="col-md-3">
									<select name="event_nation">
										<option value=""> Nation</option>
										<option value="">IND</option>
										<option value="">CH</option>
									</select>
								</div>
								<div class="col-md-2">
									<div class="ev_search_btn">
										<button type="button" class="btn btn-danger">GO</button>
									</div>
								</div>
							</form>
						</div>
					</div>	
				
				<hr class="dotted"></hr>
				<div class="row">
					<div class="serch_athletes_frm_section">
						<h6>Athletes  Search</h6>
						<form action="" class="event_search__form">
							<div class="col-md-4">
								<input placeholder="Name (fragment)" type="text">
							</div>	
							<div class="col-md-3">
								<select name="age_group">
									<option>Gender</option>
									<option value="all">All </option>
									<option value="">Man </option>
									<option value="">Woman</option>
								</select>
							</div>
							<div class="col-md-3"> 
								<select name="event_nation">
									<option value=""> Nation</option>
									<option value="">IND</option>
									<option value="">CH</option>
										   
								</select>
							</div>
							<div class="col-md-2">
								<div class="ev_search_btn">
									<button type="button" class="btn btn-danger">GO</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				</div>
				<div class="col-md-4">
					<div id="events_years">
						<div id="next_year">
							<a href="">2020</a>
						</div>
						<div id="current_year">
							<a href="">2019</a>
						</div>
						<div id="prev_year">
							<a href="">2018</a>
						</div>
        			</div>
				</div>
				</div>
			</div>
			
		   <div class="event_result_page">
				<table class="text-center event_result_table">
					<tr class="rs_table_heading">
						<th>Date</th>
						<th>Event</th>
						<th>Place</th>
						 <th>Event Type</th>
					</tr>
					<?php
						$posts = $wpdb->get_results("SELECT * FROM results GROUP BY Participation");
						foreach ($posts as $row){
					?>
					<tr class="_even">
						<td class="r_evnt_date"><a href="http://staging-projects.com/iwlf/?page_id=4806 & event_name= <?= $row->Participation ?>"><?= $row->Dates ?></a></td>
						<td class="r_evnt_nam"><a href="http://staging-projects.com/iwlf/?page_id=4806 & event_name= <?= $row->Participation ?>"><?= $row->Participation ?></a></td>
						<td class="r_evnt_place"><a href="http://staging-projects.com/iwlf/?page_id=4806 & event_name= <?= $row->Participation ?>"><?= $row->Venue ?></a></td>
						<td class="r_evnt_e_typ"><a href="http://staging-projects.com/iwlf/?page_id=4806 & event_name= <?= $row->Participation ?>">
						<?php if($row->Venue=="india"){?>
						<img src="http://staging-projects.com/iwlf/wp-content/uploads/2021/03/orange-national.png">
						<?php }else{ ?>
						<img src="http://staging-projects.com/iwlf/wp-content/uploads/2021/03/green-internation.png"></a></td>
						<?php } ?>
					</tr>
					<?php
						}					
					?>
				</table>
			 </div>
		 </div>
		</div>
		<div class="col-md-4 col-sm-12 col-xs-12 gt-site-left gt-fixed-sidebar">
			<div class="result_ev_sidebar">
			    <?php dynamic_sidebar( 'sidebar-event_side_bar' ); ?>
			</div>
		</div>
	</div>	 
 </main><!-- .site-main -->
 
   
</div><!-- .content-area -->
 
<?php get_footer(); ?>