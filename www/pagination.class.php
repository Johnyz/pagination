<?php

class Pagination 
{
	protected $active_page;
	private $per_page;
	private $total_items;	
	protected $page_qty;
	private $size;
	protected $url; 
	protected $url_params;
	private $delimiter;
	protected $out = array();
	private $start;
	private $end;

	public function __construct() 
	{
		$this->active_page = 1;
		$this->size = 10;
		$this->per_page = 5;
		$this->delimiter = "&nbsp;";
		$this->url_params = "";
	}
	
	public function setSize($size)
	{
		$this->size = (int)$size;
		return $this;
	}
	public function perPage($per_page)
	{
		$this->per_page = (int)$per_page;
		return $this;
	}
	public function totalItems($total_items)
	{
		$this->total_items = (int)$total_items;
		return $this;
	}
	public function activePage($active_page)
	{
		$this->active_page = (int)$active_page;
		return $this;
	}
	public function setDelimiter($delimiter)
	{
		$this->delimiter = $delimiter;
		return $this;
	}
	public function setUrl($url)
	{
		$this->url = $url;
		return $this;
	}	
	public function setUrlParams($url_params)
	{
		$this->url_params = $url_params;
		return $this;
	}
	
	protected function createLink($page_number)
	{
		if ($this->active_page == $page_number)
		{
			$this->out[] = '<strong>'. $page_number .'</strong>';
		}
		else
		{
			$this->out[] = '<a href="'.$this->url.'/'.$page_number.$this->url_params.'" title="Strana '. $page_number .'">'. $page_number .'</a>';
		}
	}
	protected function createPrev()
	{
		if ($this->active_page - 1 > 0)
		{
			$prev = $this->active_page - 1;
			$this->out[] = '<a href="'.$this->url.'/'.$prev.$this->url_params.'" title="Strana '. $prev .'">prev</a>';
		}
	}
	protected function createNext()
	{
		if ($this->active_page < $this->page_qty)
		{
			$next = $this->active_page + 1;
			$this->out[] = '<a href="'.$this->url.'/'.$next.$this->url_params.'" title="Strana '. $next .'">next</a>';
		}
	}
	protected function createDelimiter()
	{
		$this->out[] = '&hellip;';
	}
	
	
	public function render()
	{
		
		$this->page_qty = ceil($this->total_items / $this->per_page);
		$start = $this->active_page - (floor($this->size / 2));
		$this->start = ($start < 1) ? 1 : (int)$start;
		
		$end = $this->start + $this->size - 1;
		$this->end = ($end > $this->page_qty) ? (int)$this->page_qty : (int)$end;

		$this->createPrev();
		
		if ($this->start > 1) $this->createLink(1);
		if ($this->start > 2) $this->createDelimiter();

		for ($i = $this->start; $i <= $this->end; $i++)
		{	
			$this->createLink($i);
		}
		
		if ($this->end < $this->page_qty)
		{
			if ($this->end + 1 < $this->page_qty) $this->createDelimiter();
			$this->createLink($this->page_qty);
		}
		
		$this->createNext();
	}
	
	public function out($type = 'html')
	{
		return ($type == "html") ? implode("&nbsp;",$this->out) : $this->out;
	}

}

class oldPagination extends Pagination 
{
	protected function createPrev()
	{
		if ($this->active_page - 1 > 0)
		{
			$prev = $this->active_page - 1;
			$this->out[] = '<a href="'.$this->url.'?pg='.$prev.$this->url_params.'" title="Strana '. $prev .'">prev</a>';
		}
	}
	protected function createNext()
	{
		if ($this->active_page < $this->page_qty)
		{
			$next = $this->active_page + 1;
			$this->out[] = '<a href="'.$this->url.'?pg='.$next.$this->url_params.'" title="Strana '. $next .'">next</a>';
		}
	}
	protected function createLink($page_number)
	{
		if ($this->active_page == $page_number)
		{
			$this->out[] = '<strong>'. $page_number .'</strong>';
		}
		else
		{
			$this->out[] = '<a href="'.$this->url.'?pg='.$page_number.$this->url_params.'" title="Strana '. $page_number .'">'. $page_number .'</a>';
		}
	}	
}
