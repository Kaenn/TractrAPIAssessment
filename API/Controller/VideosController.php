<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Controller for the Score action
 */
namespace API\Controller;

include_with_check(DOCUMENT_ROOT . '/API/Controller/BasicMySQLController.php');

class VideosController extends BasicMySQLController{
	
	public function getVideos()
	{
		$videos = [];
		
		$stmt = $this->mysql->prepare('
			SELECT v.id, v.id_youtube, v.author, v.title, v.description, f.name 
			FROM videos as v
			INNER JOIN video_filter as vf
				ON v.id = vf.id_video
			INNER JOIN filters as f
				ON vf.id_filter = f.id
		');
		$stmt->execute();
		while($row = $stmt->fetch()){
			if(!isset($videos[$row['id']])){
				$videos[$row['id']] = [
					'id' => $row['id_youtube'],
					'author' => $row['author'],
					'title' => $row['title'],
					'filters' => [$row['name']]
				];
			}else{
				$videos[$row['id']]['filters'][] = $row['name'];
			}
		}
		
		return array_values($videos);
	}
	
	public function getVideo($id)
	{
		$video = [];
		
		$stmt = $this->mysql->prepare('
			SELECT v.id, v.id_youtube, v.author, v.title, v.description, v.description, f.name
			FROM videos as v
			INNER JOIN video_filter as vf
				ON v.id = vf.id_video
			INNER JOIN filters as f
				ON vf.id_filter = f.id
			WHERE v.id_youtube = :id
		');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		while($row = $stmt->fetch()){
			if(empty($video)){
				$video = [
						'id' => $row['id_youtube'],
						'author' => $row['author'],
						'title' => $row['title'],
						'description' => $row['description'],
						'filters' => [$row['name']]
				];
			}else{
				$video['filters'][] = $row['name'];
			}
		}
		
		return $video;
	}
	
	public function getFilters()
	{
		$filters = [];
		
		$stmt = $this->mysql->prepare('SELECT * FROM filters ORDER BY name');
		$stmt->execute();
		while($row = $stmt->fetch()){
			$filters[] = $row['name'];
		}
		
		return $filters;
	}
}