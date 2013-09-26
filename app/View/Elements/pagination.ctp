<ul class="pagination">	
    <?php
	echo $this->Paginator->prev('<< ', array(), null, array(
	    'class' => 'disabled',
	    'tag' => 'li',
	    'disabledTag' => 'a'
	));
	echo $this->Paginator->numbers(array(
	    'separator' => '',
	    'tag' => 'li',
	    'currentClass' => 'active',
	    'disabledTag' => 'a'
	));
	echo $this->Paginator->next(' >>', array(), null, array(
	    'class' => 'disabled',
	    'tag' => 'li',
	    'disabledTag' => 'a'
	 ));
	?>
</ul>