<?php

class Posts extends MY_Controller {

	public function Posts() {
		parent::Controller();
	
		$this->load->library('flare');
		
		$this->load->model('post_model');
		$this->load->model('comment_model');
		$this->load->model('category_model');	
	}
	
	public function index() {
		$this->data['posts'] = Post::all();
	}
	
	public function show($id) {
		$this->data['post'] = Post::find($id);
	}
	
	public function add() {
		$this->data['post'] = new Post();
	}
	
	public function create() {
		if ($post = Post::create($this->input->post('post'))) {
			redirect("posts/show/$post");
		} else {
			$this->data['error'] = Post::$db->error();
		}
	}
	
	public function edit($id) {
		$this->data['post'] = Post::find($id);
	}
	
	public function update($id) {
		$post = Post::find($id);
		
		if ($post->update($this->input->post('post'))) {
			redirect("posts/show/$post");
		} else {
			$this->data['error'] = Post::$db->error();
		}
	}
	
	public function delete($id) {
		Post::delete($id);
		redirect("posts");
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */