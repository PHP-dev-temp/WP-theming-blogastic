<?php
	$catSetings = get_option('category-icon-color');
	$terms = get_terms(array(
		'taxonomy' => 'category',
		'hide_empty' => false,
	));
	$awesomeIcons = array(
	'star', 'bank', 'beer', 'asterisk', 'at', 'automobile', 'balance-scale', 'bed', 'bell', 'bicycle', 'binoculars', 'birthday-cake', 'bolt', 'bomb', 'book', 'briefcase', 'bug', 'bus', 'coffee', 'cube', 'desktop', 'diamond', 'envelope', 'fire', 'folder-open', 'gift', 'glass', 'globe', 'hashtag', 'headphones', 'heart', 'home', 'image', 'info', 'key', 'laptop', 'legal', 'magic', 'music', 'paper-plane', 'phone', 'plane', 'shopping-cart', 'tree', 'trophy', 'umbrella', 'user', 'video-camera', 'facebook', 'flickr', 'github', 'google-plus', 'instagram', 'linkedin', 'twitter', 'youtube', 'stop',
	);
?>
	<table class="wp-list-table widefat fixed striped" cellspacing="0">
		<thead>
			<tr>
				<th class="manage-column column-category" scope="col">-- Category --</th>
				<th class="manage-column column-icon" scope="col">--Icon--</th>
				<th class="manage-column column-color" scope="col">--Color--</th>
			</tr>
		</thead>
		<tbody class=" blogastic-cat-table">
<?php	
	$category = array();
	foreach ($terms as $term){
		if ($term->parent == 0){
			$name = trim(esc_html($term->name));
			$category[$name]['icon'] = isset($catSetings[$name]['icon']) ? $catSetings[$name]['icon'] : 'star';
			$category[$name]['color'] = isset($catSetings[$name]['color']) ? $catSetings[$name]['color'] : 'grey';
?>			
			<tr>
				<td class="manage-column column-category" scope="col"><b><?php echo($name); ?></b><input type="hidden" value="<?php echo($term->term_id); ?>" name="category-icon-color[<?php echo($name); ?>][id]" /></td>
				<td class="manage-column column-icon" scope="col"><input type="hidden" value="<?php echo($category[$name]['icon']); ?>" name="category-icon-color[<?php echo($name); ?>][icon]" class="js-pick-icon-<?php echo($name); ?>" /><i class="fa fa-<?php echo($category[$name]['icon']); ?> admin-cat-icon js-icon-picker-open" aria-hidden="true" data-category="<?php echo($name); ?>"></i></td>
				<td class="manage-column column-color" scope="col">
					<input type="text" value="<?php echo($category[$name]['color']); ?>" name="category-icon-color[<?php echo($name); ?>][color]" class="my-color-field" />
				</td>
			</tr>
<?php
		}
	}
?>
		</tbody>
	</table>
		<div class="blogastic-fa-icon-picker">
			<div class="icon-picker-close"><i class="fa fa-times js-icon-picker-close" aria-hidden="true" data-icon=""></i></div>
			<div class="blogastic-fa-icon-picker-container">
<?php
				foreach($awesomeIcons as $icon){
					echo ('<i class="fa fa-' . $icon . ' admin-cat-icon js-icon-picker-close" aria-hidden="true" data-icon="' . $icon . '"></i>');
				}
?>
			</div>
		</div>