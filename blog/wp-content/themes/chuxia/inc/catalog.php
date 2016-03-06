<div class="cats mt25">
	<h3 class="h3">分类目录</h3>
	<?php //wp_list_categories('orderby=name&show_count=1&depth=1&style=list&title_li='); ?>
	<ul>
	<?php 
		$orderby = 'name'; 
		$order = 'ASC';
		$depth = 1;
		$show_count = 1;      // 1 for yes, 0 for no
		$pad_counts = 0;      // 1 for yes, 0 for no
		$hierarchical = 1;      // 1 for yes, 0 for no
		$title = '';
		$args = array(
			'order' => $order,
			'orderby' => $orderby,
			'depth' => $depth,
			'show_count' => $show_count,
			'pad_counts' => $pad_counts,
			'hierarchical' => $hierarchical,
			'title_li' => $title 
		);
		$categories = get_categories($args);
		foreach($categories as $category) {
			echo ' <li>';
			echo ' <a href="' . get_category_link( $category->term_id ) . '" title="' . $category->name . '">' . $category->name .'<b>['. $category->category_count . ']</b></a>';
			echo ' </li>';
		}; ?>
		</ul>
</div>