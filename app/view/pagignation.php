<?php
#pagignation 
	if ( $this->page == 0)  $this->page = 1;					//if no page var is given, default to 1.
	$prev = $this->page - 1;							//previous page is page - 1
	$next = $this->page + 1;							//next page is page + 1
	$lastpage = ceil($this->total_pages/$this->limit);		//lastpage is = total pages / items per page, rounded up.
	//echo $this->total_pages;
        $lpm1 = $lastpage - 1;						//last page minus 1
	$this->pagination = "";
	if($lastpage > 1)
	{	
	$this->pagination .= "<div class=\"pagination\">";
	//previous button
	if ($this->page > 1) 
	$this->pagination.= '<input type="radio" style="display:none;" id="edit'.$prev.'" name="page" value="'.$prev.'" onclick="this.form.submit()"> <label for="edit'.$prev.'" style="cursor:pointer; "> < </lable> ';
	
	if ($lastpage < 7 + ($this->adjacents * 2))	//not enough pages to bother breaking it up
	{	
	for ($counter = 1; $counter <= $lastpage; $counter++)
	{
	if ($counter == $this->page)
	$this->pagination.= '<label style="color:black;">'.$counter.'</label>';
	else
	$this->pagination.= '<input type="radio" style="display:none;" id="edit'.$counter.'" name="page" value="'.$counter.'" onclick="this.form.submit()"> <label for="edit'.$counter.'" style="cursor:pointer; "> '.$counter.'</lable>';					
	}
	}
	elseif($lastpage > 5 + ($this->adjacents * 2))	//enough pages to hide some
	{
	//close to beginning; only hide later pages
	if($this->page < 1 + ($this->adjacents * 2))		
	{
	for ($counter = 1; $counter < 4 + ($this->adjacents * 2); $counter++)
	{
	if ($counter == $this->page)
	$this->pagination.= '<label style="color:black;">'.$counter.'</label>';
	else
	$this->pagination.= '<input type="radio" style="display:none;" id="edit'.$counter.'" name="page" value="'.$counter.'" onclick="this.form.submit()"> <label for="edit'.$counter.'" style="cursor:pointer; "> '.$counter.'</lable>';					
	}
	$this->pagination.= "...";
	$this->pagination.= '<input type="radio" style="display:none;" id="edit'.$lpm1.'" name="page" value="'.$lpm1.'" onclick="this.form.submit()"> <label for="edit'.$lpm1.'" style="cursor:pointer; "> '.$lpm1.'</lable>';
	$this->pagination.= '<input type="radio" style="display:none;" id="edit'.$lastpage.'" name="page" value="'.$lastpage.'" onclick="this.form.submit()"> <label for="edit'.$lastpage.'" style="cursor:pointer; "> '.$lastpage.'</lable>';		
	}
	//in middle; hide some front and some back
	elseif($lastpage - ($this->adjacents * 2) > $this->page && $this->page > ($this->adjacents * 2))
	{
	$this->pagination.= '<input type="radio" style="display:none;" id="edit1" name="page" value="1" onclick="this.form.submit()"> <label for="edit1" style="cursor:pointer; "> 1 </lable>';
	$this->pagination.= '<input type="radio" style="display:none;" id="edit2" name="page" value="2" onclick="this.form.submit()"> <label for="edit2" style="cursor:pointer; "> 2 </lable>';
	$this->pagination.= "...";
	for ($counter = $this->page - $this->adjacents; $counter <= $this->page + $this->adjacents; $counter++)
	{
	if ($counter == $this->page)
	$this->pagination.= '<label style="color:black;">'.$counter.'</label>';
	else
	$this->pagination.= '<input type="radio" style="display:none;" id="edit'.$counter.'" name="page" value="'.$counter.'" onclick="this.form.submit()"> <label  class="current" for="edit'.$counter.'" style="cursor:pointer; "> '.$counter.'</lable>';					
	}
	$this->pagination.= "...";
	$this->pagination.= '<input type="radio" style="display:none;" id="edit'.$lpm1.'" name="page" value="'.$lpm1.'" onclick="this.form.submit()"> <label  class="current" for="edit'.$lpm1.'" style="cursor:pointer; "> '.$lpm1.'</lable>';					
	$this->pagination.= '<input type="radio" style="display:none;" id="edit'.$lastpage.'" name="page" value="'.$lastpage.'" onclick="this.form.submit()"> <label  class="current" for="edit'.$lastpage.'" style="cursor:pointer; "> '.$lastpage.'</lable>';					
	}
	//close to end; only hide early pages
	else
	{
	$this->pagination.= '<input type="radio" style="display:none;" id="edit1" name="page" value="1" onclick="this.form.submit()"> <label for="edit1" style="cursor:pointer; "> 1</lable>';					
	$this->pagination.= '<input type="radio" style="display:none;" id="edit2" name="page" value="2" onclick="this.form.submit()"> <label for="edit2" style="cursor:pointer; "> 2</lable>';					
	$this->pagination.= "...";
	for ($counter = $lastpage - (2 + ($this->adjacents * 2)); $counter <= $lastpage; $counter++)
	{
	if ($counter == $this->page)
	$this->pagination.= '<label style="color:black;">'.$counter.'</label>';
	else
	$this->pagination.= '<input type="radio" style="display:none;" id="edit'.$counter.'" name="page" value="'.$counter.'" onclick="this.form.submit()"> <label for="edit'.$counter.'" style="cursor:pointer; "> '.$counter.'</lable>';					
	}
	}
	}
	//next button
	if ($this->page < $lastpage) {
	$this->pagination.= '<input type="radio" style="display:none;" id="edit'.$next.'" name="page" value="'.$next.'" onclick="this.form.submit()"> <label for="edit'.$next.'" style="cursor:pointer; "> > </lable>';
        }else{
        }
	}
      
	?>
