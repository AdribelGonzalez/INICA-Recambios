<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');
/**
 * Image Social Option
 *
 */
function option_tree_social( $value, $settings, $int ) 
{ 
?>
  
  
  <div class="option option-option-tree-social">
    
    <div class="lambda-opttitle">
        <div class="lambda-opttitle-pad">
		<?php echo htmlspecialchars_decode( $value->item_title ); ?>
		<span class="infoButton right">
				<img class="infoImage" src="<?php echo OT_PLUGIN_URL; ?>/assets/images/info.png" width="40px" height="20px" alt="Info" style="left: 0px;">
		</span>  
        </div>
    </div>
	<div class="section">
    
        <div class="element">
        
        <?php
        
        $social = array(
            'aim' 			=> 'AIM',
            'twitter' 		=> 'Twitter',
            'facebook' 		=> 'Facebook',
            'googleplus' 	=> 'GooglePlus',
            'flickr' 		=> 'Flickr',
            'forrst' 		=> 'Forrst',
            'instagram' 	=> 'Instagram',
            'picasa' 		=> 'Picasa',
            'fivehundredpx' => '500px',
            'youtube' 		=> 'Youtube',
            'vimeo' 		=> 'Vimeo',
            'dribbble' 		=> 'Dribbble',
            'delicious' 	=> 'Delicious',
            'digg' 			=> 'Digg',
            'dropbox' 		=> 'Dropbox',
            'grooveshark' 	=> 'Grooveshark',
            'pinterest' 	=> 'Pinterest',
            'behance' 		=> 'Behance',
            'deviantart' 	=> 'Deviantart',
            'lastfm' 		=> 'LastFM',
            'soundcloud' 	=> 'Soundcloud',
            'steam'			=> 'Steam',
            'foursquare' 	=> 'Foursquare',
            'github' 		=> 'Github',
            'linkedin' 		=> 'Linkedin',
            'xing' 			=> 'Xing',
            'yahoo' 		=> 'Yahoo',
            'wordpress' 	=> 'Wordpress',
            'tumblr' 		=> 'Tumblr',
            'rss' 			=> 'RSS'
    
        ); ?>
	
        <?php foreach($social as $key => $socialname) { ?>        
        
        <div class="select_wrapper">
            <label><?php echo $socialname; ?></label>
            <input style="width:175px;" type="text" name="<?php echo $value->item_id; ?>[<?php echo $key; ?>]" id="<?php echo $value->item_id; ?>-<?php echo $key; ?>" value="<?php echo ( isset( $settings[$value->item_id][$key] ) ) ? stripslashes( $settings[$value->item_id][$key] ) : ''; ?>" />
    	</div>
		<div class="clear"></div>

        <?php } ?>
        
        </div> 
		
		<?php if($value->item_desc) { ?>
        	<div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode( $value->item_desc ); ?></div>
	    	<div class="clear"></div>       
      	<?php } ?>
        
    </div>
  </div>
<?php
}