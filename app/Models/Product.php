<?php

namespace App\Models;
use App\Config\DataBase;

class Product extends BaseElement {

    public function getProductsWithFilters($cat_ids, $brand_ids, $price_from, $price_to, $sort_by){
        $query = "SELECT p.id, b.name AS brand_name, p.name, p.price, i.path_small, i.alt 
        FROM product p 
        INNER JOIN image i ON p.image_id = i.id 
        INNER JOIN brand b ON p.brand_id = b.id ";

        if($cat_ids != null || $brand_ids != null || $price_from != null || $price_to != null){
            $query .= "WHERE ";

            $tmp_query = [];
            if($cat_ids != null){
                $ids_tmp = [];
                foreach($cat_ids as $c_id){
                    $ids_tmp[] = "p.category_id = ".$c_id;
                }
                $query_with_category_ids = implode(" OR ", $ids_tmp)." ";
                $tmp_query[] = $query_with_category_ids;
            }

            if($brand_ids != null){
                $ids_tmp = [];
                foreach($brand_ids as $b_id){
                    $ids_tmp[] = "p.brand_id = ".$b_id;
                }
                $query_with_brand_ids = implode(" OR ", $ids_tmp)." ";
                $tmp_query[] = $query_with_brand_ids;
            }

            if($price_from != null){
                $tmp_query[] = "p.price >= ".$price_from." ";
            }

            if($price_to != null){
                $tmp_query[] = "p.price <= ".$price_to." ";
            }

            $query .= implode(" AND ", $tmp_query);
        }

        if($sort_by != null){
            switch($sort_by){
                case "Latest" : $query .= " ORDER BY p.id ASC"; break;
                case "Highest Price" : $query .= " ORDER BY p.price DESC"; break;
                case "Lowest Price" : $query .= " ORDER BY p.price ASC"; break;
                case "Name Price" : $query .= " ORDER BY p.name"; break;
                default : break;
            }
        }

        return $this->db->executeQuery($query);
    }

    public function getProductsAdmin(){
        $query = "SELECT p.id, c.name AS cat_name, b.name AS brand_name, p.name, p.price, p.description, p.in_stock
        FROM product p
        INNER JOIN image i ON p.image_id = i.id 
        INNER JOIN brand b ON p.brand_id = b.id
        INNER JOIN category c ON p.category_id = c.id";

        $result = $this->db->executeQuery($query);

        foreach($result as $item){
            $colors = self::getProductColors($item->id);
            
            foreach($colors as $item1){
                $item->colors = $colors;
            }
        }
        return $result;
    }

    public static function getProductColors($product_id){
        $query = "SELECT c.id, c.name, c.code 
        FROM color c 
        INNER JOIN product_color pc ON c.id = pc.color_id 
        WHERE pc.product_id = ?";

        return self::$dbase->executeQuery($query, [$product_id]);
    }

    public function getOne(int $id){
        $query = "SELECT p.id, p.brand_id, p.category_id, c.name AS cat_name, b.name AS brand_name, p.name, p.price, p.description, p.in_stock, p.image_id, i.path_big, i.path_small, i.alt
        FROM product p
        INNER JOIN image i ON p.image_id = i.id 
        INNER JOIN brand b ON p.brand_id = b.id
        INNER JOIN category c ON p.category_id = c.id
        WHERE p.id = ?";

        $result = $this->db->executeOneRow($query, [$id]);
        $colors = self::getProductColors($id);

        foreach($colors as $item){
            $result->colors = $colors;
        }
        return $result;
    }

    public function insertProduct($request, $image){
        $base_url = $_SERVER['PHP_SELF'];
        $base_url = str_replace("/index.php", "", $base_url);
        
        $ok = true;

        $img = isset($image['img']) ? $image['img'] : null;
        $name = isset($request['name']) ? $request['name'] : null;
        $desc = isset($request['desc']) ? $request['desc'] : null;
        $price = isset($request['price']) ? $request['price'] : null;
        $in_stock = isset($request['count']) ? $request['count'] : null;
        $brand_id = isset($request['brand_id']) ? $request['brand_id'] : null;
        $cat_id = isset($request['cat_id']) ? $request['cat_id'] : null;
        $color_ids = isset($request['color_ids']) ? $request['color_ids'] : null; //array

        if($img == null || $name == null || $desc == null || $price == null || $in_stock == null || $brand_id == null || $cat_id == null || $color_ids == null){
            $ok = false;
        }

        if(!\intval($price) || !\intval($in_stock) || !\intval($brand_id) || !\intval($cat_id)){
            $ok = false;
        }

        if(is_array($color_ids)){
            foreach($color_ids as $item){
                if(!\intval($item)){
                    $ok = false;
                }
            }
        }
        else{
            $ok = false;
        }

        if($ok){
            $ok1 = true;

            $img_name = $img['name'];
            $img_type = $img['type'];
            $img_size = $img['size'];
            $img_tmp_name = $img['tmp_name'];

            $allowed_types = array("image/jpg", "image/jpeg", "image/png", "image/gif");

            $errors = [];
            
            if(in_array($img_type, $allowed_types)){
                
                // list($width, $height) = getimagesize($img_tmp_name);
                
                // if($width < 701 || $height < 401){
                //     $errors[] = "Minimum width must be 701px & minumun height must be 401px";
                // }
            }
            else{
                $errors[] = "Wrong file type.";
            }

            if($img_size > 8388608){
                $errors[] = "Image must be lover then 8MB";
            }

            if($price > 1000000){
                $errors[] = "Price can not be more then 1m";
            }

            if($in_stock > 1000){
                $errors[] = "In stock can not be more then 1000";
            }

            //$dbi = DataBase::instance();
            $brand = new Brand($this->db);
            $category = new Category($this->db);
            $color = new Color($this->db);

            if(!$brand->getOne($brand_id)){
                $errors[] = "Brand not found";
            }

            if(!$category->getOne($cat_id)){
                $errors[] = "Category not found";
            }

            foreach($color_ids as $c_id){
                if(!$color->getOne($c_id)){
                    $errors[] = "Color not found";
                }
            }

            if(count($errors) == 0){
                \define("UPLOAD_DIR", "app/assets/images/");

                $file_name = time().$img_name;
                $new_path = UPLOAD_DIR.$file_name;

                //upload originalne slike na server
                if(\move_uploaded_file($img_tmp_name, $new_path)){
                    
                    $thumb_big = UPLOAD_DIR."big_".$file_name;
                    $thumb_small = UPLOAD_DIR."small_".$file_name;
                    
                    //velika
                    self::make_thumb($new_path, $thumb_big, 410, 460);
                    //mala
                    self::make_thumb($new_path, $thumb_small, 115, 115);

                    $thumb_big_name = explode("/", $thumb_big);
                    $thumb_small_name = explode("/", $thumb_small);
                    
                    $thumb_big_name = $thumb_big_name[3]; //ovo ide u bazu
                    $thumb_small_name = $thumb_small_name[3]; // i ovo
                    
                    //brisanje originalne slike sa servera
                    \unlink($new_path);
                    
                    $query = "INSERT INTO `image` (`id`, `path_big`, `path_small`, `alt`) VALUES (NULL, ?, ?, ?)";
                    $success = $this->db->executeQueryNonGet($query, [$thumb_big_name, $thumb_small_name, $img_name]);

                    $lastinsertid = $this->db->getLastInsertId();
                    
                    $query = "INSERT INTO `product` (`id`, `name`, `description`, `price`, `in_stock`, `brand_id`, `category_id`, `image_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
                    $success = $this->db->executeQueryNonGet($query, [$name, $desc, $price, $in_stock, $brand_id, $cat_id, $lastinsertid]);

                    $lastinsertid = $this->db->getLastInsertId();

                    $query = "INSERT INTO `product_color` (`id`, `product_id`, `color_id`) VALUES (NULL, ?, ?)";
                    foreach($color_ids as $item){
                        $success = $this->db->executeQueryNonGet($query, [$lastinsertid, $item]);
                    }

                    $query = "INSERT INTO `actions` (`id`, `user_id`, `table_name`, `action`, `notification`, `ip_address`) VALUES (NULL, ?, ?, ?, ?, ?)";
                    $query = $this->db->executeQueryNonGet($query, [$_SESSION['user']->id, "product", "Insert", "Added new Product: ".$name, $_SERVER['REMOTE_ADDR']]);

                    //\header("Location: ".$base_url);
                }
            }
            else{
                $_SESSION['errors'] = $errors;
                //\header("Location: ".$base_url."/adminpanel");
            }
        }
        else{
            //code 400
            \http_response_code(400);
        }
    }

    public function editProduct($request, $image){

        $p_id = isset($request['product_id']) ? $request['product_id'] : null;

        if($p_id == null){
            return;
        }

        $product = $this->getOne($p_id);
        if(!is_object($product)){
            return;
        }

        $ok = true;
        $img = isset($image['img']) ? $image['img'] : $ok = false;
        $name = isset($request['name']) ? $request['name'] : $product->name;
        $desc = isset($request['desc']) ? $request['desc'] : $product->description;
        $price = isset($request['price']) ? $request['price'] : $product->price;
        $in_stock = isset($request['count']) ? $request['count'] : $product->in_stock;
        $brand_id = isset($request['brand_id']) ? $request['brand_id'] : $product->brand_id;
        $cat_id = isset($request['cat_id']) ? $request['cat_id'] : $product->category_id;
        $color_ids = isset($request['color_ids']) ? $request['color_ids'] : $product->colors; //array

        if(!\intval($price) || !\intval($in_stock) || !\intval($brand_id) || !\intval($cat_id)){
            $ok = false;
        }

        if(is_array($color_ids)){
            foreach($color_ids as $item){
                if(is_object($item)){
                    if(!\intval($item->id)){
                        $ok = false;
                    }
                }
                else{
                    if(!\intval($item)){
                        $ok = false;
                    }
                }
            }
        }
        else{
            $ok = false;
        }

        if($ok){
            $ok1 = true;

            $img_name = $img['name'];
            $img_type = $img['type'];
            $img_size = $img['size'];
            $img_tmp_name = $img['tmp_name'];

            $allowed_types = array("image/jpg", "image/jpeg", "image/png", "image/gif");

            $errors = [];
            
            if(in_array($img_type, $allowed_types)){
                
                // list($width, $height) = getimagesize($img_tmp_name);
                
                // if($width < 701 || $height < 401){
                //     $errors[] = "Minimum width must be 701px & minumun height must be 401px";
                // }
            }
            else{
                $errors[] = "Wrong file type.";
            }

            if($img_size > 8388608){
                $errors[] = "Image must be lover then 8MB";
            }

            if($price > 1000000){
                $errors[] = "Price can not be more then 1m";
            }

            if($in_stock > 1000){
                $errors[] = "In stock can not be more then 1000";
            }

            //$dbi = DataBase::instance();
            $brand = new Brand($this->db);
            $category = new Category($this->db);
            $color = new Color($this->db);

            if(!$brand->getOne($brand_id)){
                $errors[] = "Brand not found";
            }

            if(!$category->getOne($cat_id)){
                $errors[] = "Category not found";
            }

            foreach($color_ids as $c_id){
                if(is_object($c_id)){
                    if(!$color->getOne($c_id->id)){
                        $errors[] = "Color not found";
                    }
                }
                else{
                    if(!$color->getOne($c_id)){
                        $errors[] = "Color not found";
                    }
                }
            }

            if(count($errors) == 0){
                \define("UPLOAD_DIR", "app/assets/images/");

                $file_name = time().$img_name;
                $new_path = UPLOAD_DIR.$file_name;

                //upload originalne slike na server
                if(\move_uploaded_file($img_tmp_name, $new_path)){
                    
                    $thumb_big = UPLOAD_DIR."big_".$file_name;
                    $thumb_small = UPLOAD_DIR."small_".$file_name;
                    
                    //velika
                    self::make_thumb($new_path, $thumb_big, 410, 460);
                    //mala
                    self::make_thumb($new_path, $thumb_small, 115, 115);

                    $thumb_big_name = explode("/", $thumb_big);
                    $thumb_small_name = explode("/", $thumb_small);
                    
                    $thumb_big_name = $thumb_big_name[3]; //ovo ide u bazu
                    $thumb_small_name = $thumb_small_name[3]; // i ovo
                    
                    //brisanje originalne slike sa servera
                    \unlink($new_path);

                    \unlink(UPLOAD_DIR.$product->path_small); //brisanje stare male slike
                    \unlink(UPLOAD_DIR.$product->path_big); //brisanje stare velike
                    
                    $query = "UPDATE `image` SET path_big = ?, path_small = ?, alt = ? WHERE id = ?";
                    $success = $this->db->executeQueryNonGet($query, [$thumb_big_name, $thumb_small_name, $img_name, $product->image_id]);
                    
                    $query = "UPDATE `product` SET name = ?, description = ?, price = ?, in_stock = ?, brand_id = ?, category_id = ? WHERE id = ?";
                    $success = $this->db->executeQueryNonGet($query, [$name, $desc, $price, $in_stock, $brand_id, $cat_id, $product->id]);

                    $success = $this->db->executeQueryNonGet("DELETE FROM `product_color` WHERE product_id = ?", [$product->id]);

                    $query = "INSERT INTO `product_color` (`id`, `product_id`, `color_id`) VALUES (NULL, ?, ?)";
                    foreach($color_ids as $item){
                        if(is_object($c_id)){
                            $success = $this->db->executeQueryNonGet($query, [$product->id, $item->id]);
                        }
                        else{
                            $success = $this->db->executeQueryNonGet($query, [$product->id, $item]);
                        }
                    }

                    $query = "INSERT INTO `actions` (`id`, `user_id`, `table_name`, `action`, `notification`, `ip_address`) VALUES (NULL, ?, ?, ?, ?, ?)";
                    $query = $this->db->executeQueryNonGet($query, [$_SESSION['user']->id, "product", "Edit", "Edited Product: ".$name, $_SERVER['REMOTE_ADDR']]);

                    //\header("Location: ".$base_url);
                }
            }
            else{
                $_SESSION['errors'] = $errors;
                \header("Location: ".$base_url."/adminpanel");
            }
        }
        else{
            //code 400
            \http_response_code(400);
        }
    }

    public function deleteProduct($request){
        
        $p_id = isset($request['product_id']) ? $request['product_id'] : null;

        if($p_id == null){
            return 400;
        }

        $product = $this->getOne($p_id);
        if(!is_object($product)){
            return 404;
        }

        \unlink("app/assets/images/".$product->path_small); //brisanje male slike
        \unlink("app/assets/images/".$product->path_big); //brisanje velike

        $query = $this->db->executeQueryNonGet("DELETE FROM cart WHERE product_id = ?", [$product->id]);
        $query = $this->db->executeQueryNonGet("DELETE FROM product_color WHERE product_id = ?", [$product->id]);
        $query = $this->db->executeQueryNonGet("DELETE FROM product WHERE id = ?", [$product->id]);
        $query = $this->db->executeQueryNonGet("DELETE FROM image WHERE id = ?", [$product->image_id]);

        $query = "INSERT INTO `actions` (`id`, `user_id`, `table_name`, `action`, `notification`, `ip_address`) VALUES (NULL, ?, ?, ?, ?, ?)";
        $query = $this->db->executeQueryNonGet($query, [$_SESSION['user']->id, "product", "Delete", "Deleted Product: ".$product->name, $_SERVER['REMOTE_ADDR']]);

        return 204;
    }

    public static function make_thumb($putanja_velika, $putanja_mala, $nova_sirina, $nova_visina){
    
        $podaciSlika=explode('.',$putanja_velika);
        //var_dump($podaciSlika);
        
        $ekstenzija = $podaciSlika[1]; 
    
        if (preg_match('/jpg|jpeg/i',$ekstenzija)){
            $nova_slika = imagecreatefromjpeg($putanja_velika);
        }
    
        if (preg_match('/png/i', $ekstenzija)){
            $nova_slika = imagecreatefrompng($putanja_velika);
        }
    
        $sirina_original = imageSX($nova_slika);
        $visina_original = imageSY($nova_slika);
    
        if ($sirina_original > $visina_original) {
    
            $tmp_sirina = $nova_sirina;
            $tmp_visina = $visina_original * ($nova_visina / $visina_original); 
        }
        if ($sirina_original < $visina_original) {
            $tmp_sirina = $sirina_original * ($nova_sirina / $sirina_original);
            $tmp_visina = $nova_visina;
        }
        if ($sirina_original == $visina_original) {
            $tmp_sirina=$nova_sirina;
            $tmp_visina=$nova_visina;
        }
    
        $izlazna_slika = imagecreatetruecolor($tmp_sirina, $tmp_visina);
    
        imagecopyresampled($izlazna_slika, $nova_slika, 0, 0, 0, 0, $tmp_sirina, $tmp_visina, $sirina_original, $visina_original);
    
        if (preg_match("/png/i",$ekstenzija)){
            imagepng($izlazna_slika, $putanja_mala);
        } else {
              imagejpeg($izlazna_slika, $putanja_mala);
        }
        imagedestroy($izlazna_slika);
        imagedestroy($nova_slika);
    }
}