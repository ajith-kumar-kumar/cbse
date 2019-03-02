public function get_category_video()
     { 
         
         error_reporting(0);
                $result = array(); 
                  $json = file_get_contents('php://input');
                     $obj = json_decode($json);
                    

                     $client_id = $obj->{'client_id'};
                $this->db->order_by('id','DESC');
                $this->db->group_by('category_id');
                $results = $this->db->get_where("gallery",array('status'=>'live','client_id'=>$client_id))->result_array();
                if($row['url'] != '') {
                if(count($results) >0) {
 foreach ($results as $row) {
            $dt['cat_id']=$row['category_id'];
             $dt['catname']= $this->db->get_where("album_category",array('id'=>$row['category_id']))->row()->title;
             $img=$this->db->get_where("album_category",array('id'=>$row['category_id']))->row()->img;
              $dt['thumbnail']=$this->crud_model->file_view('album_category',$row['category_id'],'thumb',$img);
          //  $dt['servicename']=$row['title'];
         //   $dt['servicedesc']=$row['content'];
          //  $dt['serviceimg']=$this->crud_model->file_view('home_service',$row['id'],'no',$row['img']);
          
          
            array_push($result, $dt);
            
        }
        }
        else
        {
             $result["error"] = 1;
        }
                } else {
                    $result["error"] = 404;
                }
         
         echo json_encode($result);
}