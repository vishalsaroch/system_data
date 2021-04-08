<?php
/*
*
Template Name: Single Event Results
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
				<h5><?php echo $event_name = trim($_GET['event_name'])?></h5>

				<?php
				// echo "SELECT * FROM results WHERE `Participation` = '$event_name'";
					$posts = $wpdb->get_results("SELECT * FROM results WHERE `Participation` = '$event_name'");
					foreach ($posts as $row){
				?>
				<div class="single_event_result">
				  <h3 class="athlete_weight"><?php echo $Snatch=  $row->Snatch?> </h3>
				  
					<table class="single_event_tbl">
					  <tr>
						<th>Rank</th>
						<th>Name</th>
						<th>Nation</th>
						<th>B.weight</th>
						<th>Snatch</th>
						<th>CI&Jerk</th>
						<th> Total</th>
					  </tr>
					  <?php
						$posts = $wpdb->get_results("SELECT * FROM results WHERE `Participation` = '$event_name' AND `Snatch` = '$Snatch'");
						foreach ($posts as $row)
							{
					?>
					  <tr>
						<td class="r_rank"><?= $row->Place?></td>
						<td class="r_name"><?= $row->Name?></td>
						<td class="r_nation"><b><?= $row->Venue?></b></td>
						<td class="r_weight"><?= $row->WtCat?></td>
						<td class="r_snatch"><?= $row->Snatch?></td>
						<td class="r_ci_j"><?= $row->Name?></td>
						<td class="r_total"><b><?= $row->Total?></b></td>
					  </tr>
						<?php } ?>
					</table>
			   </div>
			   <?php } ?>
				<!-- <div class="single_event_result">
				  <h3 class="athlete_weight">56 kg </h3>
					<table class="single_event_tbl">
					  <tr>
						<th>Rank</th>
						<th>Name</th>
						<th>Nation</th>
						<th>B.weight</th>
						<th>Snatch</th>
						<th>CI&Jerk</th>
						<th> Total</th>
					  </tr>
					  <tr>
						<td class="r_rank">1</td>
						<td class="r_name">Jamjang Deru</td>
						<td class="r_nation"><b>Doha, Qatar</b></td>
						<td class="r_weight">56 kg</td>
						<td class="r_snatch">101</td>
						<td class="r_ci_j">141</td>
						<td class="r_total"><b>242</b></td>
					  </tr>
					</table>
			   </div>
			   <div class="single_event_result">
				  <h3 class="athlete_weight">62 kg </h3>
					<table class="single_event_tbl">
					  <tr>
						<th>Rank</th>
						<th>Name</th>
						<th>Nation</th>
						<th>B.weight</th>
						<th>Snatch</th>
						<th>CI&Jerk</th>
						<th> Total</th>
					  </tr>
					  <tr>
						<td class="r_rank">1</td>
						<td class="r_name">Lalu Taku</td>
						<td class="r_nation"><b>Doha, Qatar</b></td>
						<td class="r_weight">62 kg</td>
						<td class="r_snatch">108</td>
						<td class="r_ci_j">142</td>
						<td class="r_total"><b>250</b></td>
					  </tr>
					  <tr>
						<td class="r_rank">2</td>
						<td class="r_name">Deepak Lather</td>
						<td class="r_nation"><b>Doha, Qatar</b></td>
						<td class="r_weight">62 kg</td>
						<td class="r_snatch">115</td>
						<td class="r_ci_j">130</td>
						<td class="r_total"><b>245</b></td>
					  </tr>
					  
					</table>
			   </div> -->
			 </div>  
		 </div>
		 <div class="col-md-4 col-sm-12 col-xs-12 gt-site-left gt-fixed-sidebar">
			<div class="result_ev_sidebar">
			    <?php dynamic_sidebar( 'sidebar-event_side_bar' ); ?>
			</div>
		</div>
		
	</div>
    </main><!-- .site-main -->
 
    <?php get_sidebar( 'content-bottom' ); ?>
	<?php get_sidebar(); ?>
</div><!-- .content-area -->
 
<?php get_footer(); ?>